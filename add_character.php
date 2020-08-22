<h1>Character</h1>
<form action="add.php" method="post">
    <div class="row">
        <div class="col">
            <input type="text" name="character[name]" placeholder="Name" required>
            <input type="radio" name="character[gender]" value="Male" required>Male
            <input type="radio" name="character[gender]" value="Female">Female
            <input type="radio" name="character[gender]" value="Other">Other

            <select name="character[series]" required>
                <option value="RS1">RS1</option>
                <option value="RS2">RS2</option>
                <option value="RS3">RS3</option>
                <option value="SF1">SF1</option>
                <option value="SF2">SF2</option>
                <option value="US">US</option>
                <option value="ES">ES</option>
                <option value="SSG">SSG</option>
                <option value="SaGaRS">SaGaRS</option>
            </select>

            <input type="text" name="character[description]" placeholder="Desc" required>
        </div>
    </div>

    <input type="submit" class="btn btn-primary" value="Add Character">
</form>