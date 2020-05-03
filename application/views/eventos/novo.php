<?php echo validation_errors(); ?>
<?php echo form_open_multipart('eventos/novo'); ?>

<!-- Page Content -->
<div class="container container-white">

    <!-- Titulo Row -->
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <p class="card-text"><b>Título do Evento: </b><br> <input type="text" name="titulo" required /><br /></p>
                </div>
            </div>
        </div>
        <!-- /.col-md-4 -->
    </div>
    <!-- /.row -->

    <!-- Imagem Row -->
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card h-100">
                <div class="card-body" style="overflow: hidden;">
                    <p class="card-text"><b>Imagem do Evento: </b></p>
                    <b>Enviar nova imagem: </b><br>
                    <input type="file" name="imagem"><br />
                </div>
            </div>
        </div>
        <!-- /.col-md-4 -->
    </div>
    <!-- /.row -->

    <!-- Detalhes Row -->
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <p class="card-text"><b>Descrição do Evento: </b><br> <textarea name="descricao" required></textarea><br /></p>
                    <hr>
                    <p class="card-text"><b>Local do Evento: </b><br> <textarea name="local" required></textarea><br /></p>
                    <hr>
                    <p class="card-text"><b>Data do Evento: </b><br> <input type="date" name="data" required> </p>
                    <hr>
                    <p class="card-text"><b>Horário do Evento: </b><br> <input type="time" name="hora" required> </p>
                </div>
            </div>
        </div>
        <!-- /.col-md-4 -->
    </div>
    <!-- /.row -->

    <?php echo anchor('eventos/', 'Cancelar', 'class="btn btn-danger btn-sm"'); ?>
    <button type="submit" class="btn btn-danger btn-sm">Salvar</button>
    <br><br>

</div>
<!-- /.container -->

</form>
