<div>
    <!--Mensaje de enviados desde el controlador de usuario-->
    <?php if (session()->getFlashData('altaExitosa')): ?>
        <div class='mt-3 mb-3 ms-3 me-3 h4 text-center alert alert-success' id="msgAltaExitosa">
            <?=session()->getFlashData('altaExitosa');?>
        </div>
    <?php endif?>
    <?php if (session()->getFlashData('msgDangerUsuario')): ?>
        <div class='mt-3 mb-3 ms-3 me-3 h4 text-center alert alert-danger' id="msgDanger">
            <?=session()->getFlashData('msgDangerUsuario');?>
        </div>
    <?php endif?>

</div>

<div class="container mt-4">
<h2 class="fw-bold tituloCrud">Usuarios</h2>
    <div class="d-flex justify-content-end">
        <a href="<?php echo site_url('/alta_de_usuario') ?>" class="btn botonEnviarProd botonAgregarProd">Agregar Usuario</a>
    </div>

<div class="mt-1">
    <div class="table-responsive">
        <table class="table table-hover" id="tabla-usuarios">
            <thead>
                <tr>
                    <th class="colTablaProd">Id</th>
                    <th class="colTablaProd">Nombre de usuario</th>
                    <th class="colTablaProd">Nombre</th>
                    <th class="colTablaProd">Apellido</th>
                    <th class="colTablaProd">Email</th>
                    <th class="colTablaProd">Perfil</th>
                    <th class="colTablaProd">Baja</th>
                    <th class="colTablaProd">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if($users): ?>
                <?php foreach($users as $user): ?>
                <tr class="filaUsuarios">
                    <td class="elemTablaUsuarios"><?php echo $user['id_usuario']; ?></td>
                    <td class="elemTablaUsuarios"><?php echo $user['usuario']; ?></td>
                    <td class="elemTablaUsuarios"><?php echo $user['nombre']; ?></td>
                    <td class="elemTablaUsuarios"><?php echo $user['apellido']; ?></td>
                    <td class="elemTablaUsuarios"><?php echo $user['email']; ?></td>
                    <td class="elemTablaUsuarios">
                        <?php if ($user['perfil_id'] == 1){
                            echo('Admin');
                        }
                        else {
                            echo('Usuario');
                        }?>
                    </td>
                    <td class="elemTablaUsuarios"><?php echo $user['baja']; ?></td>
                    <td>
                        <?php $idUser = $user['id_usuario']; ?>

                        <!--Botones para dar privilegios de administrador a un usuario-->
                        <?php if ($user['perfil_id'] == 1): ?>
                            <button title="Quitar admin" type="button" class="btn btn-primary btn-sm botonEliminarProd" data-bs-toggle="modal" data-bs-target="#modalQuitarAdmin-<?php echo $user['id_usuario']; ?>">
                                <i class="bi bi-person-fill-down"></i>
                            </button>
                        <?php else: ?>
                        <button title="Otorgar admin" type="button" class="btn btn-dark btn-sm botonEliminarProd" data-bs-toggle="modal" data-bs-target="#modalDarAdmin-<?php echo $user['id_usuario']; ?>">
                            <i class="bi bi-person-fill-up"></i>
                            </button>
                        <?php endif; ?>
                        
                        <!--botones para dar de baja o activar usuario-->
                        <?php if ($user['baja'] == 'NO'): ?>
                            <button title="Dar de baja" type="button" class="btn btn-danger btn-sm botonEliminarProd" data-bs-toggle="modal" data-bs-target="#modalBajaUsuario-<?php echo $user['id_usuario']; ?>">
                                <i class="bi bi-ban"></i>
                            </button>
                        <?php else: ?>
                        <button title="Activar" type="button" class="btn btn-success btn-sm botonEliminarProd" data-bs-toggle="modal" data-bs-target="#modalActivaUsuario-<?php echo $user['id_usuario']; ?>">
                            <i class="bi bi-check-lg"></i>
                            </button>
                        <?php endif; ?>
                    </td>


                            <!--Mensaje para quitar o dar admin-->
                            <div class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
                                <?php if($user['perfil_id'] == '1'): ?>
                                id="modalQuitarAdmin-<?php echo $user['id_usuario']; ?>"
                            <?php else: ?>
                                id="modalDarAdmin-<?php echo $user['id_usuario']; ?>"
                            <?php endif; ?>>
                        
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header p-3">
                                            <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">
                                            <?php if($user['perfil_id'] == '1'): ?>
                                                Desea revocar los permisos de Administrador al siguiente usuario?
                                            <?php else: ?>
                                                Desea otorgar permisos de Administrador al siguiente usuario?
                                            <?php endif; ?></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                    <div class="modal-body">
                                        <div class="row text-start mt-1 ps-4">
                                                <p><span class="fw-bold">Nombre de usuario:</span> <?php echo $user['usuario']; ?>
                                                <br><span class="fw-bold">Nombre:</span> <?php echo $user['nombre']; ?>
                                                <br><span class="fw-bold">Apellido:</span> <?php echo $user['apellido']; ?>
                                                <br><span class="fw-bold">Email:</span> <?php echo $user['email']; ?>
                                        </div>
                                                <?php if($user['perfil_id'] == 1): ?>
                                                    <p class="msgModal mb-0 pb-0 text-center">Revocar los permisos de administrador restringirá al usuario la capacidad de realizar cambios importantes en el sistema.</p>
                                                <?php else: ?>
                                                    <p class="msgModal mb-0 pb-0 text-center">Otorgar permisos de administrador permitirá al usuario acceder a otras funcionalidades y realizar cambios importantes en el sistema.</p>
                                                <?php endif; ?>
                                    </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <?php if($user['perfil_id'] == 1): ?>
                                        <a href="<?php echo base_url('quitarAdmin/'.$idUser);?>" type="button" class="btn btn-primary">Revocar permisos</a>
                                    <?php else: ?>
                                        <a href="<?php echo base_url('otorgarAdmin/'.$idUser);?>" type="button" class="btn btn-dark">Otorgar permisos</a>
                                    <?php endif; ?>
                                  
                                </div>
                              </div>
                            </div>
                          </div>

                          
                            <!--Mensaje para dar de baja o activar usuario-->
                            <div class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
                                <?php if($user['baja'] == 'NO'): ?>
                                id="modalBajaUsuario-<?php echo $user['id_usuario']; ?>"
                            <?php else: ?>
                                id="modalActivaUsuario-<?php echo $user['id_usuario']; ?>"
                            <?php endif; ?>>
                        
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">
                                            <?php if($user['baja'] == 'NO'): ?>
                                                Desea dar de baja el siguiente usuario?
                                            <?php else: ?>
                                                Desea activar el siguiente usuario?
                                            <?php endif; ?></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                    <div class="modal-body">
                                        <div class="row text-start mt-1 ps-4">
                                                <p><span class="fw-bold">Nombre de usuario:</span> <?php echo $user['usuario']; ?>
                                                <br><span class="fw-bold">Nombre:</span> <?php echo $user['nombre']; ?>
                                                <br><span class="fw-bold">Apellido:</span> <?php echo $user['apellido']; ?>
                                                <br><span class="fw-bold">Email:</span> <?php echo $user['email']; ?>
                                                <br><span class="fw-bold">Tipo de usuario:</span>
                                                <?php if($user['perfil_id'] == 1) {
                                                    echo('Admin');
                                                }
                                                else {
                                                    echo('Usuario');
                                                }?> </p>
                                                <?php if($user['baja'] == 'NO'): ?>
                                                    <p class="msgModal mb-0 pb-0">Los usuarios dados de baja no podrán ingresar al sistema.</p>
                                                <?php else: ?>
                                                    <p class="msgModal mb-0 pb-0">Los usuarios activos pueden ingresar al sistema.</p>
                                                <?php endif; ?>
                                        </div>
                                    </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <?php if($user['baja'] == 'NO'): ?>
                                        <a href="<?php echo base_url('bajausuario/'.$idUser);?>" type="button" class="btn btn-danger">Dar de Baja</a>
                                    <?php else: ?>
                                        <a href="<?php echo base_url('activarusuario/'.$idUser);?>" type="button" class="btn btn-success">Activar</a>
                                    <?php endif; ?>
                                  
                                </div>
                              </div>
                            </div>
                          </div>


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