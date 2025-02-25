<button onclick="ChangeTask()">Change task</button>
<div class="task1">
    <?php
    function WriteContentsInFile($filename, $name, $comment)
    {
        file_put_contents($filename, "$name:$comment\n", FILE_APPEND);
    }
    function GetContentInFile($filename): array
    {
        $comments_data = file_get_contents($filename);
        $comments_data = explode("\n", $comments_data);
        array_pop($comments_data);
        $nameandCommentsarr = [];
        foreach ($comments_data as $comment) {
            $comment = explode(":", $comment);
            for ($i = 0; $i < count($comment); $i++) {
                $nameandCommentsarr[] = $comment[$i];
            }
        }
        return $nameandCommentsarr;
    }
    ?>

    <form action="" method="POST">
        <table>
            <tr>
                <td>Ім'я</td>
                <td><input type="text" name="name" value="<?= $_POST['name'] ?>" required></td>
            </tr>
            <tr>
                <td>Коментар</td>
                <td><input type="text" name="comment" value="<?= $_POST['comment'] ?>" required></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit">Send</button></td>
            </tr>
        </table>
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $name = $_POST['name'];
        $comment = $_POST['comment'];
        $filePath = "Templates/Tasks/fileTask/files/comments.txt";
        WriteContentsInFile($filePath, $name, $comment);
        $comments = GetContentInFile($filePath);
    }

    if (!empty($comments)) :
    ?>
        <table class=" block-comments">
            <tr>
                <td>Ім'я</td>
                <?php
                for ($i = 0; $i < count($comments); $i++) {
                    if ($i % 2 == 0) {
                        echo "<td>{$comments[$i]}</td>";
                    }
                }
                ?>
            </tr>
            <tr>
                <td>Коментар</td>
                <?php
                for ($i = 0; $i < count($comments); $i++) {
                    if ($i % 2 != 0) {
                        echo "<td>{$comments[$i]}</td>";
                    }
                }
                ?>
            </tr>
        </table>
    <?php endif; ?>
</div>
<div class="task2 dp-none">
    <?php

    $filePath1 = 'Templates/Tasks/fileTask/files/file1.txt';
    $filePath2 = 'Templates/Tasks/fileTask/files/file2.txt';
    $contents1 = file_get_contents($filePath1);
    $contents1 = explode(" ", $contents1);
    $contents2 = file_get_contents($filePath2);
    $contents2 = explode(" ", $contents2);
    function outputFile($filePath)
    {
        $contents = file_get_contents($filePath);
        $contents = explode(" ", $contents);
        echo "<div><h3>" . basename($filePath) . "</h3>";
        for ($i = 0; $i < count($contents); $i++) {
            echo "$contents[$i]<br>";
        }
        echo "</div>";
    }
    function wordsOnlyFirstFile($contents1, $contents2, $path): array
    {
        $contentsUniqued = [];
        foreach ($contents1 as $key) {
            if (!in_array($key, $contents2)) {
                $contentsUniqued[] = $key;
            }
        }
        file_put_contents($path, implode(' ', $contentsUniqued));
        return $contentsUniqued;
    }
    function wordsTwoFiles($contents1, $contents2, $path): array
    {
        $contents = [];
        foreach ($contents1 as $key) {
            if (in_array($key, $contents2)) {
                $contents[] = $key;
            }
        }
        file_put_contents($path, implode(' ', $contents));
        return $contents;
    }
    function wordsMoreTwoTimes($contents1, $contents2, $path): array
    {
        $wordCounts1 = array_count_values($contents1);

        $wordCounts2 = array_count_values($contents2);
        $repeatedWords = [];

        foreach ($wordCounts1 as $word => $count) {
            if (isset($wordCounts2[$word]) && ($count + $wordCounts2[$word]) > 2) {
                $repeatedWords[] = $word;
            }
        }
        file_put_contents($path, implode(' ', $repeatedWords));
        return $repeatedWords;
    }
    function deleteFile($filename)
    {
        unlink("./files/filesForFunction/$filename.txt");
    }
    echo "<div style='display:flex; justify-content: space-around; flex-direction:row'>";
    outputFile($filePath1);
    outputFile($filePath2);
    echo "</div>";

    $filePath_wordsOnlyFirstFile = 'Templates/Tasks/fileTask/files/filesForFunction/wordsMoreTwoTimes.txt';
    $filePath_wordsTwoFiles = 'Templates/Tasks/fileTask/files/filesForFunction/wordsOnlyFirstFile.txt';
    $filePath_wordsMoreTwoTimes = 'Templates/Tasks/fileTask/files/filesForFunction/wordsTwoFiles.txt';
    $filePath_delete = $_POST['fileName'];
    ?>


    <form action="" method="POST">
        <table>
            <tr>
                <td><input type="submit" value="Рядки, які зустрічаються тільки в першому файлі"
                        name="wordsOnlyFirstFile">
                </td>
            </tr>
            <tr>
                <td><input type="submit" value="Рядки, які зустрічаються в обох файлах" name="wordsTwoFiles"></td>
            </tr>
            <tr>
                <td><input type="submit" value="рядки, які зустрічаються в кожному файлі більше двох разів"
                        name="wordsMoreTwoTimes"></td>
            </tr>
            <tr>
                <td>Введіть слово, яке бажаєте видалити</td>
                <td><input type="text" name="fileName"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Видалити"></td>
            </tr>
        </table>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        deleteFile($filePath_delete);
        if (isset($_POST["wordsOnlyFirstFile"])) {
            $wordsOnlyFirstFile = wordsOnlyFirstFile($contents1, $contents2, $filePath_wordsOnlyFirstFile);
        }
        if (isset($_POST["wordsTwoFiles"])) {
            $wordsTwoFiles = wordsTwoFiles($contents1, $contents2, $filePath_wordsTwoFiles);
        }
        if (isset($_POST["wordsMoreTwoTimes"])) {
            $wordsMoreTwoTimes =  wordsMoreTwoTimes($contents1, $contents2, $filePath_wordsMoreTwoTimes);
        }
    }
    echo "<div style='display:flex; justify-content: space-around; flex-direction:row;'>";
    if (is_file($filePath_wordsOnlyFirstFile)) {
        outputFile($filePath_wordsOnlyFirstFile);
    }
    if (is_file($filePath_wordsTwoFiles)) {
        outputFile($filePath_wordsTwoFiles);
    }
    if (is_file($filePath_wordsMoreTwoTimes)) {
        outputFile($filePath_wordsMoreTwoTimes);
    }
    echo "</div>";
    ?>
</div>
<script>
    function ChangeTask() {
        let task1 = document.querySelector('.task1');
        let task2 = document.querySelector('.task2');
        task1.classList.toggle('dp-none');
        task2.classList.toggle('dp-none');
    }
</script>