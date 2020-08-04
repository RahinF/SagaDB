<?php 
$GLOBALS['tables'] = ['rarity','roles', 'types', 'spellaffinity'];

// get the name of the role
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



// gets the names of the values ie role: attacker, def, etc 
function getAttValue($con){
    $tables = $GLOBALS['tables'];

    for ($i = 0; $i < count($tables); $i++){
    $sql = "SELECT * FROM $tables[$i]";
    $result = mysqli_query($con, $sql);

    echo '<div id="filter-'.$tables[$i].'">';
    
    echo '<select name="filter['.$tables[$i].']">';
    echo '<option value="0">'.$tables[$i].'</option>';
        while ($row = mysqli_fetch_assoc($result)){
            echo '<option value="'.$row['ID'].'">'.$row['Name'].'</option>';
        } 
        echo '</select>';
    echo '</div>'; 
    }
}

// generate character list when adding styles
function genCharList($con){
    $sql = "SELECT * FROM `characters` ORDER BY name ASC";
    $result = mysqli_query($con, $sql);
    
    echo '<select name="style[characters]" required>';
    while ($row = mysqli_fetch_assoc($result)){
        echo '<option value="'.$row['Name'].'">'.$row['Name'].'</option>';
    }
    echo '</select>';
}

// generates style attributes in list on add section
function genStyleAtt($con){
    $tables = $GLOBALS['tables'];
    
    for ($i = 0; $i < count($tables); $i++){
    $sql = "SELECT * FROM $tables[$i]";
    $result = mysqli_query($con, $sql);

    echo '<select name="style['.$tables[$i].']" required>';
        while ($row = mysqli_fetch_assoc($result)){
        echo '<option value="'.$row['ID'].'">'.$row['Name'].'</option>';
        }
    echo '</select>';
    }
}


// generate series list
function genCharSeries($con){
    $sql = "SELECT * FROM series";
    $result = mysqli_query($con, $sql);
    
    echo '<select name="char[series]" required>';
        while ($row = mysqli_fetch_assoc($result)){
            echo '<option value="'.$row['ID'].'">'.$row['Name'].'</option>';
        }
    echo '</select>';
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