<!-- Page Content -->
<div class="container container-white" style="margin-top: 20px;">

    <!-- Heading Row -->
    <div class="row my-4">
        <div class="col-md-3">
            <a href="#">
                <?php
                if(!empty($evento['imagem'])){
                    ?>
                    <img class="img-fluid rounded mb-3 mb-md-0" style="width: 200px; height: 200px; object-fit: cover;" src="<?php echo base_url('assets/img/eventos/'. $evento['imagem']);?>" alt="">
                    <?php
                }else{
                    ?>
                    <img class="img-fluid rounded mb-3 mb-md-0" style="width: 200px; height: 200px; object-fit: cover;" src="<?php echo base_url('assets/img/eventos/default.png');?>" alt="">
                    <?php
                }
                ?>
            </a>
        </div>
        <div class="col-md-9">
            <br>
            <h5><?php echo $evento['titulo']; ?></h5>
            <p><b>Início:</b> <?php echo "TODO"; ?><br><b>Horário:</b> <?php echo "TODO"; ?></p>
            <p><b>Local do evento:</b><br><?php echo $evento['local']; ?></p>
        </div>
        <!-- /.col-md-4 -->
    </div>
    <!-- /.row -->

    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12 mb-4">

            <form action="<?php echo site_url('eventos/atualizar_ingressos/'.$evento['id']); ?>" method="post">

                <div class="card h-100">
                    <div class="card-body table-responsive">
                        <h5 class="card-title">EDITAR INGRESSOS</h5>
                        <table class="table" id="tabela_ingressos" style="overflow:auto;">
                            <tbody id="ingressos">
                                <tr>
                                    <th>Ação</th>
                                    <th>Título</th>
                                    <th>Valor</th>
                                    <th>Qtd. Total</th>
                                    <th>Qtd. Restante</th>
                                </tr>
                                <?php
                                if($cat_ingressos){
                                    foreach ($cat_ingressos as $cat_ingresso) {
                                        $id = $cat_ingresso['id'];
                                        ?>
                                        <tr id="ingresso-<?php echo $id; ?>">
                                            <td><a class="btn btn-dark btn-sm" onclick="deletar_ingresso(<?php echo $id; ?>)"  href="#" ><i class="fa fa-minus-circle"></i> Excluir</a></td>
                                            <td>
                                                <input type="text" name="titulo-<?php echo $id; ?>" id="titulo-<?php echo $id; ?>"
                                                value="<?php echo $cat_ingresso['titulo']; ?>" placeholder="Ex.: Ingresso (Meia) Arquibancada " required>
                                                <input type="hidden" name="ativo-<?php echo $id; ?>" id="ativo-<?php echo $id; ?>" value="1">
                                            </td>
                                            <td>
                                                <input type="text" name="valor-<?php echo $id; ?>" id="valor-<?php echo $id; ?>" value="<?php echo $cat_ingresso['valor']; ?>"
                                                onKeyPress="return(MascaraMoeda(this, '.', ',', event))" placeholder="Ex.: 125,00" required>
                                            </td>
                                            <td>
                                                <input type="number" name="qtd-<?php echo $id; ?>" id="qtd-<?php echo $id; ?>" value="<?php echo $cat_ingresso['qtd']; ?>" placeholder="Ex.: 200" required>
                                            </td>
                                            <td>
                                                <input type="number" name="qtd_restante-<?php echo $id; ?>" id="qtd_restante-<?php echo $id; ?>" value="<?php echo $cat_ingresso['qtd_restante']; ?>"  disabled>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </tr>
                        <td><a class="btn btn-dark btn-sm novo_ingresso" href="#" ><i class="fa fa-plus"></i> Novo</a></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </div><br>
        <?php echo anchor('eventos/', 'Cancelar', 'class="btn btn-danger btn-sm"'); ?>
        <button type="submit" class="btn btn-danger btn-sm">Salvar</button>

    </form>

</div>
<!-- /.col-md-4 -->
</div>
<!-- /.row -->

</div>
<!-- /.container -->



<script>

var new_id = 0;

$(document).ready(function(){
    $('.novo_ingresso').click(function(){
        new_id++;
        var nova_linha = `<tr id="novo-`+new_id+`">
        <td><a class="btn btn-dark btn-sm deletar_novo" onclick="deletar_novo(`+new_id+`)" href="#" ><i class="fa fa-minus-circle"></i> Excluir</a></td>
        <td>
        <input type="text" name="titulo-novo-`+new_id+`"  id="titulo-novo-`+new_id+`" value="" placeholder="Ex.: Ingresso (Meia) Arquibancada " required>
        <input type="hidden" name="ativo-novo-`+new_id+`" id="ativo-novo-`+new_id+`" value="1">
        </td>
        <td>
        <input type="text" name="valor-novo-`+new_id+`" id="valor-novo-`+new_id+`" value="" onKeyPress="return(MascaraMoeda(this, '.', ',', event))" placeholder="Ex.: 125,00" required>
        </td>
        <td>
        <input type="number" name="qtd-novo-`+new_id+`" id="qtd-novo-`+new_id+`" value="" placeholder="Ex.: 200" required>
        </td>
        <td>
        <input type="number" name="qtd_restante-novo-`+new_id+`" id="qtd_restante-novo-`+new_id+`" value="0" disabled>
        </td>
        </tr>`;
        $('#ingressos').append(nova_linha);
    });
});

function deletar_novo(id){
    if(confirm("Tem certeza que deseja excluir esta categoria de ingresso?")){
        $('#novo-'+id).remove();
    }
}

function deletar_ingresso(id){
    if(confirm("Tem certeza que deseja excluir esta categoria de ingresso?")){
        $('#ingresso-'+id).hide();
        $('#titulo-'+id).removeAttr("required");
        $('#valor-'+id).removeAttr("required");
        $('#qtd-'+id).removeAttr("required");
        $('#ativo-'+id).val(0);
    }
}

$(document).ready(function(){
    $('.deletar_novo').click(function(){
        var id = $(this).attr("id");
        if(confirm("Tem certeza que deseja excluir esta categoria de ingresso?")){
            $('.novo-'+id).remove();
        }
    });
});

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
