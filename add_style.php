<h1>Style</h1>
<form action="add.php" method="post">

    <select name='style[character]' required>
        <?php generate_character_list($connection)?>
    </select>

    <input type="text" name="style[name]" placeholder="Name" required>
    <input type="text" name="style[title]" placeholder="Title" required>

    <select name='style[rarity]' required>
        <option value="SS">SS</option>
        <option value="S">S</option>
        <option value="A">A</option>
    </select>

    <select name='style[role]' required>
        <option value="Attacker">Attacker</option>
        <option value="Defender">Defender</option>
        <option value="Jammer">Jammer</option>
        <option value="Supporter">Supporter</option>
    </select>

    <select name='style[type]' required>
        <option value="Sword">Sword</option>
        <option value="G.Sword">G.Sword</option>
        <option value="Axe">Axe</option>
        <option value="Club">Club</option>
        <option value="M.Arts">M.Arts</option>
        <option value="Gun">Gun</option>
        <option value="S.Sword">S.Sword</button>
        <option value="Spear">Spear</option>
        <option value="Bow">Bow</option>
        <option value="Staff">Staff</option>
    </select>

    <select name='style[affinity]' required>
        <option value="None">None</option>
        <option value="Fire">Fire</option>
        <option value="Water">Water</option>
        <option value="Earth">Earth</option>
        <option value="Wind">Wind</option>
        <option value="Light">Light</option>
        <option value="Dark">Dark</option>
    </select>

    <input type="text" name="style[description]" placeholder="Description" required>
    <input type="submit" class="btn btn-primary" value="Add Style">

</form>