<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
    $this->app->bind(ClientInterface::class, function ($app) {
      return new Client(); // Создает экземпляр Guzzle HTTP клиента
    });
  }

  /**
   * The model to policy mappings for the application.
   *
   * @var array<class-string, class-string>
   */
  protected $policies = [
    // 'App\Models\Model' => 'App\Policies\ModelPolicy',
  ];

  /**
   * Register any authentication / authorization services.
   */
  public function boot(): void
  {
    $this->registerPolicies();

    Gate::define('access-admin-manager', function (User $user) {
      return $user->role == 'super-admin' ||
        $user->role == 'admin' ||
        $user->role == 'manager';
    });
    Gate::define('access-admin', function (User $user) {
      return $user->role == 'super-admin' ||
        $user->role == 'admin';
    });
  }
}
