<!DOCTYPE html>

<?php if (session()->get('username')) : ?>
<p>Bienvenue, <?= session()->get('username'); ?> !</p>
<p>Bienvenue, <?= session()->get('id_user'); ?> !</p>
<h1> Bienvenue sur Jura </h1>

    
<?php endif; ?>


    
    


