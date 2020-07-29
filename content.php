<?php include 'condb.php'?>

<?php function callrow($row, $con, $select, $join, $joinOnA, $joinOnB){

$stmt = $con->prepare("SELECT ".$select." FROM styles JOIN ".$join." ON ".$joinOnA." = ".$joinOnB." WHERE styles.ID = ?");
$stmt->bind_param('i', $row['ID']);
$stmt->execute();
$stmt->bind_result($q);
$stmt->fetch();
$stmt->close();
 echo $q;
}?>

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
    echo '<tr>';
    echo '<td>'.$row['Name'].'</td>';
    echo '<td>'.$row['Title'].'</td>';
    echo '<td>'.$row['Rarity'].'</td>';
    echo '<td>';
    callrow($row, $con, $select = "roles.Name", $join = 'roles', $joinOnA = 'styles.Role', $joinOnB = 'roles.ID');
    echo  '</td>';
    echo '<td>';
    callrow($row, $con, $select = "types.Name", $join = 'types', $joinOnA = 'styles.Type', $joinOnB = 'types.ID');
    echo  '</td>';
    echo '<td>';
    callrow($row, $con, $select = "spellaffinity.Element", $join = 'spellaffinity', $joinOnA = 'styles.spellaffinity', $joinOnB = 'spellaffinity.ID');
    echo  '</td>';
    echo '</tr>';
}
?>
</table>