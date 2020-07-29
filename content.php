<?php include 'condb.php'?>

<?php function callrow($row, $con, $select, $joinTable, $joinOnA, $joinOnB){

$stmt = $con->prepare("SELECT ".$select." FROM styles JOIN ".$joinTable." ON ".$joinOnA." = ".$joinOnB." WHERE styles.ID = ?");
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

    for ($i = 0; $i < 3; $i++){
        echo '<td>';
        $tables = ['roles', 'types', 'spellaffinity'];
        $select = $tables[$i].'.name';
        $joinTable = $tables[$i];
        $joinOnA = 'styles.'.$tables[$i];
        $joinOnB = $tables[$i].'.id';
        callrow($row, $con, $select, $joinTable, $joinOnA, $joinOnB);
        echo  '</td>';
    }
    
    echo '</tr>';
}
?>
</table>