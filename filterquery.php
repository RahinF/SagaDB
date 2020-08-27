<?php 

include_once 'database_connection.php';
include_once 'query_database.php';

$query = new QueryDatabase;

$filter_rarity   = $_POST['Rarity'];
$filter_role     = $_POST['Role'];
$filter_type     = $_POST['Type'];
$filter_affinity = $_POST['Affinity'];


if($filter_rarity === '' && $filter_role === '' && $filter_type === '' && $filter_affinity === ''){
    
    $data = $query->basic_query("Styles");  // if no filters are selected run basic query
} 

else {
    
    $filter = array_slice($_POST, 5, 8); // creates an array of filter types (rarity, role, type, affinity)

    $filters = array();
    
    foreach($filter as $table_column => $search_value){
        
        if($search_value !== "none"){
            $filters[$table_column] = $search_value;
        } 
    }

    $data = $query->filter_query($filters); // run filtered query
}



if(!isset($data)){
    $number_of_rows = 1; // if filtered query fails
    $data['data'] = []; // display empty table
} else {
    $number_of_rows = count($data);
}

$output = array(
    "draw"            =>  $number_of_rows,
    "recordsTotal"    =>  $number_of_rows, 
    "recordsFiltered" =>  $number_of_rows, // filtered styles in db
    "data"            =>  $data
);

echo json_encode($output);
?>