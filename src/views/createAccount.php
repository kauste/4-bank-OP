<?php require __DIR__.'/top.php'?>
<h3 class="new-account-h">Pateikite duomenis naujos sąskaitos sukūrimui.</h3>
    <form class="new-account-form" action="#" method="post">
        <div class="new-accout-data">
            <label for="vardas">Vardas</label>
            <input type="text" name="vardas" id="" required>
        </div>
        <div class="new-accout-data">
            <label for="pavarde">Pavarde</label>
            <input type="text" name="pavarde" id="" required>
        </div>
        <div class="new-accout-data">
            <label for="asmens-kodas">Asmens kodas</label>
            <input type="text" name="asmens-kodas" id="" required>
        </div>
        <div class="new-accout-data">
            <label for="saskaitos-numeris">Saskaitos Numeris</label>
            <input type="text" name="saskaitos-numeris" id="" value="<?= $iban ?>" readonly >
        </div>
        <button class="new-accout-button" type="submit">+</button>
    </form>
<?php require __DIR__.'/bottom.php';?>
