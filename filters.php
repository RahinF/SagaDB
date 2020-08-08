<div class="col-3 bg-primary m-3">
    <h4>filters</h4>
    
    <select id="filter-Rarity" name=" filter[Rarity]" class="row m-2">
        <option value="0">Rarity</option>
        <?php genStyleAtt($con, 'Rarity'); ?>
    </select>

    <select id="filter-Role" name="filter[Role]" class="row m-2">
        <option value="0">Role</option>
        <?php genStyleAtt($con, 'Roles'); ?>
    </select>

    <select id="filter-Type" name="filter[Type]" class="row m-2">
        <option value="0">Type</option>
        <?php genStyleAtt($con, 'Types'); ?>
    </select>

    <select id="filter-SpellAffinity" name="filter[SpellAffinity]" class="row m-2">
        <option value="0">Spell Affinity</option>
        <?php genStyleAtt($con, 'SpellAffinity'); ?>
    </select>

    <button class="btn btn-warning btn-sm row m-2">Filter</button>
</div>