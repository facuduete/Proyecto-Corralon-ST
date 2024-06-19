<div class="container-fluid">
    <div class="row m-4 cabeceraCatalogo">
        <h2><?php echo ($titulo); ?> </h2>
        <div class="col-12 col-md-6">
            <p class="productosEncontrados"><?php echo($cantidadProductos); ?> producto(s) encontrado(s)</p>
        </div>

        <div class="col-12 col-md-6">
            <form id="ordenarPorForm" action="<?php echo base_url('catalogo' . $categoriaSeleccionada['id']); ?>" method="get">
            <div class="row ordenarPor">
                <div class="col-6 col-md-7">
                    <p>Ordenar por</p>
                </div>
                <div class="col-12 col-md-5">
                <select class="form-control selectOrdenarPor" name="ordenarPor" onchange="document.getElementById('ordenarPorForm').submit()">
                <option value="nombreAZ" <?php echo $ordenar_por == 'nombreAZ' ? 'selected' : ''; ?>>Nombre A-Z</option>
                <option value="nombreZA" <?php echo $ordenar_por == 'nombreZA' ? 'selected' : ''; ?>>Nombre Z-A</option>
                <option value="precioMenor" <?php echo $ordenar_por == 'precioMenor' ? 'selected' : ''; ?>>Precio Menor a Mayor</option>
                <option value="precioMayor" <?php echo $ordenar_por == 'precioMayor' ? 'selected' : ''; ?>>Precio Mayor a Menor</option>
                </select>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="container mb-5 catalogo">
    <div class="row">
    <?php if ($producto): ?>
        <?php foreach ($producto as $prod): ?>

            <!--Tarjetas para productos-->
            <div class="col-6 col-md-4 col-lg-3">
                <?php $imagen = $prod['imagen'];?>

                <div class="card cartaCatalogo mb-3">
                    <a href="<?php echo base_url('vistaProducto'. $prod['id']); ?>">
                        <img src="<?=base_url()?>/assets/uploads/<?=$imagen?>" class="card-img-top imgCarruselProd" alt="...">
                    </a>
                    <div class="card-body cartaCatalogoBody bg-light">
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

                        <button class="btn btn-danger botonCarta botonCartaCatalogoLg" onclick="agregarAlCarrito(<?=$prod['id']?>)">
                            <i class="bi bi-cart3 px-1"></i>Agregar al carrito
                        </button>
                        <button class="btn btn-danger botonCarta botonCartaCatalogoSm" onclick="agregarAlCarrito(<?=$prod['id']?>)">
                            <i class="bi bi-cart3 px-1"></i>Agregar
                        </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
        <?php endforeach; ?>
        <?php else: ?>
            <h3 class="text-center mb-5">No se encontraron productos</h3>
        <?php endif; ?>
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
