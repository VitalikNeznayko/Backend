<?php
$arr = [];

for ($i = 0; $i < 10; $i++) {
    $arr[] = mt_rand(1, 9);
}
echo "Створений масив: ";
for ($i = 0; $i < 10; $i++) {
    echo $arr[$i];
}
repeatSymbols($arr);
function repeatSymbols($arr): void
{
    $repeatSymbols = [];
    for ($i = 0; $i < count($arr); $i++) {
        for ($j = $i + 1; $j < count($arr); $j++) {
            if ($arr[$i] == $arr[$j]) {
                if (!in_array($arr[$i], $repeatSymbols)) { //перевірка чи такий символ вже є в масиві
                    $repeatSymbols[] = $arr[$i];
                }
                break; //уникнути додаткових перевірок для цього елемента
            }
        }
    }
    // Виводимо елементи, що повторюються
    echo "<br>Повторюються: ";
    for($i = 0; $i < count ($repeatSymbols); $i++) {
        echo $repeatSymbols[$i] . " ";
    }
}