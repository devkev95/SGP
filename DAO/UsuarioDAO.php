<?php
	require_once '../../services/conn.php';
	require_once '../../model/Usuario.php';

	/**
	* 
	*/
	class UsuarioDAO 
	{
		private $db;
		private $error = null;
		
		public function __construct()
		{
			$this->db = ConnectionFactory::getFactory("sgp_user", "56p_2016", "sgp_system")->getConnection();
			if ($this->db->connect_errno) {
				$this->error = 1;
			}
		}

		public function save($user){
			if(is_a($user, "Usuario")){
				$query = "INSERT INTO usuario (email, nombres, apellidos, password, activo) VALUES ('".$user->getEmail()."', '".$user->getNombres()."', '".$user->getApellidos()."', '".$user->getEncryptedPassword()."', 0)";
				$res = $this->db->query($query);
				if(!$res){
					if ($this->db_errno == 1062){
						$this->error = 2;
					}
					else{
						$this->error = 1;
					}
					return $this->error;
				}
				return True;	
			}
		}

		public function getUserById($id){
			$id = $this->db->real_escape_string($id);
			$query = 'SELECT nombres, apellidos, password, nombrePerfil, email FROM usuario INNER JOIN'.' perfil ON usuario.perfil = perfil.idPerfil WHERE activo = 1 AND email = "'.$id.'"';
			$res = $this->db->query($query);
			if ($res and $res->num_rows > 0){
				$obj = $res->fetch_object();

				$user = new Usuario();
		
				$user->setNombres($obj->nombres);
				$user->setApellidos($obj->apellidos);
				$user->setEncryptedPassword($obj->password);
				$user->setPerfil($obj->nombrePerfil);
				$user->setEmail($obj->email);
				$user->setEstado(True);

				return $user;
			}else{
				if($db->errno){
					$this->error = 1;
				}else{
					$this->error = 3;
				}
				return $this->error;
			}
		}

		public function getError()
		{
			return $this->error;
		}
	}

?>