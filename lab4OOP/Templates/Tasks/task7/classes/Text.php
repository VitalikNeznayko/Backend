<?php
class Text
{
    protected static $dir = "Templates/Tasks/task7/text";

    static public function ReadText($filename)
    {
        $path = self::$dir . "/" . $filename; //використовуємо self::, щоб отримати доступ до статичної змінної
        if (is_file($path)) {
            return file_get_contents($path);
        }
    }
    static public function WriteText($filename, $text)
    {
        $path = self::$dir . "/" . $filename; //використовуємо self::, щоб отримати доступ до статичної змінної
        if (is_file($path)) {
            file_put_contents($path, $text . "\n", FILE_APPEND);
            echo "У файл було успішно додано текст";
        }
    }
    static public function ClearText($filename)
    {
        $path = self::$dir . "/" . $filename; //використовуємо self::, щоб отримати доступ до статичної змінної
        if (is_file($path)) {
            file_put_contents($path, "");
            echo "Файл було успішно очищено";
        }
    }
}
