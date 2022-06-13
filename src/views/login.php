<?php require __DIR__.'/top.php'?>
<h3>Login</h3>
<main class="login-main">
        <form class="login-form" action="" method="post">
            <label class="login-label" for="vardas">Vardas</label>
            <input class="login-inp" name="name" type="text">
            <label class="login-label" for="slaptazodis" hash>Slaptazodis</label>
            <input class="login-inp" type="password" name="password" type="text" >
            <button class="login-btn" type="submit">Login</button>
            <input type="hidden" name="csrf" value="<?= $csrf?>">
        </form>
    </main>
<?php require __DIR__.'/bottom.php'?>