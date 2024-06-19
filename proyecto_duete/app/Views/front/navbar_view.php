<?php
$session = session();
$nombre = $session->get('nombre');
$perfil_id = $session->get('perfil_id');
?>

<!-- Inicio de navbar -->

<nav class="navbar navbar-expand bg-body-secondary navbar2">
    <div class="container-fluid">
        <ul class="navbar-nav ms-auto ">
          <li class="nav-item botonNavbar2">
            <a class="nav-link active" aria-current="page" href="<?php echo base_url('atencion_al_cliente') ?>">Atención al cliente</a>
          </li>
          <li class="nav-item">
            <p class="navbar2-guion"> | </p>
          </li>
          <li class="nav-item botonNavbar2 me-3">
            <a class="nav-link active" href="<?php echo base_url('quienes_somos')?>">Quienes somos</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <nav class="shadow navbar navbar-expand-md bg-body-tertiary p-2">
    <div class="container-fluid">
      <a class="navbar-brand" href="<?php echo base_url('/') ?>">
        <img src="assets/img/logo.png" class="logo">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <?php if(session()->perfil_id == 1 || session()->perfil_id == 2): ?>

      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item botonNavbar dropdown dropdownHover">
            <a class="nav-link active icon-link-hover dropdown-toggle"role="button" data-bs-toggle="dropdown" aria-expanded="false" aria-current="page" href="#">
              <img src="assets/img/iniciarSesion_icon.svg" class="bi px-1 iconoNavbar">
              <?php if(session()->perfil_id == 1): ?> Admin
              <?php else: ?> Usuario <?php endif ?>
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item itemMenuDropdown" href="<?php echo base_url('/mi-cuenta') ?>">Mi cuenta</a></li>
              <li><a class="dropdown-item itemMenuDropdown" href="<?php echo base_url('logout') ?>">Cerrar sesión</a></li>
            </ul>
          </li>

      <?php endif ?>

        <?php if(session()->perfil_id == 1): ?>

          <li class="nav-item botonNavbar">
            <a class="nav-link active icon-link-hover" aria-current="page" href="<?php echo base_url('/crud_usuarios') ?>"><img src="assets/img/person-gear.svg" class="bi px-1 iconAdminNavbar iconoNavbar">CRUD Usuarios</a>
          </li>
          <li class="nav-item botonNavbar">
            <a class="nav-link active icon-link-hover" aria-current="page" href="<?php echo base_url('/crud_productos') ?>"><img src="assets/img/gear-wide-connected.svg" class="bi px-1 iconoNavbar">CRUD Productos</a>
          </li>
          <li class="nav-item botonNavbar">
            <a class="nav-link active icon-link-hover" aria-current="page" href="<?php echo base_url('/ventas') ?>"><img src="assets/img/carrito_icon.svg" class="bi px-1 iconoNavbar">Ventas</a>
          </li>
          <li class="nav-item botonNavbar">
            <a class="nav-link active icon-link-hover" aria-current="page" href="<?php echo base_url('/consultas') ?>"><img src="assets/img/question-circle.svg" class="bi px-1 iconAdminNavbar iconoNavbar">Consultas</a>
          </li>
        </ul>
      </div>

      <?php elseif(session()->perfil_id == 2): ?>
        <div class="align-items-start">
        <ul class="navbar-nav ms-auto">

          <li class="nav-item dropdown botonNavbar dropdownHover">
            <a class="nav-link active dropdown-toggle icon-link-hover" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="assets/img/categorias_icon.png" class="bi px-2 iconoCategoria iconoNavbar">Categorias
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item itemMenuDropdown" href="<?php echo base_url('catalogo' . 1) ?>">Construcción en seco</a></li>
              <li><a class="dropdown-item itemMenuDropdown" href="<?php echo base_url('catalogo' . 2) ?>">Materiales gruesos</a></li>
              <li><a class="dropdown-item itemMenuDropdown" href="<?php echo base_url('catalogo' . 3) ?>">Ladrillos y Viguetas</a></li>
              <li><a class="dropdown-item itemMenuDropdown" href="<?php echo base_url('catalogo' . 4) ?>">Pisos y Revestimientos</a></li>  
              <li><a class="dropdown-item itemMenuDropdown" href="<?php echo base_url('catalogo' . 5) ?>">Herramientas</a></li>
              <li><a class="dropdown-item itemMenuDropdown" href="<?php echo base_url('catalogo' . 6) ?>">Materiales para techos</a></li>
            </ul>
          </li>
          <li class="nav-item botonNavbar">
            <a class="nav-link active icon-link-hover" href="<?php echo base_url('carrito') ?>"><img src="assets/img/carrito_icon.svg" class="bi px-2 iconoNavbar">Ver carrito</a>
          </li>
          
        </ul>
        </div>

      <?php else: ?>

      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item botonNavbar">
            <a class="nav-link active icon-link-hover" aria-current="page" href="<?php echo base_url('login') ?>"><img src="assets/img/iniciarSesion_icon.svg" class="bi px-2 iconoNavbar">Iniciar sesión</a>
          </li>
          <li class="nav-item dropdown botonNavbar dropdownHover">
            <a class="nav-link active dropdown-toggle icon-link-hover" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="assets/img/categorias_icon.png" class="bi px-2 iconoCategoria iconoNavbar">Categorias
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item itemMenuDropdown" href="<?php echo base_url('catalogo' . 1) ?>">Construcción en seco</a></li>
              <li><a class="dropdown-item itemMenuDropdown" href="<?php echo base_url('catalogo' . 2) ?>">Materiales gruesos</a></li>
              <li><a class="dropdown-item itemMenuDropdown" href="<?php echo base_url('catalogo' . 3) ?>">Ladrillos y Viguetas</a></li>
              <li><a class="dropdown-item itemMenuDropdown" href="<?php echo base_url('catalogo' . 4) ?>">Pisos y Revestimientos</a></li>
              <li><a class="dropdown-item itemMenuDropdown" href="<?php echo base_url('catalogo' . 5) ?>">Herramientas</a></li>
              <li><a class="dropdown-item itemMenuDropdown" href="<?php echo base_url('catalogo' . 6) ?>">Materiales para techos</a></li>
            </ul>
          </li>
          <li class="nav-item botonNavbar">
            <a class="nav-link active icon-link-hover" href="<?php echo base_url('carrito') ?>"><img src="assets/img/carrito_icon.svg" class="bi px-2 iconoNavbar">Ver carrito</a>
          </li>
        </ul>
      </div>

      <?php endif ?>

    </div>
  </nav>

  <!-- Fin de navbar -->