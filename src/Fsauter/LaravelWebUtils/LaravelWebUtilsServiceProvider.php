<?php namespace Fsauter\LaravelWebUtils;

use Illuminate\Support\ServiceProvider;

class LaravelWebUtilsServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('fsauter/laravel-web-utils');

        // Include utility files.
        include __DIR__.'/../../utils.php';
        include __DIR__.'/../../blade.php';
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->app['resourceLoader'] = $this->app->share(function($app)
        {
            return new ResourceLoader;
        });
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('resourceLoader');
	}

}
