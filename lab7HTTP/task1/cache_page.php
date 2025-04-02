<?php
$cache_file = 'cache.html';

function generatePageContent($title, $text)
{
    $content = '<h1>'. $title . '</h1>';
    $content .= '<p>'. $text . '</p>';
    return $content;
}

// http_response_code(404);

if (file_exists($cache_file) && http_response_code() == 200) {
    echo file_get_contents($cache_file);
} else {
    unlink($cache_file);
    ob_start();

    $content = generatePageContent("Some page", "Text");
    echo $content;

    $content = ob_get_contents();

    ob_end_clean();

    if (http_response_code() == 200) {
        file_put_contents($cache_file, $content);
        echo $content;
    } elseif (http_response_code() == 404) {
        if (file_exists($cache_file)) {
            unlink($cache_file);
        }
        echo '<h1>Сторінка не знайдена</h1>';
    }
}
