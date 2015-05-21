<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CsvServiceProvider extends ServiceProvider {

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
		$this->app->bind(
			'csv',
			'App\MyLibs\Csv'
			);
		// $this->app->bindshared('csv', function()
		// {
		// 	return new Csv;
		// });
	}

}
