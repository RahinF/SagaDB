<?php

$filter_rarity     = ["SS", "S", "A"];
$filter_role       = ["Attacker", "Defender", "Jammer", "Supporter"];
$filter_type       = ["Sword", "G.Sword", "Axe", "Club", "M.Arts", "Gun", "S.Sword", "Spear", "Bow", "Staff"];
$filter_affinity   = ["None", "Fire", "Water", "Earth", "Wind", "Light", "Dark"];

// creates options of filters from array
function create_filter_list($filter){
    
    for($i = 0; $i < count($filter); $i++) {
        echo "<option value='{$filter[$i]}'>$filter[$i]</option>";
    } 
}


?>

<h1>filters</h1>
<div>
    

    <div class="row">
        
        <div class="col-3">
            <select id="filter-rarity" class="btn btn-danger">
                <option value='none' selected disabled hidden>Rarity</option>
                <?php create_filter_list($filter_rarity)?>
            </select>
        </div>


        <div class="col-3">
            <select id="filter-role" class="btn btn-danger">
                <option value='none' selected disabled hidden>Role</option>
                <?php create_filter_list($filter_role)?>
            </select>
        </div>

            
        <div class="col-3">
            <select id="filter-type" class="btn btn-danger">
                <option value='none' selected disabled hidden>Type</option>
                <?php create_filter_list($filter_type)?>
            </select>
        </div>


        <div class="col-3">
            <select id="filter-affinity" class="btn btn-danger">
                <option value='none' selected disabled hidden>Spell Affinity</option>
                <?php create_filter_list($filter_affinity)?>
            </select>
        </div>

    </div>

    <div class="row">
        <button id="filter-btn" class="btn btn-light col">Filter</button>
        <button id="filter-clear" class="btn btn-info col">Clear</button>
    </div>

</div>