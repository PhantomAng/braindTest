<?php

namespace Phantom\DevPsr;

class Helper
{
    /*
     * @param int $num - Число которое нудно просклонять
     * @param array $word - Массив слов для склонения
     * @return string
     * */
    static function DeclensionOfWords($num, $word)
    {
        $val = $num % 10;
        if($val > 19)
            $val = $val % 10;
        $out = $num. ' - ';
        switch ($val){
            case 1:
                $out .= $word[0];
                break;
            case 2:
            case 3:
            case 4:
                $out .= $word[1];
                break;
            default:
                $out .= $word[2];
                break;
        }
        return $out;
    }
    /*
     * @param $value - То что нужно вывести в тегах <pre> </pre>
    */
    static function Pre ($value)
    {
        if(is_array($value)){
            echo '<pre>'; print_r($value); echo '</pre>';
        }
        else{
            echo "<pre> $value </pre>";
        }
    }
}