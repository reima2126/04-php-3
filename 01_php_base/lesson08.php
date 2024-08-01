<?php
$capital = [
    "日本" => "東京",
    "アメリカ" => "ワシントン",
    "イギリス" => "ロンドン",
    "フランス" => "パリ",
];

foreach($capital as $key=>$countory){
    echo "{$key}の首都は{$countory}です</br>";
}