<h4>filters</h4>

<form action="index.php">
    <?php
    getAttValue($con, $table = 'roles');
    getAttValue($con, $table = 'spellaffinity');
    getAttValue($con, $table = 'types');
    getAttValue($con, $table = 'rarity');  
    ?>
</form>