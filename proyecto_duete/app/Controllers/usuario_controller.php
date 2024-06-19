<?php
namespace App\Controllers;
Use App\Models\usuario_Model;
use CodeIgniter\Controller;

class usuario_controller extends Controller{
    public function __construct(){
        helper(['form', 'url']);
    }

    public function create(){
        $dato['titulo']='Registro';
        echo view('front/head_view', $dato);
        echo view('front/navbar_view');
        echo view('back/usuario/registro');
        echo view('front/footer_view');
    }

    public function formValidation(){
        //reglas de validación para los campos del formulario
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

            'passconf' => [
                'rules' => 'required|matches[pass]',
                'errors' => [
                    'matches' => 'La contraseña y la confirmación de la misma deben ser idénticas.'
                ]
            ],

            'acepTYC' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Debes aceptar los Términos y Condiciones.'
                ]
            ],

        ],);

        $formModel = new usuario_Model(); //se instancia el modelo

        if (!$input) {
            $data['titulo'] = 'Registro';
            echo view('front/head_view', $data);
            echo view('front/navbar_view');
            echo view('back/usuario/registro', ['validation' => $this->validator, 'oldInput' => $this->request->getPost()]);
            echo view('front/footer_view');
        }
        else { //pasó la validación, se guarda en el modelo
            $formModel->save([
                'nombre' => $this->request->getVar('nombre'),
                'apellido' => $this->request->getVar('apellido'),
                'usuario' => $this->request->getVar('usuario'),
                'tel' => $this->request->getVar('tel'),
                'email' => $this->request->getVar('email'),
                'pass' => password_hash($this->request->getVar('pass'), PASSWORD_DEFAULT)
            ]);

            // Flashdata funciona solo en redirigir la función en el controlador en la vista de carga.
            session()->setFlashdata('success', 'Usuario registrado con exito');
            return redirect()->to('/login');
            // return $this->response->redirect('/registro');
        }
    }
}
