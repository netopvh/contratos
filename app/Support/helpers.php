<?php

if (!function_exists('arUrlActive')) {

    function arUrlActive(array $urls, $output = "active")
    {
        foreach ($urls as $url)
        {
            if(request()->segment(1) == $url) return $output;
        }

        return null;
    }
}

if (!function_exists('isUrlActive')) {

    function isUrlActive($url, $output = "active")
    {
        if(URL::current() == url($url)) return $output;

        return null;
    }
}

if (!function_exists('set_upper')) {

    function set_upper($str)
    {
        return strtoupper($str);
    }

}

if (!function_exists('valores')) {

    function valores($data)
    {
        if(strstr($data, ',')){
            $valor = str_replace(",", ".", str_replace('.', '', $data));
        }else{
            $valor = $data;
        }

        return $valor;
    }

}

if (! function_exists('text_limit')){

    function text_limit($text, $limit = 20)
    {
        $text = substr($text, 0, strrpos(substr($text, 0, $limit), ' '));
        return $text;
    }

}

if(! function_exists('mask')){

    function mask($mask, $str){

        $str = str_replace(" ", "", $str);

        for($i = 0; $i < strlen($str); $i++){

            $mask[strpos($mask, "#")] = $str[$i];

        }

        return $mask;

    }

}