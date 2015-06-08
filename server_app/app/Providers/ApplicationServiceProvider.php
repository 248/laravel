<?php namespace App\Providers;

use App\Database\Manager as DB;
use Illuminate\Support\ServiceProvider;

class ApplicationServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bindShared('dbal', function($app) {
			return new DB($app['config']);
		}
		);
	}

}
