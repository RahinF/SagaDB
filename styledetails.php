<?php 
include 'database_connection.php';

$style_id = $_POST['style_id'];


////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
// Style info
$query ='
SELECT `Name`, `Title`, `Rarity`, `Role`, `Type`, `Affinity`, `Description`
FROM `Styles` WHERE `ID` = :style_id';

$statement = $connection->prepare($query);
$statement->execute(['style_id' => $style_id]);



echo '<div class="container">';
while ($row = $statement->fetch()){ 
    $style_name        = $row['Name'];
    $style_title       = $row['Title'];
    $style_rarity      = $row['Rarity'];
    $style_role        = $row['Role'];
    $style_type        = $row['Type'];
    $style_affinity    = $row['Affinity'];
    $style_description = $row['Description'];
// create_basic_information_layout();
}
echo '</div>';




////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
echo '<div class="container">';


// elemental resistance
$query ='
SELECT `Slash`, `Blunt`, `Pierce`, `Heat`, `Cold`, `Lightning`, `Sun`, `Shadow`
FROM `EResist` WHERE `ID` = :style_id';

$statement = $connection->prepare($query);
$statement->execute(['style_id' => $style_id]);

while ($row = $statement->fetch()){ 
    echo '<div class="col">';
    echo '<h5>Elemental Resistance</h5>';
    echo '<div class="row">';
    foreach($row as $attribute => $value){
        echo "<div class='col'>{$attribute}: {$value}</div>"; 
    }
    echo '</div>';
    echo '</div>';
}

echo '</div>';
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////


echo '<div class="container">';

// character details
$query ='
SELECT C.Name, C.Gender, C.Series 
FROM `Characters` C JOIN `Characters_Styles`CS 
ON C.ID = CS.characterid
WHERE CS.styleID = :style_id';

$statement = $connection->prepare($query);
$statement->execute(['style_id' => $style_id]);

while ($row = $statement->fetch()){ 
    echo '<div class="col">';
    echo '<h5>Character</h5>';
    foreach($row as $attribute => $value){
        echo "<div>{$attribute}: {$value}</div>"; 
    }
    echo '</div>';
}

echo '</div>';

////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
echo '<div class="container">';

// Skills
$query ='
SELECT SK.ID, SK.Name, SK.Class, SK.Power, SK.Description, SK.Cost, SK.AwakenLimit AS Awaken 
FROM `Styles_Skills` SS join `Skills` SK 
ON SS.SkillID = SK.ID where SS.StyleID = :style_id';

$statement = $connection->prepare($query);
$statement->execute(['style_id' => $style_id]);

echo '<h5>Skills</h5>';

while ($row = $statement->fetch()){ 
    echo '<div class="row">';

    // gets the names of the skills elements
    $skill_id = $row['ID'];
    print_r($result = get_element_name($connection, $skill_id));
    


    
    
    foreach($row as $attribute => $value){
        echo "<div>{$attribute}: {$value}</div>"; 
    }

}

echo '</div>';
echo '</div>';
echo '</div>';

////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
?>


<div class="container">
    <div class="col">
        <h5 class="p-2 bg-primary text-white rounded-pill text-center">Abilites</h5>
    </div>
    <div class="row">
        <?php include 'style_abilities.php'?>
    </div>
</div>


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


// function create_basic_information_layout(){
//     echo '<div class="col">';
//     echo '<h5>Info</h5>';
//     echo '<div class="row">';
//     foreach($row as $attribute => $value){
//         echo "<div>{$attribute}: {$value}</div>"; 
//     }
//     echo '</div>';
// }


// gets the elements of skills
function get_element_name($connection, $skill_id){

    $query = 'SELECT E.Element FROM `Skills` S JOIN `Elements` E ON S.ID = E.ID WHERE S.ID = :skill_id';
    $statement = $connection->prepare($query);
    $statement->execute(['skill_id' => $skill_id]);
    $result = $statement->fetchAll();
    return $result;
}
?>