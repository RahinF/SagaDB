<?php
include 'condb.php';
include 'functions.php';
include 'header.php';


// add character
if (isset($_POST['char'])){
    print_r($_POST);
    $name = $_POST['char']['name'];
    $gender = $_POST['char']['gender'];
    $series = $_POST['char']['series'];
    $desc = $_POST['char']['desc'];
    $str = $_POST['char']['STR'];
    $end = $_POST['char']['END'];
    $dex = $_POST['char']['DEX'];
    $agi = $_POST['char']['AGI'];
    $int = $_POST['char']['INT'];
    $wil = $_POST['char']['WIL'];
    $lov = $_POST['char']['LOV'];
    $cha = $_POST['char']['CHA'];
    
    if (isset($name)){ $name = filter_var($name, FILTER_SANITIZE_STRING); }
    if (isset($gender)){ $gender = filter_var($gender, FILTER_SANITIZE_STRING); }
    if (isset($series)){ $series = filter_var($series, FILTER_SANITIZE_STRING); }
    if (isset($desc)){ $desc = filter_var($desc, FILTER_SANITIZE_STRING); }
    if (isset($str)){ $str = filter_var($str, FILTER_VALIDATE_INT); }
    if (isset($end)){ $end = filter_var($end, FILTER_VALIDATE_INT); }
    if (isset($dex)){ $dex = filter_var($dex, FILTER_VALIDATE_INT); }
    if (isset($agi)){ $agi = filter_var($agi, FILTER_VALIDATE_INT); }
    if (isset($int)){ $int = filter_var($int, FILTER_VALIDATE_INT); }
    if (isset($wil)){ $wil = filter_var($wil, FILTER_VALIDATE_INT); }
    if (isset($lov)){ $lov = filter_var($lov, FILTER_VALIDATE_INT); }
    if (isset($cha)){ $cha = filter_var($cha, FILTER_VALIDATE_INT); }

    // see if character already exists
    $sql = 'SELECT `Name` FROM `Characters` WHERE `Name` = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name]);

        // character exists
        if ($row = $stmt->fetch()){
            echo 'char exists';
        } 
        
        // character does exist INSERT new row
        else {
            $sql = 'INSERT INTO `Characters` (`name`, `gender`, `series`, `description`) VALUES (?,?,?,?)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$name, $gender, $series, $desc]);
            
            // Insert Stats
            $sql = 'INSERT INTO `Attributes` (`Name`, `STR`, `END`, `DEX`, `AGI`, `INT`, `WIL`, `LOV`, `CHA`) VALUES (?,?,?,?,?,?,?,?,?)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$name, $str, $end, $dex, $agi, $int, $wil, $lov, $cha]);
            
            echo $name, $gender, $series, $desc.' added';
        }
}

// add style
if (isset($_POST['style'])){

    $name = $_POST['style']['name'];
    $title = $_POST['style']['title'];
    $character = $_POST['style']['characters'];
    $rarity = $_POST['style']['rarity'];
    $role = $_POST['style']['role'];
    $type = $_POST['style']['type'];
    $affinity = $_POST['style']['affinity'];
    $desc = $_POST['style']['desc'];
    
    if (isset($name)){ $name = filter_var($name, FILTER_SANITIZE_STRING); }
    if (isset($title)){ $title = filter_var($title, FILTER_SANITIZE_STRING); }
    if (isset($desc)){ $desc = filter_var($desc, FILTER_SANITIZE_STRING); }

    // see if style already exists
    $sql = 'SELECT `ID` FROM `Styles` WHERE `Name` = ? AND `Title` = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $title]);

        // style exists
        if ($row = $stmt->fetch()){
            echo 'style exists';
        } 
        
        // style does exist INSERT new row
        else {
            $sql = 'INSERT INTO `Styles` (`Name`, `Character`, `Title`, `Rarity`, `Role`, `Type`, `Affinity`, `Description`) VALUES (?,?,?,?,?,?,?,?)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$name, $character, $title, $rarity, $role, $type, $affinity, $desc]);
        }
}

include 'addchar.php';
include 'addstyle.php';
include 'footer.php';
?>