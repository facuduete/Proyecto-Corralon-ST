<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        echo view('front/head_view');
        echo view('front/navbar_view');
        echo view('front/principal');
        echo view('front/footer_view');
    }

    public function atencion_al_cliente()
    {
        echo view('front/head_view');
        echo view('front/navbar_view');
        echo view('front/atencion_al_cliente');
        echo view('front/footer_view');
    }

    public function mi_carrito()
    {
        echo view('front/head_view');
        echo view('front/navbar_view');
        echo view('front/mi_carrito');
        echo view('front/footer_view');
    }

    public function quienes_somos()
    {
        echo view('front/head_view');
        echo view('front/navbar_view');
        echo view('front/quienes_somos');
        echo view('front/footer_view');
    }
    public function terminos_y_condiciones()
    {
        echo view('front/head_view');
        echo view('front/navbar_view');
        echo view('front/terminos_y_condiciones');
        echo view('front/footer_view');
    }
    public function comercializacion()
    {
        echo view('front/head_view');
        echo view('front/navbar_view');
        echo view('front/comercializacion');
        echo view('front/footer_view');
    }
    public function login()
    {
        echo view('front/head_view');
        echo view('front/navbar_view');
        echo view('back/usuario/login');
        echo view('front/footer_view');
    }
    public function registro()
    {
        echo view('front/head_view');
        echo view('front/navbar_view');
        echo view('back/usuario/registro');
        echo view('front/footer_view');
    }
}
