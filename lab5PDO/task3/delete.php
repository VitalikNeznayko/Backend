<?php
function deleteRow($pdo, $selectedIds){
    if (!empty($selectedIds)) {
        $placeholders = implode(',', array_fill(0, count($selectedIds), '?'));
        $sql = "DELETE FROM employees WHERE id IN ($placeholders)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute($selectedIds);

        return $stmt->rowCount();
    } else {
        return 0;
    }
}