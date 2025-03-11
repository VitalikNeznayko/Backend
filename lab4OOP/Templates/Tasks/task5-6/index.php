<?php
require_once('Templates/Tasks/task5-6/classes/Circle.php');


$Circle1 = new Circle(2, 5, 1);

$Circle2 = new Circle(1, 4, 1);

echo "1)" . $Circle1->__toString() . "<br>";
echo "2)" . $Circle2->__toString() . "<br>";

if ($Circle1->circlesCheck($Circle2)) {
    echo 'Кола перетинаються';
} else {
    echo 'Кола не перетинаються';
}
