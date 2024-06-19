<?php
namespace App\Models;
use CodeIgniter\Model;

class usuariosPromociones_Model extends Model
{
    protected $table = 'usuariospromociones';
    protected $primaryKey = 'id';
    protected $allowedFields = ['email', 'respuesta'];
}