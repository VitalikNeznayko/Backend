<?php
session_start();
function checkPassword($password, $repassword): string
{
    if (isset($password) && isset($repassword)) {
        if ($password == $repassword) {
            return "Паролі співпадають<br>";
        } else {
            return "Паролі не співпадають<br>";
        }
    } else {
        return "Пароль не був введений <br>";
    };
}
function uploadingPhoto($file): string
{
    if (isset($_FILES["photo"]["tmp_name"])) {
        $uploadDirectory = 'Templates\tasks\taskForm\photos';
        if (!is_dir($uploadDirectory)) {
            mkdir($uploadDirectory, 0, true);
        }
        $i = uniqid();
        do {
            $path = "$uploadDirectory\{$i}.png";
            $i = uniqid();
        } while (is_file($path));
        move_uploaded_file($file, $path);
        return $path;
    } else {
        echo "Файл не був завантажений або не існує.";
        return "";
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Отримання даних з форми
    $login = $_POST['login'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    $gender = $_POST['gender'];
    $city = $_POST['city'];
    $games = $_POST['games'];
    $aboutMyself = $_POST['info'];
    $file = $_FILES["photo"]["tmp_name"];

    $path = uploadingPhoto($file);

    // Збереження даних у сесії
    $_SESSION['login'] = $login;
    $_SESSION['password'] = $password;
    $_SESSION['repassword'] = $repassword;
    $_SESSION['gender'] = $gender;
    $_SESSION['city'] = $city;
    $_SESSION['games'] = serialize($games);
    $_SESSION['aboutMyself'] = $aboutMyself;
}
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") :
?>
<table>
    <tr>
        <td>Логін:</td>
        <td><?= isset($login) && $login !== "" ? $login : "Логін не був введений" ?></td>
    </tr>
    <tr>
        <td>Пароль:</td>
        <td><?= checkPassword($password, $repassword) ?></td>
    </tr>
    <tr>
        <td>Cтать:</td>
        <td><?= isset($gender) ? $gender : "Стать не встановлена" ?></td>
    </tr>
    <tr>
        <td>Місто:</td>
        <td><?= $city ?></td>
    </tr>
    <tr>
        <td>Улюблені ігри: </td>
        <td>
            <?php
                if (isset($games)) {
                    echo implode(", ", $games);
                } else {
                    echo "Ігри не були обрані";
                }
                ?>
        </td>
    </tr>
    <tr>
        <td>Про себе: </td>
        <td><?php
                if (isset($aboutMyself) && $aboutMyself !== "") {
                    $aboutMyself = nl2br($aboutMyself);
                    echo $aboutMyself;
                } else {
                    echo "Опис не був введений";
                }
                ?></td>
    </tr>
    <tr>
        <td>Фотографія: </td>
        <td>
            <img style="width: 250px; height: 250px;" src="<?= $path ?>" alt="">
        </td>
    </tr>
</table>
<?php else : ?>
<p>Дані не були відправлені.</p>
<?php endif; ?>
<a href="/?page=taskForm/index">Back</a>