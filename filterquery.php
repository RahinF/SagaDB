<?php 
include 'database_connection.php';

$query ='SELECT `ID`, `Name`, `Title`, `Rarity`, `Role`, `Type`, `Affinity` FROM Styles';

// filter add to query based on selection
    $counter = 0;
    
    // creates an array of filter types (rarity, role, type, affinity)
    $filter = array_slice($_POST, 5, 8);

    foreach($filter as $table_column => $search_value){
        
        if(!empty($search_value)){

            // first option selected
            if($counter === 0){
                $query .= " WHERE {$table_column} = '{$search_value}'";
                $counter++;
            } 
            
            // if more than 1 option is selected
            else { 
            $query .= " and {$table_column} = '{$search_value}'"; 
            }
        } 
    }


$statement = $connection->query($query);
$number_filter_row = $statement->rowCount();
$result = $statement->fetchAll();

$data = array();
foreach($result as $row){
    $sub_array = array();
    $sub_array[] = $row['ID'];
    $sub_array[] = $row['Name'];
    $sub_array[] = $row['Title'];
    $sub_array[] = $row['Rarity'];
    $sub_array[] = $row['Role'];
    $sub_array[] = $row['Type'];
    $sub_array[] = $row['Affinity'];

    $data[] = $sub_array;
}
function count_all_data($connection){
    $query = 'SELECT * FROM styles';
    $statement = $connection->prepare($query);
    $statement->execute();
    return $statement->rowCount();
}

$output = array(
    "draw"       =>  $number_filter_row,
    "recordsTotal"   =>  count_all_data($connection),
    "recordsFiltered"  =>  $number_filter_row,
    "data"       =>  $data
);

echo json_encode($output);
?>