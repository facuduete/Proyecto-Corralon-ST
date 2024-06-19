<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\usuario_Model;

class login_controller extends BaseController{

    public function index(){

        helper(['form', 'url']);

        $dato['titulo'] = 'login';
        echo view('front/head_view', $dato);
        echo view('front/navbar_view');
        echo view('back/usuario/login');
        echo view('front/footer_view');
    }

    public function auth(){

        $imput = $this->validate([
            'email' => 'required|valid_email',
            'pass' => 'required'
        ],);


        $session = session(); //el objeto de sesión se asigna a la variable $session.
        $model = new usuario_Model(); //se instancia el modelo

        if ($imput){
            //se traen los datos del formulario
            $email = $this->request->getVar('email');
            $password = $this->request->getVar('pass');

            $data =  $model->where('email', $email)->first();
            if($data){
                $pass = $data['pass'];
                $ba = $data['baja'];
                if ($ba == 'SI'){
                    $session->setFlashdata('msg', 'El usuario está dado de baja');
                    return redirect()->to('/login');
                }

                //Se verifican los datos ingresados para iniciar, si cumple la verificación, se inicia la sesión.
                $verify_pass = password_verify($password, $pass);
                //password_verify determina los requisitos de configuración de la contraseña.
                if ($verify_pass){
                    $session_data = [
                        'id_usuario' => $data['id_usuario'],
                        'nombre' => $data['nombre'],
                        'apellido' => $data['apellido'],
                        'usuario' => $data['usuario'],
                        'tel' => $data['tel'],
                        'email' => $data['email'],
                        'perfil_id' => $data['perfil_id'],
                        'logeado' => TRUE
                    ];
                    //se inicia la sesión.
                    $session->set($session_data);
                    $session->setFlashdata('logeadoMsg', 'Bienvenido!');
                    return redirect()->to('/mi-cuenta');
                }
                else {
                    //no pasó la validación de la contraseña.
                    $session->setFlashData('msg', 'Tu email o contraseña no coinciden con nuestros registros.');
                    return redirect()->to('/login');
                }
            }
            else {
                //no pasó la validación del correo
                $session->setFlashdata('msg', 'Tu email o contraseña no coinciden con nuestros registros.');
                return redirect()->to('/login');
            }
        }
        else {
            $dato['titulo'] = 'login';
            echo view('front/head_view', $dato);
            echo view('front/navbar_view');
            echo view('back/usuario/login', ['validation' => $this->validator, 'oldInput' => $this->request->getPost()]);
            echo view('front/footer_view');
        }
        
    }

    public function logout(){
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}