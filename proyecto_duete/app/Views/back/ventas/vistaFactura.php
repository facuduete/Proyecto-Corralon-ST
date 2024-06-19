<?php if (session()->getFlashData('msgDangerProd')): ?>
    <div class='mt-3 h5 text-center alert alert-secondary' id="msgDanger">
        <?=session()->getFlashData('msgDangerProd');?>
    </div>
<?php endif?>

<div class="row m-4">
    <div class="col-8 col-md-6">
        <?php if ($aux == 0) :?>
        <a href="<?php echo base_url('/ventas');?>" class="btn btn-secondary btn-sm"><i class="bi bi-box-arrow-in-left"></i> Volver a ventas</a>
        <?php else : ?>
        <a href="<?php echo base_url('/ver-compras');?>" class="btn btn-secondary btn-sm"><i class="bi bi-box-arrow-in-left"></i> Volver a mis compras</a>
        <?php endif; ?>
    </div>
</div>
<div class="container facturaContainer">
    <div class="row filaImgFactura">
        <div class="col-8">
            <h3 class="text-start pt-3 fw-bolder">Factura de Compra</h3>
        </div>
        <div class="col-4">
            <img src="assets/img/facturaLogo.png" alt="">
        </div>
    </div>
    <div class="row filaDatosFacturaMd">
        <div class="col-2">
            <p class="fw-bold">Facturar a</p>
            <?php $nombre = $usuario['nombre']; $apellido = $usuario['apellido']; ?>
            <p><?php echo $nombre .' '. $apellido; ?></p>
        </div>
        <div class="col-4">
            <p class="fw-bold">ID de factura</p>
            <p class="fw-bold"><?php echo ($cabecera['id']); ?></p>
        </div>
        <div class="col-2">
            <p class="fw-bold">Fecha:</p>
            <p class="fw-bold">Email:</p>
            <p class="fw-bold">Teléfono:</p>
        </div>
        <div class="col-4">
            <p><?php echo date('d/m/y', strtotime($cabecera['fecha'])); ?></p>
            <p><?php echo ($usuario['email']); ?></p>
            <p><?php echo ($usuario['tel']); ?></p>
        </div>
    </div>
    <div class="row filaDatosFacturaSm">
        <div class="col-12">
            <p><span class="fw-bold">Facturar a:</span> <?php echo $nombre .' '. $apellido; ?></p>
            <p class="fw-bold">ID de factura: <?php echo ($cabecera['id']); ?></p>
            <p><span class="fw-bold">Fecha:</span> <?php echo date('d/m/y', strtotime($cabecera['fecha'])); ?></p>
            <p><span class="fw-bold">Email:</span> <?php echo ($usuario['email']); ?></p>
            <p><span class="fw-bold">Teléfono:</span> <?php echo ($usuario['tel']); ?></p>
        </div>
    </div>
    <div class="row filaIndicesFactura fw-bold">
        <div class="col-2">
            Cant.
        </div>
        <div class="col-4">
            Producto
        </div>
        <div class="col-3 col-md-2">
            Precio unitario
        </div>
        <div class="col-3 col-md-4">
            Importe
        </div>
    </div>
    <?php foreach ($detalles as $det): ?>
    <div class="row filaValoresFactura mt-3">
        <div class="col-2">
            <?php echo($det['cantidad']); ?>
        </div>
        <div class="col-4">
            <?php echo($det['nombre_producto']); ?>
        </div>
        <div class="col-3 col-md-2">
            $<?php echo number_format($det['precio'], 2); ?>
        </div>
        <div class="col-3 col-md-4">
            $<?php echo number_format(($det['precio'] * $det['cantidad']), 2); ?>
        </div>
    </div>
    <?php endforeach; ?>
    <div class="row filaTotalesFactura mt-4 ">
        <div class="col-6">
            <h4 class="fw-bolder totalFacturaSm">Total Factura</h4>
        </div>
        <div class="col-6">
            <h4 class="fw-bolder text-end"><?php echo number_format($cabecera['total_venta'], 2); ?></h4>
        </div>
    </div>
</div>