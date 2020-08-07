<?php
include 'condb.php';
include 'header.php';
include 'functions.php';


// add character
if (isset($_POST['char'])){
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
    
    if (isset($name)){
        $name = filter_var($name, FILTER_SANITIZE_STRING);
    }

    if (isset($gender)){
        $gender = filter_var($gender, FILTER_SANITIZE_STRING);
    }

    if (isset($series)){
        $series = filter_var($series, FILTER_VALIDATE_INT);
    }

    if (isset($desc)){
        $desc = filter_var($desc, FILTER_SANITIZE_STRING);
    }

    if (isset($str)){
        $str = filter_var($str, FILTER_VALIDATE_INT);
    }

    if (isset($end)){
        $end = filter_var($end, FILTER_VALIDATE_INT);
    }

    if (isset($dex)){
        $dex = filter_var($dex, FILTER_VALIDATE_INT);
    }

    if (isset($agi)){
        $agi = filter_var($agi, FILTER_VALIDATE_INT);
    }

    if (isset($int)){
        $int = filter_var($int, FILTER_VALIDATE_INT);
    }

    if (isset($wil)){
        $wil = filter_var($wil, FILTER_VALIDATE_INT);
    }

    if (isset($lov)){
        $lov = filter_var($lov, FILTER_VALIDATE_INT);
    }

    if (isset($cha)){
        $cha = filter_var($cha, FILTER_VALIDATE_INT);
    }

    // see if character already exists
    $sql = "SELECT * FROM characters WHERE name = '$name'";
    $result = mysqli_query($con, $sql);

        // character exists
        if ($row = mysqli_fetch_assoc($result)){
            echo 'char exists';
        } 
        
        // character does exist INSERT new row
        else {
            $stmt = $con->prepare('INSERT INTO characters (`name`, `gender`, `series`, `description`) VALUES (?,?,?,?)');
            $stmt->bind_param('ssis', $name, $gender, $series, $desc);
            $stmt->execute();
            $stmt->close();

            
            // insert stats
            $stmt = $con->prepare('INSERT INTO attributes (`Name`, `STR`, `END`, `DEX`, `AGI`, `INT`, `WIL`, `LOV`, `CHA`) VALUES (?,?,?,?,?,?,?,?,?)');
            $stmt->bind_param('siiiiiiii', $name, $str, $end, $dex, $agi, $int, $wil, $lov, $cha);
            $stmt->execute();
            $stmt->close();
            
            echo $name, $gender, $series, $desc.' added';
        }
}

// add style
if (isset($_POST['style'])){
    $name = $_POST['style']['name'];
    $title = $_POST['style']['title'];
    $character = $_POST['style']['characters'];
    $rarity = $_POST['style']['rarity'];
    $role = $_POST['style']['roles'];
    $type = $_POST['style']['types'];
    $spellAff = $_POST['style']['spellaffinity'];
    $desc = $_POST['style']['desc'];
    
    if (isset($name)){
        $name = filter_var($name, FILTER_SANITIZE_STRING);
    }

    if (isset($title)){
        $title = filter_var($title, FILTER_SANITIZE_STRING);
    }

    if (isset($desc)){
        $desc = filter_var($desc, FILTER_SANITIZE_STRING);
    }

    // see if style already exists
    $sql = "SELECT * FROM styles WHERE name = '$name' and title = '$title'";
    $result = mysqli_query($con, $sql);

        // style exists
        if ($row = mysqli_fetch_assoc($result)){
            echo 'style exists';
        } 
        
        // style does exist INSERT new row
        else {
            $stmt = $con->prepare('INSERT INTO styles (`name`, `character`, `title`, `rarity`, `roles`, `types`, `spellaffinity`, `description`) VALUES (?,?,?,?,?,?,?,?)');
            $stmt->bind_param('sssiiiis', $name, $character, $title, $rarity, $role, $type, $spellAff, $desc);
            $stmt->execute();
            $stmt->close();
        }
}

?>



<?php include 'addchar.php';?>
<br>

<h1>Style</h1>
<form action="add.php" method="post">

    <select name='style[characters]' required>
        <?php genCharList($con)?>
    </select>

    <input type="text" name="style[name]" placeholder="Name" required>
    <input type="text" name="style[title]" placeholder="Title" required>

    <select name='style[Rarity]' required>
        <?php genStyleAtt($con, 'Rarity'); ?>
    </select>

    <select name='style[Roles]' required>
        <?php genStyleAtt($con, 'Roles'); ?>
    </select>

    <select name='style[Types]' required>
        <?php genStyleAtt($con, 'Types'); ?>
    </select>

    <select name='style[SpellAffinity]' required>
        <?php genStyleAtt($con, 'SpellAffinity'); ?>
    </select>

    <input type="text" name="style[desc]" placeholder="Description" required>
    <input type="submit" value="Add Style">
</form>




<?php include 'footer.php';?>