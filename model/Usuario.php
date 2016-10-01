<?php
	/**
	 * 
	 */
	 class Usuario implements JSONSerializable
	 {
	 	
	 	private $nombres;
	 	private $apellidos;
	 	private $encryptedPassword;
	 	private $perfil;
	 	private $email;
	 	private $estado;

	 	public function getEncryptedPassword(){

	 		return $this->encryptedPassword;
	 	}

	 	public function setEncryptedPassword($encryptedPassword){
	 		
	 		$this->encryptedPassword = $encryptedPassword;
	 	}

	 	public function getNombres(){

	 		return $this->nombres;
	 	}

	 	public function setNombres($nombres){

	 		$this->nombres = $nombres;
	 	}

	 	public function getApellidos(){

	 		return $this->apellidos;
	 	}

	 	public function setApellidos($apellidos){

	 		$this->apellidos = $apellidos;
	 	}

	 	public function getPerfil(){

	 		return $this->perfil;
	 	}

	 	public function setPerfil($perfil){

	 		$this->perfil = $perfil;
	 	}

	 	public function setEstado($estado){
	 		$this->estado = $estado;
	 	}

	 	public function getEstado(){
	 		return $this->estado;
	 	}

	 	public function setEmail($email){
	 		$this->email = $email;
	 	}

	 	public function getEmail(){
	 		return $this->email;
	 	}

	 	public function jsonSerialize(){
	 		return array('nombres' => $this->nombres,
	 		'apellidos' => $this->apellidos,
	 		'email' => $this->email,
	 		'perfil' => (is_null($this->perfil) ? "Ninguno" : $this->perfil),
	 		'estado' => ($this->estado ? "Desactivado" : "Activado"));
	 	}

	 } 
?>