<?php
require_once("Templates/Tasks/task1-4/autoload.php");

$userModel = new Models\UserModels();
$userController = new Controllers\UserControllers();
$userView = new Views\UserViews();

echo $userModel->getMessage() . "<br>";
echo $userController->getMessage() . "<br>";
echo $userView->getMessage() . "<br>";
