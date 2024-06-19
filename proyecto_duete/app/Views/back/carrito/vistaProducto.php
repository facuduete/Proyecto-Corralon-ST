<?php $stock = $producto['stock'] - $producto['stock_min']; ?>

<!--Vista de un producto-->
<div class="container-fluid containerVistaProducto">
    <div class="row">
        <div class="col-12 col-md-6 columnaImagenProd mt-3">
            <?php $imagen = $producto['imagen'];?>
            <img class="img-fluid imgVistaProd" src="<?=base_url()?>/assets/uploads/<?=$imagen?>" alt="">
        </div>
        <div class="col-12 col-md-6 col-lg-6 mt-3">
            <div class="container-fluid containerDatosProd">
                <h4> <?php echo ($producto['nombre_prod']); ?></h4>
                <p class="marca"> <?php echo ($producto['marca_prod']); ?></p>
                <h2>$<?php echo number_format($producto['precio_vta'], 2); ?></h2>
                <a class="text-decoration-none" href="<?php echo base_url('comercializacion#mediosDePago')?>" target="_blank">Ver todos los medios de pago</a>
            </div>
            <div class="container-fluid containerDatosProd mt-4">
                <div class="col-6 offset-3 col-md-5 offset-md-0">
                    <div class="form-text mb-2">Cantidad</div>
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
                <p class="mt-3 mb-1"><span class="negrita"><?php echo ($stock); ?></span> en stock</p>
            </div>
            <div class="container-fluid containerDatosProd mt-4">
                <?php if ($producto['stock'] <= $producto['stock_min']): ?>
                    <button class="btn btn-secondary w-100 py-3" disabled>Producto sin stock</button>
                <?php else: ?>
                <?php
                    echo form_open('carrito_agrega', ['id' => 'form_'.$producto['id']]);
                        echo form_hidden('id', $producto['id']);
                        echo form_hidden('precio_vta', $producto['precio_vta']);
                        echo form_hidden('nombre_prod', $producto['nombre_prod']);
                        echo form_hidden('marca_prod', $producto['marca_prod']);
                        echo form_hidden('imagen', $producto['imagen']);
                        echo form_hidden('stock', $stock);

                        echo form_hidden('cantidad', '1');

                        
                        echo form_close();
                ?>
                <button type="submit" class="btn btn-dark w-100 py-3" onclick="agregarAlCarritoVarios(<?=$producto['id']?>)">Agregar al carrito</button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!--Productos relacionados-->
<div class="container-fluid productosRelacionados mb-5">
    <h3 class="fw-bold">Productos Relacionados</h3>
    <div class="row">
        <div class="swiper swiperProductosRel pt-5">
            <div class="swiper-wrapper carruselProdRel">

            <?php if ($productosRel): ?>
              <?php $contador = 0; ?>
              <?php foreach ($productosRel as $prod): if($contador >= 6) break; ?>
                <?php if (!$productosRel) break;?>
                <?php $imagen = $prod['imagen'];?>

              <div class="swiper-slide">
                <div class="card">
                    <a href="<?php echo base_url('vistaProducto'. $prod['id']); ?>">
                        <img src="<?=base_url()?>/assets/uploads/<?=$imagen?>" class="card-img-top imgCarruselProd" alt="...">
                    </a>
                  <div class="card-body bg-light">
                    <p class="card-title1"><span class="marca"><?php echo($prod['marca_prod']);?>
                    </span><br>
                    <a href="<?php echo base_url('vistaProducto'. $prod['id']); ?>" class="text-decoration-none text-dark">
                      <?php echo($prod['nombre_prod']);?></p>
                    </a>
                  </div>
                  <div class="card-footer bg-light">
                    <p class="precio">$<?php echo number_format($prod['precio_vta'], 2);?></p>
                    <?php if ($prod['stock'] <= $prod['stock_min']): ?>
                        <button class="btn btn-secondary botonCarta" disabled>Producto sin stock</button>
                    <?php else: ?>
                        <?php
                            echo form_open('carrito_agrega', ['id' => 'form_'.$prod['id']]);
                                echo form_hidden('id', $prod['id']);
                                echo form_hidden('precio_vta', $prod['precio_vta']);
                                echo form_hidden('nombre_prod', $prod['nombre_prod']);
                                echo form_hidden('marca_prod', $prod['marca_prod']);
                                echo form_hidden('imagen', $prod['imagen']);
                                echo form_hidden('stock', $prod['stock'] - $prod['stock_min']);
                        
                                echo form_close();
                            ?>

                        <button class="btn btn-danger botonCarta" onclick="agregarAlCarrito(<?=$prod['id']?>)">
                            <i class="bi bi-cart3 px-1"></i>Agregar al carrito
                        </button>
                    <?php endif;?>
                  </div>
                </div>
              </div>

              <?php $contador++; endforeach; endif; ?>

            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next ms-5"></div>
          </div>

        </div>
    </div>
</div>

<!--Modals que se muestran al añadir un producto al carrito o si no se puede añadir-->
<div class="modal fade" id="loginCarritoModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="loginModalLabel">Debes iniciar sesión para continuar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Necesitas iniciar sesión para agregar productos al carrito.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <a href="<?php echo base_url('login') ?>" class="btn btn-danger">Iniciar sesión</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="añadirAlCarritoModal" tabindex="-1" aria-labelledby="addToCartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="addToCartModalLabel"><i class="bi bi-check-circle checkCarrito"></i> Producto agregado al carrito</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ver más productos</button>
                <a href="<?php echo base_url('carrito') ?>" class="btn btn-danger"><i class="bi bi-cart3 px-1"></i>Ir al carrito </a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="stockInsuficienteModal" tabindex="-1" aria-labelledby="stockInsuficienteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold" id="stockInsuficienteModalLabel">Stock Insuficiente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        No hay suficiente stock disponible para este producto.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


