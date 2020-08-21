<?php
include 'database_connection.php';
include 'functions.php';
include 'header.php';


// add character
if (isset($_POST['character'])){
    print_r($_POST);
    $character_name = $_POST['character']['name'];
    $character_gender = $_POST['character']['gender'];
    $character_series = $_POST['character']['series'];
    $character_description = $_POST['character']['description'];
    $character_strength = $_POST['character']['strength'];
    $character_endurance = $_POST['character']['endurance'];
    $character_dexterity = $_POST['character']['dexterity'];
    $character_agility = $_POST['character']['agility'];
    $character_intelligence = $_POST['character']['intelligence'];
    $character_willpower = $_POST['character']['willpower'];
    $character_love = $_POST['character']['love'];
    $character_charisma = $_POST['character']['charisma'];
    
    if (isset($character_name)){ $character_name = filter_var($character_name, FILTER_SANITIZE_STRING); }
    if (isset($character_gender)){ $character_gender = filter_var($character_gender, FILTER_SANITIZE_STRING); }
    if (isset($character_series)){ $character_series = filter_var($character_series, FILTER_SANITIZE_STRING); }
    if (isset($character_description)){ $character_description = filter_var($character_description, FILTER_SANITIZE_STRING); }
    if (isset($character_strength)){ $character_strength = filter_var($character_strength, FILTER_VALIDATE_INT); }
    if (isset($character_endurance)){ $character_endurance = filter_var($character_endurance, FILTER_VALIDATE_INT); }
    if (isset($character_dexterity)){ $character_dexterity = filter_var($character_dexterity, FILTER_VALIDATE_INT); }
    if (isset($character_agility)){ $character_agility = filter_var($character_agility, FILTER_VALIDATE_INT); }
    if (isset($character_intelligence)){ $character_intelligence = filter_var($character_intelligence, FILTER_VALIDATE_INT); }
    if (isset($character_willpower)){ $character_willpower = filter_var($character_willpower, FILTER_VALIDATE_INT); }
    if (isset($character_love)){ $character_love = filter_var($character_love, FILTER_VALIDATE_INT); }
    if (isset($character_charisma)){ $character_charisma = filter_var($character_charisma, FILTER_VALIDATE_INT); }

    // see if character already exists
    $query = 'SELECT `Name` FROM `Characters` WHERE `Name` = :character_name';
    $statement = $connection->prepare($query);
    $statement->execute(['character_name' => $character_name]);

        // character exists
        if ($row = $statement->fetch()){
            echo 'Character already exists!';
        } 
        
        // character does exist INSERT new row
        else {
            $query = 'INSERT INTO `Characters` (`Name`, `Gender`, `Series`, `Description`) 
            VALUES (
                :character_name, 
                :character_gender, 
                :character_series, 
                :character_description
                )';

            $statement = $connection->prepare($query);
            $statement->execute([
                'character_name' => $character_name, 
                'character_gender' => $character_gender, 
                'character_series' => $character_series, 
                'character_description' => $character_description
                ]);
            
            // Insert Stats
            $query = 'INSERT INTO `Attributes` (`Name`, `STR`, `END`, `DEX`, `AGI`, `INT`, `WIL`, `LOV`, `CHA`) 
            VALUES (
                :character_name, 
                :character_strength, 
                :character_endurance, 
                :character_dexterity, 
                :character_agility, 
                :character_intelligence, 
                :character_willpower, 
                :character_love, 
                :character_charisma
                )';

            $statement = $connection->prepare($query);
            $statement->execute([
                'character_name' => $character_name, 
                'character_strength' => $character_strength, 
                'character_endurance' => $character_endurance, 
                'character_dexterity' => $character_dexterity, 
                'character_agility' => $character_agility, 
                'character_intelligence' => $character_intelligence, 
                'character_willpower' => $character_willpower, 
                'character_love' => $character_love, 
                'character_charisma' => $character_charisma
                ]);
            
            echo $character_name, $character_gender, $character_series, $character_description.' added';
        }
}

// add style
if (isset($_POST['style'])){

    $style_name = $_POST['style']['name'];
    $style_title = $_POST['style']['title'];
    $style_character = $_POST['style']['character'];
    $style_rarity = $_POST['style']['rarity'];
    $style_role = $_POST['style']['role'];
    $style_type = $_POST['style']['type'];
    $style_affinity = $_POST['style']['affinity'];
    $style_description = $_POST['style']['description'];
    
    if (isset($style_name)){ $style_name = filter_var($style_name, FILTER_SANITIZE_STRING); }
    if (isset($style_title)){ $style_title = filter_var($style_title, FILTER_SANITIZE_STRING); }
    if (isset($style_description)){ $style_description = filter_var($style_description, FILTER_SANITIZE_STRING); }

    // see if style already exists
    $query = 'SELECT `ID` FROM `Styles` WHERE `Name` = :style_name AND `Title` = :style_title';
    $statement = $connection->prepare($query);
    $statement->execute([
        'style_name' => $style_name,     
        'style_title' => $style_title
        ]);

        // style exists
        if ($row = $statement->fetch()){
            echo 'style exists';
        } 
        
        // style does exist INSERT new row
        else {
            $query = 'INSERT INTO `Styles` (`Name`, `Character`, `Title`, `Rarity`, `Role`, `Type`, `Affinity`, `Description`) 
            VALUES (
                :style_name,
                :style_character,
                :style_title,
                :style_rarity,
                :style_role,
                :style_type,
                :style_affinity,
                :style_description
                )';

            $statement = $connection->prepare($query);
            $statement->execute([
                'style_name' => $style_name, 
                'style_character' => $style_character, 
                'style_title' => $style_title, 
                'style_rarity' => $style_rarity, 
                'style_role' => $style_role, 
                'style_type' => $style_type, 
                'style_affinity' => $style_affinity, 
                'style_description' => $style_description
                ]);
        }
}

include 'addchar.php';
include 'addstyle.php';
include 'footer.php';
?>