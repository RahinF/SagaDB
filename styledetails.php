<?php 
include 'database_connection.php';

$style_id = $_POST['StyleID'];
$character = $_POST['Character'];


echo '<div class="row">';

// basic info
$query ='
SELECT `Name`, `Character`, `Title`, `Rarity`, `Role`, `Type`, `Affinity`, `Description`
FROM `Styles`
WHERE `ID` = ?
';

$statement = $connection->prepare($query);
$statement->execute([$style_id]);

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
FROM `EResist`
WHERE `ID` = ?
';

$statement = $connection->prepare($query);
$statement->execute([$style_id]);

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
FROM `StyleAttributes`
WHERE `ID` = ?
';

$statement = $connection->prepare($query);
$statement->execute([$style_id]);

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
SELECT `Name`, `Gender`, `Series`
FROM `Characters`
WHERE `Name` = ?
';

$statement = $connection->prepare($query);
$statement->execute([$character]);

while ($row = $statement->fetch()){ 
    echo '<div class="col">';
    echo '<h5>Character</h5>';
    foreach($row as $attribute => $value){
        echo "<div>{$attribute}: {$value}</div>"; 
    }
    echo '</div>';
}
echo '</div>';
?>