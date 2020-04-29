<h2><?php echo $title; ?></h2>

<?php foreach ($eventos as $evento): ?>

    <h3><?php echo $evento['titulo']; ?></h3>
    <div class="main">
        <?php echo $evento['descricao']; ?>
    </div>
    <p><a href="<?php echo site_url('eventos/'.$evento['url_amiga']); ?>">Ver mais</a></p>

<?php endforeach; ?>
