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



echo '<div class="row">';
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
echo '</div>';



////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
echo '<div class="row">';


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


echo '<div class="row">';

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
echo '<div class="row">';

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
    get_element_name($connection, $skill_id);
    


    
    
    foreach($row as $attribute => $value){
        echo "<div>{$attribute}: {$value}</div>"; 
    }

}
   
echo '</div>';
    echo '</div>';
echo '</div>';

////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
echo '<div class="container">';

// abilities
$query ='
SELECT A.ID, A.Name, A.Description
FROM `Styles_Abilities` S JOIN `Abilities` A 
ON S.AbilityID = A.ID  where S.StyleID = :style_id';

$statement = $connection->prepare($query);
$statement->execute(['style_id' => $style_id]);

echo '<div class="col">';
echo '<h5 class="p-2 bg-primary text-white rounded-pill text-center">Abilites</h5>';
echo '</div>';
echo '<div class="row">';
while ($row = $statement->fetch()){ 
    echo '<div class="col">';

    // gets the names of the skills elements
    $skill_id = $row['ID'];
    get_element_name($connection, $skill_id);
    


    
    
    foreach($row as $attribute => $value){
        echo "<div class='row'>{$value}</div>"; 
    }
    echo '</div>';
}
   

echo '</div>'; 
echo '</div>';

////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

//diplay skills of the same character that styles dont have
$query ='
SELECT S.Name, S.Title, S.Rarity, 
A.ID, A.Name AS Skill, A.Class, A.Power, A.Description, A.Cost, A.AwakenLimit AS Awaken

FROM `Styles` S JOIN `Characters_Styles` CS ON S.ID = CS.StyleID
JOIN `Styles_Skills` SS ON CS.StyleID = SS.StyleID
JOIN `Skills` A ON SS.SkillID = A.ID

WHERE CS.CharacterID = (
SELECT DISTINCT CS.CharacterID
FROM `Characters_Styles` CS
WHERE CS.StyleID = :style_id)

AND SS.SkillID NOT IN (
SELECT DISTINCT SS.SkillID
FROM `Styles_Skills` SS
WHERE SS.StyleID = :style_id)';

$statement = $connection->prepare($query);
$statement->execute(['style_id' => $style_id]);
?>


<div class="container">
    <div class="col">
        <h5 class="p-2 bg-primary text-white rounded-pill text-center">Inheritable Skills</h5>
    </div>
    <?php
while ($row = $statement->fetch()){ 

    create_inheritable_skill_layout($connection, $row);
}

echo '</div>';

////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////


function create_inheritable_skill_layout($connection, $row){

    $style_name        = $row['Name'];
    $style_title       = $row['Title'];
    $style_rarity      = $row['Rarity'];
    $skill_id          = $row['ID'];
    $skill_name        = $row['Skill'];
    $skill_class       = $row['Class'];
    $skill_power       = $row['Power'];
    $skill_description = $row['Description'];
    $skill_cost        = $row['Cost'];
    $skill_awaken      = $row['Awaken'];

    // gets the elements of skills
    $query = 'SELECT E.Element FROM `Skills` S JOIN `Elements` E ON S.ID = E.ID WHERE S.ID = :skill_id';
    $statement = $connection->prepare($query);
    $statement->execute(['skill_id' => $skill_id]);

    ?>
    <div class="col">
        <div class="container border-bottom">

            <div class="row">
                <div class="col-sm">
                    <?= $style_name ?>
                </div>
                <div class="col-sm">
                    [<?= $style_title ?>]
                </div>
                <div class="col-sm">
                    Rarity: <?= $style_rarity ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm">
                    Skill: <?= $skill_name ?>
                </div>
                <div>
                    <?php while($row = $statement->fetch()){ 
                        echo $row['Element'];
                    }?>
                </div>

            </div>


            <div class="row">
                <div class="col-sm">Description: <?= $skill_description ?></div>
            </div>
            <div class="row">
                <div class="col-sm">Class: <?= $skill_class ?></div>
                <div class="col-sm">Power: <?= $skill_power ?></div>
                <div class="col-sm">Initial BP: <?= $skill_cost ?></div>
                <div class="col-sm">Maximum BP Reduction: <?= $skill_cost-$skill_awaken ?></div>
                <div class="col-sm">Awaken Limit: <?= $skill_awaken ?></div>
            </div>
        </div>
    </div>
    <?php
}

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

    echo '<div class="row">';

    while($row = $statement->fetch()){ 
        $skill_element = $row['Element'];
        echo "<div class='col'>{$skill_element}</div>";
    }

    echo '</div>';
}
?>