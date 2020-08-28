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



<div>

    <div class="text-center bg-primary  text-white"><?= "{$style_name} [{$style_title}]" ?></div>

    <div class="row">
        <div class="col">
            <?= $style_rarity ?>
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