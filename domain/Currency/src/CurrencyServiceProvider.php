<?php

namespace Currency;

use Currency\Models\Currency;
use Currency\Exchange\Manager;
use Currency\Models\CurrencyVault;
use Psr\Container\ContainerInterface;
use Currency\Services\CurrencyService;
use Currency\Exchange\Contract\Factory;
use Illuminate\Support\ServiceProvider;
use Currency\Services\CurrencyVaultService;
use Currency\Services\Contract\CurrencyServiceInterface;
use Currency\Services\Contract\CurrencyVaultServiceInterface;

class CurrencyServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/currency.php' => config_path('currency.php')
        ]);

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/../routes/console.php');
    }

    public function register()
    {
        $this->registerCurrencyService();
        $this->registerCurrencyVaultService();

        $this->app->singleton(Factory::class, Manager::class);
    }

    public function provides()
    {
        return [Factory::class];
    }

    protected function registerCurrencyVaultService()
    {
        $this->app->bind(CurrencyVaultServiceInterface::class, function (ContainerInterface $container) {
            return new CurrencyVaultService($container->get(CurrencyVault::class));
        });
    }

    protected function registerCurrencyService()
    {
        $this->app->bind(CurrencyServiceInterface::class, function (ContainerInterface $container) {
            return new CurrencyService(
                $container->get(Currency::class),
                $container->get(CurrencyVaultServiceInterface::class)
            );
        });
    }
}
