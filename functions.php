<?php 
$GLOBALS['tables'] = ['rarity','roles', 'types', 'spellaffinity'];

// gets the name of the style attributes
function getAttName($row, $con){
    $table = $GLOBALS['tables'];
    for ($i = 0; $i < count($table); $i++){
        $select = $table[$i].'.name';
        $joinTable = $table[$i];
        $joinA = 'styles.'.$table[$i];
        $joinB = $table[$i].'.id';
        $stmt = $con->prepare("SELECT ".$select." FROM styles JOIN ".$joinTable." ON ".$joinA." = ".$joinB." WHERE styles.ID = ?");
        $stmt->bind_param('i', $row['ID']);
        $stmt->execute();
        $stmt->bind_result($query);
        $stmt->fetch();
        $stmt->close();
       
        echo '<td>';
        echo $query;
        echo '</td>';
    }
}



// gets the names of the values ie role: attacker, def, etc 
function getAttValue($con, $table){
    $sql = "SELECT * FROM $table";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($result)){
        echo '<button type="submit" name="'.$table.'" value="'.$row['ID'].'">'.$row['Name'].'</button>';
    }   
}

// generates style attributes in list on add section
function genStyleAtt($con){
    $tables = $GLOBALS['tables'];
    array_unshift($tables,"characters");

    for ($i = 0; $i < count($tables); $i++){
    $sql = "SELECT * FROM $tables[$i]";
    $result = mysqli_query($con, $sql);

    echo '<select name="'.$tables[$i].'">';
    while ($row = mysqli_fetch_assoc($result)){
        echo '<option value="'.$row['ID'].'">'.$row['Name'].'</option>';
    }
    echo '</select>';
}}


// generate series list
function genCharSeries($con){
        $sql = "SELECT * FROM series";
        $result = mysqli_query($con, $sql);
    
        echo '<select name="series">';
        while ($row = mysqli_fetch_assoc($result)){
            echo '<option value="'.$row['ID'].'">'.$row['Name'].'</option>';
        }
        echo '</select>';
}


?>