<?php
$sql_param_1 = 'mysql:host=localhost;port=8080;dbname=Products_CRUD';
$sql_param_2 = 'root';
$sql_param_3 = 'luge5UCdcUmq04Bi';

function randomString($n)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $str = '';
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $str .= $characters[$index];
    }
    return $str;
}
