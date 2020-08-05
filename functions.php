<?php 

// get the name of the rarity
function getRarityName($id, $con){
    $stmt = $con->prepare("

    SELECT R.NAME 
    FROM STYLES S JOIN RARITY R
    ON S.RARITY = R.ID
    WHERE S.ID = ?
    
    ");
    
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($query);
    $stmt->fetch();
    $stmt->close();
    return $query;
}

// get the name of the role
function getRoleName($id, $con){
    $stmt = $con->prepare("

    SELECT R.NAME 
    FROM STYLES S JOIN ROLES R
    ON S.ROLE = R.ID
    WHERE S.ID = ?
    
    ");
    
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($query);
    $stmt->fetch();
    $stmt->close();
    return $query;
}

// get the name of the type
function getTypeName($id, $con){
    $stmt = $con->prepare("

    SELECT T.NAME 
    FROM STYLES S JOIN TYPES T
    ON S.TYPE = T.ID
    WHERE S.ID = ?
    
    ");
    
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($query);
    $stmt->fetch();
    $stmt->close();
    return $query;
}

// get the name of the spell affinity
function getSpellAffName($id, $con){
    $stmt = $con->prepare("

    SELECT SA.NAME 
    FROM STYLES S JOIN SPELLAFFINITY SA
    ON S.SPELLAFFINITY = SA.ID
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