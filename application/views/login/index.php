<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <?php
            if(!empty($erro)){
                echo "<h3 style='color:red'>".$erro."</h3>";
            }
         ?>
        <form action="<?php echo site_url("login/entrar"); ?>" method="post">
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit" name="button">Entrar</button>
        </form>
    </body>
</html>