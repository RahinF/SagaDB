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
    <input type="submit" class="btn btn-primary" value="Add Style">
</form>