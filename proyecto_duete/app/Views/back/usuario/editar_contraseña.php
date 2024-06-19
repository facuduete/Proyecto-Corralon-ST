<div class="container-fluid editarDatosPersonalesC">
    <div class="col-lg-5 col-md-8 col-sm-10 col-12 editarDatosP">
        <h2>Editar contraseña</h2>

        <?php $validation = \Config\Services::validation(); ?>
        <form method="post" action="<?php echo base_url('/enviar-editar-pass') ?>" id="editarPassForm">

                <?php if(session()->getFlashData('AuthFail')):?>
                    <div class="alert alert-danger" id="msgAuthError">
                        <i class="bi bi-exclamation-octagon-fill"></i>
                        <?=session()->getFlashData('AuthFail');?>
                    </div>
                <?php endif?>
        
                <div class="imput-field">
                    <label for="ingresarContraseña">Contraseña actual <span class="requerido">*</span> </label>
                    <input name="passActual" type="password" class="form-control campoEditarDatosP" id="passActual" placeholder="Ingresá tu contraseña" value="<?= set_value('passActual') ?>">
                    <i onclick="verContraseñaEditar('passActual')" id="verpassActual" class="bi bi-eye-slash verContraseñaRegistro verContraseña"></i>
                    <?php if($validation->getError('passActual')) {?>
                        <div class="errorEditarUsuario">
                            <?= $error = $validation->getError('passActual'); ?>
                        </div>
                    <?php }?>
                </div>

                <div class="imput-field">
                    <label for="ingresarContraseña">Nueva contraseña <span class="requerido">*</span> </label>
                    <input name="passNueva" type="password" class="form-control campoEditarDatosP" id="passNueva" placeholder="Ingresá tu nueva contraseña" value="<?= set_value('passNueva') ?>">
                    <i onclick="verContraseñaEditar('passNueva')" id="verpassNueva" class="bi bi-eye-slash verContraseñaRegistro verContraseña"></i>

                    <?php if($validation->getError('passNueva')) {?>
                        <div class="errorEditarUsuario">
                            <?= $error = $validation->getError('passNueva'); ?>
                        </div>
                    <?php }?>
                </div>

                <div class="imput-field">
                    <label for="ingresarContraseña2">Confirmar contraseña <span class="requerido">*</span> </label>
                    <input name="passNueva2" type="password" class="form-control campoEditarDatosP" id="passNueva2" placeholder="Volvé a ingresar tu contraseña" value="<?= set_value('passNueva2') ?>">
                    <?php if($validation->getError('passNueva2')) {?>
                        <div class="errorEditarUsuario">
                            <?= $error = $validation->getError('passNueva2'); ?>
                        </div>
                    <?php }?>
                </div>

        <input type="submit" class="btn botonRegistrarse botonEnviarProd mt-4" value="GUARDAR">
        <a href="<?php echo base_url('/cancelar-editar-cuenta') ?>" class="btn botonRegistrarse mt-3">CANCELAR</a>
        </form>

    </div>
</div>