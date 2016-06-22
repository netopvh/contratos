<?php
/**
 * Created by PhpStorm.
 * User: angelo.neto
 * Date: 10/06/2016
 * Time: 11:53
 */

namespace CodeBase\Enum;

use Greg0ire\Enum\AbstractEnum;

class TipoPessoa extends AbstractEnum
{

    const PF = "Pessoa Física";
    const PJ = "Pessoa Jurídica";

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