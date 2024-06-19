<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\usuario_Model;
use App\Models\ventas_cabecera_Model;

class account_controller extends Controller{
    public function __construct(){
        helper(['form', 'url']);
    }

    public function cuenta(){
        $ventasCabeceraModel = new ventas_cabecera_Model();
        $data['venta'] = $ventasCabeceraModel->where('usuario_id', session()->get('id_usuario'))->first();
        $data['tieneCompra'] = false;
        if (!empty($data['venta'])){
            $data['tieneCompra'] = true;
        }

        echo view('front/head_view');
        echo view('front/navbar_view');
        echo view('back/usuario/mi_cuenta', $data);
        echo view('front/footer_view');
    }

    public function editarDatos(){
        echo view('front/head_view');
        echo view('front/navbar_view');
        echo view('back/usuario/editar_datos_personales');
        echo view('front/footer_view');
    }

    public function modificar(){
        $sessionID = session()->get('id_usuario');
        $input = $this->validate([
            'nombre' => 'required|alpha_space|max_length[32]',
            'apellido' => 'required|alpha_space|max_length[32]',

            'usuario' => [
                'rules' => "required|alpha_dash|min_length[4]|max_length[32]|is_unique[usuarios.usuario,id_usuario,{$sessionID}]",
                'errors' => [
                    'alpha_dash' => 'El nombre de usuario solo puede contener letras, números y guiones.',
                    'min_length' => 'El nombre de usuario debe tener al menos 4 caracteres.',
                    'max_length' => 'El nombre de usuario no puede tener más de 32 caracteres.',
                    'is_unique' => 'Ya existe una cuenta registrada con ese nombre de usuario.'
                ]
            ],

            'tel' => [
                'rules' =>  "required|numeric|min_length[8]|max_length[11]|is_unique[usuarios.tel,id_usuario,{$sessionID}]",
                'errors' => [
                    'numeric' => 'Ingrese un número de teléfono válido.',
                    'min_length' => 'Ingrese un número de teléfono válido.',
                    'max_length' => 'Ingrese un número de teléfono válido.',
                    'is_unique' => 'El número de teléfono ya se encuentra registrado.'
                ]
            ],

            'email' => [
                'rules' => "required|max_length[100]|valid_email|is_unique[usuarios.email,id_usuario,{$sessionID}]",
                'errors' => [
                    'is_unique' => 'Ya existe una cuenta registrada con ese correo electrónico.',
                    'max_length' => 'La dirección de correo electrónico no puede tener más de 100 caracteres.'
                ]
            ]
        ]);

        if ($input){
            $usuario = new usuario_Model();
            $data = $usuario->where('id_usuario', $sessionID)->first();
            if (empty($data)){
                session()->setFlashdata('error', 'No se encontró al usuario!');
                return redirect()->to('/mi-cuenta');
            }
            else {
                $datos = [
                    'nombre' => $this->request->getVar('nombre'),
                    'apellido' => $this->request->getVar('apellido'),
                    'usuario' => $this->request->getVar('usuario'),
                    'tel' => $this->request->getVar('tel'),
                    'email' => $this->request->getVar('email')
                ];
                $usuario->update($sessionID, $datos);
                $session = session();
                $session->set($datos);

                session()->setFlashdata('logeadoMsg', 'Datos modificados con éxito!');
                return $this->response->redirect(site_url('/mi-cuenta'));
            }
        }
        else {
            echo view('front/head_view');
            echo view('front/navbar_view');
            echo view('back/usuario/editar_datos_personales', ['validation' => $this->validator]);
            echo view('front/footer_view');
        }
    }

    public function editarContraseña(){
        echo view('front/head_view');
        echo view('front/navbar_view');
        echo view('back/usuario/editar_contraseña');
        echo view('front/footer_view');
    }

    public function modificarPass(){
        $input = $this->validate([
            'passActual' => 'required',

            'passNueva' => [
                'rules' => 'required|min_length[8]|max_length[32]',
                'errors' => [
                    'max_length' => 'La contraseña no puede tener más de 32 caracteres.',
                    'min_length' => 'La contraseña debe tener al menos 8 caracteres.'
                ]
            ],

            'passNueva2' => [
                'rules' => 'required|matches[passNueva]',
                'errors' => [
                    'matches' => 'La nueva contraseña y la confirmación de la misma deben ser idénticas.'
                ]
            ],

        ]);
        if ($input) {
            $sessionID = session()->get('id_usuario');
            $usuario = new usuario_Model();
            $datos = $usuario->where('id_usuario', $sessionID)->first();
            if (empty($datos)){
                session()->setFlashdata('error', 'No se encontró al usuario!');
                return redirect()->to('/mi-cuenta');
            }
            else {
                $passIngresada = $this->request->getVar('passActual');
                $passActual = $datos['pass'];
                $verify_pass = password_verify($passIngresada, $passActual);
                if ($verify_pass){
                    $nuevaPass = [
                        'pass' => password_hash($this->request->getVar('passNueva'), PASSWORD_DEFAULT)
                    ];
                    $usuario->update($sessionID, $nuevaPass);
                    session()->setFlashdata('logeadoMsg', 'Datos modificados con éxito!');
                    return $this->response->redirect(site_url('/mi-cuenta'));
                }
                else {
                    session()->setFlashdata('AuthFail', 'La contraseña actual no coincide con la ingresada.');
                    return $this->response->redirect(site_url('/editar-pass'));
                }
            }
        }
        else {
            echo view('front/head_view');
            echo view('front/navbar_view');
            echo view('back/usuario/editar_contraseña', ['validation' => $this->validator]);
            echo view('front/footer_view');
        }
    }

    public function cancelar(){
        session()->setFlashData('error', 'Operacion cancelada!');
        return $this->response->redirect(site_url('/mi-cuenta'));
    }


}