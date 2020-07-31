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
    
    if (isset($name)){
        $name = filter_var($name, FILTER_SANITIZE_STRING);
    }

    if (isset($desc)){
        $desc = filter_var($desc, FILTER_SANITIZE_STRING);
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



<h1>Character</h1>
<form action="add.php" method="post">
    <input type="text" name="char[name]" placeholder="Name" required>
    <input type="radio" name="char[gender]" value="Male" required>Male
    <input type="radio" name="char[gender]" value="Female">Female
    <input type="radio" name="char[gender]" value="Other">Other
    <?php genCharSeries($con)?>
    <input type="text" name="char[desc]" placeholder="Desc" required>
    <input type="submit" value="Add Character">
</form>
<br>

<h1>style</h1>
<form action="add.php" method="post">
    <?php genCharList($con)?>
    <input type="text" name="style[name]" placeholder="Name" required>
    <input type="text" name="style[title]" placeholder="Title" required>
    <?php genStyleAtt($con)?>
    <input type="text" name="style[desc]" placeholder="Description" required>
    <input type="submit" value="Add Style">
</form>




<?php
include 'footer.php';
?>