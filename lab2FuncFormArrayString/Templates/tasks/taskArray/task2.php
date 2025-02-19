<?php
$parts = [
    ["Ре", "Ге", "Лу", "Бар", "Ха", "Мур", "Сні", "Бу"],
    ["к", "р", "на", "сі", "ті", "зі", "жо", "син"],
    ["c", "да", "ра", "к", "ко", "к", "к", "ка"],
];


function generateAnimalName($parts) : string
{
    $name = "";
    if (count($parts) > 0) { //перевірка чи не пустий масив
        for ($i = 0; $i < count($parts); $i++) {
            $randomIndex = rand(0, count($parts[$i]) -1);//обрання рандомного складу з масиву
            $name .= $parts[$i][$randomIndex];//додання складу імені до змінної 

        }
    } else {
        $name = "Без імені";
    }
    return $name;
}
echo "Ім'я для собаки: " . generateAnimalName($parts);
echo "<br>Ім'я для кішки: " . generateAnimalName($parts);
echo "<br>Ім'я для хомяка: " . generateAnimalName($parts);