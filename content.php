<?php 
include 'condb.php';
include 'functions.php';
?>

<h4>filters</h4>
<?php
getAttValue($con, $table = 'roles');
getAttValue($con, $table = 'spellaffinity');
getAttValue($con, $table = 'types');
getAttValue($con, $table = 'rarity'); 
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

// query db
$sql = "SELECT * FROM styles";
$result = mysqli_query($con, $sql);

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