<?php if(isset($erro) && !empty($erro)){
    ?>
    <div class="alert alert-danger" role="alert" style="margin-top: 20px; margin-bottom: -20px;">
        <?php echo $erro; ?>
    </div>
    <?php
}
