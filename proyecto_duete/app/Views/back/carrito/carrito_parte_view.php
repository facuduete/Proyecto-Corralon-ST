<?php
$session = session();
$cart = \Config\Services::Cart();
$cart = $cart->contents(); ?>

<?php if (session()->getFlashData('msgDangerProd')): ?>
    <div class='mt-3 h5 text-center alert alert-secondary' id="msgDanger">
        <?=session()->getFlashData('msgDangerProd');?>
    </div>
<?php endif?>


<?php if (empty($cart)): ?>
    <div class="container-fluid carritoVacio">
        <div class="col-12">
            <h4><i class="bi bi-cart3 carritoVacioIcon"></i><br>Su carrito está vacío</h4>
            <a href="<?php echo base_url('/') ?>" class="linksInfo linkCarritoVacio">Volver al inicio</a>
        </div>
    </div>
<?php endif; ?>

<?php if($cart == TRUE): ?>
    <div class="container-fluid contenedorCarrito">
        <h2 class="fw-bold">Carrito</h2>

        <?php $gran_total = 0; ?>

        <div class="row">
        <!-- Columna de productos -->
        <div class="col-12 col-md-8 col-lg-7">

            <?php foreach($cart as $item):?>

        <div class="row productosCarrito">
            <div class="col-12 datosProductoCar">
                <p class="fw-bold"><?php echo $item['name']; ?>
                    <a href="<?php echo base_url('carrito_elimina/'. $item['rowid']);?>" class="carEliminar"><i class="bi bi-trash3-fill"></i></a>

                    <button class="carEliminar carEditar" data-bs-toggle="modal" data-bs-target="#editarProductoCarModal"
                            data-rowid="<?= $item['rowid']; ?>"
                            data-name="<?= $item['name']; ?>"
                            data-marca="<?= $item['options']['marca']; ?>"
                            data-imagen="<?= base_url('/assets/uploads/' . $item['options']['imagen']); ?>"
                            data-price="<?= number_format($item['price'], 2); ?>"
                            data-qty="<?= $item['qty']; ?>"
                            data-stock="<?= $item['options']['stock']; ?>">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    
                    <br><span class="marca fw-light"><?php echo $item['options']['marca']; ?></span>
                </p>
                <div class="row">
                    <div class="col-12">
                        <div class="row text-center">
                            <div class="col-2">
                            <img src="<?=base_url()?>/assets/uploads/<?=$item['options']['imagen']?>" alt="" class="imgProductoCar">
                            </div>
                            <div class="col-4">
                                <p class="datosCar">Precio unitario</p>
                                <p class="datosCar fw-normal">$<?php echo number_format($item['price'], 2); ?></p>
                            </div>
                            <div class="col-2">
                                <p class="datosCar">Cantidad</p>
                                <p class="datosCar fw-normal"><?php echo $item['qty']; ?></p>
                                <?php $gran_total += $item['price'] * $item['qty']; ?>
                            </div>
                            <div class="col-4">
                                <p class="datosCar">Total</p>
                                <p class="datosCar fw-normal"><?php echo number_format($item['subtotal'], 2); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach;?>
        </div>
        <div class="col-12 col-md-4">
                <div class="container resumenCar">
                    <h5>Resumen del pedido</h5>
                    <p class="fw-bold pt-2">Total: <span class="fw-normal granTotal">$<?php echo number_format($gran_total, 2); ?></span></p>
                    <?php echo form_open('carrito-comprar');
                        echo form_hidden('granTotal', $gran_total);
                        $btnComprar = array(
                            'class' => 'btn botonIniciar mt-2',
                            'value' => 'Comprar',
                        );
                        echo form_submit($btnComprar);
                        echo form_close(); ?>
                    <input type="button" class="btn btn-outline-secondary w-100 py-3 mt-2" value="Vaciar carrito" onclick="window.location = 'borrarCarrito'">
                </div>
            </div>
        </div>
    </div>


<!-- Modal de edición de producto -->
<div class="modal fade" id="editarProductoCarModal" tabindex="-1" aria-labelledby="editarProductoCarModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editarProductoCarModalLabel">Detalles del Producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container modalEditarCar">
          <div class="row">
            <div class="col-md-6">
              <img id="modalImagenProd" src="" alt="" class="img-fluid modalEditarImg">
            </div>
            <div class="col-md-6">
                <h5 class="mb-1" id="modalNombreProd"><br></h5>
                <div><span class="marca" id="modalMarcaProd"></span></div>
                <h5 class="fw-bold mb-4">$<span id="modalPrecioProd"></span></h5>
                <div class="d-flex align-items-center">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button class="btn btn-dark botonDecrementar" type="button" id="botonDecrementar"><i class="bi bi-dash"></i></button>
                        </div>
                        <input name="cantidadProducto" type="text" class="form-control cantidadProd text-center" id="valor" value="1">
                        <div class="input-group-append">
                            <button class="btn btn-dark botonIncrementar" type="button" id="botonIncrementar"><i class="bi bi-plus-lg"></i></button>
                        </div>
                    </div>
                </div>
                <p class="mt-2"><span class="fw-bold" id="modalStockProd"></span> en stock</p>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <?php echo form_open('carrito_actualiza', ['id' => 'modificarCarrito']); ?>
        <input type="hidden" id="modalQtyHidden" name="cantidad">
        <input type="hidden" id="modalRowId" name="rowid">
        <input type="hidden" id="modalStockHidden" name="stock">
        <button type="button" class="btn btn-danger" id="enviarModCarrito">Modificar</button>
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>

<?php endif; ?>


