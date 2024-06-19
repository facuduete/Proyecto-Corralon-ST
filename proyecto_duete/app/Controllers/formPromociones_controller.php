<?php
namespace App\Controllers;
Use App\Models\usuariosPromociones_Model;
Use CodeIgniter\Controller;

class formPromociones_controller extends Controller{
    public function __construct(){
        helper(['form', 'url']);
    }

    public function formValidation(){
        $input = $this->validate([
            'email' => [
                'rules' => 'required|valid_email|is_unique[usuariospromociones.email]',
                'errors' => [
                    'is_unique' => 'El correo electrónico ya se encuentra registrado.'
                ]
            ],
        ]);

        if (!$input){
            echo view('front/head_view');
            echo view('front/navbar_view');
            echo view('front/principal', ['validation' => $this->validator, 'oldInput' => $this->request->getPost()]);
            echo view('front/footer_view');
        }
        else {
            $formModel = new usuariosPromociones_Model();
            $formModel->save([
                'email' => $this->request->getVar('email')
            ]);
            session()->setFlashdata('promocionesOk', '¡Registro de correo electrónico exitoso!');
            return redirect()->to('/#promociones');
        }
    }

    public function index(){
        $promociones = new usuariosPromociones_Model();
        $data['promociones'] = $promociones->orderBy('id', 'ASC')->findAll();

        echo view('front/head_view');
        echo view('front/navbar_view');
        echo view('back/consulta/promocionesForm_view', $data);
    }

    public function responder($id = null) {
        $promocion = new usuariosPromociones_Model();
        $data['respuesta'] = $promocion->where('id', $id)->first();
        if (empty($data['respuesta'])){
            throw new \CodeIgniter\Exceptions\PageNotFoundException('No se encuentra el registro seleccionado.');
        }
        else {
            $data['respuesta'] = 'SI';
            $promocion->update($id, $data);
            session()->setFlashData('promocionesSuccess', 'Suscripción respondida con éxito');
            return $this->response->redirect(site_url('/usuarios-promociones'));
        }
    }

    public function quitarRespuesta($id = null){
        $promocion = new usuariosPromociones_Model();
        $data['respuesta'] = $promocion->where('id', $id)->first();
        if (empty($data['respuesta'])){
            throw new \CodeIgniter\Exceptions\PageNotFoundException('No se encuentra el registro seleccionado.');
        }
        else {
            $data['respuesta'] = 'NO';
            $promocion->update($id, $data);
            session()->setFlashData('msgDangerPromociones', 'Respuesta anulada con éxito!');
            return $this->response->redirect(site_url('/usuarios-promociones'));
        }   
    }

}