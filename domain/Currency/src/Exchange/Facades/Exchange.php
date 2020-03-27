<?php

namespace Currency\Exchange\Facades;

use Illuminate\Support\Facades\Facade;
use Currency\Exchange\Contract\Factory;

/**
 * @method static \Currency\Exchange\Contract\Provider driver(string $driver = null)
 */
class Exchange extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Factory::class;
    }
}
