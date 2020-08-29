<?php


$data = $query->basic_query("Styles", "style_id", $style_id);
$data = $data[0];



$style_name        = $data['Name'];
$style_title       = $data['Title'];
$style_rarity      = $data['Rarity'];
$style_role        = $data['Role'];
$style_type        = $data['Type'];
$style_affinity    = $data['Affinity'];
$style_description = $data['Description'];

?>



<div class="container">

    <h5 class="p-2 bg-primary text-white text-center"><?= "{$style_name} [{$style_title}]" ?></h5>

    <div class="row">
        <div class="col">
            <?php $image->display_image("rarity", $style_rarity, "png"); ?>
        </div>
        <div class="col">
            <?= $style_role ?>
        </div>
        <div class="col">
            <?= $style_type ?>
        </div>
        <div class="col">
            <?= $style_affinity ?>
        </div>
    </div>

    <div><?= $style_description ?></div>
    
</div>