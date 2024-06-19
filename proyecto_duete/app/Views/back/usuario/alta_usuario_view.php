<div class="container-fluid altaUsuarioContainer">
    <div class="col-lg-6 col-md-8 col-sm-10 col-12 altaUsuario">
        <h2>Alta de usuario</h2>

        <?php $validation = \Config\Services::validation(); ?>
        <form method="post" action="<?php echo base_url('/enviar-usuario') ?>" id="alta-usuario">

                <div class="imput-field">
                    <label for="ingresarNombre">Nombre <span class="requerido">*</span> </label>
                    <input name="nombre" type="text" class="form-control campoAltaUsuario" id="ingresarNombreAlta" placeholder="Nombre" value="<?= isset($oldInput['nombre']) ? esc($oldInput['nombre']) : '' ?>">
                    
                    <?php if($validation->getError('nombre')) {?>
                        <div class="errorAltaUsuario">
                            <?= $error = $validation->getError('nombre'); ?>
                        </div>
                    <?php }?>

                </div>

                <div class="imput-field">
                    <label for="ingresarApellido">Apellido <span class="requerido">*</span> </label>
                    <input name="apellido" type="text" class="form-control campoAltaUsuario" id="ingresarApellidoAlta" placeholder="Apellido" value="<?= isset($oldInput['apellido']) ? esc($oldInput['apellido']) : '' ?>">
                    
                    <?php if($validation->getError('apellido')) {?>
                        <div class="errorAltaUsuario">
                            <?= $error = $validation->getError('apellido'); ?>
                        </div>
                    <?php }?>

                </div>

                <div class="imput-field">
                    <label for="ingresarUsuario">Nombre de Usuario <span class="requerido">*</span> </label>
                    <input name="usuario" type="text" class="form-control campoAltaUsuario" id="ingresarUsuarioAlta" placeholder="Nombre de Usuario" value="<?= isset($oldInput['usuario']) ? esc($oldInput['usuario']) : '' ?>">
                    
                    <?php if($validation->getError('usuario')) {?>
                        <div class="errorAltaUsuario">
                            <?= $error = $validation->getError('usuario'); ?>
                        </div>
                    <?php }?>

                </div>

                <div class="imput-field">
                    <label for="ingresarTelefono">Número de Teléfono <span class="requerido">*</span> </label>
                    <input name="tel" type="tel" class="form-control campoAltaUsuario" id="ingresarTelefonoAlta" placeholder="Teléfono" value="<?= isset($oldInput['tel']) ? esc($oldInput['tel']) : '' ?>">
                    
                    <?php if($validation->getError('tel')) {?>
                        <div class="errorAltaUsuario">
                            <?= $error = $validation->getError('tel'); ?>
                        </div>
                    <?php }?>

                </div>
                <div class="imput-field">
                    <label for="ingresarEmail">Correo electrónico <span class="requerido">*</span> </label>
                    <input name="email" type="text" class="form-control campoAltaUsuario" id="ingresarEmailAlta" placeholder="ejemplo@ejemplo.com" value="<?= isset($oldInput['email']) ? esc($oldInput['email']) : '' ?>">
                    
                    <?php if($validation->getError('email')) {?>
                        <div class="errorAltaUsuario">
                            <?= $error = $validation->getError('email'); ?>
                        </div>
                    <?php }?>

                </div>
                <div class="imput-field">
                    <label for="ingresarContraseña">Contraseña <span class="requerido">*</span> </label>
                    <input name="pass" type="password" class="form-control campoAltaUsuario" id="ingresarContraseñaRegistro" placeholder="Ingresá tu contraseña" value="<?= isset($oldInput['pass']) ? esc($oldInput['pass']) : '' ?>">
                    <i class="bi bi-eye-slash verContraseñaRegistro verContraseña"></i>
                   
                    <?php if($validation->getError('pass')) {?>
                        <div class="errorAltaUsuario">
                            <?= $error = $validation->getError('pass'); ?>
                        </div>
                    <?php }?>

                </div>
         
        <input type="submit" class="btn botonRegistrarse botonEnviarProd mt-0" value="CREAR USUARIO">
        <a href="<?php echo base_url('/cancelar_alta_usuario') ?>" class="btn botonRegistrarse mt-3">CANCELAR</a>
        </form>

    </div>
    <script src="assets/js/bootstrap.bundle.min.js" integrity="" crossorigin=""></script>
    <script src="assets/js/swiper/swiper-bundle.min.js"></script>
    <script src="assets/js/swiper/script.js"></script>
</div>