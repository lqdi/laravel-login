<?php
/**
 * Created by PhpStorm.
 * User: anderson.mota
 * Date: 12/11/2014
 * Time: 15:20
 *
 * @author Anderson Mota <anderson.mota@lqdi.net>
 */

namespace Lqdi\LaravelLogin;

use Lang;
use View;

class ServiceProvider extends \Illuminate\Support\ServiceProvider {

    public function boot()
    {
        $this->package('lqdi/laravel-login', 'laravel-login', __DIR__);
        $this->app['config']->package('lqdi/laravel-login', __DIR__ . '/config');
        View::addNamespace('laravel-login', __DIR__ . '/views');
        Lang::addNamespace('laravel-login', __DIR__ . '/lang');

        $this->app['router']->group(array('namespace' => 'Lqdi\\LaravelLogin\\Controllers'), function() {
            $this->app['router']->get('auth/login', array('as' => 'authenticate', 'uses' => 'AuthenticateController@index'));
            $this->app['router']->post('auth/login', array('as' => 'authenticate', 'uses' => 'AuthenticateController@in'));

            $this->app['router']->get('auth/forgot', array('as' => 'authenticate.forgot', 'uses' => 'AuthenticateController@forgot'));
            $this->app['router']->post('auth/forgot', array('as' => 'authenticate.forgot', 'uses' => 'AuthenticateController@sendResetPasswordCode'));

            $this->app['router']->get('auth/password/reset/{token}', array('as' => 'authenticate.recover', 'uses' => 'AuthenticateController@defineNewPassword'));
            $this->app['router']->post('auth/password/reset/{token}', array('as' => 'authenticate.recover', 'uses' => 'AuthenticateController@updatePassword'));
        });


        $this->app['router']->group(array('before' => 'auth.laravel-login', 'namespace' => 'Lqdi\\LaravelLogin\\Controllers'), function() {
            $this->app['router']->get('auth/logout', array('as' => 'authenticate.out', 'uses' => 'AuthenticateController@out'));

            $this->app['router']->get('auth/profile/edit', array('as' => 'profile.edit', 'uses' => 'ProfileController@edit'));
            $this->app['router']->post('auth/profile/edit', array('as' => 'profile.edit', 'uses' => 'ProfileController@save'));
        });

        $this->app['router']->filter('auth.laravel-login', function()
        {
            if (!Auth::check()) {
                return $this->app['redirect']->route('authenticate');
            }
        });
    }
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        $this->app['auth'] = $this->app->share(function($app)
        {
            // Once the authentication service has actually been requested by the developer
            // we will set a variable in the application indicating such. This helps us
            // know that we need to set any queued cookies in the after event later.
            $app['sentry.loaded'] = true;

            return new Auth(
                $app['sentry.user'],
                $app['sentry.group'],
                $app['sentry.throttle'],
                $app['sentry.session'],
                $app['sentry.cookie'],
                $app['request']->getClientIp()
            );
        });
    }

    /**
     * @return array
     */
    public function provides()
    {
        return array('auth');
    }
}