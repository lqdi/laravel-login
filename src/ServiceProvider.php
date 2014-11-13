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

use Cartalyst\Sentry\Sentry;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\View;

class ServiceProvider extends \Illuminate\Support\ServiceProvider {

    public function boot()
    {
        $this->package('lqdi/laravel-login', 'laravel-login', __DIR__);
        $this->app['config']->package('lqdi/laravel-login', __DIR__ . '/config');
        View::addNamespace('laravel-login', __DIR__ . '/views');
        Lang::addNamespace('laravel-login', __DIR__ . '/lang');


        $this->app['router']->get('login', array('as' => 'authenticate', 'uses' => 'Lqdi\\LaravelLogin\\Controllers\\AuthenticateController@index'));
        $this->app['router']->post('login', array('as' => 'authenticate', 'uses' => 'Lqdi\\LaravelLogin\\Controllers\\AuthenticateController@in'));

        $this->app['router']->get('forgot', array('as' => 'authenticate.forgot', 'uses' => 'Lqdi\\LaravelLogin\\Controllers\\AuthenticateController@forgot'));
        $this->app['router']->post('forgot', array('as' => 'authenticate.forgot', 'uses' => 'Lqdi\\LaravelLogin\\Controllers\\AuthenticateController@sendResetPasswordCode'));

        $this->app['router']->get('password/reset/{token}', array('as' => 'authenticate.recover', 'uses' => 'Lqdi\\LaravelLogin\\Controllers\\AuthenticateController@defineNewPassword'));
        $this->app['router']->post('password/reset/{token}', array('as' => 'authenticate.recover', 'uses' => 'Lqdi\\LaravelLogin\\Controllers\\AuthenticateController@updatePassword'));

        $this->app['router']->group(array('before' => 'auth.laravel-login'), function() {
            $this->app['router']->get('/', Config::get('laravel-login::config.action_root_authenticated'));
            $this->app['router']->get('logout', array('as' => 'authenticate.out', 'uses' => 'Lqdi\\LaravelLogin\\Controllers\\AuthenticateController@out'));
        });

        $this->app['router']->filter('auth.laravel-login', function()
        {
            if (!(new Sentry)->check()) {
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

    }
}