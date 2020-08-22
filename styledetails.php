<?php 
include 'database_connection.php';

$style_id = $_POST['style_id'];


echo '<div class="row">';

// Style info
$query ='
SELECT `Name`, `Title`, `Rarity`, `Role`, `Type`, `Affinity`, `Description`
FROM `Styles` WHERE `ID` = :style_id';

$statement = $connection->prepare($query);
$statement->execute(['style_id' => $style_id]);

while ($row = $statement->fetch()){ 
    echo '<div class="col">';
    echo '<h5>Info</h5>';
    foreach($row as $attribute => $value){
        echo "<div>{$attribute}: {$value}</div>"; 
    }
    echo '</div>';
}



// elemental resistance
$query ='
SELECT `Slash`, `Blunt`, `Pierce`, `Heat`, `Cold`, `Lightning`, `Sun`, `Shadow`
FROM `EResist` WHERE `ID` = :style_id';

$statement = $connection->prepare($query);
$statement->execute(['style_id' => $style_id]);

while ($row = $statement->fetch()){ 
    echo '<div class="col">';
    echo '<h5>Elemental Resistance</h5>';
    foreach($row as $attribute => $value){
        echo "<div>{$attribute}: {$value}</div>"; 
    }
    echo '</div>';
}

echo '</div>';
echo '<div class="row">';

// BP details
$query ='
SELECT `LP`, `StartingBP`, `MaxBP`, `RecoverBP`
FROM `Styles_Attributes`
WHERE `ID` = :style_id';


$statement = $connection->prepare($query);
$statement->execute(['style_id' => $style_id]);

while ($row = $statement->fetch()){ 
    echo '<div class="col">';
    echo '<h5>BP</h5>';
    foreach($row as $attribute => $value){
        echo "<div>{$attribute}: {$value}</div>"; 
    }
    echo '</div>';
}

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

// abilities
$query ='
SELECT A.Name, A.Description 
FROM `Styles_Abilities` SA join `Abilities` A 
ON SA.AbilityID = A.ID where SA.StyleID = :style_id';
$statement = $connection->prepare($query);
$statement->execute(['style_id' => $style_id]);
echo '<h5>Abilites</h5>';
while ($row = $statement->fetch()){ 
    echo '<div class="col">';
    
    foreach($row as $attribute => $value){
        echo "<div>{$attribute}: {$value}</div>"; 
    }
    echo '</div>';
}
echo '</div>';

//other styles of same character
$query ='
SELECT S.Name, S.Title, S.Rarity, A.Name, A.Description
FROM `Styles` S JOIN `Characters_Styles` CS ON S.ID = CS.StyleID 
JOIN `Styles_Abilities` SA ON CS.StyleID = SA.StyleID 
JOIN `Abilities` A ON SA.AbilityID = A.ID

WHERE CS.CharacterID = (
SELECT DISTINCT CS.CharacterID
FROM `Characters_Styles` CS
WHERE CS.StyleID = :style_id)';

$statement = $connection->prepare($query);
$statement->execute(['style_id' => $style_id]);

echo '<h5>Abilites of syltes from the same character</h5>';
while ($row = $statement->fetch()){ 
    echo '<div class="col">';
    
    foreach($row as $attribute => $value){
        echo "<div>{$attribute}: {$value}</div>"; 
    }
    echo '</div>';
}
echo '</div>';
?>

