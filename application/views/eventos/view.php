<!-- Page Content -->
<div class="container container-white">

    <?php
    if($admin){
        ?><a class="btn btn-dark btn-sm" href="<?php echo site_url('eventos/novo'); ?>"><i class="fa fa-plus"></i> Novo</a><?php
    }
    ?>

    <!-- Heading Row -->
    <div class="row my-4">
        <div class="col-md-7">
            <a href="#">
                <img class="img-fluid rounded mb-3 mb-md-0" style="width: 100%; max-height: 360px; object-fit: cover;" src="<?php echo base_url('assets/img/eventos/'. $evento['imagem']);?>" alt="">
            </a>
        </div>
        <div class="col-md-5">
            <br>
            <?php
            if($admin){
                ?>
                <div style="float: right;">
                    <a class="btn btn-dark btn-sm" href="<?php echo site_url('eventos/editar/'.$evento['id']); ?>"><i class="fa fa-edit"></i> Editar</a>
                    <a class="btn btn-dark btn-sm delete_data" href="#"  id="<?php echo $evento['id']; ?>"><i class="fa fa-minus-circle"></i> Excluir</a>
                </div>
                <?php
            }
            ?>
            <h5><?php echo $evento['titulo']; ?></h5>
            <p><b>Início:</b> <?php echo "TODO"; ?><br><b>Horário:</b> <?php echo "TODO"; ?></p>
            <p><b>Local do evento:</b><br><?php echo $evento['local']; ?></p>
            <?php echo anchor('eventos/ingressos/'.$evento['url_amiga'], 'Quero participar!', 'class="btn btn-danger btn-sm" style="margin-right:5px;margin-top:5px;"'); ?>
        </div>
        <!-- /.col-md-4 -->
    </div>
    <!-- /.row -->

    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">SOBRE O EVENTO</h5>
                    <hr>
                    <?php
                    echo '<p class="card-text">' . $evento['descricao'] . '</p>';
                    ?>
                </div>
            </div><br>
            <?php echo anchor('eventos/', '< Voltar', 'class="btn btn-danger btn-sm"'); ?>
        </div>
        <!-- /.col-md-4 -->

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->



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
<?php
