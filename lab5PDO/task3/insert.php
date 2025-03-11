<?php

$pdo = new PDO('mysql:host=localhost;dbname=lab5;charset=utf8', 'homeuser', '123456');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT * FROM employees";
$sth = $pdo->prepare($sql);
$sth->execute();
$userData = $sth->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['add'])) {
    foreach ($_POST as $key => $value) {
        if ($key != 'add') {
            $$key = $value;
        }
    }
    $sql = "INSERT INTO employees (name, position, salary) VALUES (:name, :position, :salary)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':position', $position);
    $stmt->bindParam(':salary', $salary);

    $stmt->execute();
}
$types = [
    "id" => "type='number' readonly",
    "name" => "type='text'",
    "position" => "type='text'",
    "salary" => "type='number' step='0.01'",
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .bdtable {
            width: 100%;
            border-collapse: collapse;
            text-align: left;

            th,
            td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: center;
            }

            th {
                background-color: #f2f2f2;
                font-size: 20px;
                text-align: center;
            }

            tr:nth-child(odd) {
                background-color: #f2f2f2;
            }

            tr:hover {
                background-color: #ddd;
            }

            td {
                font-size: 20px;
                color: #333;
            }

        }
    </style>
</head>

<body>
    <h3>Додавання до бази даних</h3>
    <form action="" method="POST">
        <table class="bdtable">
            <tr>
                <th>Ім'я</th>
                <th>Посада</th>
                <th>Зарплата</th>
            </tr>
            <tr>
                <td><input style="width: 100%;" <?= $types['name'] ?> name='name' /></td>
                <td><input style="width: 100%;" <?= $types['position'] ?> name='position' /> </td>
                <td><input style="width: 100%;" <?= $types['salary'] ?> name='salary' /> </td>
            </tr>
        </table>
        <table>
            <tr>
                <td>
                    <input type="submit" value="Додати запис" name="add">
                </td>
            </tr>
        </table>
        <a href="index.php">Повернутися до таблиці</a>
    </form>
</body>

</html>