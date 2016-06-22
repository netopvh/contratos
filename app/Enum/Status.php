<?php
/**
 * Created by PhpStorm.
 * User: angelo.neto
 * Date: 14/06/2016
 * Time: 15:13
 */

namespace CodeBase\Enum;

use Greg0ire\Enum\AbstractEnum;

class Status extends AbstractEnum
{

    const V = "Vigente";
    const F = "Finalizado";
    const C = "Cancelado";

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