<?php

class Connection{
	
	//variables para los datos de la base de datos
	public $server;
	public $userdb;
	public $passdb;
	public $dbname;
	
	public function __construct(){
		
		//Iniciar las variables con los datos de la base de datos
		$this->server = 'localhost';
		$this->userdb = 'sgp_user';
		$this->passdb = '56p_2016';
		$this->dbname = 'sgp_system';
		
	}
	
	public function get_connected(){
		
		//Para conectarnos a MySQL
		$con = mysql_connect($this->server, $this->userdb, $this->passdb) or die ("No se pudo conectar a la base de datos");
		//Nos conectamos a la base de datos que vamos a usar
		mysql_select_db($this->dbname, $con) or die ("No se encontro la base de datos");
		
	}
	
}

?>