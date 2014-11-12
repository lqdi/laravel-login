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

class ServiceProvider extends \Illuminate\Support\ServiceProvider {

    public function boot()
    {
        $this->package('lqdi/laravel-login', 'laravel-login', __DIR__);
        $this->app['config']->package('lqdi/laravel-login', __DIR__ . '/config');

        $this->app['router']->get('login', array('as' => 'authenticate', 'uses' => 'Lqdi\\LoginLaravel\\Controllers\\AuthenticateController@index'));
        $this->app['router']->post('login', array('as' => 'authenticate', 'uses' => 'Lqdi\\LoginLaravel\\Controllers\\AuthenticateController@in'));

        $this->app['router']->get('forgot', array('as' => 'authenticate.forgot', 'uses' => 'Lqdi\\LoginLaravel\\Controllers\\AuthenticateController@forgot'));
        $this->app['router']->post('forgot', array('as' => 'authenticate.forgot', 'uses' => 'Lqdi\\LoginLaravel\\Controllers\\AuthenticateController@sendResetPasswordCode'));

        $this->app['router']->get('password/reset/{token}', array('as' => 'authenticate.recover', 'uses' => 'Lqdi\\LoginLaravel\\Controllers\\AuthenticateController@defineNewPassword'));
        $this->app['router']->post('password/reset/{token}', array('as' => 'authenticate.recover', 'uses' => 'Lqdi\\LoginLaravel\\Controllers\\AuthenticateController@updatePassword'));

        $this->app['router']->group(array('before' => 'auth.admin'), function() {
            $this->app['router']->get('/', $this->app['config']->get('laravel-login::config.action_root_authenticated'));
        });

        $this->app['router']->filter('auth.laravel-login', function ()
        {
            if (!Sentry::check()) {
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

        $this->app['laravel-login.publish'] = $this->app->share(
            function ($app) {
                //Make sure the asset publisher is registered.
                $app->register('Illuminate\Foundation\Providers\PublisherServiceProvider');
                return new Commands\PublishCommand($app['asset.publisher']);
            }
        );

        $this->commands('laravel-login.publish');
    }
}