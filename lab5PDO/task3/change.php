<?php
function changeRow($pdo, $selectedData)
{
    foreach ($selectedData as $key => $newData) {
        $set = "";
        foreach ($newData as $key => $value) {
            if ($key != "id")
                $set .= "$key = :$key, ";
        }
        $set = rtrim($set, ', ');
        $sql = "UPDATE employees SET $set WHERE id = :id";
        $sthChange = $pdo->prepare($sql);

        foreach ($newData as $key => $value)
            $sthChange->bindValue(":$key", $value);

        $sthChange->bindValue(":id", $newData['id']);
        $sthChange->execute();
    
    }
}
