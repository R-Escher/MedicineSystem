<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];
include_once $raiz.'/MedicineSystem/config/database/database.php';

class Administrador {

    private $login;
	private $senha;
	
	public static $DB;
	public static $database;

	public function __construct(){
		self::$DB = new DB;
		self::$database = DB::_conectaDB();
	}

	public function setLogin($login) {
		$this->login = $login;
	}

	public function getLogin() {
		return $this->login;
	}

	public function setSenha($senha) {
		$this->senha = $senha;
	}

	public function getSenha() {
		return $this->senha;
	}

	public function listaAdmins(){
		$query = self::$database->prepare("SELECT * FROM admin");
		$query->execute();

		$rows = $query->fetchAll(PDO::FETCH_OBJ);
		$listaAdmins = array();

		foreach ($rows as $a){
			$admin = new Administrador();
			$admin->setLogin($a->login);
			$admin->setSenha($a->senha);
			$listaAdmins[] = $admin;
		}

		return $listaAdmins;
	}
}
?>
