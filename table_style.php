<div class="container">


            <?php include 'filter_layout.php'?>


            <div>
                <table id="style-table" class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Style</th>
                            <th>Title</th>
                            <th>Rarity</th>
                            <th>Role</th>
                            <th>Type</th>
                            <th>Spell Affinity</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                </table>
            </div>
        
 
 

    <div id="style-details"></div>

</div>


<script>
$(document).ready(function() {

    fill_datatable();

    function fill_datatable(filter_rarity = 'none', filter_role = 'none', filter_type = 'none',
        filter_affinity = 'none') {

        var dataTable = $('#style-table').DataTable({
            "serverSide": true,
            "order": false,
            "searching": false,
            "bSort": false,


            "scrollY": "200px",
            "scrollCollapse": true,
            "paging": false,


            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            responsive: true,


            "columns": [{
                    data: 'Style_ID'
                },
                {
                    data: 'Name'
                },
                {
                    data: 'Title'
                },
                {
                    data: 'Rarity'
                },
                {
                    data: 'Role'
                },
                {
                    data: 'Type'
                },
                {
                    data: 'Affinity'
                },
                {
                    data: 'Description'
                }
            ],
            "columnDefs": [{
                "targets": [0], // hide style ID column
                "visible": false,
                "searchable": true
            }, {
                "targets": [7], // hide description column
                "visible": false,
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
        let style_id = table.row(this).data()['Style_ID']; // gets the id of the style from the row

        $("#style-details").load("style_preview.php", {
            style_id: style_id,
        });
    });

    // clears all filters
    $("#filter-clear").click(function() {
        $('#style-table').DataTable().destroy();
        fill_datatable();

        // reset filter selection to 'please select'
        $("#filter-rarity").val("none");
        $("#filter-role").val("none");
        $("#filter-type").val("none");
        $("#filter-affinity").val("none");
    });

    // filter style table
    $("#filter-btn").click(function() {

        let filter_rarity = $("#filter-rarity option:selected").val();
        let filter_role = $("#filter-role option:selected").val();
        let filter_type = $("#filter-type option:selected").val();
        let filter_affinity = $("#filter-affinity option:selected").val();

        if (!(
                filter_rarity === "none" &&
                filter_role === "none" &&
                filter_type === "none" &&
                filter_affinity === "none"
            )) {

            $('#style-table').DataTable().destroy();
            fill_datatable(filter_rarity, filter_role, filter_type, filter_affinity);
        }
    });



});
</script>

