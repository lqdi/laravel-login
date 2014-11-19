<?php
/**
 * Created by PhpStorm.
 * User: anderson.mota
 * Date: 18/11/2014
 * Time: 13:31
 *
 * @author Anderson Mota <anderson.mota@lqdi.net>
 */

namespace Lqdi\LaravelLogin;

use Cartalyst\Sentry\Facades\Laravel\Sentry;

/**
 * Class Auth
 * @package Lqdi\LaravelLogin
 *
 * @method static \Auth check()
 * @method static \Auth getUser()
 * @method static \Auth logout()
 * @method static \Auth findUserByLogin()
 * @method static \Auth findUserByResetPasswordCode()
 * @method static \Auth authenticate()
 */
class Auth extends Sentry {

}