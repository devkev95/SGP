<?php
	
	/**
	 * Clase para crear la conexion a la BD
	 */
	 class ConnectionFactory
	 {
	 	
	 	private static $factory;
	 	private $db;
	 	private $user;
	 	private $password;
	 	private $dbName;

	 	function __construct($user, $password, $dbName){
	 		$this->user = $user;
	 		$this->password = $password;
	 		$this->dbName = $dbName;
	 	}

	 	public static function getFactory($user, $password, $dbName){
	 		if (!self::$factory){
	 			self::$factory = new ConnectionFactory($user, $password, $dbName);
	 		}
	 		return self::$factory;
	 	}

	 	public function getConnection(){
	 		if(!$this->db){
	 			$this->db = new mysqli("localhost", $this->user, $this->password, $this->dbName);
	 		}
	 		return $this->db;
	 	}
	 } 
?>