<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h2>Курс валют:</h2>
                <?foreach ($arResult['RATE'] as $key => $rate):?>
                    <div class="col-3">
                        <p><span style="font-weight: bolder"><?echo $arResult['NAME'][$key]?>:</span> <? echo $rate?> руб.</p>
                    </div>
                <?endforeach;?>
            </div>
    </div>
</div>
