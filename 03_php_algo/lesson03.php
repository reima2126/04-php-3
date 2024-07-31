<?php

$num1 = 1;  // 分子
$deno1 = 10; // 分母
$num2 = 5;  // 分子
$deno2 = 6; // 分母

function calcFraction($num1, $deno1, $num2, $deno2)
{
  // この関数内に処理を記述
  $denolcm = lcm($deno1, $deno2);
  $sumnum = ($num1 * ($denolcm / $deno1)) + ($num2 * ($denolcm / $deno2));
  echo "{$num1}/{$deno1} + {$num2}/{$deno2} = ";

  $numgcd = gcd($sumnum, $denolcm);
  $a = $sumnum / $numgcd;
  $b = $denolcm / $numgcd;
  echo "{$a}/{$b}";
}

// 最大公約数
function gcd($m, $n)
{
  if ($n > $m) list($m, $n) = array($n, $m);

  while ($n !== 0) {
    $tmp_n = $n;
    $n = $m % $n;
    $m = $tmp_n;
  }
  return $m;
}

// 最小公倍数
function lcm($m, $n)
{
  return $m * $n / gcd($m, $n);
}

calcFraction($num1, $deno1, $num2, $deno2);
