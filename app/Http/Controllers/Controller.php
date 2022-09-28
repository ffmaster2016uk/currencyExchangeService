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


        public function getExchangeRates()
        {
            $result = $this->service->getExchangeRates();

            return response()->json($result);
        }
    }
