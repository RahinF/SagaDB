<?php 

// get the name of the rarity, role, type, affinity
function getAttName($id, $con, $column, $table){
    $stmt = $con->prepare("

    SELECT X.NAME 
    FROM STYLES S JOIN {$table} X
    ON S.{$column} = X.ID
    WHERE S.ID = ?
    
    ");
    
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($query);
    $stmt->fetch();
    $stmt->close();
    return $query;
}


// generates style attributes in list on add section
function genStyleAtt($con, $table){
    
    $sql = "SELECT `ID`, `Name` FROM $table";
    $result = mysqli_query($con, $sql);
    
        while ($row = mysqli_fetch_assoc($result)){
            echo "<option value='{$row['ID']}'>{$row['Name']}</option>";
        }
}


// generate character list when adding styles
function genCharList($con){
    $sql = "SELECT `Name` FROM `characters` ORDER BY name ASC";
    $result = mysqli_query($con, $sql);
    
    while ($row = mysqli_fetch_assoc($result)){
        echo "<option value='{$row['Name']}'>{$row['Name']}</option>";
    }
}


// gets the series name for characters
function getSeriesName($row, $con){
    $stmt = $con->prepare("

    SELECT S.Name 
    FROM series S JOIN characters C 
    ON S.ID = C.Series 
    WHERE C.Name = ?
    
    ");
    $stmt->bind_param('s', $row['Name']);
    $stmt->execute();
    $stmt->bind_result($query);
    $stmt->fetch();
    $stmt->close();
    return $query;
}


?>