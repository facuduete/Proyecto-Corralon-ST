<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\usuario_Model;
use App\Models\producto_Model;
use App\Models\categoria_Model;
use App\Models\ventas_cabecera_Model;
use App\Models\ventas_detalle_Model;


class carrito_controller extends BaseController{

    public function __construct(){
        helper(['form', 'url', 'cart']);
        $session = session();
        $cart = \Config\Services::Cart();
        $cart->contents();
    }

    public function index(){
        helper(['form', 'url', 'cart']);
        $cart = \Config\Services::Cart();
        $cart->contents();
        
        $session = session();
        $nombre = $session->get('nombre');
        $perfil_id = $session->get('perfil_id');
        $email = $session->get('email');

        echo view('front/head_view');
        echo view('front/navbar_view');
        echo view('back/carrito/carrito_parte_view');
        echo view('front/footer_view');
    }

    public function add(){
        $cart = \Config\Services::Cart();
        $request = \Config\Services::request();
        $productoModel = new producto_Model();

        if (session()->get('logeado')){
            $productoID = $request->getPost('id');
            $producto = $productoModel->where('id', $productoID)->first();

            $stock = $producto['stock'] - $producto['stock_min'];
            $cantidadEnCarrito = 0;

            $cantidad = $request->getPost('cantidad') ? intval($request->getPost('cantidad')) : 1;

            foreach ($cart->contents() as $item){
                if ($item['id'] == $productoID){
                    $cantidadEnCarrito = $item['qty'];
                }
            }

            if ($cantidadEnCarrito + $cantidad > $stock){
                return $this->response->setJSON(['status' => 'error', 'message' => 'No stock']);
            }

            $cart->insert(array(
                'id' => $request->getPost('id'),
                'qty' => $cantidad,
                'price' => $request->getPost('precio_vta'),
                'name' => $request->getPost('nombre_prod'),
                'options' => array('marca' => $request->getPost('marca_prod'),
                                    'imagen' => $request->getPost('imagen'),
                                    'stock' => $request->getPost('stock')),
            ));
    
            //$cart->destroy();
            return $this->response->setJSON(['status' => 'success', 'message' => 'Producto agregado']);
        }
        else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Login requerido']);
        }
    }

    public function actualiza_carrito(){
        $cart = \Config\Services::Cart();
        $request = \Config\Services::request();

        $cantidad = $request->getPost('cantidad');
        $stock = $request->getPost('stock');
        if ($cantidad > $stock) {
            session()->setFlashData('msgDangerProd', 'No hay suficiente stock disponible de este producto.');
            return $this->response->redirect(site_url('/carrito'));
        }
        else {
            $cart->update(array(
                'rowid' => $request->getPost('rowid'),
                'qty' => $request->getPost('cantidad'),
            ));
    
            session()->setFlashData('msgDangerProd', 'Producto modificado con éxito!');
            return $this->response->redirect(site_url('/carrito'));
        }
    }

    public function remove($rowid){
        $cart = \Config\Services::Cart();
        $request = \Config\Services::request();

        $cart->remove($rowid);
        session()->setFlashData('msgDangerProd', 'Producto eliminado con éxito!');
        return $this->response->redirect(site_url('/carrito'));
    }

    public function borrarCarrito(){
        $cart = \Config\Services::Cart();
        $cart->destroy();
        return redirect()->back()->withInput();
    }

    public function comprar_carrito(){
        $cart = \Config\Services::Cart();
        //var_dump($cart->contents());

        $productos = $cart->contents();
        $request = \Config\Services::request();
        $montoTotal = $request->getPost('granTotal');
        $ventaCabecera = new ventas_cabecera_Model();
        $idcabecera = $ventaCabecera->insert(["total_venta" => $montoTotal, "usuario_id" => session()->get('id_usuario')]);
        
        $ventaDetalle = new ventas_detalle_Model();
        $productoModel = new producto_Model();

        foreach($productos as $prod) {
            $ventaDetalle->insert([
                "venta_id" => $idcabecera,
                "producto_id" => $prod["id"],
                "cantidad" => $prod["qty"],
                "precio" => $prod["price"]]);

            $productoActual = $productoModel->getProducto($prod['id']);
            $productoModel->update($prod['id'], 
            ["stock" => $productoActual['stock'] - $prod['qty']]);
        }
        $cart->destroy();
        session()->setFlashData('msgDangerProd', 'Compra realizada exitosamente!');
        return redirect()->to(base_url('ver-factura-usuario'. $idcabecera));
    }

    public function catalogoPorCategoria($aux){
        if ($aux >= 1 && $aux <= 6) {

            $ordenar_por = $this->request->getGet('ordenarPor') ?? 'nombreAZ'; // Valor por defecto 'precio'
            $productoModel = new producto_Model();
            switch ($ordenar_por) {//se ordenan todos los productos según la seleccion.
                case 'nombreAZ':
                    $productoModel->orderBy('nombre_prod', 'ASC');
                    break;
                case 'nombreZA':
                    $productoModel->orderBy('nombre_prod', 'DESC');
                    break;
                case 'precioMayor':
                    $productoModel->orderBy('precio_vta', 'DESC');
                    break;
                default:
                    $productoModel->orderBy('precio_vta', 'ASC');
                    break;
            }

            //obtiene los productos de la categoria seleccionada y su cantidad
            $productos = $productoModel->where('categoria_id', $aux)->where('eliminado', 'NO')->findAll();
            $cantidadProductos = count($productos);

            //obtiene la categoria seleccionada y su descripcion
            $categoriaModel = new categoria_Model();
            $categoriaSeleccionada = $categoriaModel->where('id', $aux)->first();
            $titulo = $categoriaSeleccionada['descripcion'];

            $data = [
                'producto' => $productos,
                'cantidadProductos' => $cantidadProductos,
                'categoriaSeleccionada' => $categoriaSeleccionada,
                'titulo' => $titulo,
                'ordenar_por' => $ordenar_por
            ];
    
            echo view('front/head_view');
            echo view('front/navbar_view');
            echo view('back/carrito/catalogo_view', $data);
            echo view('front/footer_view');
        }
        else {
            return redirect()->to(base_url('catalogo'. 1));
        }
    }

    public function vistaProducto($id){
        $productoModel = new producto_Model();
        $data['producto'] = $productoModel->where('id', $id)->first();
        if (empty($data) || $data['producto']['eliminado'] == 'SI') {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('No se encuentra el producto seleccionado.');
        }
        else {
            $data['productosRel'] = $productoModel
                                                ->where('categoria_id', $data['producto']['categoria_id'])
                                                ->where('eliminado', 'NO')
                                                ->where('id !=', $id)
                                                ->orderBy('RAND()')
                                                ->findAll();
                                                
            echo view('front/head_view');
            echo view('front/navbar_view');
            echo view('back/carrito/vistaProducto', $data);
            echo view('front/footer_view');
        }
    }

    public function paginaPrincipal(){
        $productoModel = new producto_Model();
        $data['productosObraGruesa'] = $productoModel->where('categoria_id', 2)->where('eliminado', 'NO')->orderBy('RAND()')->findAll();
        $data['productosHerramientas'] = $productoModel->where('categoria_id', 5)->where('eliminado', 'NO')->orderBy('RAND()')->findAll();
        $data['productosLadrillos'] = $productoModel->where('categoria_id', 3)->where('eliminado', 'NO')->orderBy('RAND()')->findAll();

        echo view('front/head_view');
        echo view('front/navbar_view');
        echo view('front/principal', $data);
        echo view('front/footer_view');
    }
}

