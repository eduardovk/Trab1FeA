<?php echo validation_errors(); ?>
<?php echo form_open_multipart('eventos/editar/'.$evento['id']); ?>

<!-- Page Content -->
<div class="container container-white">

    <!-- Titulo Row -->
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <p class="card-text"><b>Título do Evento: </b><br> <input type="text" name="titulo" value="<?php echo $evento['titulo']; ?>"/><br /></p>
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
                    <?php
                    if(!empty($evento['imagem'])){
                        ?><img id="thumb_imagem" style="max-width: 100%; max-height: 360px; object-fit: cover;"
                        src="<?php echo base_url('assets/img/eventos/'. $evento['imagem']);?>" /><br><br>
                        <p><a href="#" class="btn btn-dark btn-sm delete_data "><i class="fa fa-minus-circle"></i> Remover Imagem</a></p>
                        <?php
                    }
                    ?>
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
                    <p class="card-text"><b>Descrição do Evento: </b><br> <textarea name="descricao" required><?php echo $evento['descricao']; ?></textarea><br /></p>
                    <hr>
                    <p class="card-text"><b>Local do Evento: </b><br> <textarea name="local" required><?php echo $evento['local']; ?></textarea><br /></p>
                    <hr>
                    <p class="card-text"><b>Data do Evento: </b><br> <input type="date" name="data" value="<?php echo $evento['data']; ?>" required> </p>
                    <hr>
                    <p class="card-text"><b>Horário do Evento: </b><br> <input type="time" name="hora" value="<?php echo $evento['hora']; ?>" required> </p>
                </div>
            </div>
        </div>
        <!-- /.col-md-4 -->
    </div>
    <!-- /.row -->

    <?php echo anchor('eventos/', 'Cancelar', 'class="btn btn-danger btn-sm"'); ?>
    <button type="submit" class="btn btn-danger btn-sm">Salvar alterações</button>
    <br><br>
</form>

</div>
<!-- /.container -->

<script>
$(document).ready(function(){
    $('.delete_data').click(function(){
        if(confirm("Tem certeza que deseja remover a imagem?")){
            $('#excluir_img').val("true");
            $('.delete_data').hide();
            $('#thumb_imagem').hide();
        }
    });
});
</script>
