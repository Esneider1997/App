<?php namespace App\Controllers\API;

use App\Models\UsuarioModel;
use CodeIgniter\RESTful\ResourceController;
use App\Models\FileModel;

class Usuarios extends ResourceController
{
    public function __construct()
    {
        helper('multiconnection');
        $this->model = $this->setModel(new UsuarioModel($db));
    }

    public function index()
    {
        setdb('banco');
        $usuarios = $this->model->findAll();
		return $this->respond($usuarios);       /* Permite contestar todas respuestas http, 100x, 200x, 300x, 400x */
    }

    public function create()
    {
        try {
            
            $usuario = $this->request->getJSON();
            if($this->model->insert($usuario)):
                $usuario->id = $this->model->insertID();
                return $this->respondCreated($usuario);
            else:
                return $this->failValidationErrors($this->model->validation->listErrors());
            endif;
        } catch (\Throwable $th) {
            return $this->failServerError('Ha ocurrido un error en el servidor');
        }
    }

    public function edit($id = null)
    {
        try {
            if($id == null)
                return $this->failValidationErrors('No se ha pasado un ID valido');
            $usuario = $this->model->find($id);
            if($usuario == null)
                return $this->failNotFound('No se ha encontrado un cliente con el id: '.$id);
            return $this->respond($usuario);
        } catch (\Exception $e) {
            return $this->failServerError('Ha ocurrido un error en el servidor');
        }
    }

    public function update($id = null)
    {
        try {
            if($id == null)
                return $this->failValidationErrors('No se ha encontrado un ID valido');
            
            $usuarioVerificado = $this->model->find($id);
            if($usuarioVerificado == null)
                return $this->failValidationErrors('No se ha encontrado un cliente con el ID '.$id);
            
            $usuario = $this->request->getJSON();

            if($this->model->update($id, $usuario)):
                $usuario->id = $id;
                return $this->respondUpdated($usuario);
            else:
                return $this->failValidationErrors($this->model->validation->listErrors());
            endif;
        } catch (\Exception $e) {
            return $this->failServerError('Ha ocurrido un error en el servidor');
        }

    }

    public function delete($id = null)
    { 
        try {
            if($id == null)
                return $this->failValidationErrors('No se ha encontrado un ID valido');
                
            $usuarioVerificado = $this->model->find($id);
            if($usuarioVerificado == null)
                return $this->failValidationErrors('No se ha encontrado un cliente con el ID '.$id);
            
            if ($this->model->delete($id)):
                return $this->respondDeleted($usuarioVerificado);
            else:
                return $this->failServerError('No se ha podido elimar el registro');
			endif;
        } catch (\Exception $e) {
            return $this->failServerError('Ha ocurrido un problema en el servidor '.$e);
        } 
    }

    public function cargarImagen()
	{
		$file = $this->request->getFile('image');

		$profile_image = $file->getName();

		// Renombre el archivo antes de cargarlo
		$temp = explode(".",$profile_image);
		$newfilename = round(microtime(true)) . '.' . end($temp);

        $micarpeta = '../MedicinaIntegral/public/perfiles/';

        if (!file_exists($micarpeta)) {

            mkdir($micarpeta, 0777, true);
        }

		if ($file->move($micarpeta, $newfilename)) {

			$fileModel = new FileModel();

            $data = [
                "file_name" => $newfilename,
                "file_path" => '/public/perfiles/' . $newfilename
            ];


			if ($fileModel->insert($data)) {

				$response = [
					'status' => 200,
					'error' => false,
					'message' => 'documento cargado exitosamente',
					'data' => []
				];
			} else {

				$response = [
					'status' => 500,
					'error' => true,
					'message' => 'No se pudo guardar la imagen',
					'data' => []
				];
			}
		} else {

			$response = [
				'status' => 500,
				'error' => true,
				'message' => 'No se pudo cargar la imagen.',
				'data' => []
			];
		}

		return $this->respondCreated($response);
	}

    /* public function updateImage()
    { 
        $fileModel = new FileModel();

        $file = $this->request->getFile('image');

        $response = [
            'status' => 200,
            "error" => false,
            'messages' => 'Update Image Method',
            'data' => []
        ];

        return $this->respondCreated($response);
    } */
}
