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
		//Instanciar ClientRepositoryEloquent ao chamar ClientRepository
		$this->app->bind(
			\MerezaProject\Repositories\ClientRepository::class,
			\MerezaProject\Repositories\ClientRepositoryEloquent::class
		);

		//Instanciar ProjectRepositoryEloquent ao chamar ProjectRepository
		$this->app->bind(
			\MerezaProject\Repositories\ProjectRepository::class,
			\MerezaProject\Repositories\ProjectRepositoryEloquent::class
		);
	}
}
