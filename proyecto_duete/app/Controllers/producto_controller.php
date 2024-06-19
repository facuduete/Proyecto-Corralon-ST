<?php
namespace App\Controllers;
Use App\Models\producto_Model;
Use App\Models\usuario_Model;
Use App\Models\categoria_Model;
Use CodeIgniter\Controller;

class producto_controller extends Controller{

    public function __construct(){
        helper(['url', 'form']);
        $session = session();
    }

    //muestra los productos en lista
    public function index(){
        $productoModel = new producto_Model();
        $categoriasModel = new categoria_Model();

        $data['aux'] = 0; //variable auxiliar para ver productos activos
        $data['categorias'] = $categoriasModel->getCategorias();

        $categoriaSelec = $this->request->getGet('filtrarPorCat');
    
        if ($categoriaSelec == '' || $categoriaSelec > 6) {
            $data['producto'] = $productoModel->getProductoAll();
        } else {
            $data['producto'] = $productoModel->getProductosByCategoria($categoriaSelec);
        }

        $data['categoriaSelec'] = $categoriaSelec;

        $dato['titulo'] = 'Crud_productos';
        echo view('front/head_view', $dato);
        echo view('front/navbar_view');
        echo view('back/producto/crud_productos', $data);
    }

    public function creaProducto(){
        $categoriasModel = new categoria_Model();

        //traer todas las categorias desde la db
        $data['categorias'] = $categoriasModel->getCategorias();

        $productoModel = new producto_Model();
        $data['obj'] = $productoModel->orderBy('id', 'DESC')->findAll();

        $dato['titulo'] = 'Alta producto';
        echo view('front/head_view', $dato);
        echo view('front/navbar_view');
        echo view('back/producto/alta_producto_view', $data);
    }

    public function cancelarCreaProducto(){
        session()->setFlashData('msgDangerProd', 'Operacion cancelada!');
        return $this->response->redirect(site_url('/crud_productos'));
    }

    public function store(){
        $session = session();
        $input = $this->validate([
            'nombre_prod' => [
                'rules' => 'required|min_length[5]|max_length[150]',
                'errors' => [
                    'alpha_numeric_punct' => 'Este campo solo puede contener letras, números y espacios.'
                ]
            ],
            'marca_prod' => [
                'rules' => 'required|alpha_numeric_punct|max_length[90]',
                'errors' => [
                    'alpha_numeric_punct' => 'Este campo solo puede contener letras, números y espacios.'
                ]
            ],

            'categoria' => [
                'rules' => 'required|is_not_unique[categorias.id]',
                'errors' => [
                    'is_not_unique' => 'Seleccione una categoría válida.'
                ]
            ],

            'precio' => 'required|decimal|max_length[15]',
            'precio_vta' => 'required|decimal|max_length[15]',
            'stock' => 'required|integer|max_length[10]',
            'stock_min' => 'required|integer|max_length[10]',

            'imagen' => [
                'rules' => 'uploaded[imagen]|is_image[imagen]
                |mime_in[imagen,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Debes subir la imagen del producto.',
                    'is_image' => 'El archivo subido debe ser una imagen.',
                    'mime_in' => 'Formato de imagen inválido.'
                ]
            ]
        ]);

        if (!$input) { 
            $categoriasModel = new categoria_Model();
            $data['categorias'] = $categoriasModel->getCategorias();
            $dato['titulo'] = 'Alta producto';
            echo view('front/head_view', $dato);
            echo view('front/navbar_view');
            echo view('back/producto/alta_producto_view', $data, ['validation' => $this->validator]);
        }
        else{
            $img = $this->request->getFile('imagen');
            $nombre_aleatorio = $img->getRandomName();
            $img->move(ROOTPATH.'assets/uploads', $nombre_aleatorio);

            $data = [
                'nombre_prod' => $this->request->getVar('nombre_prod'),
                'marca_prod' => $this->request->getVar('marca_prod'),
                'imagen' => $img->getName(),
                'categoria_id' => $this->request->getVar('categoria'),
                'precio' => $this->request->getVar('precio'),
                'precio_vta' => $this->request->getVar('precio_vta'),
                'stock' => $this->request->getVar('stock'),
                'stock_min' => $this->request->getVar('stock_min')
                //'eliminado' => 'NO'
            ];

            $producto = new producto_Model();
            $producto->insert($data);

            session()->setFlashData('altaExitosa', 'Producto agregado con éxito!');
            return $this->response->redirect(site_url('/crud_productos'));

        }
    }

    public function eliminarProducto($id = null) {
        $productoModel = new producto_Model();
        $data['eliminado'] = $productoModel->where('id', $id)->first();
        if (empty($data['eliminado'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('No se encuentra el producto seleccionado.');
        }
        else {
            $data['eliminado'] = 'SI';
            $productoModel->update($id, $data);
            $session = session();
            session()->setFlashData('msgDangerProd', 'Producto eliminado con éxito!');
            return $this->response->redirect(site_url('/crud_productos'));
        }
        
    }
    
    public function eliminados(){
        $productoModel = new producto_Model();
        $data['aux'] = 1; //variable auxiliar para ver productos eliminados
        $data['producto'] = $productoModel->getProductoAll();
        $dato['titulo'] = 'Crud_productos';
        echo view('front/head_view', $dato);
        echo view('front/navbar_view');
        echo view('back/producto/crud_productos', $data);
    }

    public function activarproducto($id = null) {
        $productoModel = new producto_Model();
        $data['eliminado'] = $productoModel->where('id', $id)->first();
        if (empty($data['eliminado'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('No se encuentra el producto seleccionado.');
        }
        else {
            $data['eliminado'] = 'NO';
            $productoModel->update($id, $data);
            $session = session();
            session()->setFlashData('altaExitosa', 'Producto habilitado con éxito!');
            return $this->response->redirect(site_url('productos_eliminados'));
        }
        
    }

    public function editarproducto($id = null){
        $productoModel = new producto_Model();
        $data['old'] = $productoModel->where('id', $id)->first();
        if (empty($data['old'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('No se encuentra el producto seleccionado.');
        }
        else {
            $categoriasM = new categoria_Model();
            $data['categorias'] = $categoriasM->getCategorias();
            $dato['titulo'] = 'Alta producto';
            echo view('front/head_view', $dato);
            echo view('front/navbar_view');
            echo view('back/producto/editar_producto', $data);
        }
    }

    public function modificar($id){
        $session = session();
        $productoModel = new producto_Model();
        $input = $this->validate([
            'nombre_prod' => [
                'rules' => 'required|alpha_numeric_space_tilde|min_length[5]|max_length[150]',
                'errors' => [
                    'alpha_numeric_punct' => 'Este campo solo puede contener letras, números y espacios.'
                ]
            ],
            'marca_prod' => [
                'rules' => 'required|alpha_numeric_punct|max_length[90]',
                'errors' => [
                    'alpha_numeric_punct' => 'Este campo solo puede contener letras, números y espacios.'
                ]
            ],

            'categoria' => [
                'rules' => 'required|is_not_unique[categorias.id]',
                'errors' => [
                    'is_not_unique' => 'Seleccione una categoría válida.'
                ]
            ],

            'precio' => 'required|decimal|max_length[15]',
            'precio_vta' => 'required|decimal|max_length[15]',
            'stock' => 'required|integer|max_length[10]',
            'stock_min' => 'required|integer|max_length[10]',
        ]);
        if ($input) {
            $img = $this->request->getFile('imagen');
            if ($img && $img->isValid()){
                if ($this->validate(['imagen' => 'is_image[imagen]|mime_in[imagen,image/jpg,image/jpeg,image/png]']) == false){
                    session()->setFlashdata('msgDangerProd', 'Ha ocurrido un error al cargar la imagen.');
                    return $this->response->redirect(site_url('/crud_productos'));
                }
                else {
                    $nombre_aleatorio = $img->getRandomName();
                    $img->move(ROOTPATH. 'assets/uploads', $nombre_aleatorio);
    
                    $data = [
                        'nombre_prod' => $this->request->getVar('nombre_prod'),
                        'marca_prod' => $this->request->getVar('marca_prod'),
                        'imagen' => $img->getName(),
                        'categoria_id' => $this->request->getVar('categoria'),
                        'precio' => $this->request->getVar('precio'),
                        'precio_vta' => $this->request->getVar('precio_vta'),
                        'stock' => $this->request->getVar('stock'),
                        'stock_min' => $this->request->getVar('stock_min')
                        //'eliminado' => 'NO'
                    ];
        
                    $productoModel->update($id, $data);
                    session()->setFlashdata('altaExitosa', 'Producto modificado con éxito!');
                    return $this->response->redirect(site_url('/crud_productos'));
                }
                
            }
            else {
                $data = [
                    'nombre_prod' => $this->request->getVar('nombre_prod'),
                    'marca_prod' => $this->request->getVar('marca_prod'),
                    'categoria_id' => $this->request->getVar('categoria'),
                    'precio' => $this->request->getVar('precio'),
                    'precio_vta' => $this->request->getVar('precio_vta'),
                    'stock' => $this->request->getVar('stock'),
                    'stock_min' => $this->request->getVar('stock_min')
                    //'eliminado' => 'NO'
                ];
                $productoModel->update($id, $data);
                session()->setFlashdata('altaExitosa', 'Producto modificado con éxito!');
                return $this->response->redirect(site_url('/crud_productos'));
            }
        }
        else {
            $data['old'] = $productoModel->where('id', $id)->first();
            $categoriasModel = new categoria_Model();
            $data['categorias'] = $categoriasModel->getCategorias();
            $dato['titulo'] = 'Alta producto';
            echo view('front/head_view', $dato);
            echo view('front/navbar_view');
            echo view('back/producto/editar_producto', $data, ['validation' => $this->validator]);
        }
    }
    
}
