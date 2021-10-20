<?php

namespace App\Controllers\API;

use App\Models\TransaccionModel;
use App\Models\CuentaModel;
use App\Models\ClienteModel;
use CodeIgniter\RESTful\ResourceController;
class Transacciones extends ResourceController
{
	public function __construct()
	{
		$this->model = $this->setModel(new TransaccionModel());
		helper('access_rol');
	}
	
	public function index()
	{
		try {
			if(!validateAccess(array('admin', 'cajero'), $this->request->getServer('HTTP_AUTHORIZATION')))
			return $this->failServerError('El rol no tiene acceso a este recurso');
				
			$transacciones = $this->model->findAll();
			return $this->respond($transacciones);
		} catch (\Exception $e) {
			return $this->failServerError('Ha ocurrido un error en el servidor');
		}
	}

	/**
	 * Create a new resource object, from "posted" parameters
	 *
	 * @return mixed
	 */
	public function create()
	{
		try {
			$transaccion =  $this->request->getJSON();
			if($this->model->insert($transaccion)):
				$transaccion->id = $this->model->insertID();
				$transaccion->resultado = $this->actualizarFondoCuenta($transaccion->tipo_transaccion_id, $transaccion->monto, $transaccion->cuenta_id);
				return $this->respondCreated($transaccion);
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
			if($id==null)
				return $this->failValidationErrors('No se ha pasado un Id valido');
			$transaccion = $this->model->find($id);
			if($transaccion == null)
				return $this->failNotFound('No se ha encontrado la transaccion con el id '.$id);
			return $this->respond($transaccion);
		} catch (\Exception $e) {
			return $this->failServerError(' Ha ocurrido un error en el servidor '.$e);
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
			/* $valido = $this->request->getJSON();
			var_dump($valido); */
			if($id == null)
				return $this->failValidationErrors('No se ha pasado un Id valido');
			
			$transaccionVerificada = $this->model->find($id);
			if($transaccionVerificada == null)
				return $this->failNotFound('No se ha encontrado una transaccion con ese ID');
			
			$transaccion = $this->request->getJSON();
			if($this->model->update($id, $transaccion)):
				return $this->respondUpdated($transaccion);
			else:
				return $this->failValidationErrors($this->model->validation->listErrors());
			endif;
		} catch (\Exception  $e) {
			return $this->failServerError('Ha ocurrido un error en el servidor'.$e);
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
			$transaccionVerificada = $this->model->find($id);
			if($transaccionVerificada == null)
				return $this->failNotFound('No se ha encontrado una transaccion con el ID: '.$id);
			if($this->model->delete($id)):
				return $this->respondDeleted($transaccionVerificada);
			else:
				return $this->failServerError('No se pudo eliminar el registro');
			endif;
		} catch (\Exception $e) {
				return $this->failServerError('Ha ocurrido un error en el servidor '.$e);
		}
	}

	public function getTransaccionesByCliente($id = null){
		try {
			$modelCliente = new ClienteModel();

			if($id == null)
				return $this->failValidationErrors('No se ha encontrado un ID valido');

			$cliente = $modelCliente->find($id);
			if($cliente == null)
				return $this->failNotFound('No se ha encontrado un cliente con el id: '.$id);

			$transacciones = $this->model->TransaccionesPorCliente($id); 
		
			return $this->respond($transacciones);

		} catch (\Exception $e) {
			return $this->failServerError('Ha ocurrido un problema con el servidor '.$e);
		}
	}

	private function actualizarFondoCuenta($tipoTransaccionId, $monto, $cuentaId)
	{
		$modelCuenta = new CuentaModel();
		$cuenta = $modelCuenta->find($cuentaId);

		switch ($tipoTransaccionId) {
			case 1:
				$cuenta["fondo"] += $monto;
				break;
			case 2:
				$cuenta["fondo"] -= $monto;
				break;
		}

		if($modelCuenta->update($cuentaId, $cuenta)):
			return array('TransaccionExitosa' => true, 'NuevoFondo' => $cuenta["fondo"]);
		else : 
			return array('TransaccionExitosa' => false, 'NuevoFondo' => $cuenta["fondo"]);
		endif;
	}
}
