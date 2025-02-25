<?php

function uploadingPhoto($file)
{
    if (isset($file)) {
        $uploadDirectory = 'Templates/Tasks/formTask/photos';
        if (!is_dir($uploadDirectory)) {
            mkdir($uploadDirectory, 0, true);
        }
        $i = uniqid();
        do {
            $path = "$uploadDirectory/{$i}.png";
            $i = uniqid();
        } while (is_file($path));
        move_uploaded_file($file, $path);
    } else {
        echo "Файл не був завантажений або не існує.";
    }
}
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $photo = $_FILES["photo"]["tmp_name"];
    uploadingPhoto($photo);
}

?>

<form action="" method="POST" enctype="multipart/form-data">
    <table>
        <tr>
            <td>Загрузіть фото:</td>
            <td><input type="file" accept="image/png,.jpg" name="photo" id=""></td>
        </tr>
        <tr>
            <td></td>
            <td><button type="submit">Send</button></td>
        </tr>
    </table>
</form>
<?php
$path = "Templates/Tasks/formTask/photos";
$pathPhotos = scandir($path);
for ($i = 2; $i < count($pathPhotos); $i++) {
    echo "<img src='$path/{$pathPhotos[$i]}' alt=''>";
}
?>