<?php 
include 'condb.php';
$data = $_POST['Rarity'];
echo $data;

$sql ="
SELECT S.ID, S.Name, S.Title, S.Rarity, S.Role, S.Type, S.SpellAffinity, 
E.Slash, E.Blunt, E.Pierce, E.Heat, E.Cold, E.Lightning, E.Sun, E.Shadow 
FROM styles S LEFT JOIN eresist E 
ON S.ID = E.ID";

// filter add to query based on selection
if(isset($_POST)){

    $counter = 0;
    
    foreach($_POST as $attribute => $value){

        // first option selected
        if($counter === 0){
             $sql .= " WHERE {$attribute} = '{$value}'";
            $counter++;
        } 
            
        // if more than 1 option is selected
        else { $sql .= " AND {$attribute} = '{$value}'"; }
        
    }
    print_r($_POST); 
    echo $sql;
}


$stmt = $pdo->query($sql);
// $stmt->execute();
while ($row = $stmt->fetch()){
        
    echo "<tr>";

    foreach($row as $attribute => $value){
    
        if ($attribute !== 'ID') {
            //echo "<td>{$value}</td>"; 
        } 
    }

    echo "</tr>";

}
?>