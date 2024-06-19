<?php
namespace App\Models;
use CodeIgniter\Model;

class consulta_Model extends Model
{
    protected $table = 'consultas';
    protected $primaryKey = 'id_consulta';
    protected $allowedFields = ['nombre', 'apellido', 'tel', 'email', 'motivo', 'comentario', 'visto'];

    public function getBuilderConsultas(){
        $db = \Config\Database::connect();
        $builder = $db->table('consultas');
        $builder->select('*');
        $builder->join('motivosconsultas', 'id = consultas.motivo');
        return $builder;
    }

    public function getConsultaAll(){
        $builder = $this->getBuilderConsultas();
        //se consulta a la base de datos para recuperar todos los registros por id, de forma descendente.
        $builder->select('*', 'id_consulta', 'DESC');
        return $this->findAll();
    }

    public function getConsulta($id = null){
        $builder = $this->getBuilderConsultas();
        $builder->where('consultas.id_consulta', $id);
        $query = $builder->get();
        return $query->getRowArray();
    }
}