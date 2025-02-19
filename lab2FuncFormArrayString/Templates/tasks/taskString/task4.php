<?php
$startDate = "13-09-2005";
$endDate = "18-02-2025";
$str_date = "Початкова дата: $startDate <br>
    Кінцева дата: $endDate<br>";
$startDate = strtotime($startDate);
$endDate = strtotime($endDate);

$countDayBetweenDate = ceil(($endDate - $startDate) / 60 / 60 / 24);

echo $str_date . "Кількість місяців між датами: " . $countDayBetweenDate / 30 .
    "<br>Кількість днів між датами: $countDayBetweenDate <br>
    Кількість годин між датами: " . $countDayBetweenDate * 24;