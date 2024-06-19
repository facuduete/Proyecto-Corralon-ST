<div>
    <!--Mensaje de Producto Cargado con éxito-->
    <?php if (session()->getFlashData('altaExitosa')): ?>
        <div class='mt-3 mb-3 ms-3 me-3 h4 text-center alert alert-success' id="msgAltaExitosa">
            <?=session()->getFlashData('altaExitosa');?>
        </div>
    <?php endif?>
    <?php if (session()->getFlashData('msgDangerProd')): ?>
        <div class='mt-3 mb-3 ms-3 me-3 h4 text-center alert alert-danger' id="msgDanger">
            <?=session()->getFlashData('msgDangerProd');?>
        </div>
    <?php endif?>

</div>
<div class="container mt-4">

<h2 class="fw-bold tituloCrud">
<?php if ($aux == 1):?> Productos Eliminados
<?php else: ?> Productos Disponibles<?php endif; ?>
</h2>
    
    <?php if ($aux == 0): ?>
    <div class="col-12 col-md-6 offset-md-6 mt-3 px-2">
            <form id="filtrarPorCategoria" action="<?php echo base_url('/crud_productos'); ?>" method="get">
            <div class="row ordenarPor">
                <div class="col-6 col-md-5">
                    <p>Filtrar por</p>
                </div>
                <div class="col-12 col-md-7">
                <select class="form-control selectOrdenarPor" name="filtrarPorCat" onchange="document.getElementById('filtrarPorCategoria').submit()">
                <option value="">Todas las categorias</option>
                    <?php foreach ($categorias as $categoria) { ?>
                        <option value="<?php echo $categoria['id']; ?>" <?php echo $categoriaSelec == $categoria['id'] ? 'selected' : ''; ?>>
                            <?php echo $categoria['descripcion']; } ?>
                        </option>
                </select>
                </div>
            </div>
            </form>
        </div>
    <?php endif; ?>

    <div class="d-flex justify-content-end">
        <?php if ($aux == 1): ?>
            <a href="<?php echo site_url('/crud_productos') ?>" class="btn botonEnviarProd botonAgregarProd">Productos Disponibles</a>
        <?php else: ?>
            <a href="<?php echo site_url('/agregar-prod') ?>" class="btn botonEnviarProd botonAgregarProd">Agregar</a>
            <a href="<?php echo site_url('/productos_eliminados') ?>" class="btn botonProdEliminados">Eliminados</a>
        <?php endif ?>
    </div>

<div class="mt-3">
    <div class="table-responsive">
        <table class="table table-hover" id="lista-productos">
            <thead>
                <tr>
                    <th class="colTablaProd">Id</th>
                    <th class="colTablaProd">Producto</th>
                    <th class="colTablaProd">Marca</th>
                    <th class="colTablaProd">Precio</th>
                    <th class="colTablaProd">Precio Venta</th>
                    <th class="colTablaProd">Stock</th>
                    <th class="colTablaProd">Imagen</th>
                    <th class="colTablaProd">Action</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php if($aux == 0): ?> <!--Productos Disponibles-->
                <?php if($producto): ?>
                    <?php foreach($producto as $prod): ?>
                        <?php $eliminado = $prod['eliminado']; ?>
                        <?php if($eliminado == 'NO'): ?>

                    <tr class="filaProductos">
                        <td class="elemTablaProd"><?php echo $prod['id']; ?></td>
                        <td class="elemTablaProd"><?php echo $prod['nombre_prod']; ?></td>
                        <td class="elemTablaProd"><?php echo $prod['marca_prod']; ?></td>
                        <td class="elemTablaProd">$ <?php echo $prod['precio']; ?></td>
                        <td class="elemTablaProd">$ <?php echo $prod['precio_vta']; ?></td>

                        <?php if ($prod['stock'] <= $prod['stock_min']): ?>
                            <td class="elemTablaProd"><i title="Stock mínimo" class="bi bi-exclamation-triangle-fill errorAtCliente"></i> <?php echo $prod['stock']; ?></td>
                        <?php else: ?>
                            <td class="elemTablaProd"><?php echo $prod['stock']; ?></td>
                        <?php endif; ?>
                        
                        <?php $imagen = $prod['imagen']; ?>
                        <?php $id = $prod['id']; ?>

                        <td class="elemTablaProd"><img height="60" width="70px" src="<?=base_url()?>/assets/uploads/<?=$imagen?>"></td>
                        <td>
                            <a title="Editar" href="<?php echo base_url('editarproducto'.$id);?>" class="btn btn-primary btn-sm botonEditarProd"><i class="bi bi-pencil-square"></i></a>

                            <button title="Eliminar" type="button" class="btn btn-danger btn-sm botonEliminarProd" data-bs-toggle="modal" data-bs-target="#modalEliminarProd-<?php echo $prod['id']; ?>">
                                <i class="bi bi-trash3-fill"></i>
                            </button>
                            <div class="modal fade" id="modalEliminarProd-<?php echo $prod['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Desea eliminar el siguiente producto?</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                    <div class="modal-body">
                                        <div class="row text-start">
                                            <div class="col-6 mt-1 ps-4">
                                                <p><span class="fw-bold"><?php echo $prod['nombre_prod']; ?></span>
                                                <br><span class="fw-bold">Marca:</span> <?php echo $prod['marca_prod']; ?>
                                                <br><span class="fw-bold">Precio:</span> $ <?php echo $prod['precio']; ?>
                                                <br><span class="fw-bold">Precio de venta:</span> $ <?php echo $prod['precio_vta']; ?>
                                                <br><span class="fw-bold">Stock:</span> <?php echo $prod['stock']; ?></p>
                                            </div>
                                        <div class="col-6 d-flex justify-content-center">
                                            <img class="img-fluid imgModalProd mb-3" src="<?=base_url()?>/assets/uploads/<?=$imagen?>">
                                        </div>
                                        </div>
                                    <p class="msgModal mb-0 pb-0">Los productos eliminados pasan a estar en la tabla "eliminados".</p>
                                    </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                  <a href="<?php echo base_url('borrar/'.$id);?>" type="button" class="btn btn-danger">Eliminar</a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </td>
                    </tr>
                    <?php endif; ?>
                    <?php endforeach; ?>
                    <?php endif; ?>
                    <?php else :?> <!--Productos Eliminados-->
                        <?php if($producto): ?>
                            <?php foreach($producto as $prod): ?>
                            <?php $eliminado = $prod['eliminado']; ?>
                            <?php if($eliminado == 'SI'): ?>

                        <tr class="filaProductos">
                            <td class="elemTablaProd"><?php echo $prod['id']; ?></td>
                            <td class="elemTablaProd"><?php echo $prod['nombre_prod']; ?></td>
                            <td class="elemTablaProd"><?php echo $prod['marca_prod']; ?></td>
                            <td class="elemTablaProd">$ <?php echo $prod['precio']; ?></td>
                            <td class="elemTablaProd">$ <?php echo $prod['precio_vta']; ?></td>
                            <td class="elemTablaProd"><?php echo $prod['stock']; ?></td>
                            <?php $imagen = $prod['imagen']; ?>
                            <?php $id = $prod['id']; ?>

                            <td class="elemTablaProd"><img height="60" width="70px" src="<?=base_url()?>/assets/uploads/<?=$imagen?>"></td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm botonActivarProd" data-bs-toggle="modal" data-bs-target="#modalEliminarProd-<?php echo $prod['id']; ?>">
                                    <i class="bi bi-check2-circle"></i>
                                </button>
                                <div class="modal fade" id="modalEliminarProd-<?php echo $prod['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Desea habilitar el siguiente producto?</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                    <div class="modal-body">
                                        <div class="row text-start">
                                            <div class="col-6 mt-1 ps-4">
                                                <p><span class="fw-bold"><?php echo $prod['nombre_prod']; ?></span>
                                                <br><span class="fw-bold">Marca:</span> <?php echo $prod['marca_prod']; ?>
                                                <br><span class="fw-bold">Precio:</span> $ <?php echo $prod['precio']; ?>
                                                <br><span class="fw-bold">Precio de venta:</span> $ <?php echo $prod['precio_vta']; ?>
                                                <br><span class="fw-bold">Stock:</span> <?php echo $prod['stock']; ?></p>
                                            </div>
                                        <div class="col-6 d-flex justify-content-center">
                                            <img class="img-fluid imgModalProd mb-3" src="<?=base_url()?>/assets/uploads/<?=$imagen?>">
                                        </div>
                                        </div>
                                    <p class="msgModal mb-0 pb-0">Los productos que son habilitados vuelven a estar en la tabla "Productos Disponibles".</p>
                                    </div><div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                  <a href="<?php echo base_url('activar/'.$id);?>" type="button" class="btn btn-primary">Habilitar</a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </td>
                    </tr>
                    <?php endif; ?>
                    <?php endforeach; ?>
                    <?php endif; ?>
                    <?php endif ?>
            </tbody>
        </table>
    </div>
</div>  
<script src="assets/js/bootstrap.bundle.min.js" integrity="" crossorigin=""></script>
<script src="assets/js/swiper/swiper-bundle.min.js"></script>
<script src="assets/js/swiper/script.js"></script>
<script src="assets/js/DataTables/jquery-3.7.1.js"></script>
<script src="assets/js/DataTables/dataTables.js"></script>
<script src="assets/js/DataTables/dataTables.bootstrap5.js"></script>
<script src="assets/js/DataTables/scriptDT.js"></script>
</div>