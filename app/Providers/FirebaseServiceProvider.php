<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging;


class FirebaseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
      $this->app->singleton(Messaging::class, function ($app) {
        $serviceAccount = storage_path('app/firebase/dev-naporoge-34683983dfb4.json');
        $factory = (new Factory)->withServiceAccount($serviceAccount);

        $messaging = $factory->createMessaging();
        return $messaging;
      });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
