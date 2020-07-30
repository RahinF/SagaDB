<?php 

// gets the name of the style attributes
function getAttName($row, $con){
    $tables = ['rarity','roles', 'types', 'spellaffinity'];
    for ($i = 0; $i < count($tables); $i++){
        $select = $tables[$i].'.name';
        $joinTable = $tables[$i];
        $joinA = 'styles.'.$tables[$i];
        $joinB = $tables[$i].'.id';
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
    $sql = "SELECT name FROM $table";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($result)){
        foreach ($row as $value){
            echo '<button>'.$value.'</button>';
        }
    }   
}

?>