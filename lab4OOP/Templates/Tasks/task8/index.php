<?php

function autoload($class)
{
    str_replace("\\", "/", $class);
    $path = "Templates/Tasks/task8/$class.php";
    if (file_exists($path)) {
        require_once($path);
    }
}


spl_autoload_register("autoload");

$programmer = new classes\Programmer("Vitalik", 180, 90, 19, ["C#", "C++", "PHP"], 3);
$student = new classes\Student("Bogdan", 170, 80, 20, "Zhytomyr Polytechnic", 2);

echo $programmer->getProgrammingLanguages("0") . "<br>";
echo $programmer->getProgrammingLanguages("") . "<br>";
echo $programmer->getProgrammerInfo();
echo $student->getStudentInfo();

echo $student->setHeight(25);
echo $student->getStudentInfo();
