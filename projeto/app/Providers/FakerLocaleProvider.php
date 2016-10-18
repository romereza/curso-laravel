<?php

namespace MerezaProject\Providers;

use Illuminate\Support\ServiceProvider;

use Faker\Generator as FakerGenerator;
use Faker\Factory as FakerFactory;

class FakerLocaleProvider extends ServiceProvider
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
		//Setando o Idioma do Faker
		$this->app->singleton(FakerGenerator::class, function () {
			return FakerFactory::create('pt_BR');
		});
	}
}
