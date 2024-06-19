<div class="container-fluid altaProdContainer">
    <div class="col-lg-6 col-md-8 col-sm-10 col-12 altaProducto">
        <h2>Alta de productos</h2>

        <?php $validation = \Config\Services::validation(); ?>
        <form method="post" action="<?php echo base_url('/enviar-prod') ?>" id="altaProdForm" enctype="multipart/form-data">

                <div class="imput-field">
                    <label for="nombre_prod">Producto <span class="requerido">*</span> </label>
                    <input name="nombre_prod" type="text" class="form-control campoAltaProd" id="nombre_prod" placeholder="Nombre del producto" value="<?= set_value('nombre_prod') ?>">
                    <!--Error-->
                    <?php if($validation->getError('nombre_prod')) {?>
                        <div class="errorAltaProd">
                            <?= $error = $validation->getError('nombre_prod'); ?>
                        </div>
                    <?php }?>
                </div>

                <div class="imput-field">
                    <label for="marca_prod">Marca <span class="requerido">*</span> </label>
                    <input name="marca_prod" type="text" class="form-control campoAltaProd" id="marca_prod" placeholder="Marca del producto" value="<?= set_value('marca_prod') ?>">
                    <!--Error-->
                    <?php if($validation->getError('marca_prod')) {?>
                        <div class="errorAltaProd">
                            <?= $error = $validation->getError('marca_prod'); ?>
                        </div>
                    <?php }?>
                </div>

                <div class="imput-field">
                    <label for="categoria_prod">Categoría <span class="requerido">*</span> </label>
                    <select class="form-control campoAltaProd" name="categoria" id="categoria_prod">
                        <option value="">Seleccionar categoría</option>
                        <?php foreach ($categorias as $categoria) { ?>
                            <option value="<?php echo $categoria['id']; ?>" <?= set_select('categoria', $categoria['id']); ?>>
                                <?php echo $categoria['id'], ". ", $categoria['descripcion']; } ?>
                            </option>
                    </select>
                    <!--Error-->
                    <?php if($validation->getError('categoria')) {?>
                        <div class="errorAltaProd">
                            <?= $error = $validation->getError('categoria'); ?>
                        </div>
                    <?php }?>
                </div>

                <div class="imput-field">
                    <label for="precio_prod">Precio <span class="requerido">*</span> </label>
                    <input name="precio" type="text" class="form-control campoAltaProd" id="precio_prod" placeholder="Precio del producto" value="<?= set_value('precio') ?>">
                    <!--Error-->
                    <?php if($validation->getError('precio')) {?>
                        <div class="errorAltaProd">
                            <?= $error = $validation->getError('precio'); ?>
                        </div>
                    <?php }?>
                </div>

                <div class="imput-field">
                    <label for="precio_vta_prod">Precio de Venta <span class="requerido">*</span> </label>
                    <input name="precio_vta" type="text" class="form-control campoAltaProd" id="precio_vta_prod" placeholder="Precio de venta del producto" value="<?= set_value('precio_vta') ?>">
                    <!--Error-->
                    <?php if($validation->getError('precio_vta')) {?>
                        <div class="errorAltaProd">
                            <?= $error = $validation->getError('precio_vta'); ?>
                        </div>
                    <?php }?>
                </div>
                <div class="imput-field">
                    <label for="stock_prod">Stock <span class="requerido">*</span> </label>
                    <input name="stock" type="text" class="form-control campoAltaProd" id="stock_prod" placeholder="Stock del producto" value="<?= set_value('stock') ?>">
                    <!--Error-->
                    <?php if($validation->getError('stock')) {?>
                        <div class="errorAltaProd">
                            <?= $error = $validation->getError('stock'); ?>
                        </div>
                    <?php }?>
                </div>
                <div class="imput-field">
                    <label for="stock_min_prod">Stock mínimo <span class="requerido">*</span> </label>
                    <input name="stock_min" type="text" class="form-control campoAltaProd" id="stock_min_prod" placeholder="Stock mínimo del producto" value="<?= set_value('stock_min') ?>">
                    <!--Error-->    
                    <?php if($validation->getError('stock_min')) {?>
                        <div class="errorAltaProd">
                            <?= $error = $validation->getError('stock_min'); ?>
                        </div>
                    <?php }?>
                </div>

                <div class="imput-field">
                    <label class="mb-2" for="img_prod">Imagen del producto <span class="requerido">*</span></label>
                    <input class="d-block" type="file" name="imagen" id="img_prod">
                    <?php if($validation->getError('imagen')) {?>
                        <div class="errorAltaProd">
                            <?= $error = $validation->getError('imagen'); ?>
                        </div>
                    <?php }?>
                </div>

                <div class="row">
                    <div class="col-6">
                        <input type="submit" class="btn botonRegistrarse botonEnviarProd" value="ENVIAR">
                    </div>
                    <div class="col-6">
                        <a href="<?php echo base_url('/cancelar_alta_prod') ?>" class="btn botonRegistrarse">CANCELAR</a>
                    </div>
                </div>
        
        
        </form>

    </div>
<script src="assets/js/bootstrap.bundle.min.js" integrity="" crossorigin=""></script>
<script src="assets/js/swiper/swiper-bundle.min.js"></script>
<script src="assets/js/swiper/script.js"></script>
</div>