<h4>filters</h4>

<form action="index.php">

    <select name="filter[Rarity]">
        <option value="0">Rarity</option>
        <?php genStyleAtt($con, 'Rarity'); ?>
    </select>

    <select name="filter[Role]">
        <option value="0">Role</option>
        <?php genStyleAtt($con, 'Roles'); ?>
    </select>

    <select name="filter[Type]">
        <option value="0">Type</option>
        <?php genStyleAtt($con, 'Types'); ?>
    </select>

    <select name="filter[SpellAffinity]">
        <option value="0">Spell Affinity</option>
        <?php genStyleAtt($con, 'SpellAffinity'); ?>
    </select>

    <input type="submit" value="submit">
</form>