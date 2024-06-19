<?php

namespace App\Models;
use CodeIgniter\Model;

class categoria_Model extends Model {
    protected $table = 'categorias';
    protected $primary_key = 'id';
    protected $allowedFields = ['descripcion', 'activo'];

    public function getCategorias(){
        return $this->findAll();
    }
}