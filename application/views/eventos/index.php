<?php
if($nome){
    echo "<h3>Bem-vindo, $nome!</h3>";
}
if($admin){
    ?><p><a href="<?php echo site_url('eventos/novo'); ?>">Novo</a></p><?php
}
?>
<h2><?php echo $title; ?></h2>

<?php foreach ($eventos as $evento):
    if(!empty($evento['imagem'])){
        ?><img style="width: 400px; height: 400px; object-fit: cover;"
         src="<?php echo base_url('assets/img/eventos/'. $evento['imagem']);?>" /><?php
    }
    ?>
    <h3><?php echo $evento['titulo']; ?></h3>
    <div class="main">
        <?php echo $evento['descricao']; ?>
    </div>
    <p><a href="<?php echo site_url('eventos/'.$evento['url_amiga']); ?>">Ver mais</a></p>
    <?php
    if($admin){
        ?>
        <p><a href="<?php echo site_url('eventos/editar/'.$evento['id']); ?>">Editar</a></p>
        <p><a href="#" class="delete_data" id="<?php echo $evento['id']; ?>">Excluir</a></p>
        <?php
    }
    ?>

<?php endforeach; ?>

<script>
$(document).ready(function(){
    $('.delete_data').click(function(){
        var id = $(this).attr("id");
        if(confirm("Tem certeza que deseja excluir este evento?")){
            window.location="<?php echo site_url('eventos/deletar/'); ?>"+id;
        }
    });
});
</script>
