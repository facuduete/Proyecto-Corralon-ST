<?php
namespace App\Controllers;
use CodeIgniter\Controller;
Use App\Models\producto_Model;
Use App\Models\usuario_Model;
Use App\Models\ventas_cabecera_Model;
Use App\Models\ventas_detalle_Model;

class ventas_controller extends Controller{
    
    public function todas_ventas(){
        $ventasCabeceraModel = new ventas_cabecera_Model();

        $data['aux'] = 0;
        $data['ventas'] = $ventasCabeceraModel->orderBy('id', 'DESC')->findAll();

        echo view('front/head_view');
        echo view('front/navbar_view');
        echo view('back/ventas/all_ventas_view', $data);
    }
    
    public function verFacturaAdm($id) {
        $ventasCabeceraModel = new ventas_cabecera_Model();
        $ventasDetalleModel = new ventas_detalle_Model();
        $productoModel = new producto_Model();
        $usuarios = new usuario_Model();

        $data['cabecera'] = $ventasCabeceraModel->where('id', $id)->first();
        if (empty($data['cabecera'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('No se encuentra la venta seleccionada.');
        }
        else {
            $data['detalles'] = $ventasDetalleModel->where('venta_id', $id)
            ->orderBy('id', 'ASC')
            ->findAll();
            $data['usuario'] = $usuarios->where('id_usuario', $data['cabecera']['usuario_id'])->first();

            foreach ($data['detalles'] as &$detalle) {
                $producto = $productoModel->where('id', $detalle['producto_id'])->first();
                $detalle['nombre_producto'] = $producto['nombre_prod'];
            }
        
            $data['aux'] = 0;
            echo view('front/head_view');
            echo view('front/navbar_view');
            echo view('back/ventas/vistaFactura', $data);
            echo view('front/footer_view');
        }     
    }

    public function ventas_user(){
        $sessionID = session()->get('id_usuario');
        $ventasCabeceraModel = new ventas_cabecera_Model();

        $data['aux'] = 1;
        $data['ventas'] = $ventasCabeceraModel->where('usuario_id', $sessionID)
                                                ->orderBy('id', 'DESC')
                                                ->findAll();

        echo view('front/head_view');
        echo view('front/navbar_view');
        echo view('back/ventas/all_ventas_view', $data);
    }

    public function verFacturaUser($id){
        $ventasCabeceraModel = new ventas_cabecera_Model();
        $ventasDetalleModel = new ventas_detalle_Model();
        $productoModel = new producto_Model();
        $usuarios = new usuario_Model();

        $ID_usuario = session()->get('id_usuario');
        $data['cabecera'] = $ventasCabeceraModel->where('id', $id)->first();

        if ($data['cabecera']['usuario_id'] != $ID_usuario) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('No se encuentra la venta seleccionada.');
        }
        else {
            if (empty($data['cabecera'])){
                throw new \CodeIgniter\Exceptions\PageNotFoundException('No se encuentra la venta seleccionada.');
            }
            else {

            }
            $data['detalles'] = $ventasDetalleModel->where('venta_id', $id)
            ->orderBy('id', 'ASC')
            ->findAll();
            $data['usuario'] = $usuarios->where('id_usuario', $ID_usuario)->first();

            foreach ($data['detalles'] as &$detalle) {
                $producto = $productoModel->where('id', $detalle['producto_id'])->first();
                $detalle['nombre_producto'] = $producto['nombre_prod'];
            }
        
            $data['aux'] = 1;
            echo view('front/head_view');
            echo view('front/navbar_view');
            echo view('back/ventas/vistaFactura', $data);
            echo view('front/footer_view');
        }   
    }
}
