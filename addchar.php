<h1>Character</h1>
<form action="add.php" method="post">
    <div class="row">
        <div class="col">
            <input type="text" name="char[name]" placeholder="Name" required>
            <input type="radio" name="char[gender]" value="Male" required>Male
            <input type="radio" name="char[gender]" value="Female">Female
            <input type="radio" name="char[gender]" value="Other">Other

            <select name="char[series]" required>
                <?php genStyleAtt($con, 'Series')?>
            </select>

            <input type="text" name="char[desc]" placeholder="Desc" required>
        </div>

        <h3>stats</h3>

        <div class="col">
            <div>
                <span>str</span>
                <input type="number" name="char[STR]" required>
            </div>

            <div>
                <span>end</span>
                <input type="number" name="char[END]" required>
            </div>

            <div>
                <span>dex</span>
                <input type="number" name="char[DEX]" required>
            </div>

            <div>
                <span>agi</span>
                <input type="number" name="char[AGI]" required>
            </div>

            <div>
                <span>int</span>
                <input type="number" name="char[INT]" required>
            </div>

            <div>
                <span>wil</span>
                <input type="number" name="char[WIL]" required>
            </div>

            <div>
                <span>lov</span>
                <input type="number" name="char[LOV]" required>
            </div>

            <div>
                <span>cha</span>
                <input type="number" name="char[CHA]" required>
            </div>
        </div>
    </div>

    <input type="submit" class="btn btn-primary" value="Add Character">
</form>