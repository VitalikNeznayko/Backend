<?php
session_start();
$language = "";
if (isset($_COOKIE['Language:'])) {
    $language = $_COOKIE['Language:'];
}
if ($_SERVER['REQUEST_METHOD'] == "GET" || isset($_COOKIE['Language:'])) {
    if (isset($_GET["lang"]) || isset($_COOKIE['Language:'])) {
        $language = isset($_GET["lang"]) ? $_GET["lang"] : $_COOKIE['Language:'];
        if ($language == "ukr") {
            $language = "українська";
        } else if ($language == "eng") {
            $language = "англійська";
        } else if ($language == "ger") {
            $language = "німецька";
        } else if ($language == "pol") {
            $language = "польська";
        }
        setcookie("Language:", $_GET["lang"], time() + 3600 * 24 * 30 * 6, "/");
    }
}
// Отримання даних з форми
if (!empty($_SESSION))
    $form_data = [
        'login' => $_SESSION['login'],
        'password' => $_SESSION['password'],
        'repassword' => $_SESSION['repassword'],
        'gender' => $_SESSION['gender'],
        'city' => $_SESSION['city'],
        'games' => unserialize($_SESSION['games']),
        'aboutMyself' => $_SESSION['aboutMyself'],
        'path' => $_SESSION['path'],
    ];
?>

<div class="flags">
    <a href="?<?= http_build_query(array_merge($_GET, ['lang' => 'ukr'])) ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="25" viewBox="0 0 8 5">
            <rect width="8" height="5" fill="#f9da49" />
            <rect width="8" height="2.5" fill="#2455b2" />
        </svg>
    </a>
    <a href="?<?= http_build_query(array_merge($_GET, ['lang' => 'eng'])) ?>">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 30" width="40" height="25">
            <clipPath id="t">
                <path d="M25,15h25v15zv15h-25zh-25v-15zv-15h25z" />
            </clipPath>
            <path d="M0,0v30h50v-30z" fill="#012169" />
            <path d="M0,0 50,30M50,0 0,30" stroke="#fff" stroke-width="6" />
            <path d="M0,0 50,30M50,0 0,30" clip-path="url(#t)" stroke="#C8102E" stroke-width="4" />
            <path d="M-1 11h22v-12h8v12h22v8h-22v12h-8v-12h-22z" fill="#C8102E" stroke="#FFF" stroke-width="2" />
        </svg>
    </a>
    <a href="?<?= http_build_query(array_merge($_GET, ['lang' => 'ger'])) ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="25" viewBox="0 0 5 3">
            <desc>Flag of Germany</desc>
            <rect id="black_stripe" width="5" height="3" y="0" x="0" fill="#000" />
            <rect id="red_stripe" width="5" height="2" y="1" x="0" fill="#D00" />
            <rect id="gold_stripe" width="5" height="1" y="2" x="0" fill="#FFCE00" />
        </svg>
    </a>
    <a href="?<?= http_build_query(array_merge($_GET, ['lang' => 'pol'])) ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="25" viewBox="0 0 8 5">
            <rect width="8" height="5" fill="#dc143c" />
            <rect width="8" height="2.5" fill="#fff" />
        </svg>
    </a>
</div>
<?= $language !== "" ? "<h3>Було обрано $language мова</h3>" : "" ?>
<form action="/?page=taskForm/form" enctype="multipart/form-data" method="POST">
    <table>
        <tr>
            <td><label for="login">Логін:</label></td>
            <td><input type="text" name="login" value="<?= isset($form_data['login']) ? $form_data['login'] : "" ?>">
            </td>
        </tr>
        <tr>
            <td><label for="password">Пароль:</label></td>
            <td><input type="password" name="password"
                    value="<?= isset($form_data['password']) ? $form_data['password'] : "" ?>"></td>
        </tr>
        <tr>
            <td><label for=" repassword">Пароль(ще раз):</label></td>
            <td><input type="password" name="repassword"
                    value="<?= isset($form_data['repassword']) ? $form_data['repassword'] : "" ?>"></td>
        </tr>
        <tr>
            <td><label for="gender">Стать:</label></td>
            <td>
                <input type="radio" name="gender" value="Чоловік"
                    <?= $form_data['gender'] === "Чоловік" ? "checked" : "" ?>><label for="male">Чоловік</label>
                <input type="radio" name="gender" value="Жінка"
                    <?= $form_data['gender'] === "Жінка" ? "checked" : "" ?>><label for="female">Жінка</label>
            </td>
        </tr>
        <tr>
            <td><label for="city">Місто:</label></td>
            <td>
                <select name="city" id="">
                    <option value="Житомир" <?= $form_data['city'] === "Житомир" ?  "selected" : "" ?>>Житомир
                    </option>
                    <option value="Київ" <?= $form_data['city'] === "Київ" ? "selected" : "" ?>>Київ</option>
                    <option value="Вінниця" <?= $form_data['city'] === "Вінниця" ? "selected" : "" ?>>Вінниця
                    </option>
                    <option value="Львів" <?= $form_data['city'] === "Львів" ? "selected" : "" ?>>Львів</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Улюблені ігри:</td>
            <td><input type="checkbox" name="games[]" value="Футбол" <?php
                                                                        if (isset($form_data['games']))
                                                                            if (in_array("Футбол", $form_data['games']))
                                                                                echo "checked"; ?>>Футбол</td>
        </tr>
        <tr>
            <td></td>
            <td><input type="checkbox" name="games[]" value="Баскетбол" <?php
                                                                        if (isset($form_data['games']))
                                                                            if (in_array("Баскетбол", $form_data['games']))
                                                                                echo "checked"; ?>>Баскетбол</td>
        </tr>
        <tr>
            <td></td>
            <td><input type="checkbox" name="games[]" value="Волейбол" <?php
                                                                        if (isset($form_data['games']))
                                                                            if (in_array("Волейбол", $form_data['games']))
                                                                                echo "checked"; ?>>Волейбол</td>
        </tr>
        <tr>
            <td></td>
            <td><input type="checkbox" name="games[]" value="Шахи" <?php
                                                                    if (isset($form_data['games']))
                                                                        if (in_array("Шахи", $form_data['games']))
                                                                            echo "checked"; ?>>Шахи</td>
        </tr>
        <tr>
            <td></td>
            <td><input type="checkbox" name="games[]" value="World of Tanks" <?php
                                                                                if (isset($form_data['games']))
                                                                                    if (in_array("World of Tanks", $form_data['games']))
                                                                                        echo "checked"; ?>>World of
                Tanks</td>
        </tr>
        <tr>
            <td><label for="info">Про себе:</label></td>
            <td><textarea name="info" id="" cols="20"
                    rows="5"><?= isset($form_data['aboutMyself']) ? $form_data['aboutMyself'] : "" ?></textarea>
            </td>
        </tr>
        <tr>
            <td><label for="photo">Фотографія:</label></td>
            <td><input type="file" accept="image/png" name="photo"></td>
        </tr>
        <tr>
            <td></td>
            <td><button type="submit">Зареєструватися</button></td>
        </tr>
    </table>
</form>
</body>

</html>