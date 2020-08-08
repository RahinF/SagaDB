<h4>filters</h4>

<div class="row m-2">
    <label class="col" for="filter-Rarity">Rarity</label>
    <select id="filter-Rarity" name=" filter[Rarity]" class="col align-self-end">
        <option value="0">Rarity</option>
        <?php genStyleAtt($con, 'Rarity'); ?>
    </select>
</div>

<div class="row m-2">
    <label class="col" for="filter-Role">Role</label>
    <select id="filter-Role" name="filter[Role]" class="col align-self-end">
        <option value="0">Role</option>
        <?php genStyleAtt($con, 'Roles'); ?>
    </select>
</div>

<div class="row m-2">
    <label class="col" for="filter-Type">Type</label>
    <select id="filter-Type" name="filter[Type]" class="col align-self-end">
        <option value="0">Type</option>
        <?php genStyleAtt($con, 'Types'); ?>
    </select>
</div>

<div class="row m-2">
    <label class="col" for="filter-SpellAffinity">Spell Affinity</label>
    <select id="filter-SpellAffinity" name="filter[SpellAffinity]" class="col align-self-end">
        <option value="0">Spell Affinity</option>
        <?php genStyleAtt($con, 'SpellAffinity'); ?>
    </select>
</div>

<button class="btn btn-warning btn-sm row m-2">Filter</button>