<?php 
include 'database_connection.php';


$query ='
SELECT S.ID, S.Character, S.Name, S.Title, S.Rarity, S.Role, S.Type, S.Affinity, 
E.Slash, E.Blunt, E.Pierce, E.Heat, E.Cold, E.Lightning, E.Sun, E.Shadow 
FROM styles S LEFT JOIN eresist E 
ON S.ID = E.ID';


// filter add to query based on selection
// if(isset($_POST)){

//     $counter = 0;
    
//     foreach($_POST as $attribute => $value){
        
//         // first option selected
//         if($counter === 0){
//              $sql .= " WHERE {$attribute} = '{$value}'";
//             $counter++;
//         } 
            
//         // if more than 1 option is selected
//         else { 
//         $sql .= " and {$attribute} = '{$value}'"; 
//         }
        
//     }
// }

// filter results
$counter = 0;

if($_POST['Rarity'] !== ''){
    $query .= " WHERE S.Rarity = '{$_POST['Rarity']}'";
    $counter++;
}

if($_POST['Role'] !== ''){
    
    if($counter > 0){
        $query .= " AND S.Role = '{$_POST['Role']}'";
    } else {
        $query .= " WHERE S.Role = '{$_POST['Role']}'";
    }
}

if($_POST['Type'] !== ''){
        
    if($counter > 0){
        $query .= " AND S.Type = '{$_POST['Type']}'";
    } else {
        $query .= " WHERE S.Type = '{$_POST['Type']}'";
    }
    
}

if($_POST['Affinity'] !== ''){
        
    if($counter > 0){
        $query .= " AND S.Affinity = '{$_POST['Affinity']}'";
    } else {
        $query .= " WHERE S.Affinity = '{$_POST['Affinity']}'";
    }
    
}

// function sl($field){
//     $sql .= " and {$field} = '{$field}'"; 
// }

$statement = $connection->query($query);
$number_filter_row = $statement->rowCount();
//
$result = $statement->fetchAll();
$data = array();
foreach($result as $row)
{
 $sub_array = array();
 $sub_array[] = $row['ID'];
 $sub_array[] = $row['Character'];
 $sub_array[] = $row['Name'];
 $sub_array[] = $row['Title'];
 $sub_array[] = $row['Rarity'];
 $sub_array[] = $row['Role'];
 $sub_array[] = $row['Type'];
 $sub_array[] = $row['Affinity'];
 $sub_array[] = $row['Slash'];
 $sub_array[] = $row['Blunt'];
 $sub_array[] = $row['Pierce'];
 $sub_array[] = $row['Heat'];
 $sub_array[] = $row['Cold'];
 $sub_array[] = $row['Lightning'];
 $sub_array[] = $row['Sun'];
 $sub_array[] = $row['Shadow'];

 $data[] = $sub_array;
}
function count_all_data($connection)
{
 $query = "SELECT * FROM styles S LEFT JOIN eresist E ON S.ID = E.ID";
 $statement = $connection->prepare($query);
 $statement->execute();
 return $statement->rowCount();
}

$output = array(
    "draw"       =>  10,
    "recordsTotal"   =>  count_all_data($connection),
    "recordsFiltered"  =>  $number_filter_row,
    "data"       =>  $data
   );
echo json_encode($output);
?>