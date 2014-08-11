<?php namespace Fsauter\LaravelWebUtils\Facades;

use Illuminate\Support\Facades\Facade;

class Resource extends Facade {

    protected static function getFacadeAccessor() { return 'resourceLoader'; }

}