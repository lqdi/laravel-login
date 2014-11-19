<?php
/**
 * Created by PhpStorm.
 * User: anderson.mota
 * Date: 18/11/2014
 * Time: 15:58
 *
 * @author Anderson Mota <anderson.mota@lqdi.net>
 */

namespace Lqdi\LaravelLogin\Controllers;

use Lqdi\LaravelLogin\Auth;
use Controller;
use Input;
use Lang;
use Redirect;
use Request;
use Validator;
use View;

class ProfileController extends Controller {

    /**
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $profile = Auth::getUser();
        return View::make("laravel-login::profile_edit", compact('profile'));
    }

    /**
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function save()
    {
        $profile = Auth::getUser();
        $userId = $profile->getId();

        $validator = Validator::make(Request::all(), array(
            'first_name' => 'max:255',
            'email' => "required|max:255|email|unique:users,email,{$userId}",
            'password' => 'min:8|confirmed'
        ));

        if ($validator->fails()) {
            return Redirect::route('profile.edit')->withErrors($validator->messages());
        }

        $profile->first_name = Input::get('first_name');
        $profile->email = Input::get('email');
        if (Input::has('password')) {
            $profile->password = Input::get('password');
        }
        $profile->save();

        return Redirect::route('profile.edit')->with('message', Lang::get('laravel-login::messages.success_update_profile'));
    }
}