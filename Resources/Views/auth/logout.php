<?php layout('auth'); ?>

<?php section('content'); ?> 

<div class="alert alert-success text-center">
    Has cerrado sesión correctamente.  
    <a href="<?= url('login') ?>" class="alert-link">Volver al login</a>.
</div>

<?php endSection(); ?>
