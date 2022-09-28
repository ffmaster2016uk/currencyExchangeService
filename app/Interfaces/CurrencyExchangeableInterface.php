<?php

    namespace App\Interfaces;

    use App\OutPutData;

    interface CurrencyExchangeableInterface
    {
        public function getRates() : OutPutData;
    }

