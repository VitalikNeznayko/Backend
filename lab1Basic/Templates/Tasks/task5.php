<?php

/**
 * Генерування рандомних символів кирилиці
 *
 * @return string
 */
function randomCharacter(): string
{
    $unicode_code = mt_rand(0x410, 0x42F);
    return mb_chr($unicode_code, 'UTF-8');
}

// А, Е, Є, И, І, Ї, О, У, Ю, Я
$symbol = mb_strtolower(randomCharacter(), "UTF-8");
switch ($symbol) {
    case 'а':
    case 'е':
    case 'є':
    case 'и':
    case 'і':
    case 'ї':
    case 'о':
    case 'у':
    case 'ю':
    case 'я': {
            echo "Буква {$symbol} голосна";
            break;
        }
    default: {
            echo "Буква {$symbol} приголосна";

            break;
        }
}