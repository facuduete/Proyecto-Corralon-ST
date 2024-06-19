<?php
namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthAdmin implements FilterInterface{
    public function before(RequestInterface $request, $arguments = null){
        //si el usuario no está logueado
        if(!session()->get('logeado')){
        //entonces redirecciona a la pagina de login page
            $session = session();
            $session->setFlashData('AuthFail', 'Debes iniciar sesión para continuar.');
            return redirect()->to('/login');
        }
        else {
            if(session()->get('perfil_id') != 1){
                //si no es admin lo envia a su perfil.
                $session = session();
                $session->setFlashData('error', 'No tienes los permisos necesarios.');
                return redirect()->to('/mi-cuenta');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null){
        //hacer algo
    }
}