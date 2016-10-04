<?php

namespace MerezaProject\Providers;

use Illuminate\Support\ServiceProvider;

class MerezaProjectRepositoryProvider extends ServiceProvider
{
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
			\MerezaProject\Repositories\ClientRepository::class,
			\MerezaProject\Repositories\ClientRepositoryEloquent::class
		);
	}
}