<?php

namespace App\Models;
use CodeIgniter\Model;

class motivoConsulta_Model extends Model {
    protected $table = 'motivos_consultas';
    protected $primary_key = 'id';
    protected $allowedFields = ['descripcion'];

    public function getMotivosConsulta(){
        return $this->findAll();
    }
}