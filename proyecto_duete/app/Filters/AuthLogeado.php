<?php
namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthLogeado implements FilterInterface{
    public function before(RequestInterface $request, $arguments = null){
        //si el usuario está logueado
        if(session()->get('logeado')){
        //entonces redirecciona a la pagina de su cuenta
            return redirect()->to('/mi-cuenta');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null){
        //hacer algo
    }
}