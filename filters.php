<h4>filters</h4>

<form action="index.php">
    <?php 
    genRarityList($con);
    genRoleList($con);
    genTypeList($con);
    genSpellAffList($con);
    
    ?>
    <input type="submit" value="submit">
</form>