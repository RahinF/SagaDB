<?php 
include 'condb.php';
include 'functions.php';
include 'filters.php';

// query db
$sql = "SELECT `ID`, `Name`,`Title`,`Rarity`,`Roles`,`Types`,`SpellAffinity` FROM styles";


// filters query based on drop down selection
if(isset($_GET['filter'])){

    $counter = 0;

    foreach($_GET['filter'] as $attribute => $value){

        // if user has selected a filter
        if($value > 0){

            // first option selected
            if($counter === 0){
                $sql .= ' WHERE '.$attribute.' = '.$value;
                $counter++;
            } 
            
            // if more than 1 option is selected
            else {
                $sql .= ' AND '.$attribute.' = '.$value; 
            }
           
        }
    }

}

$result = mysqli_query($con, $sql);
?>

<table>
    <tr>
        <th>Style Name</th>
        <th>Title</th>
        <th>Rarity</th>
        <th>Role</th>
        <th>Type</th>
        <th>Spell Affinity</th>
    </tr>

    <?php 

// prints all rows
while ($row = mysqli_fetch_assoc($result)){

    $table = $GLOBALS['tables'];
    $i = 0;
    echo '<tr>';

    foreach($row as $attribute => $value){
       
        // if attribute is equal to something in the array
        // get the att name otherwise print the value
        if(strcasecmp($attribute, $table[$i]) == 0){
            $attName = getAttName($row, $con, $table[$i]);
            echo '<td>'.$attName.'</td>';
            $i++;
        }
        else {
            // ID is not printed
            if($attribute !== 'ID'){
            echo '<td>'.$value.'</td>';}
        }
        
    }
    echo '</tr>';
 }


?>
</table>