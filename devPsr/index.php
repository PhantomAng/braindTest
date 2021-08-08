<?php
require_once 'vendor/autoload.php';

use Phantom\DevPsr;

$help = new DevPsr\Helper();

$mass = array(
    'Name'=>'Даня',
    'LastName'=>'Логвинов',
    'PHONE'=>array(
        array('ValueType'=>'Рабочий', 'Value'=>'202'),
        array('ValueType'=>'Личный', 'Value'=>'89200825855')
    )
);

$help->Pre($mass);
$help->Pre('Что то тут будет написано');
$arrayWord = array("бублик", "бублика", "бубликов");
$result = $help->DeclensionOfWords(30, $arrayWord);
$help->Pre($result);