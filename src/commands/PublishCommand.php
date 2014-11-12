<?php
/**
 * Created by PhpStorm.
 * User: anderson.mota
 * Date: 12/11/2014
 * Time: 17:42
 *
 * @author Anderson Mota <anderson.mota@lqdi.net>
 */

namespace Lqdi\LaravelLogin\Commands;

use Illuminate\Console\Command;

class PublishCommand extends Command {

    /**
     * @var string
     */
    protected $name = 'laravel-login:publish';

    /**
     * @var string
     */
    protected $description = 'Copy login config for user modification';

}