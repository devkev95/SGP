<?php
	require_once '../../services/conn.php';
	require_once '../../model/Perfil.php';

/**
* 
*/
class PerfilDAO
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

	public function getError()
	{
		return $this->error;
	}

	public function getPerfiles(){
		$query = "SELECT idPerfil, nombrePerfil FROM perfil";
		$res = $this->db->query($query);
		if($res and $res->num_rows > 0){
			$perfiles = array();
			while ($obj = $res->fetch_object()) {
				$perfil = new Perfil();
				$perfil->setIdPerfil($obj->idPerfil);
				$perfil->setNombrePerfil($obj->nombrePerfil);
				$perfiles[] = $perfil;
			}
			return $perfiles;
		}else{
			$this->error = 1;
			return $this->error;
		}
	}
}
?>