<?php
include 'condb.php';
include 'header.php';
?>



<h1>Character</h1>
<input type="text" name="charName" value="Name">
<input type="radio" name="gender" value="male">Male
<input type="radio" name="gender" value="female">Female
<input type="radio" name="gender" value="other">Other
<select name="charSeries">
    <option value="">Series</option>
</select>
<input type="text" name="charDesc" value="Desc">
<br>

<h1>style</h1>
<input type="text" name="styleName" value="Name">
<select name="char">
    <option value="">Character List</option>
</select>
<input type="text" name="Title" value="Title">
<select name="char">
    <option value="">rarity</option>
</select>
<select name="char">
    <option value="">role</option>
</select>
<select name="char">
    <option value="">type</option>
</select>
<select name="char">
    <option value="">Spell aff</option>
</select>
<input type="text" name="styleDesc" value="Description">





<?php
include 'footer.php';
?>