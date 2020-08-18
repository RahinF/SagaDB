<?php 
include 'condb.php';
include 'functions.php';


// query db
$sql ="
SELECT S.ID, S.Name, S.Title, S.Rarity, S.Role, S.Type, S.SpellAffinity, 
E.Slash, E.Blunt, E.Pierce, E.Heat, E.Cold, E.Lightning, E.Sun, E.Shadow 
FROM styles S LEFT JOIN eresist E 
ON S.ID = E.ID";

$stmt = $pdo->prepare($sql);
$stmt->execute();

?>

<div class="row">

    <div class="col-3 bg-primary m-3">
        <?php include 'filters.php';?>
    </div>

    <div class="col-8">
        <table class="table table-hover table-responsive">
            <thead class="thead-dark">
                <tr>
                    <th>Style</th>
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


if(!$stmt->rowCount() > 0){
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
    while ($row = $stmt->fetch()){
        
        echo "<tr>";
    
        foreach($row as $attribute => $value){
        
            if ($attribute !== 'ID') {
                echo "<td>{$value}</td>"; 
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
    $(".filter-rarity").find("button").click(function(button) {
        var rarity = $(this).text();
        var btn = button.target.id;

        $(".container-fluid").load("styleList.php", {
            Rarity: rarity,
        }, function() {

            // active filter is shown
            $(`#${btn}`).siblings().removeClass("btn-dark");
            $(`#${btn}`).addClass("btn-dark");
        });
    });

    $(".filter-role").find("button").click(function() {
        var role = $(this).text();

        $(".container-fluid").load("styleList.php", {
            Role: role,
        });
    });

    $(".filter-type").find("button").click(function() {
        var type = $(this).text();

        $(".container-fluid").load("styleList.php", {
            Type: type,
        });
    });

    $(".filter-affinity").find("button").click(function() {
        var affinity = $(this).text();

        $(".container-fluid").load("styleList.php", {
            SpellAffinity: affinity,
        });
    });
});
</script>