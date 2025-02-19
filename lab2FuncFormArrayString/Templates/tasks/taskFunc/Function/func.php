<?php

function calcPower($x, $y): int
{
    return pow($x, $y);
}
function calcFactorial($x): float
{
    if ($x > 0) {
        $fact = 1;
        for ($i = $x; $i > 1; $i--) {
            $fact *= $i;
        }
    } else {
        return 0;
    }
    return $fact;
}

function calcSin($x): float
{
    $rad = deg2rad($x);
    return sin($rad);
}
function calcCos($x): float
{
    $rad = deg2rad($x);
    return cos($rad);
}
function calcTg($x): float
{
    $rad = deg2rad($x);
    return tan($rad);
}