<?php
date_default_timezone_set('Asia/Tokyo');
echo date('Y年m月d日 G時i分s秒');
echo "</br>";
echo date('Y年m月d日 G時i分s秒', strtotime("+3day"));
echo "</br>";
echo date('Y年m月d日 G時i分s秒', strtotime("-12hour"));
echo "</br>";
$today = new DateTime('now');
$day = new DateTime('2020-01-01');
$diff = $day->diff($today);
echo $diff->days;
