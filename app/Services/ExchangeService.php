<?php

    namespace App\Services;

    use App\Interfaces\CurrencyExchangeableInterface;

    class ExchangeService
    {
        protected $provider;

        public function setProvider(CurrencyExchangeableInterface $provider)
        {
            $this->provider = $provider;
        }

        public function getExchangeRates()
        {
            return $this->provider->getRates();
        }
    }
