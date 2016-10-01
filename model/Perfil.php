<?php
	/**
	* 
	*/
	class Perfil implements JSONSerializable
	{
		private $idPerfil;
		private $nombrePerfil;

		public function getIdPerfil(){
			return $this->idPerfil;
		}

		public function setIdPerfil($idPerfil){
			$this->idPerfil = $idPerfil;
		}

		public function getNombrePerfil(){
			return $this->nombrePerfil;
		}

		public function setNombrePerfil($nombrePerfil)
		{
			$this->nombrePerfil = $nombrePerfil;
		}

		public function jsonSerialize(){

			return array("idPerfil"=>$this->idPerfil, "nombrePerfil"=>$this->nombrePerfil);

		}
	}
?>