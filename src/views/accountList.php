<?php require __DIR__.'/top.php'?>
    <h3>Saskaitų sąrašas</h3>
        <main class="saraso-main">
            <div class="saraso-keys">
                <div class="saraso-key saraso-varas">Vardas</div>
                <div class="saraso-key saraso-pavarde">Pavarde</div>
                <div class="saraso-key saraso-AK">Asmens kodas</div>
                <div class="saraso-key saraso-sask-nr">Sąskaitos numeris</div>
                <div class="saraso-key saraso-sask-likutis">Sąskaitos likutis</div>
            </div>
<?php foreach($list as $item) : ?>
            <form class="saraso-vertes" action="CIA REIKES KEISTI" method="post">
                    <div class="saraso-verte saraso-varas"><?= $item['vardas'] ?></div>
                    <div class="saraso-verte saraso-pavarde"><?= $item['pavarde'] ?></div>
                    <div class="saraso-verte saraso-AK"><?= $item['asmens-kodas'] ?></div>
                    <div class="saraso-verte saraso-sask-nr"><?= $item['saskaitos-numeris'] ?></div>
                    <div class="saraso-verte saraso-sask-likutis"><?= $item['suma'] ?></div>
                    <a class="prideti-lesu" href="#">Pridėti lėšų</a>
                    <a class="nuskaiciuoti-lesu" href="#">Nuskaičiuoti lėšas</a>
                    <button type="submit">Ištrinti</button>
            </form>
<?php endforeach ?>
        </main>
<?php require __DIR__.'/bottom.php'?>
