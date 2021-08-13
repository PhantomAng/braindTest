<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Phantom\Local\Helper;

class CurrencyExchangeRate extends CBitrixComponent
{
    protected function currencyRate()
    {
        $help = new Helper();
        $date = new DateTime();
        $curDate = $date->format('d/m/Y');
        if($this->startResultCache($this->arParams['CACHE_TIME'])) {
            $val = simplexml_load_file("http://www.cbr.ru/scripts/XML_daily.asp?date_req=$curDate&d=0");
            if (!is_string($val)) {
                foreach ($this->arParams['CURRENCY'] as $param) {
                    foreach ($val->Valute as $vt) {
                        if (trim((string)$vt['ID']) == trim((string)$param)) {
                            $temp = (float)$vt->Value;
                            $temp = round($temp, 4);
                            $this->arResult['RATE'][$param] = $help->DeclensionOfWords($temp, array('рубль', 'рубля', 'рублей'));
                            $this->arResult['NAME'][$param] = (string)$vt->Name;
                        }
                    }
                }
            }
            else{
                $this->abortResultCache();
            }
        }
        else{
            $this->abortResultCache();
        }
    }

    public function executeComponent()
    {
        $this->currencyRate();
        $this->includeComponentTemplate();
    }
}