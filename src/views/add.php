<?php require __DIR__ . '/top.php'?>
<?php require __DIR__ . '/nav.php' ?>
<h3>Pridėti lėšų</h3>
        <form class="prideti-form" action="" method="post">
            <div class="prideti-vardas"><?php echo $client['vardas'] . ' ' . $client['pavarde']?></div>
            <div class="prideti-sask-likutis"><?php echo $client['suma']?> eur.</div>
            <input name="amount" class="prideti-input" type="text">
            <button class="prideti-button" type="submit">Pridėti</button>
            <input type="hidden" name="csrf" value="<?= $csrf?>">
        </form>
        <main class="choose-main">
            <a class ="saskaitu-sarasas" href="<?= self::DOMAIN . '/list' ?>">Sąskaitų sąrašas</a>
        </main>   
<?php require __DIR__ . '/bottom.php'?>