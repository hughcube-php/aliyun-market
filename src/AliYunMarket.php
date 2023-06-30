<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2021/4/18
 * Time: 10:31 下午.
 */

namespace HughCube\Laravel\AliYunMarket;

use HughCube\Laravel\ServiceSupport\LazyFacade;
use Illuminate\Support\Str;

/**
 * Class Package.
 *
 * @method static Client client(string $name = null)
 *
 * @see Manager
 * @see ServiceProvider
 */
class AliYunMarket extends LazyFacade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    public static function getFacadeAccessor(): string
    {
        return lcfirst(Str::afterLast(static::class, "\\"));
    }

    /**
     * @inheritDoc
     */
    protected static function registerServiceProvider($app)
    {
        $app->register(ServiceProvider::class);
    }
}
