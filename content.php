<?php include 'condb.php'?>

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
    
    // get role name
    $stmt = $con->prepare("SELECT roles.Name FROM styles JOIN roles ON styles.Role = roles.ID WHERE styles.ID = ?");
    $stmt->bind_param('i', $row['ID']);
    $stmt->execute();
    $stmt->bind_result($role);
    $stmt->fetch();
    $stmt->close();

    echo '<tr>';
    echo '<td>'.$row['Name'].'</td>';
    echo '<td>'.$row['Title'].'</td>';
    echo '<td>'.$row['Rarity'].'</td>';
    echo '<td>'.$role.'</td>';
    echo '<td>'.$row['Type'].'</td>';
    echo '<td>'.$row['SpellAffinity'].'</td>';
    echo '</tr>';

}
?>
</table>