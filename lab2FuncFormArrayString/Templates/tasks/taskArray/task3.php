<?php
function createArray(): array
{
    $arr = [];
    for ($i = 0; $i < rand(3, 7); $i++) {
        $arr[$i] = rand(10, 20);
    }
    return $arr;
}

function mergeAndSortUnique(array $arr1, array $arr2): array
{
    echo "Перший масив(" . count($arr1) . " елементів):" . implode(" ", $arr1);

    echo "<br>Другий масив(" . count($arr2) . " елементів):" . implode(" ", $arr2);

    $arr = array_merge($arr1, $arr2); //об'єднання двох масивів в один

    echo "<br>Загальний масив(" . count($arr) . " елементів):" . implode(" ", $arr);

    $arrUnique = array_unique($arr);
    $duplicates = array_diff_assoc($arr, $arrUnique);
    echo "<br>Було видаленні повторювані елементи масиву (" . implode(" ", $duplicates) . "):" . implode(" ", $arrUnique);
    sort($arrUnique);

    return $arrUnique;
}
$arr1 = createArray();
$arr2 = createArray();
$arrUnique = mergeAndSortUnique($arr1, $arr2);
echo "<br>Відсортований масив за зростанням: " . implode(" ", $arrUnique);