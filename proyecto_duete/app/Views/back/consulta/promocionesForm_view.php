<div>
    <!--Mensaje de Producto Cargado con éxito-->
    <?php if (session()->getFlashData('promocionesSuccess')): ?>
        <div class='mt-3 mb-3 ms-3 me-3 h5 text-center alert alert-success' id="msgAltaExitosa">
            <?=session()->getFlashData('promocionesSuccess');?>
        </div>
    <?php endif?>
    <?php if (session()->getFlashData('msgDangerPromociones')): ?>
        <div class='mt-3 mb-3 ms-3 me-3 h5 text-center alert alert-danger' id="msgDanger">
            <?=session()->getFlashData('msgDangerPromociones');?>
        </div>
    <?php endif?>

</div>

<div class="container mt-4">
    <div class="d-flex justify-content-start">
        <a href="<?php echo site_url('/consultas') ?>" class="btn botonAgregarProd btn-danger">Consultas</a>
    </div>

<div class="mt-3">
    <div class="table-responsive">
        <table class="table table-hover" id="tabla-usuarios-promociones">
            <thead>
                <tr>
                    <th class="colTablaConsulta">Id</th>
                    <th class="colTablaConsulta">Email</th>
                    <th class="colTablaConsulta">Respuesta</th>
                    <th class="colTablaConsulta">Action</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php if($promociones): ?>
                    <?php foreach($promociones as $prom): ?>

                    <tr class="filaConsultas">
                        <td class="elemTablaConsultas"><?php echo $prom['id']; ?></td>
                        <td class="elemTablaConsultas"><?php echo $prom['email']; ?></td>
                        <td class="elemTablaConsultas"><?php echo $prom['respuesta']; ?></td>

                        <td>
                            <?php if ($prom['respuesta'] == 'NO'): ?>
                                <a href="<?php echo base_url('responderPromocion/'.$prom['id']);?>" class="btn btn-warning btn-sm botonLeerConsulta"><i class="bi bi-check-circle"></i></a>
                            <?php else: ?>
                                <a href="<?php echo base_url('quitarRespuestaPromocion/'.$prom['id']);?>" class="btn btn-danger btn-sm botonLeerConsulta"><i class="bi bi-x-circle"></i></a>
                            <?php endif;?>
                        </td>
                        
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
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