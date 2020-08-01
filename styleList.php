<?php 
include 'condb.php';
include 'functions.php';
include 'filters.php';

// query db
$sql = "SELECT * FROM styles";


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


// print all rows
while ($row = mysqli_fetch_assoc($result)){
    ?>
    <tr>
        <td><?= $row['Name']?></td>
        <td><?= $row['Title']?></td>
        <?php getAttName($row, $con)?>
    </tr>
    <?php
}
?>
</table>