<?php
include 'condb.php';
include 'header.php';
include 'functions.php';

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
            $stmt = $con->prepare('INSERT INTO characters (name, gender, series, description) VALUES (?,?,?,?)');
            $stmt->bind_param('ssis', $name, $gender, $series, $desc);
            $stmt->execute();
            $stmt->close();
            echo $name, $gender, $series, $desc.' added';
        }
}


?>



<h1>Character</h1>
<form action="add.php" method="post">
    <input type="text" name="char[name]" value="Name" required>
    <input type="radio" name="char[gender]" value="Male" required>Male
    <input type="radio" name="char[gender]" value="Female">Female
    <input type="radio" name="char[gender]" value="Other">Other
    <?php genCharSeries($con)?>
    <input type="text" name="char[desc]" value="Desc" required>
    <input type="submit" value="Add Character">
</form>
<br>

<h1>style</h1>
<input type="text" name="style[name]" value="Name" required>
<input type="text" name="style[title]" value="Title" required>
<?php genStyleAtt($con)?>
<input type="text" name="style[desc]" value="Description" required>





<?php
include 'footer.php';
?>