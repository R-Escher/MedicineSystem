<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];
include_once $raiz.'/MedicineSystem/config/database/database.php';
include_once 'base.php';

class Laboratorio extends Base {

	private $cnpj;
	private $tipos_exames;

	public function __construct(){
		self::$DB = new DB;
		self::$database = DB::_conectaDB();
	}

	public function __destruct(){
	}

	public static function comArgumentos($nome_entrada, $endereco_entrada, $telefone_entrada, $email_entrada, $senha_entrada, $cnpj_entrada, $tipos_exames_entrada) {

		$instance = new Self();

		$instance->setNome($nome_entrada);
		$instance->setEndereco($endereco_entrada);
		$instance->setTelefone($telefone_entrada);
		$instance->setEmail($email_entrada);
		$instance->setSenha(md5($senha_entrada));
		$instance->setCNPJ($cnpj_entrada);
		$instance->setTipos_exames($tipos_exames_entrada);
		$instance->alterarDB();

		return $instance;
	}

	public function setCNPJ($cnpj) {
		$this->cnpj = $cnpj;
	}

	public function getCNPJ() {
		return $this->cnpj;
	}

	public function setTipos_exames($tipos_exames) {
		$this->tipos_exames = $tipos_exames;
	}

	public function getTipos_exames() {
		return $this->tipos_exames;
	}

	public function alterarDB(){
		###
		# FUNÇÃO UTILIZADA PARA CRIAR 
		# UM LABORATORIO NO SQL
		###
		
		# VERIFICA SE JÁ EXISTE NO DATABASE
		$query = self::$database->prepare("SELECT cnpj FROM laboratorios WHERE cnpj = ?");
		$cnpj = $this->getCNPJ();
		$query->bindParam(1, $cnpj);
		$query->execute();

		$row = $query->fetch(PDO::FETCH_OBJ);

		if ($row==null){ # LAB NÃO CADASTRADO
			$query = self::$database->prepare("INSERT INTO laboratorios (cnpj, nome, endereco, telefone, email, senha, tipos_exames) VALUES (:cnpj, :nome, :endereco, :telefone, :email, :senha, :tipos_exames)");
			#$cnpj = $this->getCNPJ(); $nome = $this->getNome(); $endereco = $this->getEndereco(); $telefone = $this->getTelefone(); $email = $this->getEmail(); $senha = $this->getSenha(); $tipos_exames = $this->getTipos_exames();
			#$query->execute(array(":cnpj" => $cnpj, ":nome" => $nome, ":endereco" => $endereco, ":telefone" => $telefone, ":email" => $email, ":senha" => $senha, ":tipos_exame" => $tipos_exames) );
			$query->execute(array(":cnpj" => $this->getCNPJ(), ":nome" => $this->getNome(), ":endereco" => $this->getEndereco(), ":telefone" => $this->getTelefone(), ":email" => $this->getEmail(), ":senha" => $this->getSenha(), ":tipos_exames" => $this->getTipos_exames()));


		} else {         # LAB CADASTRADO
			$query = self::$database->prepare("UPDATE laboratorios SET cnpj = :cnpj, nome = :nome, endereco = :endereco, telefone = :telefone, email = :email, senha = :senha, tipos_exames = :tipos_exames WHERE cnpj = :cnpj");
			$query->execute(array(":cnpj" => $this->getCNPJ(), ":nome" => $this->getNome(), ":endereco" => $this->getEndereco(), ":telefone" => $this->getTelefone(), ":email" => $this->getEmail(), ":senha" => $this->getSenha(), ":tipos_exames" => $this->getTipos_exames()));
		}        
  	}

	public function deletarLaboratorio(){

		$query = self::$database->prepare("DELETE FROM laboratorios WHERE cnpj = ?");
		$cnpj = $this->getCNPJ();
		$query->bindParam(1, $cnpj);
		$success = $query->execute();

		if ($success == true){
			return true;
		} else {
			return false;
		}
	}


	public function listaLaboratorios() {
		/* 
		*  RETORNA LISTA DE LABORATORIOS
		*  E SEUS DADOS


		TESTAR ESSE METODO ! ################################################################


		*/

		$query = self::$database->prepare("SELECT * FROM laboratorios");
		$query->execute();

		$rows = $query->fetchAll(PDO::FETCH_OBJ);

		$laboratorios_array = array();

		foreach ($rows as $l) {
			$laboratorio = new Laboratorio();

			$laboratorio->setNome($l->nome);
			$laboratorio->setEndereco($l->endereco);
			$laboratorio->setTelefone($l->telefone);
			$laboratorio->setEmail($l->email);
			$laboratorio->setSenha($l->senha);
			$laboratorio->setCNPJ($l->cnpj);
			$laboratorio->setTipos_exames($l->tipos_exames);

			$laboratorios_array[] = $laboratorio;
		}

		return $laboratorios_array;
	
	}

  	public function buscaLaboratorio($cnpj_entrada) {
		$cnpj_entrada = strval($cnpj_entrada);

		/* 
		*  RETORNA LABORATORIOS pesquisado
		*  E SEUS DADOS


		TESTAR ESSE METODO ! ################################################################


		*/		

		$query = self::$database->prepare("SELECT * FROM laboratorios WHERE cnpj = ?");
		$query->bindParam(1, $cnpj_entrada);
		$query->execute();

		$row = $query->fetch(PDO::FETCH_OBJ);

		$laboratorio = new laboratorio();
		  
		$laboratorio->setNome($row->nome);
		$laboratorio->setEndereco($row->endereco);
		$laboratorio->setTelefone($row->telefone);
		$laboratorio->setEmail($row->email);
		$laboratorio->setSenha($row->senha);
		$laboratorio->setCNPJ($row->cnpj);
		$laboratorio->setTipos_exames($row->tipos_exames);

		return $laboratorio;
	
	}
}
?>
