<h1><?=$title?></h1>


<? if (isset($users) && is_object($users)): ?>

        <?php $user; ?>
        

<? else : ?>

    <p> <?=$content?> </p>
