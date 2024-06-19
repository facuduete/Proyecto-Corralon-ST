<?php
$session = session();
?>

<div class="container-fluid editarDatosPersonalesC">
    <div class="col-lg-6 col-md-8 col-sm-10 col-12 editarDatosP">
        <h2>Editar datos personales</h2>

        <?php $validation = \Config\Services::validation(); ?>
        
        <form method="post" action="<?php echo base_url('/enviar-editar-cuenta')?>" id="editar-datos-personales">

                <div class="imput-field">
                    <label for="ingresarNombre">Nombre <span class="requerido">*</span> </label>
                    <input name="nombre" type="text" class="form-control campoEditarDatosP" id="ingresarNombreEdit" placeholder="Nombre" value="<?php echo $session->get('nombre'); ?>">
                    
                    <?php if($validation->getError('nombre')) {?>
                        <div class="errorEditarUsuario">
                            <?= $error = $validation->getError('nombre'); ?>
                        </div>
                    <?php }?>

                </div>

                <div class="imput-field">
                    <label for="ingresarApellido">Apellido <span class="requerido">*</span> </label>
                    <input name="apellido" type="text" class="form-control campoEditarDatosP" id="ingresarApellidoEdit" placeholder="Apellido" value="<?php echo $session->get('apellido'); ?>">
                    
                    <?php if($validation->getError('apellido')) {?>
                        <div class="errorEditarUsuario">
                            <?= $error = $validation->getError('apellido'); ?>
                        </div>
                    <?php }?>

                </div>

                <div class="imput-field">
                    <label for="ingresarUsuario">Nombre de Usuario <span class="requerido">*</span> </label>
                    <input name="usuario" type="text" class="form-control campoEditarDatosP" id="ingresarUsuarioEdit" placeholder="Nombre de Usuario" value="<?php echo $session->get('usuario'); ?>">
                    
                    <?php if($validation->getError('usuario')) {?>
                        <div class="errorEditarUsuario">
                            <?= $error = $validation->getError('usuario'); ?>
                        </div>
                    <?php }?>

                </div>

                <div class="imput-field">
                    <label for="ingresarTelefono">Número de Teléfono <span class="requerido">*</span> </label>
                    <input name="tel" type="tel" class="form-control campoEditarDatosP" id="ingresarTelefonoEdit" placeholder="Teléfono" value="<?php echo $session->get('tel'); ?>">
                    
                    <?php if($validation->getError('tel')) {?>
                        <div class="errorEditarUsuario">
                            <?= $error = $validation->getError('tel'); ?>
                        </div>
                    <?php }?>

                </div>
                <div class="imput-field">
                    <label for="ingresarEmail">Correo electrónico <span class="requerido">*</span> </label>
                    <input name="email" type="text" class="form-control campoEditarDatosP" id="ingresarEmailEdit" placeholder="ejemplo@ejemplo.com" value="<?php echo $session->get('email'); ?>">
                    
                    <?php if($validation->getError('email')) {?>
                        <div class="errorEditarUsuario">
                            <?= $error = $validation->getError('email'); ?>
                        </div>
                    <?php }?>

                </div>
         
        <input type="submit" class="btn botonRegistrarse botonEnviarProd mt-4" value="GUARDAR">
        <a href="<?php echo base_url('/cancelar-editar-cuenta') ?>" class="btn botonRegistrarse mt-3">CANCELAR</a>
        </form>

    </div>
    <script src="assets/js/bootstrap.bundle.min.js" integrity="" crossorigin=""></script>
    <script src="assets/js/swiper/swiper-bundle.min.js"></script>
    <script src="assets/js/swiper/script.js"></script>
</div>