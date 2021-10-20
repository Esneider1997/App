<?php namespace App\Controllers\API;

use App\Models\TipoTransaccionModel;
use CodeIgniter\RESTful\ResourceController;
use PhpParser\Node\Stmt\Return_;

class TiposTransaccion extends ResourceController
{
	/**
	 * Return an array of resource objects, themselves in array format
	 *
	 * @return mixed
	 */
	public function __construct()
	{
		$this->model = $this->setModel(new TipoTransaccionModel());
	}

	public function index()
	{
		$tipostransaccion = $this->model->findAll();
		return $this->respond($tipostransaccion);
	}
	
	/**
	 * Create a new resource object, from "posted" parameters
	 *
	 * @return mixed
	 */
	public function create()
	{
		try {
			$tipotransaccion = $this->request->getJSON();
			if($this->model->insert($tipotransaccion)):
				$tipotransaccion->id = $this->model->insertID();
				return $this->respondCreated($tipotransaccion);
			else:
				return $this->failValidationErrors($this->model->validation->listErrors());
			endif;
		} catch (\Exception $e) {
			return $this->failServerError('Ha ocurrido un error en el servidor, no puedes acceder');
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
				return $this->failValidationErrors('No se ha pasado un Id valido');
			$tipotransaccion = $this->model->find($id);
			if($tipotransaccion == null)
				return $this->failNotFound('No se ha encontrado un tipo decon el id '.$id);
			return $this->respond($tipotransaccion);
		} catch (\exception $e) {
			return $this->failServerError('Ha ocurrido un error en el servidor');
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
				return $this->failValidationErrors('No se ha encontrado un Id valido');
			
			$tipotransaccionVerificado = $this->model->find($id);
			if($tipotransaccionVerificado == null)
				return $this->failNotFound('No se ha encontredo ningun tipo de transaccion');
			
			$tipotransaccion = $this->request->getJSON();

			if($this->model->update($id, $tipotransaccion)):
				$tipotransaccion->id = $id;
				return $this->respondUpdated($tipotransaccion);
			else:
				return $this->failValidationErrors($this->model->validation->listErrors());
			endif;

		} catch (\Exception $e) {
			return $this->failServerError('Ha ocurrido un error en el servidor');
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
				return $this->failValidationErrors('No se ha encontrado una cuenta con este ID');
			
			$tipotransaccion = $this->model->find($id); 
			if($tipotransaccion == null)
				return $this->failNotFound('No se ha encontrado un tipo decon el id '.$id);
			
			if($this->model->delete($id)):
				return $this->respondDeleted($tipotransaccion);
			else:
				return $this->failServerError('No se ha podido eliminar el registro');
			endif;

		} catch (\Exception $e) {
			return $this->failServerError('No se ha podido eliminar el registro '.$e);
		}
		
		
		
	}
}
