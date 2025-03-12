<?php

$pdo = new PDO('mysql:host=localhost;dbname=lab5;charset=utf8', 'homeuser', '123456');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT * FROM tov";
$sth = $pdo->prepare($sql);
$sth->execute();
$userData = $sth->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['add'])) {
    foreach ($_POST as $key => $value) {
        if ($key != 'add') {
            $$key = $value;
        }
    }
    $sql = "INSERT INTO tov (name, price, count, note) VALUES (:name, :price, :count, :note)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':count', $count);
    $stmt->bindParam(':note', $note);

    $stmt->execute();
}
$types = [
    "id" => "type='number' readonly",
    "name" => "type='text'",
    "price" => "type='number'",
    "count" => "type='number'",
    "note" => "type='text'"
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
                border: 1px solid gray;
                padding: 8px;
                text-align: center;
            }

            th {
                background-color: rgb(242, 242, 242);
                font-size: 20px;
                text-align: center;
            }

            tr:nth-child(odd) {
                background-color: rgb(242, 242, 242);
            }

            tr:hover {
                background-color: lightgray;
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
                <th>Назва</th>
                <th>Ціна</th>
                <th>Кількість</th>
                <th>Примітка</th>
            </tr>
            <tr>
                <td><input style="width: 100%;" <?= $types['name'] ?> name='name' /></td>
                <td><input style="width: 100%;" <?= $types['price'] ?> name='price' /> </td>
                <td><input style="width: 100%;" <?= $types['count'] ?> name='count' /> </td>
                <td><input style="width: 100%;" <?= $types['note'] ?> name='note' /></td>
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