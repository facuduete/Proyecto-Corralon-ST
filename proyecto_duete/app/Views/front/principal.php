<body class="bg-light">
    <!-- Inicio carrusel-->
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="assets/img/swiper1.png" class="w-100 carruselFondo1" alt="...">
          <img src="assets/img/swiper1-short.png" class="w-100 carruselFondo2" alt="...">
        </div>
        <div class="carousel-item">
          <img src="assets/img/swiper2.png" class="w-100 carruselFondo1" alt="...">
          <img src="assets/img/swiper2-short.png" class="w-100 carruselFondo2" alt="...">
        </div>
        <div class="carousel-item">
          <img src="assets/img/swiper3.png" class="w-100 carruselFondo1" alt="...">
          <img src="assets/img/swiper3-short.png" class="w-100 carruselFondo2" alt="...">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next"  type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    <!-- Fin carrusel -->

    <!-- Inicio sección de información -->
    <div class="container-fluid py-4 bg-body-secondary text-center">
      <div class="row justify-content-center">
        <div class="col-sm-12 col-md-3 columnaInfo py-2">
          <a href="<?php echo base_url('comercializacion#mediosDeEnvio')?>" class="linksInfo icon-link-hover">
            <img src="assets/img/envios_icon.png" class=" bi iconoInfo iconoNavbar">
            <p>
              <span class="negrita">Envíos</span>
              <br>Recibi tu pedido sin moverte de tu hogar.
            </p>
          </a>
        </div>
        <div class="col-sm-12 col-md-3 columnaInfo py-2">
          <a href="<?php echo base_url('comercializacion#sucursal')?>" class="linksInfo icon-link-hover">
          <img src="assets/img/ubicacion_icon.png" class="bi iconoInfo iconoNavbar">
            <p>
              <span class="negrita">Ubicación</span>
              <br>Descubrí la ubicación de nuestra sucursal.
            </p>
          </a>
        </div>
        <div class="col-sm-12 col-md-3 columnaInfo py-2">
          <a href="<?php echo base_url('comercializacion#mediosDePago')?>" class="linksInfo icon-link-hover">
            <img src="assets/img/mediosdepago_icon.png" class="bi iconoInfo iconoNavbar">
            <p>
              <span class="negrita">Medios de pago</span>
              <br>Vos elegís como pagar.
            </p>
          </a> 
        </div>
        <div class="col-sm-12 col-md-3 py-2">
          <a href="<?php echo base_url('atencion_al_cliente') ?>" class="linksInfo icon-link-hover">
            <img src="assets/img/consulta_icon.png" class="bi iconoInfo iconoNavbar">
            <p>
              <span class="negrita">Hacé tu consulta</span>
              <br>Te responderemos en la brevedad.
            </p>
          </a> 
        </div>
      </div>
    </div>
    <!-- Fin sección de información -->

    <!-- Inicio seccion productos destacados -->
    <div class="container-fluid">
      <div class="row pt-3">
        <div class="col-sm-12 col-md-6">
          <h4 class="ps-3 destacadosTitle">Productos destacados</h4>
          <h5 class="ps-3">Lo mejor en obra gruesa </h5>
        </div>  
        <div class="col-sm-12 col-md-6">
          <a href="<?php echo base_url('catalogo' . 2) ?>" class="linksInfo custom-anchor" style="font-size: 17px;"> Ver todos > </a>
        </div>
      </div>
    </div>

    <!-- Inicio Carrusel productos destacados 1-->
    <div class="container-fluid">
      <div class="row">

        <div class="col-md-3">
          <a href="<?php echo base_url('catalogo' . 2) ?>">
            <img src="assets/img/banner1.png" class="img-fluid py-3 banner" alt="...">
          </a>
        </div>
        
        <div class="col-sm-12 col-md-9">
          <div class="swiper mySwiper carruselProductos1">
            <div class="swiper-wrapper">

            <?php if ($productosObraGruesa): ?>
              <?php $contador = 0; ?>
              <?php foreach ($productosObraGruesa as $prod): if($contador >= 8) break; ?>
                <?php if (!$productosObraGruesa) break;?>
                <?php $imagen = $prod['imagen'];?>

              <div class="swiper-slide">
                <div class="card">
                  <img src="<?=base_url()?>/assets/uploads/<?=$imagen?>" class="card-img-top imgCarruselProd" alt="...">
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
            <div class="swiper-button-next"></div>
          </div>

        </div>

      </div>
    </div>
    <!-- Fin Carrusel productos destacados 1-->
    <!-- Inicio Carrusel productos destacados 2-->
    <div class="container-fluid">
      <div class="row py-2">
        <div class="col-sm-12 col-md-6">
          <h4 class="ps-3 destacadosTitle">Las mejores herramientas</h4>
          <h5 class="ps-3">Manuales y eléctricas</h5>
        </div>  
        <div class="col-sm-12 col-md-6">
          <a href="<?php echo base_url('catalogo' . 5) ?>" class="linksInfo custom-anchor" style="font-size: 17px;"> Ver todos > </a>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        
        <div class="col-sm-12 col-md-9">
          <div class="swiper mySwiper carruselProductos2">
            <div class="swiper-wrapper">
        
            <?php if ($productosHerramientas): ?>
              <?php $contador = 0; ?>
              <?php foreach ($productosHerramientas as $prod): if($contador >= 8) break; ?>
                <?php if (!$productosHerramientas) break;?>
                <?php $imagen = $prod['imagen'];?>

              <div class="swiper-slide">
                <div class="card">
                  <img src="<?=base_url()?>/assets/uploads/<?=$imagen?>" class="card-img-top imgCarruselProd" alt="...">
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
            <div class="swiper-button-next"></div>
          </div>

        </div>
          <div class="col-md-3">
            <a href="<?php echo base_url('catalogo' . 5) ?>">
              <img src="assets/img/banner2.png" class="img-fluid py-3 banner2" alt="...">
            </a>
          </div>

      </div>
    </div>

    <!-- Fin Carrusel productos destacados 2-->

    <!-- Inicio Carrusel productos destacados 3-->
    <div class="container-fluid">
      <div class="row py-2">
        <div class="col-sm-12 col-md-6">
          <h4 class="ps-3 destacadosTitle">Ladrillos y Viguetas</h4>
          <h5 class="ps-3">La base sólida para tu proyecto</h5>
        </div>  
        <div class="col-sm-12 col-md-6">
          <a href="<?php echo base_url('catalogo' . 3) ?>" class="linksInfo custom-anchor" style="font-size: 17px;"> Ver todos > </a>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">

        <div class="col-md-3">
          <a href="<?php echo base_url('catalogo' . 3) ?>">
            <img src="assets/img/banner3.png" class="img-fluid py-3 banner" alt="...">
          </a>
        </div>
        
        <div class="col-sm-12 col-md-9">
          <div class="swiper mySwiper carruselProductos1">
            <div class="swiper-wrapper">

            <?php if ($productosLadrillos): ?>
              <?php $contador = 0; ?>
              <?php foreach ($productosLadrillos as $prod): if($contador >= 8) break; ?>
                <?php if (!$productosLadrillos) break;?>
                <?php $imagen = $prod['imagen'];?>

              <div class="swiper-slide">
                <div class="card">
                  <img src="<?=base_url()?>/assets/uploads/<?=$imagen?>" class="card-img-top imgCarruselProd" alt="...">
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
            <div class="swiper-button-next"></div>
          </div>

        </div>

      </div>
    </div>
    
    <!-- Fin Carrusel productos destacados 3-->
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

    <!-- Fin seccion productos destacados -->
    <!-- Inicio promociones -->

    <div class="container my-5" id="promociones">

      <?php $validation = \Config\Services::validation(); ?>

      <form class="row py-4 justify-content-center promociones" id="formularioProm" method="post" action="<?php echo base_url('/enviar-form-promociones') ?>">
        <div class="col-auto">
          <p class="promocionesTxt"> Recibí ofertas y promociones </p>
        </div>
        <div class="col-sm-10">
          <input name="email" type="text" class="form-control" id="ingresarEmailProm" placeholder="Ingresa tu email" value="<?= isset($oldInput['email']) ? esc($oldInput['email']) : '' ?>">
        </div>
        <div class="col-auto">
          <input type="submit" id="botonSubir" class="btn btn-warning mb-3 botonPromociones" value="Suscribirme">
        </div>
      </form>
      <div class="promocionesForm-error mt-2 promocionesRequired" id="promocionesRequired">
          <i class="bi bi-x-circle-fill"></i>
          Proporcione un correo electrónico.
          </div>

      <!--Error-->
      <?php if($validation->getError('email')) {?>
          <div class="promocionesForm-error mt-2">
            <i class="bi bi-x-circle-fill"></i>
            <?= $error = $validation->getError('email'); ?>
          </div>
      <?php }?>

      <!--Mensaje usuario registrado con éxito-->
      <?php if (!empty (session()->getFlashData('promocionesOk'))):?>
          <div class="promocionesForm-exito mt-2" id="usuarioRegistradoMsg">
              <i class="bi bi-check-circle-fill"></i>
              <?=session()->getFlashData('promocionesOk');?>
          </div>
      <?php endif?>

      <?php if($validation->getErrors()): ?>
        <script>
          window.onload = function() {
            document.getElementById('promociones').scrollIntoView({behavior: 'smooth'});
          };
        </script>
      <?php endif; ?>

    </div> 
    
    <!-- Fin promociones -->
</body> 

