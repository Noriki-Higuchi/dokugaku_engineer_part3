<?php

$sales = [
    1 => 10,
    2 => 3,
    5 => 1,
    7 => 5,
    10 => 1
];

$max = max($sales);
var_dump($max);
$number = array_keys($sales, $max);
var_dump($number);
