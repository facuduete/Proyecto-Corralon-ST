<?php
namespace App\Controllers;
use App\Models\usuario_Model;
use CodeIgniter\Controller;

class crud_usuarios_controller extends Controller{

    public function __construct(){
        helper(['url', 'form']);
    }

    public function index(){
        $userModel = new usuario_Model();
        $data['users'] = $userModel->orderBy('id_usuario', 'ASC')->findAll();

        echo view('front/head_view');
        echo view('front/navbar_view');
        echo view('back/usuario/crud_usuarios', $data);
    }

    public function creaUsuario(){
        $userModel = new usuario_Model();
        $data['user_obj'] = $userModel->orderBy('id_usuario', 'DESC')->findAll();

        echo view('front/head_view');
        echo view('front/navbar_view');
        echo view('back/usuario/alta_usuario_view', $data);
    }

    public function cancelarCreaUsuario(){
        session()->setFlashData('msgDangerUsuario', 'Operacion cancelada!');
        return $this->response->redirect(site_url('/crud_usuarios'));
    }

    public function store(){
        $input = $this->validate([
            'nombre' => 'required|alpha_space|max_length[32]',
            'apellido' => 'required|alpha_space|max_length[32]',

            'usuario' => [
                'rules' => 'required|alpha_dash|min_length[4]|max_length[32]|is_unique[usuarios.usuario]',
                'errors' => [
                    'alpha_dash' => 'El nombre de usuario solo puede contener letras, números y guiones.',
                    'min_length' => 'El nombre de usuario debe tener al menos 4 caracteres.',
                    'max_length' => 'El nombre de usuario no puede tener más de 32 caracteres.',
                    'is_unique' => 'Ya existe una cuenta registrada con ese nombre de usuario.'
                ]
            ],

            'tel' => [
                'rules' => 'required|numeric|min_length[8]|max_length[11]|is_unique[usuarios.tel]',
                'errors' => [
                    'numeric' => 'Ingrese un número de teléfono válido.',
                    'min_length' => 'Ingrese un número de teléfono válido.',
                    'max_length' => 'Ingrese un número de teléfono válido.',
                    'is_unique' => 'El número de teléfono ya se encuentra registrado.'
                ]
            ],

            'email' => [
                'rules' => 'required|max_length[100]|valid_email|is_unique[usuarios.email]',
                'errors' => [
                    'is_unique' => 'Ya existe una cuenta registrada con ese correo electrónico.',
                    'max_length' => 'La dirección de correo electrónico no puede tener más de 100 caracteres.'
                ]
            ],

            'pass' => [
                'rules' => 'required|min_length[8]|max_length[32]',
                'errors' => [
                    'max_length' => 'La contraseña no puede tener más de 32 caracteres.',
                    'min_length' => 'La contraseña debe tener al menos 8 caracteres.'
                ]
            ],
        ]);

        if (!$input) {
            echo view('front/head_view');
            echo view('front/navbar_view');
            echo view('back/usuario/alta_usuario_view', ['validation' => $this->validator, 'oldInput' => $this->request->getPost()]);
        }
        else {
            $userModel = new usuario_Model();
            $data = [
                'nombre' => $this->request->getVar('nombre'),
                'apellido' => $this->request->getVar('apellido'),
                'usuario' => $this->request->getVar('usuario'),
                'tel' => $this->request->getVar('tel'),
                'email' => $this->request->getVar('email'),
                'pass' => password_hash($this->request->getVar('pass'), PASSWORD_DEFAULT)
            ];
            $userModel->insert($data);

            session()->setFlashdata('altaExitosa', 'Alta de usuario exitosa!');
            return redirect()->to('/crud_usuarios');
        }
    }

    public function bajaUsuario($id = null){
        $userModel = new usuario_Model();
        $data['baja'] = $userModel->where('id_usuario', $id)->first();
        if (empty($data['baja'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('No se encuentra el usuario seleccionado.');
        }
        else {
            if (session()->get('id_usuario') == $id) {
                session()->setFlashdata('msgDangerUsuario', 'No puedes darte de baja del sistema.');
                return redirect()->to('/crud_usuarios');
            }
            else {
                $data['baja'] = 'SI';
                $userModel->update($id, $data);
                session()->setFlashdata('msgDangerUsuario', 'Usuario dado de baja con éxito!');
                return redirect()->to('/crud_usuarios');
            }
        } 
    }

    public function activaUsuario($id = null){
        $userModel = new usuario_Model();
        $data['baja'] = $userModel->where('id_usuario', $id)->first();
        if (empty($data['baja'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('No se encuentra el usuario seleccionado.');
        }
        else {
            $data['baja'] = 'NO';
            $userModel->update($id, $data);
            session()->setFlashdata('altaExitosa', 'Usuario activado con éxito!');
            return redirect()->to('/crud_usuarios');
        }
    }

    public function otorgarAdmin($id = null){
        $userModel = new usuario_Model();
        $data['perfil_id'] = $userModel->where('id_usuario', $id)->first();
        if (empty($data['perfil_id'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('No se encuentra el usuario seleccionado.');
        }
        else {
            $data['perfil_id'] = '1';
            $userModel->update($id, $data);
            session()->setFlashdata('altaExitosa', 'Permisos de administrador otorgados con éxito!');
            return redirect()->to('/crud_usuarios');
        }
    }

    public function quitarAdmin($id = null){
        $userModel = new usuario_Model();
        $data['perfil_id'] = $userModel->where('id_usuario', $id)->first();
        if (empty($data['perfil_id'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('No se encuentra el usuario seleccionado.');
        }
        else {
            if (session()->get('id_usuario') == $id) {
                session()->setFlashdata('msgDangerUsuario', 'No puedes revocar tus propios permisos de administrador.');
                return redirect()->to('/crud_usuarios');
            }
            else {
                $data['perfil_id'] = '2';
                $userModel->update($id, $data);
                session()->setFlashdata('msgDangerUsuario', 'Permisos de administrador revocados con éxito!');
                return redirect()->to('/crud_usuarios');
            }
        }
    }



}