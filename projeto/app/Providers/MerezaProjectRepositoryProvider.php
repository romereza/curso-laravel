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

		//Instanciar ProjectNoteRepositoryEloquent ao chamar ProjectNoteRepository
		$this->app->bind(
			\MerezaProject\Repositories\ProjectNoteRepository::class,
			\MerezaProject\Repositories\ProjectNoteRepositoryEloquent::class
		);

		//Instanciar ProjectTaskRepositoryEloquent ao chamar ProjectTaskRepository
		$this->app->bind(
			\MerezaProject\Repositories\ProjectTaskRepository::class,
			\MerezaProject\Repositories\ProjectTaskRepositoryEloquent::class
		);

	}
}
