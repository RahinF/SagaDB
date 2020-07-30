<?php 
include 'condb.php';
include 'functions.php';

// query db
$sql = "SELECT * FROM styles";

// filters query based on button selection
// currently only one at a time
if(!empty($_GET)){
    $attribute = key($_GET);
    $id = $_GET[key($_GET)];
    $sql .= ' WHERE '.$attribute.' = '.$id;
    unset($_GET);
}

$result = mysqli_query($con, $sql);


include 'filters.php';
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