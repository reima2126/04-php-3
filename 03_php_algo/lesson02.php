<?php
$yen = 1000;   // 購入金額
$product = 150; // 商品金額

function calc($yen, $product)
{
    $change = $yen - $product;

    $a = floor($change / 5000);
    $change -= 5000 * $a;

    $b =  floor($change / 1000);
    $change -= 1000 * $b;

    $c = floor($change / 500);
    $change -= 500 * $c;

    $d = floor($change / 100);
    $change -= 100 * $d;

    $e = floor($change / 50);
    $change -= 50 * $e;

    $f = floor($change / 10);
    $change -= 10 * $f;

    $g = floor($change / 5);
    $change -= 5 * $g;

    $h = floor($change / 1);
    $change -= 1 * $h;




    echo "1万円札で購入した場合";
    echo "<br>";
    echo "1万円札×0枚、5000円札×{$a}枚、1000円札×{$b}枚、500円玉×{$c}枚、100円玉×{$d}枚、
    50円玉×{$e}枚、10円玉×{$f}枚、5円玉×{$g}枚、1円玉×{$h}枚";

    // この関数内に処理を記述
}

if ($yen < 150) {
    $buy = 150 - $yen;
    echo "{$yen}で購入した場合 {$buy}円足りません";
} else {
    calc($yen, $product);
}


// echo floor(9850 / 5000);
// echo floor(4850 / 1000);
// echo floor(850 / 500);
// echo floor(350 / 100);
