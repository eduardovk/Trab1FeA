<?php echo validation_errors(); ?>
<?php echo form_open('eventos/ingressos/'.$evento['url_amiga']); ?>
<!-- Page Content -->
<div class="container container-white" style="margin-top: 20px;">

    <!-- Heading Row -->
    <div class="row my-4">
        <div class="col-md-7">
            <a href="#">
                <img class="img-fluid rounded mb-3 mb-md-0" style="width: 100%; max-height: 260px; object-fit: cover;" src="<?php echo base_url('assets/img/eventos/'. $evento['imagem']);?>" alt="">
            </a>
        </div>
        <div class="col-md-5">
            <br>
            <h5><?php echo $evento['titulo']; ?></h5>
            <p><b>Data:</b> <?php echo $evento['data']; ?><br><b>Horário:</b> <?php echo $evento['hora']; ?></p>
            <p><b>Local do evento:</b><br><?php echo $evento['local']; ?></p>
        </div>
        <!-- /.col-md-4 -->
    </div>
    <!-- /.row -->

    <?php
    if(isset($ingressos) && sizeof($ingressos) > 0){
        ?>
        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">COMPRAR INGRESSO</h5>
                        <hr>
                        <?php
                        foreach($ingressos as $ingresso){
                            if($ingresso['qtd_restante'] < 1){
                                echo '<p class="card-text">(Esgotado) <s>' . $ingresso['titulo'] .' - R$ '.$ingresso['valor'].'</s></p>';
                            }else{
                                $id = $ingresso['id'];
                                ?>
                                <p class="card-text">
                                    <input type="radio" name="ingresso" value="<?php echo $id; ?>" id="<?php echo $id; ?>" required>
                                    <label for="<?php echo $id; ?>"><?php echo $ingresso['titulo'] ?> - R$ <?php echo $ingresso['valor']; ?></label><br>
                                </p>
                                <?php
                            }
                        }
                        ?>
                        <label for="nome"><b>Comprar para:</b></label><br>
                        <input type="text" name="nome" id="nome" placeholder="Nome completo do inscrito" style="width: 250px;" required><br><br>
                        <button type="submit" class="btn btn-danger btn-sm">Comprar</button>
                    </div>
                </form>
            </div><br>
            <?php echo anchor('eventos/', '< Voltar', 'class="btn btn-danger btn-sm"'); ?>
        </div>
        <!-- /.col-md-4 -->
    </div>
    <!-- /.row -->
    <?php
}
?>

</div>
<!-- /.container -->
