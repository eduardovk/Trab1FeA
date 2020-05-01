<!-- /////////////////////////////////////////////////////////////////////////////////////////////// -->
<body>
    <!-- Page Content -->
    <div class="container container-white">
        <!-- Content Row EVENTOS-->
        <div class="row">
            <div class="col-md-12"><br></div>
            <div class="col-md-7">
                <a href="#">
                    <img class="img-fluid rounded mb-3 mb-md-0" src="" alt="">
                </a>
            </div>
            <div class="col-md-5">
                <h4>TITULO DO EVENTO</h4>
                <p>CHAMADA DO EVENTO...</p>
                <form name="" action="" method="post">
                    <button type="button" onclick="" name="ver_evento" class="btn btn-danger btn-sm">Mais informa&ccedil;&otilde;es</button>
                </form>
            </div>
            <!-- NOTÍCIAS -->
            <div class="col-md-12 mb-12"><br><hr></div>
            <!-- /.col-md-4 -->
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container -->
</body>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////// -->


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
