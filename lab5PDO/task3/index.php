<?php
session_start();
require_once('delete.php');
require_once('change.php');
$pdo = new PDO('mysql:host=localhost;dbname=lab5;charset=utf8', 'homeuser', '123456');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT * FROM employees";
$sth = $pdo->prepare($sql);
$sth->execute();
$userData = $sth->fetchAll(PDO::FETCH_ASSOC);

$types = [
    "id" => "type='number' readonly",
    "name" => "type='text'",
    "position" => "type='text'",
    "salary" => "type='number' step='0.01'",
];
$selectedIds = [];
$selectedData = [];
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST["edit"])) {
        if (isset($_POST["checkbox"]) && !empty($_POST["checkbox"])) {
            $selectedIds = $_POST["checkbox"];
        } else if (isset($_POST['id'])) {
            $selectedIds[] = $_POST["id"];
        }
        $_SESSION['selectedIds'] = implode(", ", $selectedIds);
    }
    if (isset($_POST['save'])  && !empty($selectedIds)) {
        $selectedIds = explode(", ", $_SESSION['selectedIds']);
        foreach ($selectedIds as $id) {
            $selectedData[$id] = [
                'id' => $_POST[$id]['id'],
                'name' => $_POST[$id]['name'],
                'position' => $_POST[$id]['position'],
                'salary' => $_POST[$id]['salary']
            ];
        }
        changeRow($pdo, $selectedData);
        header("Location: index.php");
        die;
    }
    if (isset($_POST["delete"])) {
        if (isset($_POST["checkbox"]) && !empty($_POST["checkbox"])) {
            $selectedIds = $_POST["checkbox"];
        } else if (isset($_POST['id'])) {
            $selectedIds[] = $_POST["id"];
        }
        deleteRow($pdo, $selectedIds);
        header("Location: index.php");
        die;
    }
    if (isset($_POST["add"])) {
        header("Location: insert.php");
        die;
    }
}
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
    <h3>База даних з товарами</h3>
    <form action="" method="POST">
        <table class="bdtable">
            <tr>
                <th></th>
                <th>Номер</th>
                <th>Ім'я</th>
                <th>Посада</th>
                <th>Зарплата</th>
            </tr>
            <?php if (isset($_POST['edit']) && !empty($selectedIds)) : ?>
                <?php foreach ($userData as $row) : ?>
                    <?php if (in_array($row['id'], $selectedIds)) : ?>
                        <tr>
                            <td></td>
                            <td><input style="width: 100%;" <?= $types['id'] ?> name='<?= $row['id'] ?>[id]' value="<?php echo $row['id']; ?>" /></td>
                            <td><input style="width: 100%;" <?= $types['name'] ?> name='<?= $row['id'] ?>[name]' value="<?php echo $row['name']; ?>" /></td>
                            <td><input style="width: 100%;" <?= $types['position'] ?> name='<?= $row['id'] ?>[position]' value="<?php echo $row['position']; ?>" /> </td>
                            <td><input style="width: 100%;" <?= $types['salary'] ?> name='<?= $row['id'] ?>[salary]' value="<?php echo $row['salary']; ?>" /> </td>
                        </tr>
                <?php endif;
                endforeach; ?>
        </table>
        <table>
            <tr>
                <td>
                    <input type="submit" value="Зберегти зміни" name="save">
                </td>
            </tr>
        </table>
    <?php else : ?>
        <?php foreach ($userData as $row) : ?>
            <tr>
                <td><input type="checkbox" name="checkbox[]" value="<?= $row['id'] ?>"></td>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['position']; ?></td>
                <td><?php echo $row['salary']; ?></td>
            </tr>
        <?php endforeach; ?>
        </table>
        <table>
            <tr>
                <td>
                    <input type="submit" value="Додати запис" name="add">
                </td>
                <td></td>
                <td>Оберіть номер товару:</td>
            </tr>
            <tr>
                <td><input type="submit" value="Видалити запис" name="delete"></td>
                <td><input type="submit" value="Змінити запис" name="edit"></td>
                <td><input type="number" name="id"></td>
            </tr>
        </table>
    <?php endif; ?>
    </form>

</body>

</html>