<?php


function fizzbuzz($i)
{
    if ($i % 3 == 0 && $i % 5 == 0) {
        return "FizzBuzz";
    } elseif ($i % 3 == 0) {
        return "Fizz";
    } elseif ($i % 5 == 0) {
        return "Buzz";
    } else {
        return "";
    }
}

for ($i = 1; $i <= 100; $i++) {
    echo $i . " " . fizzbuzz($i);
    echo "<br>";
}
