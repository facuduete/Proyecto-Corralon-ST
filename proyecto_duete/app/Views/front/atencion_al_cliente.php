<div>
  <img src="assets/img/banner_atcliente.png" alt="atención_al_cliente" class="imagenAtCliente">
  <img src="assets/img/banner_atcliente1.png" alt="atención_al_cliente" class="imagenAtCliente1">
</div>
<div class="container-fluid horarios">
  <h1>Atención al cliente</h1>
  <p>Consultas por Canales escritos: (Whatsapp y redes sociales)
    <br><span>Lunes a Viernes de 8 a 20 hs</span>
  </p>
  <p>Consultas por teléfono: (0800-555-CORRST)
    <br><span>Lunes a Viernes de 9 a 19 hs</span>
  <p>
</div>

<div class="formularioTxt" id="tituloFormAt">
  <h2>Completá el formulario</h2>
  <h4>¡Te responderemos en la brevedad!</h4>
</div>

<div class="container-fluid formularioContainer col-md-12 col-lg-6">
  <?php $validation = \Config\Services::validation(); ?>
  <form method="post" action="<?php echo base_url('/enviar-consulta') ?>" id="atc-form" class="formularioAtCliente pb-4 pt-3">

    <div class="imput-field">
      <label for="ingresarNombre" class="form-label label-top">Nombre y apellido <span class="requerido">*</span></label>
      <div class="row">
        <div class="col-md-6">
          <input name="nombreAtC" type="text" class="form-control campoForm" id="ingresarNombreAt" value="<?= isset($oldInput['nombreAtC']) ? esc($oldInput['nombreAtC']) : '' ?>">
          <div class="form-text" id="ingresarNombre">Nombre</div>
          <?php if($validation->getError('nombreAtC')) {?>
            <div class="form-text errorAtCliente mt-0">
                <?= $error = $validation->getError('nombreAtC'); ?>
            </div>
          <?php }?>
        </div>


        <div class="col-md-6">
          <input name="apellidoAtC" type="text" class="form-control campoForm" id="ingresarApellidoAt" value="<?= isset($oldInput['apellidoAtC']) ? esc($oldInput['apellidoAtC']) : '' ?>">
          <div class="form-text" id="ingresarApellido">Apellido</div>
          <?php if($validation->getError('apellidoAtC')) {?>
            <div class="form-text errorAtCliente mt-0">
                <?= $error = $validation->getError('apellidoAtC'); ?>
            </div>
          <?php }?>
        </div>
      </div>
    </div>

    <div class="imput-field">
        <label for="ingresarTelefono" class="form-label">Número de teléfono <span class="requerido">*</span></label>
        <input name="telAtC" type="tel" class="form-control campoForm" id="ingresarTelefonoAt" value="<?= isset($oldInput['telAtC']) ? esc($oldInput['telAtC']) : '' ?>">
        <div class="form-text" id="ingresarTelefono">Teléfono</div>
        <?php if($validation->getError('telAtC')) {?>
          <div class="form-text errorAtCliente mt-0">
              <?= $error = $validation->getError('telAtC'); ?>
          </div>
        <?php }?>
    </div>

    <div class="imput-field">
        <label for="ingresarEmail" class="form-label label-top">E-mail <span class="requerido">*</span></label>
        <input name="emailAtC" type="text" class="form-control campoForm" id="ingresarEmailAt" value="<?= isset($oldInput['emailAtC']) ? esc($oldInput['emailAtC']) : '' ?>">
        <div class="form-text" id="ingresarEmail">ejemplo@gmail.com</div>
        <?php if($validation->getError('emailAtC')) {?>
          <div class="form-text errorAtCliente mt-0">
              <?= $error = $validation->getError('emailAtC'); ?>
          </div>
        <?php }?>
    </div>

    <div>
      <label class="label-top radio-label">Seleccione el motivo <span class="requerido">*</span></label>
      <div class="form-check">
        <input class="form-check-input campoForm" type="radio" name="motivoAtC" id="ingresarMotivoAt" value="1" <?= isset($oldInput['motivoAtC']) && $oldInput['motivoAtC'] === '1' ? 'checked' : '' ?>>
        <label class="form-check-label" for="ingresarMotivo1">Medios de pago</label>
      </div>
      <div class="form-check">
        <input class="form-check-input campoForm" type="radio" name="motivoAtC" id="ingresarMotivoAt" value="2" <?= isset($oldInput['motivoAtC']) && $oldInput['motivoAtC'] === '2' ? 'checked' : '' ?>>
        <label class="form-check-label" for="ingresarMotivo2">Estado del pedido</label>
      </div>
      <div class="form-check">
        <input class="form-check-input campoForm" type="radio" name="motivoAtC" id="ingresarMotivoAt" value="3" <?= isset($oldInput['motivoAtC']) && $oldInput['motivoAtC'] === '3' ? 'checked' : '' ?>>
        <label class="form-check-label" for="ingresarMotivo3">Tuve un problema con mi compra</label>
      </div>
      <div class="form-check">
        <input class="form-check-input campoForm" type="radio" name="motivoAtC" id="ingresarMotivoAt" value="4" <?= isset($oldInput['motivoAtC']) && $oldInput['motivoAtC'] === '4' ? 'checked' : '' ?>>
        <label class="form-check-label" for="ingresarMotivo4">Otros</label>
      </div>
      <?php if($validation->getError('motivoAtC')) {?>
        <div class="form-text errorAtCliente mt-0">
            <?= $error = $validation->getError('motivoAtC'); ?>
        </div>
      <?php }?>
    </div>



    <div class="imput-field">
      <label for="ingresarComentario" class="form-label label-top">Comentario <span class="requerido">*</span></label>
      <textarea name="comentarioAtC" class="form-control campoForm" id="ingresarComentarioAt" rows="5" placeholder="Escribe aquí tu consulta" ><?= isset($oldInput['comentarioAtC']) ? esc($oldInput['comentarioAtC']) : '' ?></textarea>
      <?php if($validation->getError('comentarioAtC')) {?>
        <div class="form-text errorAtCliente mt-1">
            <?= $error = $validation->getError('comentarioAtC'); ?>
        </div>
      <?php }?>
    </div>


    <input type="submit" class="btn btn-danger botonEnviarForm mt-2" value="Enviar">

  </form>

</div>

<div class="container-fluid formularioCompleto" id="formAtEnviado">
  <img class="formCompletoImg" src="assets/img/formEnviado.png" alt="formEnviado.png">
  <p class="formCompletoTxt">Tu consulta ha sido enviada con éxito.<br>¡A la brevedad nos contactaremos con vos!</p>
</div>

<?php if($validation->getErrors()): ?>
<script>
    window.onload = function() {
        document.getElementById('atc-form').scrollIntoView({behavior: 'smooth'});
    };
</script>
<?php endif; ?>

<?php if(session()->getFlashData('formEnviado')):?>
  <script>
    window.onload = function() {
        document.getElementById('atc-form').scrollIntoView({behavior: 'smooth'});
        formularioAtEnviado();
    };
  </script>
<?php endif?>
