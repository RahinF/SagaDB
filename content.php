<?php 
include 'condb.php';

function getAttName($row, $con){
    $tables = ['roles', 'types', 'spellaffinity'];
    for ($i = 0; $i < 3; $i++){
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
        ?>
<td>
    <?= $query?>
</td>
<?php 
    }
}
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
        <td><?= $row['Rarity']?></td>
        <?php getAttName($row, $con)?>
    </tr>
    <?php
}
?>
</table>