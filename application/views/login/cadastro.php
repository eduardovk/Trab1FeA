<?php ?>
<center>
    <div class="" style="margin-top: 56px;">
        <form class="form-group" style="max-width: 300px;" action="<?php echo site_url("login/cadastrar"); ?>" method="post">
            <h4>Cadastre-se</h4><br>
            <input type="email" class="form-control" name="email" placeholder="E-mail*" required><br>
            <input type="text" class="form-control" name="nome" placeholder="Nome Completo*" required><br>
            <input type="text" class="form-control" name="cpf" data-mask="000.000.000-00" placeholder="CPF">
            <br><br>
            <input type="password" class="form-control" name="senha" placeholder="Senha*" required><br>
            <input type="password" class="form-control" name="senha2" placeholder="Repita a senha*" required><br>
            <button type="submit" class="btn btn-primary" name="button">Cadastrar</button>
        </form>
    </div>
</center>
