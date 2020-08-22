<?php
include 'header.php';
include 'database_connection.php';

// query db
$query = '
SELECT C.Name, C.Gender, C.Series, A.Strength, A.Endurance, A.Dexterity, A.agility, A.intelligence, A.willpower, A.love, A.charisma 
FROM characters C LEFT JOIN attributes A 
ON C.ID = A.ID
';

$statement = $connection->prepare($query);
$statement->execute();

?>

<table class="table table-hover table-responsive">
    <thead class="thead-dark">
        <tr>
            <th>Name</th>
            <th>Gender</th>
            <th>Series</th>
            <th>STR</th>
            <th>END</th>
            <th>DEX</th>
            <th>AGI</th>
            <th>INT</th>
            <th>WIL</th>
            <th>LOV</th>
            <th>CHA</th>
        </tr>
    </thead>
    <?php 


// print all rows
while ($row = $statement->fetch()){
    
    echo '<tr>';        
    
    foreach($row as $attribute => $value){
        echo "<td>{$value}</td>"; 
    }
    
    echo '</tr>';
}
?>

</table>

<?php include 'footer.php'?>


<script>
$(document).ready(function() {
    $("table").DataTable();
});
</script>