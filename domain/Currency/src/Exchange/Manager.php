<?php

namespace Currency\Exchange;

use GuzzleHttp\Client;
use Currency\Exchange\Contract\Factory;
use Currency\Exchange\Providers\ExchangeRateApi;

class Manager extends \Illuminate\Support\Manager implements Factory
{
    protected function createExchangeRateApiDriver()
    {
        $config = $this->config->get('currency.providers.exchange_rate_api');
        return $this->buildProvider(ExchangeRateApi::class, $config);
    }

    public function buildProvider($provider, $config)
    {
        return new $provider(
            $this->container->get(Client::class),
            $config
        );
    }

    public function getDefaultDriver()
    {
        return $this->config->get('currency.providers.default');
    }
}
