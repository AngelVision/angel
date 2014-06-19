<?php namespace Angel\Core;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;

class CoreServiceProvider extends ServiceProvider {

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
		$this->package('angel/core');

		include __DIR__ . '/Helpers.php';
		include __DIR__ . '/ToolBelt.php';
		include __DIR__ . '../../../routes.php';
		include __DIR__ . '../../../filters.php';
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		App::bind('Menu', function() {
			return new \Angel\Core\Menu;
		});
		App::bind('MenuItem', function() {
			return new \Angel\Core\MenuItem;
		});
		App::bind('Page', function() {
			return new \Angel\Core\Page;
		});
		App::bind('PageModule', function() {
			return new \Angel\Core\PageModule;
		});
		App::bind('Setting', function() {
			return new \Angel\Core\Setting;
		});


		App::bind('PageController', function() {
			return new \Angel\Core\PageController;
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
