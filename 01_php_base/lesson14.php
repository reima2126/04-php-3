<?php


function randam()
{
    $a = rand(0, 99);
    return $a;
};

for ($i = 0; $i < 10; $i++) {
    $array[] = randam();
};

var_dump($array);
