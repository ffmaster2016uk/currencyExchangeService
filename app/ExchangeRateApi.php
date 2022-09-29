<?php

    namespace App;

    use App\Interfaces\CurrencyExchangeableInterface;
    use Carbon\Carbon;

    class ExchangeRateApi implements CurrencyExchangeableInterface
    {
        protected $key;
        protected $baseCurrency;
        protected $requestDomain = 'https://v6.exchangerate-api.com/v6/';

        public function __construct()
        {
            $this->key = env('EXCHANGE_RATE_API_KEY', '');
            $this->baseCurrency = env('DEFAULT_BASE_CURRENCY', 'EUR');
            $this->requestDomain = $this->requestDomain . $this->key . '/latest/';
        }

        protected function getRequestDomain($currency = null)
        {
            $currency = $currency ? $currency : $this->baseCurrency;
            return $this->requestDomain . $currency;
        }

        public function getRates($currency) : OutPutData
        {

            try{
                $data = json_decode(file_get_contents($this->getRequestDomain($currency)));
            } catch (\Exception $e)
            {
                $data = (object) [
                    'result' => 'error',
                    'message' => $e->getMessage()
                ];
            }

            return $this->convertToOutput($data);

        }

        protected function convertToOutput($data) : OutPutData
        {
            $output = new OutPutData();
            if(is_object($data)) {
                $output->status = property_exists($data, 'result') ? $data->result : null;
                $output->baseCurrency = property_exists($data, 'base_code') ? $data->base_code : null;
                $output->lastUpdate = property_exists($data, 'time_last_update_unix') ? Carbon::parse($data->time_last_update_unix)->format('Y-m-d H:i:s') : null;
                $output->rates = property_exists($data, 'conversion_rates') ? $data->conversion_rates : null;
                $output->message = property_exists($data, 'message') ? $data->message : null;
            }

            return $output;
        }
    }
