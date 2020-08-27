<?php 

include_once 'database_connection.php';
include_once 'query_database.php';

$query = new QueryDatabase;


$style_id = $_POST['style_id'];



////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
// Style info




$data = $query->basic_query("Styles", "StyleID", $style_id);
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
    <h5>Style info</h5>
    <div><?= $style_name ?></div>
    <div><?= $style_title ?></div>
    <div><?= $style_rarity ?></div>
    <div><?= $style_role ?></div>
    <div><?= $style_type ?></div>
    <div><?= $style_affinity ?></div>
    <div><?= $style_description ?></div>
</div>



<?php
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
// elemental resistance

$data = $query->basic_query("Resistances", "StyleID", $style_id);
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



<div class="container">
    <h5>Elemental Resistance</h5>
    <div><?= $resistance_slash ?></div>
    <div><?= $resistance_blunt ?></div>
    <div><?= $resistance_pierce ?></div>
    <div><?= $resistance_heat ?></div>
    <div><?= $resistance_cold ?></div>
    <div><?= $resistance_lightning ?></div>
    <div><?= $resistance_sun ?></div>
    <div><?= $resistance_shadow ?></div>
</div>

<?php
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
// Character Info

$data = $query->join_query("Characters", "Characters_Styles", "StyleID", $style_id);
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


<!-- ////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////// -->

<!-- // Skills -->


<div class="container">
    <h5>Skills</h5>

    <?php

        $data = $query->join_query("Styles_Skills", "Skills", "StyleID", $style_id);

        if(!empty($data)){
            
            for($i = 0; $i < count($data); $i++){
                    
                $skill_name         = $data[$i]['Name'];
                $skill_class        = $data[$i]['Class'];
                $skill_power        = $data[$i]['Power'];
                $skill_description  = $data[$i]['Description'];
                $skill_cost         = $data[$i]['Cost'];
                $skill_awaken_limit = $data[$i]['AwakenLimit'];

    ?>

    <div class="col">

        <div class='row'><?= $skill_name ?></div>
        <div class='row'><?= $skill_description ?></div>
        <div class='row'><?= $skill_class ?></div>
        <div class='row'><?= $skill_power ?></div>
        <div class='row'><?= $skill_cost ?></div>
        <div class='row'><?= $skill_awaken_limit ?></div>

    </div>




    <?php
            }
        }
?>

</div>




<!-- ////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////// -->


<?php include 'style_abilities.php'?>



<?php
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
?>

<div class="container">
    <div class="col">
        <h5 class="p-2 bg-primary text-white rounded-pill text-center">Inheritable Skills</h5>
    </div>
    <?php include 'inheritable_skills.php'?>
</div>


<?php
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////



// gets the elements of skills
function get_element_name($connection, $skill_id){

    $query = 'SELECT E.Element FROM `Skills` S JOIN `Elements` E ON S.ID = E.ID WHERE S.ID = :skill_id';
    $statement = $connection->prepare($query);
    $statement->execute(['skill_id' => $skill_id]);
    $result = $statement->fetchAll();
    return $result;
}
?>