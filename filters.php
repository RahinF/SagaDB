<h4>filters</h4>

<form action="index.php">
    <?php
    getAttValue($con, $table = 'roles');
    echo '<br>';
    getAttValue($con, $table = 'spellaffinity');
    echo '<br>';
    getAttValue($con, $table = 'types');
    echo '<br>';
    getAttValue($con, $table = 'rarity');  
    ?>
</form>