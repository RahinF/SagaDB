<?php 
include 'condb.php';
include 'functions.php';
include 'modal.php';


// query db
$sql ='
SELECT S.ID, S.Character, S.Name, S.Title, S.Rarity, S.Role, S.Type, S.SpellAffinity, 
E.Slash, E.Blunt, E.Pierce, E.Heat, E.Cold, E.Lightning, E.Sun, E.Shadow 
FROM styles S LEFT JOIN eresist E 
ON S.ID = E.ID';

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
                    <th>ID</th>
                    <th>Character</th>
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
            <tbody class="style-list">

                <?php 


if($stmt->rowCount() > 0){
    // prints all rows
    while ($row = $stmt->fetch()){
        
        echo '<tr>';
    
        foreach($row as $attribute => $value){
            echo "<td>{$value}</td>"; 
        }

        echo '</tr>';
    }
    
}

else {
    
    echo "
    <tr>
        <td colspan='14' class='dataTables_empty'>
            No data available in table
        </td>
    </tr>
    ";
}


?>
            </tbody>
        </table>
    </div>
</div>

<script>
$(document).ready(function() {

    // brings up modal with detailed info on style
    $("table").on('click', 'tr', function() {
        let table = $('table').DataTable();
        let styleID = table.row(this).data()[0];
        let character = table.row(this).data()[1];

        // loads style info into modal
        $(".modal-body").load("styledetails.php", {
            StyleID: styleID,
            Character: character,
        });

        $('.modal').modal('show');
    });
});
$(document).ready(function() {
    $("table").DataTable({

        "columnDefs": [{
                "targets": [0], // hide style ID column
                "visible": false,
                "searchable": true
            },
            {
                "targets": [1], // hide character column
                "visible": false,
                "searchable": true
            }
        ]
    });


    // filter style table
    let rarity, role, type, affinity;

    $(".filters").find("button").click(function() {
        if ($(this).parent().hasClass("filter-rarity")) {
            rarity = $(this).text();
        }
        if ($(this).parent().hasClass("filter-role")) {
            role = $(this).text();
        }
        if ($(this).parent().hasClass("filter-type")) {
            type = $(this).text();
        }
        if ($(this).parent().hasClass("filter-affinity")) {
            affinity = $(this).text();
        }

        // toggle active button class
        $(this).siblings().removeClass("btn-dark");
        $(this).addClass("btn-dark");
    });

    $(".filter-btn").click(function() {

        // .container-fluid is the div the table is in
        $(".style-list").load("filterquery.php", {
            Rarity: rarity,
            Role: role,
            Type: type,
            SpellAffinity: affinity
        });
    });


});
</script>