<form action="" method="post">
    <table>
        <tr>
            <td><label for="text">Text:</label></td>
            <td><textarea type="text" name="text"><?= $_POST["text"] ?></textarea></td>
        </tr>
        <tr>
            <td><label for=" search">Search:</label></td>
            <td><input type="text" name="search" value="<?= $_POST["search"] ?>"></td>
        </tr>
        <tr>
            <td><label for="replace">Replace:</label></td>
            <td><input type="text" name="replace" value="<?= $_POST["replace"] ?>"></td>
        </tr>
        <tr>
            <td></td>
            <td><button type="submit">Send</button></td>
        </tr>
        <tr>
            <td><label>Result:</label>
            </td>
            <td>
                <?= ReplaceText() ?>
            </td>
        </tr>
    </table>
</form>
<?php
function ReplaceText(): string
{
    if (isset($_POST["text"]) && isset($_POST["search"]) && isset($_POST["replace"])) {
        $outputText = $_POST["text"];
        $searchText = $_POST["search"];
        $replaceText = $_POST["replace"];
        $value = str_replace($searchText, $replaceText, $outputText);
        return $value;
    } else {
        return "";
    }
}
?>