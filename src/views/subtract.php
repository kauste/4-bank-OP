<?php require __DIR__ . '/top.php'?>
<?php require __DIR__ . '/nav.php' ?>
<h3>Nuskaičiuoti lėšų</h3>
    <form class="nuskaiciuoti-form" action="" method="post">
        <div class="nuskaiciuoti-vardas"><?= $client['vardas'] . ' ' . $client['pavarde']?></div>
        <div class="nuskaiciuoti-sask-likutis"><?= round(($client['suma'] * $curr['currValue']) ,2) . $curr['curr'] ?></div>
        <input name="amount" class="nuskaiciuoti-input" type="text">
        <button class="nuskaiciuoti-button" type="submit">Nuskaičiuoti</button>
        <input type="hidden" name="csrf" value="<?= $csrf?>">
    </form>
    <main class="choose-main">
        <a class ="saskaitu-sarasas" href="<?= self::DOMAIN . '/list' ?>">Sąskaitų sąrašas</a>
    </main>    
<?php require __DIR__ . '/bottom.php'?>