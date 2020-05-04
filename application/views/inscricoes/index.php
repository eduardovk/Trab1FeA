<!-- Page Content -->
<div class="container container-white" style="margin-top: 20px;">


    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12 mb-4">

            <div class="card h-100">
                <div class="card-body table-responsive">
                    <h5 class="card-title">MINHAS INSCRIÇÕES</h5>
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
                            <td><?php echo $inscricao['titulo_evento'] ?></td>
                            <td><?php echo $inscricao['nome'] ?></td>
                            <td><?php echo $inscricao['titulo_ingresso'] ?></td>
                            <td>R$ <?php echo $inscricao['valor'] ?></td>
                            <td><?php echo $inscricao['pago'] ?></td>
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
