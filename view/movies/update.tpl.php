<h1><?=$title?></h1>


<? if (isset($movies) && is_object($movies)): ?>

        <?php $movie; ?>
        

<? else : ?>

    <p> <?=$content?> </p>

<? endif; ?>
 
<p><a href='<?=$this->url->create('movies/update')?>'><i class="fa fa-arrow-left"></i> Back</a></p>
