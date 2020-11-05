<?php

use App\DatosGenerales\Generalidades\IdentificacionesYUsuario;

date_default_timezone_set("America/Guayaquil");
function getNumeroAleatorioUser()
{
    $numero = IdentificacionesYUsuario::select('USID_CODIGO')->where('ID_COD', '17-DIGITOS')->orderBy('FECHA', 'desc')->first();
    $numero_trabajar = 0;
    if (!isset($numero) || $numero == null || $numero == '') {
        $numero_trabajar = 1;
    } else {
        $numero_trabajar = $numero->USID_CODIGO + 1;
    }
    $ceros = "";
    for ($i = strlen($numero_trabajar); $i < 17; $i++) {
        $ceros = "0" . $ceros;
    }

    $numero_nuevo = $ceros . number_format($numero_trabajar, 0, ',', '');

    return $numero_nuevo;
}
function getNumeroAleatorio()
{
    $w_n01 = mt_rand(0, 9);
    $w_n02 = mt_rand(0, 9);
    $w_n03 = mt_rand(0, 9);
    $w_n04 = mt_rand(0, 9);
    $w_n05 = mt_rand(0, 9);
    $w_n06 = mt_rand(0, 9);
    $w_n07 = mt_rand(0, 9);
    $w_n08 = mt_rand(0, 9);
    $w_n09 = mt_rand(0, 9);
    $w_n10 = mt_rand(0, 9);
    $numero_aleatorio = $w_n01 . $w_n02 . $w_n03 . $w_n04 . $w_n05 . $w_n06 . $w_n07 . $w_n08 . $w_n09 . $w_n10;
    return $numero_aleatorio;
}
function getFecha()
{
    $dateTime = new DateTime();
    $fecha = $dateTime->format('Y-m-d');
    return $fecha;
}
function getFechaCoberturaSeguro()
{
    $dateTime = new DateTime();
    $fecha = $dateTime->format('d-m-Y');
    return $fecha;
}
function getTime()
{
    $dateTime = new DateTime();
    $time = $dateTime->format('H:i:s');
    return $time;
}
function getFullTime()
{
    $dateTime = new DateTime();
    $time = $dateTime->format('Y-m-d H:i:s');
    return $time;
}
function addNumberToLeft($number, $length){
    return substr(str_repeat(0, $length).$number, - $length);
}
