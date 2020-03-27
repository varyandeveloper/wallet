<?php

namespace Currency\Exchange\Providers;

use Currency\Exchange\Rate;
use Illuminate\Support\Collection;
use Currency\Exchange\Contract\Provider;

class ExchangeRateApi extends AbstractProvider implements Provider
{
    public function rates(string $base, string ...$symbols): Collection
    {
        $query = $this->config['key'];

        $query['base'] = $base;
        $query['symbols'] = implode(',', $symbols);

        $response = $this->client->get($this->url . 'latest?' . http_build_query($query));

        if ($response->getStatusCode() === 200) {
            $data = json_decode($response->getBody(), true);

            $prototype = new Rate;
            $prototype->setDate(new \DateTimeImmutable($data['date']));
            $rates = [];

            foreach ($symbols as $symbol) {
                $clone = clone $prototype;
                $clone
                    ->setCode($symbol)
                    ->setRate($data['rates'][$symbol])
                ;
                $rates[] = $clone;
            }

            return collect($rates);
        }

        return collect();
    }
}
