<?php 
include 'condb.php';

$styleID = $_POST['StyleID'];
$character = $_POST['Character'];


// basic info
$sql ='
SELECT `Name`, `Character`, `Title`, `Rarity`, `Role`, `Type`, `SpellAffinity`, `Description`
FROM `Styles`
WHERE `ID` = ?
';

$stmt = $pdo->prepare($sql);
$stmt->execute([$styleID]);

// show data
echo '<h5>Info</h5>';

while ($row = $stmt->fetch()){ 
    echo '<div>';
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
echo '<h5>Elemental Resistance</h5>';

while ($row = $stmt->fetch()){ 
    echo '<div>';
    foreach($row as $attribute => $value){
        echo "<div>{$attribute}: {$value}</div>"; 
    }
    echo '</div>';
}

// BP details
$sql ='
SELECT `LP`, `StartingBP`, `MaxBP`, `RecoverBP`
FROM `StyleAttributes`
WHERE `ID` = ?
';

$stmt = $pdo->prepare($sql);
$stmt->execute([$styleID]);

// show data
echo '<h5>BP</h5>';

while ($row = $stmt->fetch()){ 
    echo '<div>';
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
echo '<h5>Character</h5>';

while ($row = $stmt->fetch()){ 
    echo '<div>';
    foreach($row as $attribute => $value){
        echo "<div>{$attribute}: {$value}</div>"; 
    }
    echo '</div>';
}

?>