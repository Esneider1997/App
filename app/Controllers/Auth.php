<?php namespace App\Controllers;

use Config\Services;
use App\Models\UsuarioModel;
use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;

class Auth extends BaseController
{
     use ResponseTrait;

    public function __construct()
    {
        helper('secure_password');
    }

    public function login()
    {
        try {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $usuarioModel = new UsuarioModel();

            $validateUsuario = $usuarioModel->where('username', $username)->first();
            
            if($validateUsuario == null)
                return $this->failNotFound('Usuario no encontrado');

            if(verifyPassword($password, $validateUsuario["password"])):
                
                $jwt = $this->generateJWT($validateUsuario);
                return $this->respond(['Token' => $jwt], 201);

            else:
                return $this->failValidationErrors('Contraseña invalida');
            endif; 

        } catch (\Exception $e) {
            return $this->failServerError('Ha ocurrido un error en el servidor '.$e);
        }
    } 

    public function login2()
    {
        try {
            $user =  $this->request->getJSON();  

            /* $usuario = '';
            $password = '';
            foreach($user as $val){
                $usuario = $val->username;
                $password = $val->password;
            }
            var_dump($user[0]->usuario); */

            session()->set([
                
            ]);

            $usuarioModel = new UsuarioModel();
            $usuariovalidado = $usuarioModel->where('username', $user->usuario)->first();
         
            
            
           if ( $usuariovalidado == null )
                return $this->failNotFound('Usuario no encontrado');

            if (verifyPassword($user->contrasena, $usuariovalidado["password"])):
                $jwt = $this->generateJWT($usuariovalidado);
                return $this->respond(['Token' => $jwt], 201);
            else:   
                return $this->failValidationErrors('Contraseña invalida');
            endif;  
        } catch (\Exception $e) {
            return $this->failServerError('Ha ocurrido un error en el servidor '.$e);
        }
    }


    protected function generateJWT($usuario)
    {
        $key = Services::getSecretKey();
        $time = time();

        $playload = [
            'aud' => base_url(),
            'ait' => $time, // como entero el tiempo,
            'exp' => $time + 900, // 
            'data' => [
                'nombre' => $usuario['nombre'],
                'username' => $usuario['username'],
                'rol' => $usuario['rol_id']

            ]
        ];

        $jwt = JWT::encode($playload, $key);
        return $jwt;
    } 
}