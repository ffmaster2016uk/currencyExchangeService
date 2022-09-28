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
            $this->baseCurrency = env('BASE_CURRENCY', 'EUR');
            $this->requestDomain = $this->requestDomain . $this->key . '/latest/' . $this->baseCurrency;
        }

        public function getRates() : OutPutData
        {
            $data = json_decode(file_get_contents($this->requestDomain));
            return $this->convertToOutput($data);

        }

        protected function convertToOutput($data) : OutPutData
        {
            $output = new OutPutData();
            $output->status = $data->result;
            $output->baseCurrency = $data->base_code;
            $output->lastUpdate = Carbon::parse($data->time_last_update_unix)->format('Y-m-d H:i:s');
            $output->rates = $data->conversion_rates;

            return $output;
        }
    }
