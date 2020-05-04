<!-- Page Content -->
<div class="container container-white" style="margin-top: 20px;">

    <?php if($admin){
        ?><a class="btn btn-dark btn-sm" href="<?php echo site_url('eventos/novo'); ?>"><i class="fa fa-plus"></i> Novo</a><?php
    } ?>

    <!-- Content Row EVENTOS-->
    <div class="row">

        <?php foreach ($eventos as $evento): ?>
            <div class="col-md-12"><br></div>
            <div class="col-md-7">
                <a href="#">
                    <?php
                    if(!empty($evento['imagem'])){
                        ?><img class="img-fluid rounded mb-3 mb-md-0" style="width: 100%; max-height: 360px; object-fit: cover;"  src="<?php echo base_url('assets/img/eventos/'. $evento['imagem']);?>" /><?php
                    }else{
                        ?><img class="img-fluid rounded mb-3 mb-md-0" style="width: 100%; max-height: 360px; object-fit: cover;"  src="" alt=""><?php
                    }
                    ?>
                </a>
            </div>
            <div class="col-md-5">
                <?php
                if($admin){
                    ?>
                    <div style="float: right;">
                        <a class="btn btn-dark btn-sm" href="<?php echo site_url('eventos/editar/'.$evento['id']); ?>"><i class="fa fa-edit"></i> Editar</a>
                        <a class="btn btn-dark btn-sm" href="<?php echo site_url('eventos/categorias_ingressos/'.$evento['id']); ?>"><i class="fa fa-ticket"></i> Ingressos</a>
                        <a class="btn btn-dark btn-sm" href="<?php echo site_url('eventos/inscricoes/'.$evento['id']); ?>"><i class="fa fa-list"></i> Inscrições</a>
                        <a class="btn btn-dark btn-sm delete_data" href="#"  id="<?php echo $evento['id']; ?>"><i class="fa fa-minus-circle"></i> Excluir</a>
                    </div><br><br>
                    <?php
                }
                ?>
                <h4><?php echo $evento['titulo']; ?></h4>
                <p><b>Data:</b> <?php echo $evento['data']; ?><br><b>Horário:</b> <?php echo $evento['hora']; ?></p>
                <p><?php echo $evento['descricao']; ?></p>
                <a class="btn btn-danger btn-sm" href="<?php echo site_url('eventos/'.$evento['url_amiga']); ?>">Ver mais</a></p>
            </div>

            <div class="col-md-12 mb-12"><br><hr></div>
        <?php endforeach; ?>

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
