<?php 
// generate character list when adding styles
function generate_character_list($connection){

    $query = 'SELECT `ID`, `Name` FROM `Characters` ORDER BY name ASC';
    $statement = $connection->prepare($query);
    $statement->execute();

    while ($row = $statement->fetch()){
        echo "<option value='{$row['ID']}'>{$row['Name']}</option>";
    }
}

?>