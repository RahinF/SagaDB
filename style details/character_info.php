<?php

$data = $query->join_query("Characters", "Characters_Styles", "style_id", $style_id);
$data = $data[0];



$character_name   = $data['Name'];
$character_gender = $data['Gender'];
$character_series = $data['Series'];

?>



<div class="container">
    <h5>Character Info</h5>
    <div><?= $character_name ?></div>
    <div><?= $character_gender ?></div>
    <div><?= $character_series ?></div>
</div>