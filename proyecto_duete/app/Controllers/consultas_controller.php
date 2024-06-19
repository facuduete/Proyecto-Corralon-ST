<?php
namespace App\Controllers;
Use App\Models\consulta_Model;
Use App\Models\usuario_Model;
Use CodeIgniter\Controller;

class consultas_controller extends Controller{

    public function __construct(){
        helper(['url', 'form']);
        $session = session();
    }

    public function validation(){
        $input = $this->validate([
            'nombreAtC' => 'required|alpha_space|max_length[32]',
            'apellidoAtC' => 'required|alpha_space|max_length[32]',

            'telAtC' => [
                'rules' => 'required|numeric|min_length[8]|max_length[11]',
                'errors' => [
                    'numeric' => 'Ingrese un número de teléfono válido.',
                    'min_length' => 'Ingrese un número de teléfono válido.',
                    'max_length' => 'Ingrese un número de teléfono válido.',
                ]
            ],

            'emailAtC' => [
                'rules' => 'required|max_length[150]|valid_email',
                'errors' => [
                    'max_length' => 'La dirección de correo electrónico no puede tener más de 100 caracteres.'
                ]
            ],

            'motivoAtC' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Debes seleccionar un motivo.'
                ]
            ],

            'comentarioAtC' => 'required'

        ],);

        if (!$input) {
            echo view('front/head_view');
            echo view('front/navbar_view');
            echo view('front/atencion_al_cliente', ['validation' => $this->validator, 'oldInput' => $this->request->getPost()]);
            echo view('front/footer_view');
        }
        else {
            $consulta = new consulta_Model();
            $datos = [
                'nombre' => $this->request->getVar('nombreAtC'),
                'apellido' => $this->request->getVar('apellidoAtC'),
                'tel' => $this->request->getVar('telAtC'),
                'email' => $this->request->getVar('emailAtC'),
                'motivo' => $this->request->getVar('motivoAtC'),
                'comentario' => $this->request->getVar('comentarioAtC')
            ];
            $consulta->insert($datos);
            session()->setFlashdata('formEnviado', 'Formulario enviado con éxito!');
            return redirect()->to('/atencion_al_cliente');
        }
    }

    public function index(){
        $consulta = new consulta_Model();
        $data['aux'] = 0;
        $data['consulta'] = $consulta->getConsultaAll();

        $dato['titulo'] = 'Consultas';
        echo view('front/head_view', $dato);
        echo view('front/navbar_view');
        echo view('back/consulta/consultas_view', $data);
    }

    public function consultasLeidas(){
        $consulta = new consulta_Model();
        $data['aux'] = 1;
        $data['consulta'] = $consulta->getConsultaAll();

        $dato['titulo'] = 'Consultas';
        echo view('front/head_view', $dato);
        echo view('front/navbar_view');
        echo view('back/consulta/consultas_view', $data);
    }

    public function leerconsulta($id = null){
        $consulta = new consulta_Model();
        $data['visto'] = $consulta->where('id_consulta', $id)->first();
        if (empty($data['visto'])){
            throw new \CodeIgniter\Exceptions\PageNotFoundException('No se encuentra la consulta seleccionada.');
        }
        else {
            $data['visto'] = 'SI';
            $consulta->update($id, $data);
            session()->setFlashData('consultaSuccess', 'La consulta ha sido marcada como leída exitosamente.');
            return $this->response->redirect(site_url('/consultas'));
        }
    }

    public function consultaNoLeida($id = null){
        $consulta = new consulta_Model();
        $data['visto'] = $consulta->where('id_consulta', $id)->first();
        if (empty($data['visto'])){
            throw new \CodeIgniter\Exceptions\PageNotFoundException('No se encuentra la consulta seleccionada.');
        }
        else {
            $data['visto'] = 'NO';
            $consulta->update($id, $data);
            session()->setFlashData('msgDangerConsulta', 'Consulta marcada como no leída!.');
            return $this->response->redirect(site_url('/consultas_leidas'));
        }
    }


}