<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$val = simplexml_load_file("http://www.cbr.ru/scripts/XML_val.asp?d=0");

foreach ($val->Item as $vt)
{
    $tempID = (string)$vt->ParentCode;
    $tempName = (string)$vt->Name;
    $valueVal[$tempID] = $tempName;
}

$arComponentParameters = array(
    "PARAMETERS"=>array(
        "CURRENCY"=>array(
            "PARENT"=>"BASE",
            "NAME"=>"Название валюты",
            "TYPE"=>"LIST",
            "MULTIPLE"=>"Y",
            "DEFAULT"=>"",
            "VALUES"=>$valueVal
        ),
        "CACHE_TIME"=>array(
            'DEFAULT'=> 3600
        )
    )
)

?>