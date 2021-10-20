<?php namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{

	protected $table                = 'usuario';
	protected $primaryKey           = 'id';
	
	protected $returnType           = 'array';

	protected $protectFields        = true;
	protected $allowedFields        = ['nombre', 'username', 'password', 'imagen_nombre', 'imagen_ruta','rol_id'];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';

	// Validation
	protected $validationRules      = [
		'imagen_nombre'		=> 'uploaded[imagen]|max_size[imagen,1024]' /* mime_in[imagen,image/jpg,image/jpeg/image/png]' */
	];

	protected $validationMessages   = [];
	protected $skipValidation       = false;


	// Callbacks
	/* protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = []; */
}
