<?php

$filter_rarity     = ["SS", "S", "A"];
$filter_role       = ["Attacker", "Defender", "Jammer", "Supporter"];
$filter_type       = ["Sword", "G.Sword", "Axe", "Club", "M.Arts", "Gun", "S.Sword", "Spear", "Bow", "Staff"];
$filter_affinity   = ["None", "Fire", "Water", "Earth", "Wind", "Light", "Dark"];

// creates options of filters from array
function create_filter_list($filter){
    
    echo "<option value='none' selected disabled hidden>Select an option</option>";

    for($i = 0; $i < count($filter); $i++) {
        echo "<option value='{$filter[$i]}'>$filter[$i]</option>";
    } 
}


?>


<div class="filters">
    <h4>filters</h4>

    <h5>Rarity</h5>
    <select id="filter-rarity" class="btn btn-danger">
        <?php create_filter_list($filter_rarity)?>
    </select>

    <h5>Role</h5>
    <select id="filter-role" class="btn btn-danger">
        <?php create_filter_list($filter_role)?>
    </select>


    <h5>Type</h5>
    <select id="filter-type" class="btn btn-danger">
        <?php create_filter_list($filter_type)?>
    </select>

    <h5>Spell Affinity</h5>
    <select id="filter-affinity" class="btn btn-danger">
        <?php create_filter_list($filter_affinity)?>
    </select>

    <button id="filter-btn" class="btn btn-light">Filter</button>
    <button id="filter-clear" class="btn btn-info">Clear</button>
</div>