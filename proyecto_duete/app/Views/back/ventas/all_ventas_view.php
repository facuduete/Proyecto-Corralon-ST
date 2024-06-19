<div class="container mt-4">
<h2 class="fw-bold tituloCrud">
    <?php if ($aux == 0): ?>Ventas
    <?php else: ?>Mis Compras
    <?php endif; ?></h2>

<div class="mt-1">
    <div class="table-responsive">
        <table class="table table-hover" id="tabla-ventas">
            <thead>
                <tr>
                    <th class="colTablaProd">ID</th>
                    <th class="colTablaProd">Fecha</th>
                    <th class="colTablaProd">Hora</th>
                    <?php if ($aux == 0): ?>
                    <th class="colTablaProd">ID Usuario</th>
                    <?php endif; ?>
                    <th class="colTablaProd">Total</th>
                    <th class="colTablaProd">Factura</th>
                </tr>
            </thead>
            <tbody>
                <?php if($ventas): ?>
                <?php foreach($ventas as $venta): ?>
                <tr class="filaUsuarios">
                    <td class="elemTablaUsuarios"><?php echo $venta['id']; ?></td>
                    <td class="elemTablaUsuarios"><?php echo date('d/m/y', strtotime($venta['fecha'])); ?></td>
                    <td class="elemTablaUsuarios"><?php echo date('H:i:s', strtotime($venta['fecha'])); ?></td>

                    <?php if ($aux == 0): ?>
                    <td class="elemTablaUsuarios"><?php echo $venta['usuario_id']; ?></td>
                    <?php endif; ?>

                    <td class="elemTablaUsuarios">$<?php echo number_format($venta['total_venta'], 2); ?></td>
                    <td>
                        <?php if ($aux == 0): ?>
                            <a title="Ver factura" href="<?php echo base_url('ver-factura'.$venta['id']);?>" class="btn btn-danger btn-sm botonVerFactura"><i class="bi bi-eye"></i></a>
                        <?php else: ?>
                            <a title="Ver factura" href="<?php echo base_url('ver-factura-usuario'.$venta['id']);?>" class="btn btn-danger btn-sm botonVerFactura"><i class="bi bi-eye"></i></a>
                        <?php endif; ?>
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