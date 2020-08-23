<?php 
include 'database_connection.php';
include 'functions.php';
include 'modal.php';
?>

<div class="row">

    <div class="col-3 bg-primary m-3">
        <?php include 'filters.php'?>
    </div>

    <div class="col-8 table-responsive">
        <table id="style-table" class="table table-hover ">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Style</th>
                    <th>Title</th>
                    <th>Rarity</th>
                    <th>Role</th>
                    <th>Type</th>
                    <th>Spell Affinity</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div class="style-details container-fluid col"></div>

<script>
$(document).ready(function() {

    fill_datatable();

    function fill_datatable(filter_rarity = '', filter_role = '', filter_type = '', filter_affinity = '') {
        var dataTable = $('#style-table').DataTable({
            "serverSide": true,
            "order": false,
            "searching": false,
            "columnDefs": [{
                "targets": [0], // hide style ID column
                "visible": false,
                "searchable": true
            }],
            "ajax": {
                url: "filterquery.php",
                type: "POST",
                data: {
                    Rarity: filter_rarity,
                    Role: filter_role,
                    Type: filter_type,
                    Affinity: filter_affinity
                }

            }
        });
    }


    //loads style info into div
    $("#style-table").on('click', 'tr', function() {
        let table = $("#style-table").DataTable();
        let style_id = table.row(this).data()[0];

        $(".style-details").load("styledetails.php", {
            style_id: style_id,
        });
    });


    // filter style table
    let filter_rarity, filter_role, filter_type, filter_affinity;

    $(".filters").find("button").click(function() {
        if ($(this).parent().hasClass("filter-rarity")) {
            filter_rarity = $(this).text();
        }
        if ($(this).parent().hasClass("filter-role")) {
            filter_role = $(this).text();
        }
        if ($(this).parent().hasClass("filter-type")) {
            filter_type = $(this).text();
        }
        if ($(this).parent().hasClass("filter-affinity")) {
            filter_affinity = $(this).text();
        }

        // toggle active button class
        $(this).siblings().removeClass("btn-dark");
        $(this).toggleClass("btn-dark");
    });

    // displays filtered data
    $(".filter-btn").click(function() {
        $('#style-table').DataTable().destroy();
        fill_datatable(filter_rarity, filter_role, filter_type, filter_affinity);
    });

});
</script>