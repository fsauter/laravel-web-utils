<?php

use Illuminate\View\Compilers\BladeCompiler;

/**
 * USER extension
 */
Blade::extend(function($view, BladeCompiler $compiler)
{
    $pattern = $compiler->createMatcher('user');

    return preg_replace($pattern, '$1<?php echo user$2; ?>', $view);
});

/**
 * ASSET extension
 */
Blade::extend(function($view, BladeCompiler $compiler)
{
    $pattern = $compiler->createMatcher('asset');

    return preg_replace($pattern, '$1<?php echo asset$2; ?>', $view);
});

/**
 * GRAVATAR extension
 */
Blade::extend(function($view, BladeCompiler $compiler)
{
    $pattern = $compiler->createMatcher('gravatar');

    return preg_replace($pattern, '$1<?php echo gravatar$2; ?>', $view);
});

/**
 * IMG extension
 */
Blade::extend(function($view, BladeCompiler $compiler)
{
    $pattern = $compiler->createMatcher('img');

    return preg_replace($pattern, '$1<?php echo HTML::image$2; ?>', $view);
});

/**
 * CSS extension
 */
Blade::extend(function($view, BladeCompiler $compiler)
{
    $pattern = $compiler->createMatcher('css');

    return preg_replace($pattern, '$1<?php echo HTML::style$2; ?>', $view);
});

/**
 * SCRIPT extension
 */
Blade::extend(function($view, BladeCompiler $compiler)
{
    $pattern = $compiler->createMatcher('script');

    return preg_replace($pattern, '$1<?php echo HTML::script$2; ?>', $view);
});

/**
 * RESOURCE extension
 */
Blade::extend(function($view, BladeCompiler $compiler)
{
    $pattern = $compiler->createMatcher('resource');

    return preg_replace($pattern, '$1<?php Resource::add$2; ?>', $view);
});

/**
 * RESOURCE SCRIPTS extension
 */
Blade::extend(function($view, BladeCompiler $compiler)
{
    $pattern = $compiler->createPlainMatcher('injectScripts');

    return preg_replace($pattern, '$1<?php echo Resource::scripts(); ?>', $view);
});

/**
 * ENVIRONMENT extension
 */
Blade::extend(function($view, BladeCompiler $compiler)
{
    $pattern = $compiler->createPlainMatcher('env');

    return preg_replace($pattern, '$1<?php echo App::environment(); ?>', $view);
});