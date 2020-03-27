<?php

namespace Wallet;

use Wallet\Models\Wallet;
use Wallet\Services\WalletService;
use Wallet\Models\WalletTransaction;
use Psr\Container\ContainerInterface;
use Illuminate\Support\ServiceProvider;
use Wallet\Services\WalletTransactionService;
use Wallet\Services\Contract\WalletServiceInterface;
use Currency\Services\Contract\CurrencyServiceInterface;
use Wallet\Services\Contract\WalletTransactionServiceInterface;

class WalletServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/wallet.php' => config_path('wallet.php')
        ]);

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    public function register()
    {
        $this->app->bind(WalletServiceInterface::class, function (ContainerInterface $container) {
            return new WalletService(
                $container->get(Wallet::class),
                $container->get(WalletTransactionServiceInterface::class)
            );
        });

        $this->app->bind(WalletTransactionServiceInterface::class, function (ContainerInterface $container) {
            return new WalletTransactionService($container->get(WalletTransaction::class));
        });
    }
}
