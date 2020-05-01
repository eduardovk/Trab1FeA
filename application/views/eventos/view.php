<?php
if(!empty($evento['imagem'])){
    ?><img style="width: 400px; height: 400px; object-fit: cover;"
    src="<?php echo base_url('assets/img/eventos/'. $evento['imagem']);?>" /><?php
}
echo '<h2>'.$evento['titulo'].'</h2>';
echo $evento['descricao'];
echo "<br><br>";
echo anchor('eventos/ingressos/'.$evento['url_amiga'], 'Quero participar!', 'class="link-class"');
echo "<br>";
if($admin){
    ?>
    <p><a href="<?php echo site_url('eventos/editar/'.$evento['id']); ?>">Editar</a></p>
    <p><a href="#" class="delete_data" id="<?php echo $evento['id']; ?>">Excluir</a></p>
    <?php
    echo "<br>";
}

echo anchor('eventos/', 'Voltar', 'class="link-class"');
echo "<br>";
?>
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
