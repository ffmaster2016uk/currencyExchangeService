<?php

    namespace App\Http\Controllers;

    use App\ExchangeRateApi;
    use App\Services\ExchangeService;
    use Laravel\Lumen\Routing\Controller as BaseController;

    class Controller extends BaseController
    {
        protected $service;

        public function __construct(ExchangeService $service)
        {
            $exchangeRateProvider = new ExchangeRateApi();
            $service->setProvider($exchangeRateProvider);
            $this->service = $service;
        }


        public function getExchangeRates($baseCurrency = null)
        {
            $result = $this->service->getExchangeRates($baseCurrency);

            return response()->json($result);
        }
    }
