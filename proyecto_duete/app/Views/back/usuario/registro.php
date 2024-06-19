
<div class="container-fluid registroContainer">
    <div class="col-lg-6 col-md-8 col-sm-10 col-12 registrarse">
        <h2>Crear Cuenta</h2>

        <?php $validation = \Config\Services::validation(); ?>
        <form class="registroForm" method="post" action="<?php echo base_url('/enviar-form') ?>" id="registroForm">

                <div class="imput-field">
                    <label for="ingresarNombre">Nombre <span class="requerido">*</span> </label>
                    <input name="nombre" type="text" class="form-control campoRegistro" id="ingresarNombreRegistro" placeholder="Nombre" value="<?= isset($oldInput['nombre']) ? esc($oldInput['nombre']) : '' ?>">
                    <!--Error-->
                    <div class="errorRegistro registroRequired" id="ingresarNombreRegistroRequired">
                        Este campo es obligatorio.
                    </div>
                    <?php if($validation->getError('nombre')) {?>
                        <div class="errorRegistro">
                            <?= $error = $validation->getError('nombre'); ?>
                        </div>
                    <?php }?>
                </div>

                <div class="imput-field">
                    <label for="ingresarApellido">Apellido <span class="requerido">*</span> </label>
                    <input name="apellido" type="text" class="form-control campoRegistro" id="ingresarApellidoRegistro" placeholder="Apellido" value="<?= isset($oldInput['apellido']) ? esc($oldInput['apellido']) : '' ?>">
                    <!--Error-->
                    <div class="errorRegistro registroRequired" id="ingresarApellidoRegistroRequired">
                        Este campo es obligatorio.
                    </div>
                    
                    <?php if($validation->getError('apellido')) {?>
                        <div class="errorRegistro">
                            <?= $error = $validation->getError('apellido'); ?>
                        </div>
                    <?php }?>
                </div>

                <div class="imput-field">
                    <label for="ingresarUsuario">Nombre de Usuario <span class="requerido">*</span> </label>
                    <input name="usuario" type="text" class="form-control campoRegistro" id="ingresarUsuarioRegistro" placeholder="Nombre de Usuario" value="<?= isset($oldInput['usuario']) ? esc($oldInput['usuario']) : '' ?>">
                    <!--Error-->
                    <div class="errorRegistro registroRequired" id="ingresarUsuarioRegistroRequired">
                        Este campo es obligatorio.
                    </div>
                    <?php if($validation->getError('usuario')) {?>
                        <div class="errorRegistro">
                            <?= $error = $validation->getError('usuario'); ?>
                        </div>
                    <?php }?>
                </div>

                <div class="imput-field">
                    <label for="ingresarTelefono">Número de Teléfono <span class="requerido">*</span> </label>
                    <input name="tel" type="tel" class="form-control campoRegistro" id="ingresarTelefonoRegistro" placeholder="Teléfono" value="<?= isset($oldInput['tel']) ? esc($oldInput['tel']) : '' ?>">
                    <!--Error-->
                    <div class="errorRegistro registroRequired" id="ingresarTelefonoRegistroRequired">
                        Este campo es obligatorio.
                    </div>
                    <?php if($validation->getError('tel')) {?>
                        <div class="errorRegistro">
                            <?= $error = $validation->getError('tel'); ?>
                        </div>
                    <?php }?>
                </div>
                <div class="imput-field">
                    <label for="ingresarEmail">Correo electrónico <span class="requerido">*</span> </label>
                    <input name="email" type="text" class="form-control campoRegistro" id="ingresarEmailRegistro" placeholder="ejemplo@ejemplo.com" value="<?= isset($oldInput['email']) ? esc($oldInput['email']) : '' ?>">
                    <!--Error-->
                    <div class="errorRegistro registroRequired" id="ingresarEmailRegistroRequired">
                        Este campo es obligatorio.
                    </div>
                    <?php if($validation->getError('email')) {?>
                        <div class="errorRegistro">
                            <?= $error = $validation->getError('email'); ?>
                        </div>
                    <?php }?>
                </div>
                <div class="imput-field">
                    <label for="ingresarContraseña">Contraseña <span class="requerido">*</span> </label>
                    <input name="pass" type="password" class="form-control campoRegistro" id="ingresarContraseñaRegistro" placeholder="Ingresá tu contraseña" value="<?= isset($oldInput['pass']) ? esc($oldInput['pass']) : '' ?>">
                    <i class="bi bi-eye-slash verContraseñaRegistro verContraseña"></i>
                    <!--Error-->
                    <div class="errorRegistro registroRequired" id="ingresarContraseñaRegistroRequired">
                        Este campo es obligatorio.
                    </div>
                    <?php if($validation->getError('pass')) {?>
                        <div class="errorRegistro">
                            <?= $error = $validation->getError('pass'); ?>
                        </div>
                    <?php }?>
                </div>
                <div class="imput-field">
                    <label for="ingresarContraseña2">Confirmar contraseña <span class="requerido">*</span> </label>
                    <input name="passconf" type="password" class="form-control campoRegistro" id="ingresarContraseña2Registro" placeholder="Volvé a ingresar tu contraseña" value="<?= isset($oldInput['passconf']) ? esc($oldInput['passconf']) : '' ?>">
                    <!--Error-->
                    <div class="errorRegistro registroRequired" id="ingresarContraseña2RegistroRequired">
                        Este campo es obligatorio.
                    </div>
                    <?php if($validation->getError('passconf')) {?>
                        <div class="errorRegistro">
                            <?= $error = $validation->getError('passconf'); ?>
                        </div>
                    <?php }?>
                </div>
                <div class="acepTYC">
                    <input name="acepTYC" class="form-check-input" type="checkbox"  id="aceptarTYC">
                    <label class="form-check-label" for="aceptarTYC">
                        Acepto los <a href="<?php echo base_url('terminos_y_condiciones')?>" target="_blank">Terminos y condiciones</a>
                        y las <a href="<?php echo base_url('terminos_y_condiciones#privacidad')?>" target="_blank">Políticas de privacidad.</a>
                    <span class="requerido">*</span> </label>
                </div>
                    <!--Error-->
                    <div class="errorRegistro registroRequired" id="aceptarTYCRequired">
                        Debes aceptar los Términos y Condiciones.
                    </div>
                    <?php if($validation->getError('acepTYC')) {?>
                        <div class="errorRegistro">
                            <?= $error = $validation->getError('acepTYC'); ?>
                        </div>
                    <?php }?>
        <input type="submit" class="btn botonRegistrarse" value="CREAR CUENTA">
        </form>

    </div>
</div>