<?php
include 'condb.php';
include 'header.php';
include 'functions.php';
?>



<h1>Character</h1>
<input type="text" name="charName" value="Name">
<input type="radio" name="gender" value="Male">Male
<input type="radio" name="gender" value="Female">Female
<input type="radio" name="gender" value="Other">Other

<?php genCharSeries($con)?>


<input type="text" name="charDesc" value="Desc">
<br>

<h1>style</h1>
<input type="text" name="styleName" value="Name">


<input type="text" name="Title" value="Title">

<?php genStyleAtt($con)?>

<input type="text" name="styleDesc" value="Description">





<?php
include 'footer.php';
?>