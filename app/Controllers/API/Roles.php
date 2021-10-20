<?php

namespace App\Controllers\API;

use App\Models\RolModel;
use CodeIgniter\RESTful\ResourceController;

class Roles extends ResourceController
{
	public function __construct()
	{
		$model = $this->setModel(new RolModel());	
	}
	
	/**
	 * Return an array of resource objects, themselves in array format
	 *
	 * @return mixed
	 */
	public function index()
	{
		$roles = $this->model->findAll();
		return $this->respond($roles);
		//return $this->setResponseFormat('json')->respond($roles);
	}

	/**
	 * Create a new resource object, from "posted" parameters
	 *
	 * @return mixed
	 */
	public function create()
	{
		try {
			$rol = $this->request->getJSON();
			if($this->model->insert($rol)):
				$rol->id = $this->model->insertID();
				return $this->respondCreated($rol);
			else:
				return $this->failValidationErrors($this->model->validation->listErrors());
			endif;
		} catch (\Exception $e) {
			return $this->failServerError('Ha ocurrido un error en el servidor'.$e);
		}
	}

	/**
	 * Return the editable properties of a resource object
	 *
	 * @return mixed
	 */
	public function edit($id = null)
	{
		try {
			if($id == null)
				return $this->failValidationErrors('No se ha pasado un ID valido');
			$rol = $this->model->find($id);
			if($rol == null)
				return $this->failNotFound('No se ha encontrado el rol con el id ');
			return $this->respond($rol);
		} catch (\Exception $e) {
			return $this->failServerError('Ha ocurrido un problema en el servidor'.$e);
		}
	}

	/**
	 * Add or update a model resource, from "posted" properties
	 *
	 * @return mixed
	 */
	public function update($id = null)
	{
		try {
			if($id == null)
				return $this->failValidationErrors('No se ha pasado un ID valido');
			$rolVerificado = $this->model->find($id);
			if($rolVerificado == null)
				return $this->failNotFound('No se ha encontrado el rol con el id '.$id);
			
			$rol = $this->request->getJSON();

			if ($this->model->update($id, $rol)):
				$rol->id = $id;
				return $this->respondUpdated($rol);
			else:
				return $this->failValidationErrors($this->model->validation->listErrors());
			endif;
		} catch (\Exception $e) {
			return $this->failServerError('Ha ocurrido un problema en el servidor '.$e);
		}
	}

	/**
	 * Delete the designated resource object from the model
	 *
	 * @return mixed
	 */
	public function delete($id = null)
	{
		
		try {
			if($id == null)
				return $this->failValidationErrors('No se ha pasado un ID valido');
			
			$rolVerificado = $this->model->find($id);
			if($rolVerificado == null)
				return $this->failNotFound('No se ha encontrado el rol con el id '.$id);
	
			if($this->model->delete($id)):
				return $this->respondDeleted($rolVerificado);
			else: 
				return $this->failServerError('No se ha podido elimar el registro');
			endif;
		} catch (\Exception $e) {
			return $this->failServerError('Ha ocurrido un error en el servidor'.$e);
		}
		
	}
}
