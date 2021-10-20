<?php namespace App\Models;

use CodeIgniter\Model;

class CuentaModel extends Model
{
	protected $table                = 'cuenta';
	protected $primaryKey           = 'id';

	protected $returnType           = 'array';
	protected $allowedFields        = ['moneda', 'fondo', 'cliente_id'];

	// Dates
	protected $useTimestamps        = true;
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';

	// Validation
	protected $validationRules      = [
		'moneda'	 =>	'required|alpha_space|min_length[1]|max_length[3]',
		'fondo'		 =>	'required|numeric',
		'cliente_id' =>	'required|integer|is_valid_cliente',
	];


	protected $validationMessages = [
		'cliente_id'	=> [
			'is_valid_cliente'	 =>	'Estimado usuario, debe ingresar un cliente valido',
			'is_allow_cliente'	 =>	'Estimado usuario, debe ingresar un cliente de la lista pemitida'
		]
	];

	protected $skipValidation       = false;

}
