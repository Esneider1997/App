<?php namespace App\Models;

use CodeIgniter\Model;

class TipoTransaccionModel extends Model
{

	protected $table                = 'tipo_transaccion';
	protected $primaryKey           = 'id';

	protected $returnType           = 'array';
	protected $allowedFields        = ['descripcion'];

	// Dates
	protected $useTimestamps        = true;
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	
	// Validation
	protected $validationRules      = [
		'descripcion'	=> 'required|alpha_space|max_length[65]'
	]; 

	protected $validationMessages   = [
		'descripcion'    => [
            'max_length' => 'Estimado usuario, debe ingresar maximo 65 caracteres'
        ]
	]; 

	protected $skipValidation       = false;

	// Callbacks
/* 	protected $allowCallbacks       = true; */
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];
}
