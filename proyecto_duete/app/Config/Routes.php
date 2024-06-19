<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'carrito_controller::paginaPrincipal');
$routes->get('/atencion_al_cliente', 'Home::atencion_al_cliente');
$routes->get('/quienes_somos', 'Home::quienes_somos');
$routes->get('/terminos_y_condiciones', 'Home::terminos_y_condiciones');
$routes->get('/comercializacion', 'Home::comercializacion');
$routes->get('/login', 'Home::login',['filter' => 'authlogeado']);
$routes->get('/registro', 'Home::registro', ['filter' => 'authlogeado']);

//registro
$routes->get('/registro', 'usuario_controller::create', ['filter' => 'authlogeado']);
$routes->post('/enviar-form', 'usuario_controller::formValidation', ['filter' => 'authlogeado']);

//login
$routes->get('/login', 'login_controller', ['filter' => 'authlogeado']);
$routes->post('/enviarlogin', 'login_controller::auth', ['filter' => 'authlogeado']);
$routes->get('/logout', 'login_controller::logout', ['filter' => 'auth']);

//cuenta
$routes->get('/mi-cuenta', 'account_controller::cuenta', ['filter' => 'auth']);
$routes->get('/editar-cuenta', 'account_controller::editarDatos', ['filter' => 'auth']);
$routes->get('/cancelar-editar-cuenta', 'account_controller::cancelar', ['filter' => 'auth']);
$routes->post('/enviar-editar-cuenta', 'account_controller::modificar', ['filter' => 'auth']);
$routes->get('/editar-pass', 'account_controller::editarContraseña', ['filter' => 'auth']);
$routes->post('/enviar-editar-pass', 'account_controller::modificarPass', ['filter' => 'auth']);


//promociones form
$routes->post('/enviar-form-promociones', 'formPromociones_controller::formValidation');
$routes->get('/usuarios-promociones', 'formPromociones_controller::index', ['filter' => 'authadmin']);
$routes->get('/responderPromocion/(:num)', 'formPromociones_controller::responder/$1', ['filter' => 'authadmin']);
$routes->get('/quitarRespuestaPromocion/(:num)', 'formPromociones_controller::quitarRespuesta/$1', ['filter' => 'authadmin']);

//CRUD usuarios
$routes->get('/crud_usuarios', 'crud_usuarios_controller::index', ['filter' => 'authadmin']);
$routes->get('/alta_de_usuario', 'crud_usuarios_controller::creaUsuario', ['filter' => 'authadmin']);
$routes->post('/enviar-usuario', 'crud_usuarios_controller::store', ['filter' => 'authadmin']);
$routes->get('/cancelar_alta_usuario', 'crud_usuarios_controller::cancelarCreaUsuario', ['filter' => 'authadmin']);
$routes->get('/bajausuario/(:num)', 'crud_usuarios_controller::bajaUsuario/$1', ['filter' => 'authadmin']);
$routes->get('/activarusuario/(:num)', 'crud_usuarios_controller::activaUsuario/$1', ['filter' => 'authadmin']);
$routes->get('/quitarAdmin/(:num)', 'crud_usuarios_controller::quitarAdmin/$1', ['filter' => 'authadmin']);
$routes->get('/otorgarAdmin/(:num)', 'crud_usuarios_controller::otorgarAdmin/$1', ['filter' => 'authadmin']);

//CRUD productos
$routes->get('/crud_productos', 'producto_controller::index', ['filter' => 'authadmin']);
$routes->get('/agregar-prod', 'producto_controller::creaProducto', ['filter' => 'authadmin']);
$routes->post('/enviar-prod', 'producto_controller::store', ['filter' => 'authadmin']);
$routes->get('/cancelar_alta_prod', 'producto_controller::cancelarCreaProducto', ['filter' => 'authadmin']);
$routes->get('/borrar/(:num)', 'producto_controller::eliminarProducto/$1', ['filter' => 'authadmin']);
$routes->get('/productos_eliminados', 'producto_controller::eliminados', ['filter' => 'authadmin']);
$routes->get('/activar/(:num)', 'producto_controller::activarproducto/$1', ['filter' => 'authadmin']);
$routes->get('/editarproducto(:num)', 'producto_controller::editarproducto/$1', ['filter' => 'authadmin']);
$routes->post('/modificarProducto(:num)', 'producto_controller::modificar/$1', ['filter' => 'authadmin']);

//consultas
$routes->post('/enviar-consulta', 'consultas_controller::validation');
$routes->get('/consultas', 'consultas_controller::index', ['filter' => 'authadmin']);
$routes->get('/consultas_leidas', 'consultas_controller::consultasLeidas', ['filter' => 'authadmin']);
$routes->get('/leerConsulta/(:num)', 'consultas_controller::leerconsulta/$1', ['filter' => 'authadmin']);
$routes->get('/consultaSinLeer/(:num)', 'consultas_controller::consultaNoLeida/$1', ['filter' => 'authadmin']);

//carrito
$routes->get('/carrito', 'carrito_controller::index');
$routes->get('/catalogo(:num)', 'carrito_controller::catalogoPorCategoria/$1');
$routes->get('/vistaProducto(:num)', 'carrito_controller::vistaProducto/$1');
$routes->post('/carrito_agrega', 'carrito_controller::add');
$routes->post('/carrito_actualiza', 'carrito_controller::actualiza_carrito', ['filter' => 'auth']);
$routes->get('/carrito_elimina/(:any)', 'carrito_controller::remove/$1', ['filter' => 'auth']);
$routes->get('/borrarCarrito', 'carrito_controller::borrarCarrito', ['filter' => 'auth']);
$routes->post('/carrito-comprar', 'carrito_controller::comprar_carrito', ['filter' => 'auth']);

//ventas
$routes->get('/ventas', 'ventas_controller::todas_ventas', ['filter' => 'authadmin']);
$routes->get('/ver-factura(:num)', 'ventas_controller::verFacturaAdm/$1', ['filter' => 'authadmin']);
$routes->get('/ver-compras', 'ventas_controller::ventas_user', ['filter' => 'auth']);
$routes->get('/ver-factura-usuario(:num)', 'ventas_controller::verFacturaUser/$1', ['filter' => 'auth']);

