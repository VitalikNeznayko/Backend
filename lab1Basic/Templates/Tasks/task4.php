<?php
    $month = [rand(1, 12), rand(1, 12), rand(1, 12)];

    for ($i = 0; $i < count($month); $i++) {
        if ($month[$i] < 3 || $month[$i] === 12) {
            $season = "зима";
        } else if ($month[$i] <  6) {
            $season = "весна";
        } else if ($month[$i] <  9) {
            $season = "літо";
        } else {
            $season = "осінь";
        }
        echo "<p>Номер місяця {$month[$i]} відповідає сезону - {$season} </p>";
    }
