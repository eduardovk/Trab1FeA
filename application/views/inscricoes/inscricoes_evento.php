<!-- Page Content -->
<div class="container container-white" style="margin-top: 20px;">

    <!-- Heading Row -->
    <div class="row my-4">
        <div class="col-md-7">
            <a href="#">
                <img class="img-fluid rounded mb-3 mb-md-0" style="width: 100%; max-height: 360px; object-fit: cover;" src="<?php echo base_url('assets/img/eventos/'. $evento['imagem']);?>" alt="">
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

    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12 mb-4">

            <div class="card h-100">
                <div class="card-body table-responsive">
                    <h5 class="card-title">LISTA DE INSCRIÇÕES</h5>
                    <table class="table">
                        <tr>
                            <th>Evento</th>
                            <th>Inscrito</th>
                            <th>Tipo de Ingresso</th>
                            <th>Valor</th>
                            <th>Pago</th>
                        </tr>
                        <?php
                        foreach($inscricoes as $inscricao){
                            ?>
                            <tr>
                                <td><?php echo $evento['titulo'] ?></td>
                                <td><?php echo $inscricao['nome'] ?></td>
                                <td><?php echo $inscricao['titulo_ingresso'] ?></td>
                                <td>R$ <?php echo $inscricao['valor'] ?></td>
                                <td><?php echo $inscricao['pago'] ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </div>
            </div><br>
            <?php echo anchor('eventos/', '< Voltar', 'class="btn btn-danger btn-sm"'); ?>

        </div>
        <!-- /.col-md-4 -->
    </div>
    <!-- /.row -->

</div>
<!-- /.container -->

<?php
