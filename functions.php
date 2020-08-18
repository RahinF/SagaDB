<?php 
// generate character list when adding styles
function genCharList($pdo){

    $sql = 'SELECT `Name` FROM `Characters` ORDER BY name ASC';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    while ($row = $stmt->fetch()){
        echo "<option value='{$row['Name']}'>{$row['Name']}</option>";
    }
}

?>