<?php

namespace Hmoradian\FhSms;

use Illuminate\Support\ServiceProvider;

class FhSmsServiceProvider extends ServiceProvider
{
	public function boot()
	{
		$this->mergeConfigFrom(__DIR__.'/../config/fhsms.php', 'fhsms');

		$this->publishes([
			__DIR__.'/../config/fhsms.php' => config_path('fhsms.php'),
		], 'fhsms');
	}


    public function register()
    {
        $this->app->singleton('FhSms', function ($app) {
            $conf = $app['config']['fhsms.services'];

            return new Sms($conf['user_name'], $conf['password'], $conf['phone_number']);
        });
    }
}
