<?php 
// generate character list when adding styles
function generate_character_list($connection){

    $query = 'SELECT `Name` FROM `Characters` ORDER BY name ASC';
    $statement = $connection->prepare($query);
    $statement->execute();

    while ($row = $statement->fetch()){
        echo "<option value='{$row['Name']}'>{$row['Name']}</option>";
    }
}

?>