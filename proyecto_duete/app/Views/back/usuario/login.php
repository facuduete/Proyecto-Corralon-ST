<div class="container-fluid inicioSesionContainer">
    <div class="col-lg-6 col-md-8 col-sm-10 col-12 inicioSesion">
        <h2>Ingresar</h2>
        <p>¿Todavía no tenés cuenta? <a href="<?php echo base_url('registro') ?>">Crear cuenta </a></p>

        <?php $validation = \Config\Services::validation(); ?>

        <!--Mensaje de Auth al redireccionar al login-->
        <?php if(session()->getFlashData('AuthFail')):?>
            <div class="alert alert-danger" id="msgAuthError">
                <i class="bi bi-exclamation-octagon-fill"></i>
                <?=session()->getFlashData('AuthFail');?>
            </div>
        <?php endif?>


        <!--Mensaje usuario registrado con éxito-->
        <?php if(!empty (session()->getFlashData('fail'))):?>
            <div class="alert alert-danger">
                <?=session()->getFlashData('fail');?>
            </div>
                <?php endif?>
            <?php if (!empty (session()->getFlashData('success'))):?>
                <div class="alert alert-success usuarioRegistradoMsg" id="usuarioRegistradoMsg">
                    <i class="bi bi-check-circle-fill"></i>
                    <?=session()->getFlashData('success');?>
                </div>
                <?php endif?>

        <form id="loginForm" method="post" action="<?php echo base_url('/enviarlogin') ?>">
            
            <div>
                <div class="imput-field">
                    <label for="ingresarEmail2">Correo electrónico <span class="requerido">*</span></label>
                    <input name="email" type="text" class="form-control campoInicio" id="ingresarEmailLogin" placeholder="ejemplo@ejemplo.com" value="<?= isset($oldInput['email']) ? esc($oldInput['email']) : '' ?>">
                    <div class="loginRequired errorLogin" id="emailError">
                        Este campo es obligatorio. 
                    </div>
                    <!--Error-->
                    <?php if($validation->getError('email')) {?>
                        <div class="errorLogin">
                            <?= $error = $validation->getError('email'); ?>
                        </div>
                    <?php }?>
                </div>

                <div class="imput-field">
                    <label for="ingresarContraseña">Contraseña <span class="requerido">*</span></label>
                    <input name="pass" type="password" class="form-control campoInicio" id="ingresarContraseñaLogin" placeholder="Ingresá tu contraseña" value="<?= isset($oldInput['pass']) ? esc($oldInput['pass']) : '' ?>">
                    <i class="bi bi-eye-slash verContraseñaLogin verContraseña"></i>
                    <div class="loginRequired errorLogin" id="passError">
                        Este campo es obligatorio.
                    </div>
                    <!--Error-->
                    <?php if($validation->getError('pass')) {?>
                        <div class="errorLogin">
                            <?= $error = $validation->getError('pass'); ?>
                        </div>
                    <?php }?>
                </div>

                <?php if (session()->getFlashData('msg')):?>
                    <div class="alert alert-danger mt-3">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        <?= session()->getFlashData('msg')?>
                    </div>
                <?php endif;?>

                
                <div class="recordarme">
                    <a href="#">Olvidé mi contraseña</a>
                    <!--
                    <input class="form-check-input" type="checkbox"  id="recordarme">
                    <label class="form-check-label" for="recordarme">Recordarme</label> -->
                </div>
            </div>
        <input type="submit" class="btn botonIniciar" value="INGRESAR">
        </form>
        
    </div>
</div>


  