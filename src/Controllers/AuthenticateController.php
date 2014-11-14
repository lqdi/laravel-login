<?php
/**
 * Created by PhpStorm.
 * User: anderson.mota
 * Date: 12/11/2014
 * Time: 15:56
 *
 * @author Anderson Mota <anderson.mota@lqdi.net>
 */

namespace Lqdi\LaravelLogin\Controllers;

use Cartalyst\Sentry\Throttling\UserBannedException;
use Cartalyst\Sentry\Throttling\UserSuspendedException;
use Cartalyst\Sentry\Users\LoginRequiredException;
use Cartalyst\Sentry\Users\PasswordRequiredException;
use Cartalyst\Sentry\Users\UserNotActivatedException;
use Cartalyst\Sentry\Users\UserNotFoundException;
use Cartalyst\Sentry\Users\WrongPasswordException;
use Illuminate\Support\Facades\Config;
use Illuminate\Routing\Controller;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Cartalyst\Sentry\Users\Eloquent\User;
use Cartalyst\Sentry\Sentry;

class AuthenticateController extends Controller {

    protected $layout = 'laravel-login::layout';

    public function __construct()
    {
        View::share('seoTitle', Lang::get('laravel-login::labels.authenticate') . " | " . Config::get('laravel-login::app_name'));
    }

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        if (!is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return View::make('laravel-login::index');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function out()
    {
        (new Sentry)->logout();
        return Redirect::route('authenticate');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function in()
    {
        try
        {
            (new Sentry)->authenticate(array(
                'email'    => Input::get('email'),
                'password' => Input::get('password'),
            ), (bool) Input::get('remember'));

            return Redirect::action(Config::get("laravel-login::action_root_authenticated"));
        }
        catch (LoginRequiredException $e)
        {
            $message = Lang::get('laravel-login::labels.Login_field_is_required');
        }
        catch (PasswordRequiredException $e)
        {
            $message = Lang::get('laravel-login::labels.password_field_is_required');
        }
        catch (WrongPasswordException $e)
        {
            $message = Lang::get('laravel-login::labels.wrong_password_try_again');
        }
        catch (UserNotFoundException $e)
        {
            $message = Lang::get('laravel-login::labels.user_was_not_found');
        }
        catch (UserNotActivatedException $e)
        {
            $message = Lang::get('laravel-login::labels.user_is_not_activated');
        }
        catch (UserSuspendedException $e)
        {
            $message = Lang::get('laravel-login::labels.user_is_suspended');
        }
        catch (UserBannedException $e)
        {
            $message = Lang::get('laravel-login::labels.user_is_banned');
        }
        catch (\Exception $e)
        {
            $message = Lang::get('laravel-login::labels.authentication_error');
        }

        return Redirect::route('authenticate')->with('message', $message);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forgot()
    {
        return View::make('laravel-login::forgot');
    }

    /**
     * Method: POST
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendResetPasswordCode()
    {
        $validator = Validator::make(Request::all(), ['email' => 'required|email']);

        if ($validator->fails()) {
            Redirect::route('authenticate.forgot')->withErrors($validator->messages());
        }

        $email = Input::get('email');

        try
        {
            /** @var User $user */
            $user = (new Sentry)->findUserByLogin($email);
            $token = $user->getResetPasswordCode();

            Mail::send('laravel-login::emails.reminder', array('token' => $token), function(Message $message) use ($email, $user)
            {
                $message->to($email)
                        ->subject(Lang::get('laravel-login::labels.mail_subject_recover_password', array('app_name' => Config::get('laravel-login::app_name'))));
            });

            return Redirect::route('authenticate')->with('message', Lang::get('laravel-login::messages.success_send_recover_code'));
        }
        catch (UserNotFoundException $e)
        {
            return Redirect::route('authenticate.forgot')->withErrors(Lang::get('laravel-login::exceptions.user_could_not_be_found', ['email' => $email]));
        }
    }

    /**
     * @param string $token
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function defineNewPassword($token)
    {
        try {
            (new Sentry)->findUserByResetPasswordCode($token);

        } catch (UserNotFoundException $e) {
            return Redirect::route('authenticate')->withErrors(Lang::get('laravel-login::exceptions.code_could_not_be_found'));
        }

        return View::make('laravel-login::recover');
    }

    /**
     * Method: POST
     * @param string $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword($token)
    {
        $validator = Validator::make(Request::all(), ['password' => 'required|min:8|confirmed']);

        if ($validator->fails()) {
            return Redirect::route('authenticate.recover', [$token])->withErrors($validator->messages());
        }

        try {
            /** @var User $user */
            $user = (new Sentry)->findUserByResetPasswordCode($token);

            if (!$user->checkResetPasswordCode($token))
            {
                throw new UserNotFoundException();
            }

            if (!$user->attemptResetPassword($token, Input::get('password')))
            {
                return Redirect::route('authenticate.recover', [$token])->withErrors(Lang::get('laravel-login::messages.error_update_password'));
            }
        }
        catch (UserNotFoundException $e)
        {
            return Redirect::route('authenticate')->withErrors(Lang::get('laravel-login::exceptions.code_could_not_be_found'));
        }

        return Redirect::route('authenticate')->with('message', Lang::get('laravel-login::messages.success_recover_password'));
    }
}