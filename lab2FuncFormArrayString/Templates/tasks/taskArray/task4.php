<?php
function sortArray($users, $parameter)
{
    if ($parameter === "вік") {
        asort($users);
    } else if ($parameter === "ім'я") {
        ksort($users);
    }
    return $users;
}
$users = [
    "Віталік" => 18,
    "Дмитро" => 19,
    "Василь" => 21,
    "Богдан" => 20,
    "Назарій" => 18,
    "Тарас" => 17,
];
echo "Вказаний параметр 'вік': <br>";
$users = sortArray($users, "вік");
foreach ($users as $key => $value) {
    echo "Ім'я: " . $key . " Вік: " . $value . " років<br>";
}
echo "<br>Вказаний параметр 'ім'я': <br>";

$users = sortArray($users, "ім'я");
foreach ($users as $key => $value) {
    echo "Ім'я: " . $key . " Вік: " . $value . " років<br>";
}