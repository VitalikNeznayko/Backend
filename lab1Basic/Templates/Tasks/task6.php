<?php
$number = mt_rand(100, 999); //генерування трьохзначного числа
$array = str_split((string)$number); //приведення числа в string і додання елементів до масиву 

/**
 * Сума кожного числа з цифри
 *
 * @param $number int трьохзначне число
 * @param $array масив з елементами числа
 * @return string
 */
function SumOfNumbers($number, $array): string
{
    $suma = 0;
    foreach ($array as $num) {
        $suma += $num;
    }
    return "Сума кожної цифри числа {$number} = {$suma}<br>";
}

/**
 * Перевернення числа в зворотньому порядку
 *
 * @param $number int трьохзначне число
 * @param $array масив з елементами числа
 * @return string
 */
function ReverseNumber($number, $array): string
{
    $reverse = [];
    for ($i = 2; $i >= 0; $i--) {
        array_push($reverse, $array[$i]);
    }
    $reversedString = implode($reverse);
    return "Число {$number} у зворотньому порядку = {$reversedString} <br>";
}
/**
 * Пошук найбільшого можливого числа шляхом сортування
 *
 * @param $array масив з елементами числа
 * @return string
 */
function BiggestPossibleNumber($array): string
{
    arsort($array);
    $biggestNumber = implode($array);
    return "Найбільше можливе число $biggestNumber";
}

echo reverseNumber($number, $array);
echo SumOfNumbers($number, $array);
echo BiggestPossibleNumber($array);