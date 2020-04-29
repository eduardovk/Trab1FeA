<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('eventos/novo'); ?>

    <label for="titulo">Título</label>
    <input type="text" name="titulo" /><br />

    <label for="descricao">Descrição</label>
    <textarea name="descricao"></textarea><br />

    <label for="local">Local</label>
    <textarea name="local"></textarea><br />

    <input type="submit" name="submit" value="Cadastrar" />

</form>
