<?php
namespace App\Models;
use CodeIgniter\Model;

class ventas_cabecera_Model extends Model{
    protected $table = 'ventas_cabecera';
    protected $primaryKey = 'id';
    protected $allowedFields = ['fecha', 'usuario_id', 'total_venta'];

    public function getBuilderVentas_cabecera(){
        $db = \Config\Database::connect();
        $builder = $db->table('ventas_cabecera');
        $builder->select('*');
        $builder->join('usuarios', 'usuarios.id_usuario = ventas_cabecera.usuario_id');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getVentas($id_usuario) {
        if ($id_usuario == null) {
            $builder = $this->getBuilderVentas_cabecera();
            $query = $builder->get();
            return $query->getResultArray();
        }
        else {
            $db = \Config\Database::connect();
            $builder = $db->table('ventas_cabecera');
            $builder->select('*');
            $builder->join('usuarios', 'usuarios.id_usuario = ventas_cabecera.usuario_id');
            $query = $builder->get();
            return $query->getResultArray();
        }
    }
}