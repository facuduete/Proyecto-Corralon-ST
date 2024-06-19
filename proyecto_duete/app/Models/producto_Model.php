<?php
namespace App\Models;
use CodeIgniter\Model;

class producto_Model extends Model{

    protected $table = 'productos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre_prod', 'marca_prod', 'imagen', 'categoria_id', 'precio', 'precio_vta', 'stock', 'stock_min', 'eliminado'];

    public function getBuilderProductos(){

        //conect() es un método de la clase Database, permite conectar a la base de datos.
        $db = \Config\Database::connect();

        //$builder es una instancia de la clase QueryBuilder de CodeIgniter.
        $builder = $db->table('productos');

        //se hace una consulta a la base de datos, en la tabla productos.
        $builder->select('*');

        //hago el join de la tabla categorias
        $builder->join('categorias', 'categorias.id = productos.categoria_id');
        //retorna el builder
        return $builder;
    }

    public function getProductoAll(){
        $builder = $this->getBuilderProductos();
        //se consulta a la base de datos para recuperar todos los registros por id, de forma descendente.
        $builder->select('*', 'id', 'DESC');
        return $this->findAll();
    }

    public function getProducto($id = null){
        $builder = $this->getBuilderProductos();
        $builder->where('productos.id', $id);
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function updateStock($id = null, $stock_actual = null) {
        $builder = $this->getBuilderProductos();
        $builder->where('productos.id', $id);
        $builder->set('productos.stock', $stock_actual);
        $builder->update();
    }

    function getVentasDetalle($id) {
        $this->db->join('productos', 'productos.id = ventas_detalle.producto_id');
        $query = $this->db->get_where('ventas_detalle', array('venta_id' => $id));
        if ($query->num_rows() > 0){
            return $query;
        }
        else {
            return false;
        }
    }

    public function getProductosByCategoria($categoriaId) {
        return $this->where('categoria_id', $categoriaId)->orderBy('id', 'DESC')->findAll();
    }
    
}