<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open_multipart('eventos/editar/'.$evento['id']); ?>

<label for="titulo">Título</label>
<input type="text" name="titulo" value="<?php echo $evento['titulo']; ?>"/><br />

<label for="descricao">Descrição</label>
<textarea name="descricao" ><?php echo $evento['descricao']; ?></textarea><br />

<label for="local">Local</label>
<textarea name="local" ><?php echo $evento['local']; ?></textarea><br />

<?php
if(!empty($evento['imagem'])){
    ?><img id="thumb_imagem" style="width: 200px; height: 200px; object-fit: cover;"
     src="<?php echo base_url('assets/img/eventos/'. $evento['imagem']);?>" /><br>
     <p><a href="#" class="delete_data">Remover Imagem</a></p><br><br>
     <?php
}
 ?>

<label for="imagem">Imagem</label>
<input type="file" name="imagem"><br />

<input type="hidden" name="excluir_img" id="excluir_img" value="false">

<input type="submit" name="submit" value="Salvar alterações" />
<?php
echo "<br><br>";
echo anchor('eventos/', 'Voltar', 'class="link-class"');
echo "<br>";
?>
</form>

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
