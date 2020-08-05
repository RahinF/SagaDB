<?php 
include 'condb.php';
include 'functions.php';
include 'filters.php';

// query db
$sql = "
SELECT S.ID, S.Name, S.Title, S.Rarity, S.Role, S.Type, S.SpellAffinity, 
E.Slash, E.Blunt, E.Pierce, E.Heat, E.Cold, E.Lightning, E.Sun, E.Shadow 
FROM styles S LEFT JOIN elementalresistances E 
ON S.ID = E.ID
";


// filters query based on drop down selection
if(isset($_GET['filter'])){

    $counter = 0;

    foreach($_GET['filter'] as $attribute => $value){

        // if user has selected a filter
        if($value > 0){

            // first option selected
            if($counter === 0){
                $sql .= " WHERE {$attribute} = {$value}";
                $counter++;
            } 
            
            // if more than 1 option is selected
            else {
                $sql .= " AND {$attribute} = {$value}"; 
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
        <th>Slash</th>
        <th>Blunt</th>
        <th>Pierce</th>
        <th>Heat</th>
        <th>Cold</th>
        <th>Lightning</th>
        <th>Sun</th>
        <th>Shadow</th>
    </tr>

    <?php 

// prints all rows
while ($row = mysqli_fetch_assoc($result)){
    
    $id = $row['ID'];
    echo "<tr>";
    
    foreach($row as $attribute => $value){
        
        switch ($attribute) {
            case 'ID':
                break;
            case 'Rarity':
                $attName = getAttName($id, $con, 'Rarity', 'Rarity');
                echo "<td>{$attName}</td>";
                break;
            case 'Role':
                $attName = getAttName($id, $con, 'Role', 'Roles');
                echo "<td>{$attName}</td>";
                break;
            case 'Type':
                $attName = getAttName($id, $con, 'Type', 'Types');
                echo "<td>{$attName}</td>";
                break;
            case 'SpellAffinity':
                $attName = getAttName($id, $con, 'SpellAffinity', 'SpellAffinity');
                echo "<td>{$attName}</td>";
                break;
            default:
                echo "<td>{$value}</td>"; 
                break;
        } 
    }
    
    echo "</tr>";
}


?>
</table>