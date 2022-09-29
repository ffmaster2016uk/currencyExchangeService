<?php

    namespace App\Services;

    use App\Interfaces\CurrencyExchangeableInterface;
    use Illuminate\Support\Facades\Cache;

    class ExchangeService
    {
        protected $provider;

        public function setProvider(CurrencyExchangeableInterface $provider)
        {
            $this->provider = $provider;
        }

        public function getExchangeRates($baseCurrency = null)
        {
            $baseCurrency = empty($baseCurrency) ? $baseCurrency : env('DEFAULT_BASE_CURRENCY', 'EUR');
            if (Cache::has($baseCurrency)) {
                return Cache::get($baseCurrency);
            }
            $result = $this->provider->getRates($baseCurrency);
            Cache::put($baseCurrency, $result, env('DEFAULT_CACHE_TTL', 120));
            return $result;
        }
    }
