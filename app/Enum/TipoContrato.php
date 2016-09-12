<?php

namespace CodeBase\Enum;

use Greg0ire\Enum\AbstractEnum;

class TipoContrato extends AbstractEnum
{

    const M = "Municipal";
    const E = "Estadual";

    public static function getValue($str)
    {

        foreach(self::getConstants() as $key => $value){

            if($key == $str){
                return $value;
            }

        }

        return false;

    }

}