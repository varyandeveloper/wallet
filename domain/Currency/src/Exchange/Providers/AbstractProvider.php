<?php

namespace Currency\Exchange\Providers;

use GuzzleHttp\Client;

abstract class AbstractProvider
{
    protected $client;

    protected $url;

    protected $config;

    public function __construct(Client $client, array $config)
    {
        $this->client = $client;
        $this->config = $config;
        $this->url = $config['url'];
    }
}
