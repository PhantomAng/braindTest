<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class CurrencyExchangeRate extends CBitrixComponent
{
    function currencyRate($arParams)
    {
        $date = new DateTime();
        $curDate = $date->format('d/m/Y');
        $val = simplexml_load_file("http://www.cbr.ru/scripts/XML_daily.asp?date_req=$curDate&d=0");
        if(!is_string($val)) {
            foreach ($arParams['CURRENCY'] as $param) {
                foreach ($val->Valute as $vt) {
                    if (trim((string)$vt['ID']) == trim((string)$param)) {
                        $temp = (float)$vt->Value;
                        $temp = round($temp, 4);
                        $arResult['RATE'][$param] = $temp;
                        $arResult['NAME'][$param] = (string)$vt->Name;
                    }
                }
            }
        }
        else $arResult = $val;

        return $arResult;
    }
    public function executeComponent()
    {
        $this->arResult = array_merge($this->arResult, $this->currencyRate($this->arParams));
        $this->includeComponentTemplate();
    }
}