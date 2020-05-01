<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open_multipart('eventos/novo'); ?>

<label for="titulo">Título</label>
<input type="text" name="titulo" /><br />

<label for="descricao">Descrição</label>
<textarea name="descricao"></textarea><br />

<label for="local">Local</label>
<textarea name="local"></textarea><br />

<label for="imagem">Imagem</label>
<input type="file" name="imagem"><br />

<input type="submit" name="submit" value="Cadastrar" />
<?php
echo "<br><br>";
echo anchor('eventos/', 'Voltar', 'class="link-class"');
echo "<br>";
?>

</form>
