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
				$user->setNombres($this->db->real_escape_string($user->getNombres()));
				$user->setEmail($this->db->real_escape_string($user->getEmail()));
				$user->setApellidos($this->db->real_escape_string($user->getApellidos()));
				$user->setEncryptedPassword($this->db->real_escape_string($user->getEncryptedPassword()));
				$query = "INSERT INTO usuario (email, nombres, apellidos, password, activo) VALUES ('".$user->getEmail()."', '".$user->getNombres()."', '".$user->getApellidos()."', '".$user->getEncryptedPassword()."', 0)";
				$res = $this->db->query($query);
				if(!$res){
					if ($this->db->errno == 1062){
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

		public function getUsuarios(){
			$query = "SELECT email, nombres, apellidos, nombrePerfil, activo FROM usuario LEFT JOIN perfil ON perfil.idPerfil = usuario.perfil ";
			$res = $this->db->query($query);
			$usuarios = array();
			if ($res and $res->num_rows > 0){
				while($obj = $res->fetch_object()){
					$user = new Usuario();
					$user->setNombres($obj->nombres);
					$user->setApellidos($obj->apellidos);
					$user->setEmail($obj->email);
					$user->setEstado(($obj->activo == 0 ? true : false));
					$user->setPerfil((!is_null($obj->nombrePerfil) ? $obj->nombrePerfil : null));
					$usuarios[] = $user;
				}
				return $usuarios;
			}else{
				$this->error = 1;
				return $this->error;
			}
		}

		public function getUserByIdAll($id)
		{
			$id = $this->db->real_escape_string($id);
			$query = 'SELECT nombres, apellidos, password, perfil, email, activo FROM usuario WHERE email = "'.$id.'"';
			$res = $this->db->query($query);
			if ($res and $res->num_rows > 0){
				$obj = $res->fetch_object();

				$user = new Usuario();
		
				$user->setNombres($obj->nombres);
				$user->setApellidos($obj->apellidos);
				$user->setEncryptedPassword($obj->password);
				$user->setPerfil($obj->perfil);
				$user->setEmail($obj->email);
				$user->setEstado(($obj->activo == 0 ? false : true));

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

		public function actualizarPermisosUsuario($usuario){
			if(is_a($usuario, "Usuario")){
				$usuario->setEmail($this->db->real_escape_string($usuario->getEmail()));
				$activo = ($usuario->getEstado() ? 1 : 0);
				$perfil = (empty($usuario->getPerfil()) ? "NULL" : $usuario->getPerfil());
				$query = "UPDATE usuario SET activo=".$activo.", perfil=".$perfil." WHERE email='".$usuario->getEmail()."'";
				if($this->db->query($query)){
					return true;
				}else{
					$this->error = 1;
					return $this->error;
				}
			}
		}

	}

?>