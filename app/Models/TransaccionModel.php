<?php

namespace App\Models;

use CodeIgniter\Database\MySQLi\Builder;
use CodeIgniter\Database\Query;
use CodeIgniter\Model;
use CodeIgniter\Validation\Validation;

class TransaccionModel extends Model
{
	protected $table                = 'transaccion';
	protected $primaryKey           = 'id';

	protected $returnType           = 'array';
	protected $protectFields        = true;
	protected $allowedFields        = ['cuenta_id', 'tipo_transaccion_id', 'monto'];

	// Dates
	protected $useTimestamps        = true;

	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';

	// Validation
	protected $validationRules      = [
		'cuenta_id'				=> 'required',
		'tipo_transaccion_id'	=> 'required',
		'monto'					=> 'required|numeric'
	];

	/* protected $validationMessages   = [
		'monto' => [
			'numeric' => 'Los valores ingresados deben de ser numericos'
		]/* ,
		'cuenta_id' => [
			'is_valid_cuenta' => 'Estimado usuario, debe ingresar una cuenta valida'
		],
		'tipo_transaccion_id' => [
			'is_valid_tipo_transaccion' => 'Estimado usuario, debe ingresar un tipo de transaccion valida'
		]  
	]; */
	
	protected $skipValidation       = false;

	public function TransaccionesPorCliente($clienteId = null)
	{
		$builder = $this->db->table($this->table);
		$builder->select('cuenta.id AS Numero_de_Cuenta, cliente.nombre, cliente.apellido');
		$builder->select('tipo_transaccion.descripcion AS Tipo, transaccion.monto, transaccion.created_at AS Fecha_de_Creacion');
		$builder->join('cuenta', 'transaccion.cuenta_id = cuenta.id');
		$builder->join('tipo_transaccion', 'transaccion.tipo_transaccion_id = tipo_transaccion.id');
		$builder->join('cliente', 'cuenta.cliente_id = cliente.id');
		$builder->where('cliente.id', $clienteId);
		
		$query = $builder->get();
		return $query->getResult();
	}

	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];
}


