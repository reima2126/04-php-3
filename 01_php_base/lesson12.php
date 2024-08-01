<?php
$week = ["日", "月", "火", "水", "木", "金", "土"];

echo date('Y'), "年", date('m'), "月", date('d'), "日";
$date = date('w');
echo " (" . $week[$date] . "曜日)";
