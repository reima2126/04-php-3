<?php
$array = [10, 60, 90, 70, 50];

function test($a)
{
    if ($a > 80) {
        echo "{$a} 点は優です";
    } elseif ($a > 60) {
        echo "{$a} 点は良です";
    } elseif ($a > 40) {
        echo "{$a} 点は可です";
    } elseif ($a < 40) {
        echo "{$a} 点は不可です";
    }
}

foreach ($array as $point) {
    test($point);
    echo "</br>";
}
