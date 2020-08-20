<?php 
include 'condb.php';

$styleID = $_POST['StyleID'];
$character = $_POST['Character'];


echo '<div class="row">';
// basic info
$sql ='
SELECT `Name`, `Character`, `Title`, `Rarity`, `Role`, `Type`, `Affinity`, `Description`
FROM `Styles`
WHERE `ID` = ?
';

$stmt = $pdo->prepare($sql);
$stmt->execute([$styleID]);

// show data


while ($row = $stmt->fetch()){ 
    echo '<div class="col">';
    echo '<h5>Info</h5>';
    foreach($row as $attribute => $value){
        echo "<div>{$attribute}: {$value}</div>"; 
    }
    echo '</div>';
}



// elemental resistance
$sql ='
SELECT `Slash`, `Blunt`, `Pierce`, `Heat`, `Cold`, `Lightning`, `Sun`, `Shadow`
FROM `EResist`
WHERE `ID` = ?
';

$stmt = $pdo->prepare($sql);
$stmt->execute([$styleID]);

// show data


while ($row = $stmt->fetch()){ 
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
$sql ='
SELECT `LP`, `StartingBP`, `MaxBP`, `RecoverBP`
FROM `StyleAttributes`
WHERE `ID` = ?
';

$stmt = $pdo->prepare($sql);
$stmt->execute([$styleID]);

while ($row = $stmt->fetch()){ 
    echo '<div class="col">';
    echo '<h5>BP</h5>';
    foreach($row as $attribute => $value){
        echo "<div>{$attribute}: {$value}</div>"; 
    }
    echo '</div>';
}

// character details
$sql ='
SELECT `Name`, `Gender`, `Series`
FROM `Characters`
WHERE `Name` = ?
';

$stmt = $pdo->prepare($sql);
$stmt->execute([$character]);

// show data


while ($row = $stmt->fetch()){ 
    echo '<div class="col">';
    echo '<h5>Character</h5>';
    foreach($row as $attribute => $value){
        echo "<div>{$attribute}: {$value}</div>"; 
    }
    echo '</div>';
}
echo '</div>';
?>