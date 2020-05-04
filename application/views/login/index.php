<?php ?>
<center>
    <div class="" style="margin-top: 56px;">
        <form class="form-group" style="max-width: 300px;" action="<?php echo site_url("login/entrar"); ?>" method="post">
            <h4>Já possui conta?</h4><br>
            <input type="email" class="form-control" name="email" placeholder="E-mail" required><br>
            <input type="password" class="form-control" name="senha" placeholder="Senha" required><br>
            <button type="submit" class="btn btn-primary" name="button">Entrar</button><br><br>
            <a href="<?php echo site_url("login/cadastrar"); ?>">Criar conta</a>
        </form>
        <br>
        <div class="">
            <p> <b>Usuáio admin neste exemplo:</b> </p>
            <p> <b>E-mail: <span style="color:red">eduardo@teste.com</span>    Senha: <span style="color:red">abc123</span></b> </p>
        </div>
    </div>
</center>
