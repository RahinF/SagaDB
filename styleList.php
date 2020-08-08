<?php 
include 'condb.php';
include 'functions.php';


// query db
$sql = "
SELECT S.ID, S.Name, S.Title, S.Rarity, S.Role, S.Type, S.SpellAffinity, 
E.Slash, E.Blunt, E.Pierce, E.Heat, E.Cold, E.Lightning, E.Sun, E.Shadow 
FROM styles S LEFT JOIN elementalresistances E 
ON S.ID = E.ID
";

// filters query based on drop down selection
if(isset($_POST)){
  
    $counter = 0;

    foreach($_POST as $attribute => $value){

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

<div class="row">
    <?php include 'filters.php';?>

    <div class="col">
        <table class="table table-hover table-responsive">
            <thead class="thead-dark">
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
            </thead>

            <?php 

// if no rows error message
if(mysqli_num_rows($result) === 0){
    echo "
    <tr>
        <td colspan='14' class='dataTables_empty'>
            No data available in table
        </td>
    </tr>
    ";
} 
else {

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
}


?>

        </table>
    </div>
</div>

<script>
$(document).ready(function() {
    $("table").DataTable();
});

// filter style table
$(document).ready(function() {
    $("button").click(function() {
        var rarity = $("#filter-Rarity option:selected").val();
        var role = $("#filter-Role option:selected").val();
        var type = $("#filter-Type option:selected").val();
        var affinity = $("#filter-SpellAffinity option:selected").val();

        // .container-fluid is the div the table is in
        $(".container-fluid").load("styleList.php", {
            Rarity: rarity,
            Role: role,
            Type: type,
            SpellAffinity: affinity
        });
    });
});
</script>