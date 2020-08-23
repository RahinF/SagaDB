<?php
include 'database_connection.php';
include 'functions.php';
include 'header.php';


// add character
if (isset($_POST['character'])){
    print_r($_POST);
    $character_name        = $_POST['character']['name'];
    $character_gender      = $_POST['character']['gender'];
    $character_series      = $_POST['character']['series'];
    $character_description = $_POST['character']['description'];

    
    if (isset($character_name)){ 
        $character_name = filter_var($character_name, FILTER_SANITIZE_STRING); 
    }
    if (isset($character_gender)){ 
        $character_gender = filter_var($character_gender, FILTER_SANITIZE_STRING); 
    }
    if (isset($character_series)){ 
        $character_series = filter_var($character_series, FILTER_SANITIZE_STRING); 
    }
    if (isset($character_description)){ 
        $character_description = filter_var($character_description, FILTER_SANITIZE_STRING); }
        


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

            $query = '
            INSERT INTO `Characters` (`Name`, `Gender`, `Series`, `Description`)
            VALUES (
                :character_name, 
                :character_gender, 
                :character_series, 
                :character_description
            );';

            $statement = $connection->prepare($query);
            $statement->execute([
                'character_name'        => $character_name, 
                'character_gender'      => $character_gender, 
                'character_series'      => $character_series, 
                'character_description' => $character_description
                ]);

            echo $character_name, $character_gender, $character_series, $character_description.' added';
        }
}

// add style
if (isset($_POST['style'])){

    $style_name        = $_POST['style']['name'];
    $style_title       = $_POST['style']['title'];
    $style_rarity      = $_POST['style']['rarity'];
    $style_role        = $_POST['style']['role'];
    $style_type        = $_POST['style']['type'];
    $style_affinity    = $_POST['style']['affinity'];
    $style_description = $_POST['style']['description'];
    $character_id      = $_POST['style']['character'];
    
    if (isset($style_name)){ $style_name = filter_var($style_name, FILTER_SANITIZE_STRING); }
    if (isset($style_title)){ $style_title = filter_var($style_title, FILTER_SANITIZE_STRING); }
    if (isset($style_description)){ $style_description = filter_var($style_description, FILTER_SANITIZE_STRING); }

    // see if style already exists
    $query = 'SELECT `ID` FROM `Styles` WHERE `Name` = :style_name AND `Title` = :style_title';
    $statement = $connection->prepare($query);
    $statement->execute([
        'style_name'    => $style_name,     
        'style_title'   => $style_title
        ]);

        // style exists
        if ($row = $statement->fetch()){
            echo 'style exists';
        } 
        
        // style does exist INSERT new row
        else {

            // insert style
            $query = 'INSERT INTO `Styles` (`Name`, `Title`, `Rarity`, `Role`, `Type`, `Affinity`, `Description`) 
            VALUES (
                :style_name,
                :style_title,
                :style_rarity,
                :style_role,
                :style_type,
                :style_affinity,
                :style_description
                )';

            $statement = $connection->prepare($query);
            $statement->execute([
                'style_name'        => $style_name, 
                'style_title'       => $style_title, 
                'style_rarity'      => $style_rarity, 
                'style_role'        => $style_role, 
                'style_type'        => $style_type, 
                'style_affinity'    => $style_affinity, 
                'style_description' => $style_description
                ]);

                // assign style to character
                $query = 'INSERT INTO `Characters_Styles` (`CharacterID`, `StyleID`) 
                VALUES (:character_id, :style_id)';
    
                $statement = $connection->prepare($query);

                // get style id
                $style_id = $connection->lastInsertId();

                $statement->execute([
                    'character_id'  => $character_id, 
                    'style_id'      => $style_id
                    ]);
        }
}

include 'add_character.php';
include 'add_style.php';
include 'footer.php';
?>