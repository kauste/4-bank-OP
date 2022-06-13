<?php use Savers\Bank\App ?>

<nav class="header-nav">
        <div class="nav-logo">
            <img src="../images/pig-icon.png" alt="Pig_icon"></img>
            <span>Savers bank</span>
        </div>
        <div class="nav-links">
        <a class="nav-link" href="<?= App::DOMAIN?>">Pagrindinis</a> <!-- ???-->
        <a class="nav-link" href="<?= App::DOMAIN?>/list">Sąskaitų sąrašas</a>
        <a class="nav-link" href="<?= App::DOMAIN?>/createAccount">Sukurti naują sąskaitą</a>
        <form class="nav-link" action="<?= App::DOMAIN?>/logout" method="post">
           <button  class="logout" type="submit">Logout</button>
        </form>
        <div>
</nav>