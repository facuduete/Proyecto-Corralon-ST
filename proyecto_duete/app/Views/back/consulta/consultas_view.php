<div>
    <!--Mensaje de Producto Cargado con éxito-->
    <?php if (session()->getFlashData('consultaSuccess')): ?>
        <div class='mt-3 mb-3 ms-3 me-3 h5 text-center alert alert-success' id="msgAltaExitosa">
            <?=session()->getFlashData('consultaSuccess');?>
        </div>
    <?php endif?>
    <?php if (session()->getFlashData('msgDangerConsulta')): ?>
        <div class='mt-3 mb-3 ms-3 me-3 h5 text-center alert alert-danger' id="msgDanger">
            <?=session()->getFlashData('msgDangerConsulta');?>
        </div>
    <?php endif?>

</div>
<div class="container mt-4">
<h2 class="fw-bold tituloCrud">
<?php if ($aux == 1):?> Consultas Leídas
<?php else: ?> Consultas sin leer<?php endif; ?>
</h2>
    <div class="row">
        <div class="col-6 d-flex justify-content-start">
            <a href="<?php echo site_url('/usuarios-promociones') ?>" class="btn botonAgregarProd btn-warning">Recibir promociones</a>
        </div>
        <div class="col-6 d-flex justify-content-end">
            <?php if ($aux == 1): ?>
                <a href="<?php echo site_url('/consultas') ?>" class="btn botonEnviarProd botonAgregarProd">Consultas no leídas</a>
            <?php else: ?>
                <a href="<?php echo base_url('/consultas_leidas');?>" class="btn botonProdEliminados">Consultas leídas</a>
            <?php endif ?>
        </div> 
    </div>

<div class="mt-3">
    <div class="table-responsive">
        <table class="table table-hover" id="tabla-consultas">
            <thead>
                <tr>
                    <th class="colTablaConsulta">Id</th>
                    <th class="colTablaConsulta">Nombre</th>
                    <th class="colTablaConsulta">Apellido</th>
                    <th class="colTablaConsulta">Teléfono</th>
                    <th class="colTablaConsulta">Email</th>
                    <th class="colTablaConsulta">Motivo</th>
                    <th class="colTablaConsulta">Comentario</th>
                    <th class="colTablaConsulta">Action</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php if($aux == 0): ?> <!--Consultas por leer-->
                <?php if($consulta): ?>
                    <?php foreach($consulta as $cons): ?>
                        <?php $leido = $cons['visto']; ?>
                        <?php if($leido == 'NO'): ?>

                    <tr class="filaConsultas">
                        <td class="elemTablaConsultas"><?php echo $cons['id_consulta']; ?></td>
                        <td class="elemTablaConsultas"><?php echo $cons['nombre']; ?></td>
                        <td class="elemTablaConsultas"><?php echo $cons['apellido']; ?></td>
                        <td class="elemTablaConsultas"><?php echo $cons['tel']; ?></td>
                        <td class="elemTablaConsultas"><?php echo $cons['email']; ?></td>
                        <td class="elemTablaConsultas">

                            <?php $motivo = $cons['motivo'];
                            switch ($motivo) {
                                case 1: echo "Medios de pago";
                                break;
                                case 2: echo "Estado del pedido";
                                break;
                                case 3: echo "Problema con la compra";
                                break;
                                default: echo "Otros";
                                break;
                            }?>

                        </td>
                        <td class="elemTablaConsultas">
                            <button type="button" class="btn btn-link btn-sm" data-bs-toggle="modal" data-bs-target="#modalVerComentario-<?php echo $cons['id_consulta']; ?>">Ver comentario</button>
                            <div class="modal fade" id="modalVerComentario-<?php echo $cons['id_consulta'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel text-center">Comentario de la consulta</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row text-start">
                                                <p><?php echo $cons['comentario']; ?></p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Volver</button>
                                            <a href="<?php echo base_url('leerConsulta/'.$cons['id_consulta']);?>" type="button" class="btn btn-primary">Marcar como leído</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td>
                            <a title="Marcar como leído" href="<?php echo base_url('leerConsulta/'.$cons['id_consulta']);?>" class="btn btn-danger btn-sm botonLeerConsulta"><i class="bi bi-eye"></i></a>
                        </td>
                        
                    </tr>

                    <?php endif; ?>
                    <?php endforeach; ?>
                    <?php endif; ?>

                    <?php else :?> <!--Consultas leídas-->
                        <?php if($consulta): ?>
                            <?php foreach($consulta as $cons): ?>
                            <?php $leido = $cons['visto']; ?>
                            <?php if($leido == 'SI'): ?>

                        <tr class="filaConsultas">
                            <td class="elemTablaConsultas"><?php echo $cons['id_consulta']; ?></td>
                            <td class="elemTablaConsultas"><?php echo $cons['nombre']; ?></td>
                            <td class="elemTablaConsultas"><?php echo $cons['apellido']; ?></td>
                            <td class="elemTablaConsultas"><?php echo $cons['tel']; ?></td>
                            <td class="elemTablaConsultas"><?php echo $cons['email']; ?></td>
                            <td class="elemTablaConsultas">
                                <?php $motivo = $cons['motivo'];
                                switch ($motivo) {
                                    case 1: echo "Medios de pago";
                                    break;
                                    case 2: echo "Estado del pedido";
                                    break;
                                    case 3: echo "Problema con la compra";
                                    break;
                                    default: echo "Otros";
                                    break;
                                }?>
                            </td>

                            <td class="elemTablaConsultas">
                            <button type="button" class="btn btn-link btn-sm" data-bs-toggle="modal" data-bs-target="#modalVerComentario-<?php echo $cons['id_consulta']; ?>">Ver comentario</button>
                            
                            <!--Modal para ver el comentario de la consulta-->
                            <div class="modal fade" id="modalVerComentario-<?php echo $cons['id_consulta'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Comentario de la consulta</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row text-start">
                                                <p><?php echo $cons['comentario']; ?></p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Volver</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </td>


                            <td>
                                <a title="Marcar como no leído" href="<?php echo base_url('consultaSinLeer/'.$cons['id_consulta']);?>" class="btn btn-success btn-sm botonLeerConsulta"><i class="bi bi-eye-slash"></i></a>
                            </td>
                    </tr>
                    <?php endif; ?>
                    <?php endforeach; ?>
                    <?php endif; ?>
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