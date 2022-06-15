<?php require __DIR__.'/top.php'?>
<?php require __DIR__ . '/nav.php' ?>
    <h3>Saskaitų sąrašas</h3>
        <main class="saraso-main">
            <div class="saraso-keys">
                <div class="saraso-key saraso-varas">Vardas</div>
                <div class="saraso-key saraso-pavarde">Pavarde</div>
                <div class="saraso-key saraso-AK">Asmens kodas</div>
                <div class="saraso-key saraso-sask-nr">Sąskaitos numeris</div>
                <div class="saraso-key saraso-sask-likutis">Sąskaitos likutis</div>
                <form action="" method="post">
                    <button type="submit" class="currency">EUR</button>
                </form>
                
            </div>
<?php foreach($list as $key => $item) : ?>
            <form class="saraso-vertes" action="<?= self::DOMAIN . '/list/' . $item['id']?>" method="post"><!-- gerai, kad urlas, o ne path???-->
                    <div class="saraso-verte saraso-varas"><?= $item['vardas'] ?></div>
                    <div class="saraso-verte saraso-pavarde"><?= $item['pavarde'] ?></div>
                    <div class="saraso-verte saraso-AK"><?= $item['asmens-kodas'] ?></div>
                    <div class="saraso-verte saraso-sask-nr"><?= $item['saskaitos-numeris'] ?></div>
                    <div class="saraso-verte saraso-sask-likutis"><?= $item['suma'] ?></div>
                    <span class="currency">EUR</span>
                    <a class="prideti-lesu" href="<?= self::DOMAIN . '/add/' . $item['id']?>">Pridėti lėšų</a>
                    <a class="nuskaiciuoti-lesu" href="<?= self::DOMAIN . '/subtract/' . $item['id']?>">Nuskaičiuoti lėšas</a>
                    <button type="submit">Ištrinti</button>
                    <input type="hidden" name="csrf" value="<?= $csrf?>">
            </form>
<?php endforeach ?>
        </main>
<?php require __DIR__.'/bottom.php'?>
