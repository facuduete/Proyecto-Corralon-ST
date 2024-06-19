<?php
$session = session();
$nombre = $session->get('nombre');
$apellido = $session->get('apellido');
?>
<?php if (!empty (session()->getFlashData('logeadoMsg'))):?>
        <div class="alert alert-success h5 usuarioRegistradoMsg m-3 text-center" id="usuarioRegistradoMsg">
            <?=session()->getFlashData('logeadoMsg');?>
        </div>
    <?php endif?>
    <?php if (!empty (session()->getFlashData('error'))):?>
        <div class="alert alert-danger h5 usuarioRegistradoMsg m-3 text-center" id="usuarioRegistradoMsg">
            <?=session()->getFlashData('error');?>
        </div>
    <?php endif?>

<div class="container miCuenta mt-5 mb-5">
    <h2>Mi cuenta</h2>
    <div class="row">

        
        <div class="col-md-6 col-sm-12 col-12">
            <div class="col-12 container miCuentaContainer1">
                <p class="nombreUser">
                    <?php echo $nombre .' '. $apellido; ?>
                </p>
                <div class="row cabeceraCardPerfil">
                    <p>
                    <?php echo $session->get('email');?>
                    <a href="<?php echo base_url('/editar-cuenta') ?>" class="editarPerfil linksInfo">Editar <i class="bi bi-gear"></i></a>
                    </p>
                </div>
                <div class="row">
                    <div class="col-4 fw-bold">
                        <p class="mt-3">Usuario</p>
                        <p>Teléfono</p>
                        <p>Tipo de cuenta</p>
                    </div>
                    <div class="col-8">
                        <p class="mt-3"><?php echo $session->get('usuario');?></p>
                        <p><?php echo $session->get('tel');?></p>
                        <p><?php if ($session->get('perfil_id') == 1) {
                            echo ('Admin <i class="bi bi-person-fill-gear"></i>');
                        }
                        else {
                            echo ('Usuario <i class="bi bi-person-fill"></i>');
                        }?></p> 
                    </div>
                </div>
            </div>
            <div class="col-12 container miCuentaContainer1">
                <p class="nombreUser">Contraseña<a href="<?php echo base_url('/editar-pass') ?>" class="editarPass linksInfo">Editar <i class="bi bi-key"></i></a></p>
            </div>
        </div>

        <?php if (!$tieneCompra): ?>
        <div class="col-md-6 col-sm-12 col-12">
            <div class="col-12 container miCuentaContainer1">
                <div class="row cabeceraCardPerfil">
                    <p class="nombreUser">Compras</p>
                </div>
                <div class="row">
                    <p class="fw-bold mt-3">Aún no tenés compras realizadas</p>
                </div>
            </div>
        </div>
        <?php else: ?>
        <div class="col-md-6 col-sm-12 col-12">
            <div class="col-12 container miCuentaContainer1">
                <div class="row">
                    <p class="nombreUser">Compras<a href="<?php echo base_url('/ver-compras') ?>" class="editarPass linksInfo">Ver compras <i class="bi bi-cart3"></i></a></p>
                </div>
            </div>
        </div>
        <?php endif; ?>

    </div>
</div>