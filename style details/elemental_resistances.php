<?php


$data = $query->basic_query("Resistances", "style_id", $style_id);
$data = $data[0];



$resistance_slash     = $data['Slash'];
$resistance_blunt     = $data['Blunt'];
$resistance_pierce    = $data['Pierce'];
$resistance_heat      = $data['Heat'];
$resistance_cold      = $data['Cold'];
$resistance_lightning = $data['Lightning'];
$resistance_sun       = $data['Sun'];
$resistance_shadow    = $data['Shadow'];

?>



<div>
    <h5>Elemental Resistance</h5>

    <div class="row">

        <div class="col">
            <div>Slash:</div>
            <div><?= $resistance_slash ?></div>
        </div>

        <div class="col">
            <div>Blunt:</div>
            <div><?= $resistance_blunt ?></div>
        </div>

        <div class="col">
            <div>Pierce:</div>
            <div><?= $resistance_pierce ?></div>
        </div>

        <div class="col">
            <div>Heat:</div>
            <div><?= $resistance_heat ?></div>
        </div>

    </div>



    <div class="row">

        <div class="col">
            <div>Cold:</div>
            <div><?= $resistance_cold ?></div>
        </div>

        <div class="col">
            <div>Lightning:</div>
            <div><?= $resistance_lightning ?></div>
        </div>

        <div class="col">
            <div>Sun:</div>
            <div><?= $resistance_sun ?></div>
        </div>

        <div class="col">
            <div>Shadow:</div>
            <div><?= $resistance_shadow ?></div>
        </div>

    </div>


</div>