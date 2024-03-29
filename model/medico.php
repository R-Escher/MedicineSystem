<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];
include_once $raiz.'/MedicineSystem/config/database/database.php';
include_once 'base.php';

class Medico extends Base {

	private $crm;
	private $especialidade;
	private $genero;

	public function __construct(){
		self::$DB = new DB;
		self::$database = DB::_conectaDB();
	}
	
	public function __destruct(){
	}

  public static function comArgumentos($nome_entrada, $endereco_entrada, $telefone_entrada, $email_entrada, $senha_entrada, $crm_entrada, $especialidade_entrada, $genero_entrada) {

		$instance = new Self();

		$instance->setNome($nome_entrada);
		$instance->setEndereco($endereco_entrada);
		$instance->setTelefone($telefone_entrada);
		$instance->setEmail($email_entrada);
		$instance->setSenha(md5($senha_entrada));
		$instance->setCRM($crm_entrada);
		$instance->setEspecialidade($especialidade_entrada);
		$instance->setGenero($genero_entrada);
		$instance->alterarDB();

		return $instance;

  }

	public function setCRM($crm) {
		$this->crm = $crm;
	}

	public function getCRM() {
		return $this->crm;
	}

	public function setEspecialidade($especialidade) {
		$this->especialidade = $especialidade;
	}

	public function getEspecialidade() {
		return $this->especialidade;
	}

	public function setGenero($genero){
		$this->genero = $genero;
	}

	public function getGenero(){
		return $this->genero;
	}

	public function alterarDB(){
		###
		# FUNÇÃO UTILIZADA PARA CRIAR 
		# UM MEDICO NO SQL
		###
		
		# VERIFICA SE JÁ EXISTE NO DATABASE
		$query = self::$database->prepare("SELECT crm FROM medicos WHERE crm = ?");
		$crm = $this->getCRM();
		$query->bindParam(1, $crm);
		$query->execute();

		$row = $query->fetch(PDO::FETCH_OBJ);

		if ($row==null){ # MEDICO NÃO CADASTRADO
			$query = self::$database->prepare("INSERT INTO medicos (crm, nome, endereco, telefone, email, senha, especialidade, genero) VALUES (:crm, :nome, :endereco, :telefone, :email, :senha, :especialidade, :genero)");
			$query->execute(array(":crm" => $this->getCRM(), ":nome" => $this->getNome(), ":endereco" => $this->getEndereco(), ":telefone" => $this->getTelefone(), ":email" => $this->getEmail(), ":senha" => $this->getSenha(), ":especialidade" => $this->getEspecialidade(), ":genero" => $this->getGenero()));

		} else {         # MEDICO CADASTRADO
			$query = self::$database->prepare("UPDATE medicos SET crm = :crm, nome = :nome, endereco = :endereco, telefone = :telefone, email = :email, senha = :senha, especialidade = :especialidade, genero = :genero WHERE crm = :crm");
			$query->execute(array(":crm" => $this->getCRM(), ":nome" => $this->getNome(), ":endereco" => $this->getEndereco(), ":telefone" => $this->getTelefone(), ":email" => $this->getEmail(), ":senha" => $this->getSenha(), ":especialidade" => $this->getEspecialidade(), ":genero" => $this->getGenero()));
		} 

	}

	public function deletarMedico(){
		$query = self::$database->prepare("DELETE FROM medicos WHERE crm = ?");
		$crm = $this->getCRM();
		$query->bindParam(1, $crm);
		$success = $query->execute();

		if ($success == true){
			return true;
		} else {
			return false;
		}
	}

	public function listaMedicos() {
		/* 
		*  RETORNA LISTA DE LABORATORIOS
		*  E SEUS DADOS


		TESTAR ESSE METODO ! ################################################################


		*/

		$query = self::$database->prepare("SELECT * FROM medicos");
		$query->execute();

		$rows = $query->fetchAll(PDO::FETCH_OBJ);

		$medicos_array = array();

		foreach ($rows as $m) {
			$medico = new Medico();

			$medico->setNome($m->nome);
			$medico->setEndereco($m->endereco);
			$medico->setTelefone($m->telefone);
			$medico->setEmail($m->email);
			$medico->setSenha($m->senha);
			$medico->setCRM($m->crm);
			$medico->setGenero($m->genero);

			$medicos_array[] = $medico;
		}

		return $medicos_array;
	
	}

	public static function buscaMedico($crm_entrada) {
		# transforma para string pois recebe tipo object
		$crm_entrada = strval($crm_entrada);

		/* 
		*  RETORNA MEDICOS pesquisado
		*  E SEUS DADOS
		*/		

		$query = self::$database->prepare("SELECT * FROM medicos WHERE crm = ?");
		$query->bindParam(1, $crm_entrada);
		$query->execute();

		$row = $query->fetch(PDO::FETCH_OBJ);

		$medico = new Medico();

		if ($row != null){
			$medico->setNome($row->nome);
			$medico->setEndereco($row->endereco);
			$medico->setTelefone($row->telefone);
			$medico->setEmail($row->email);
			$medico->setSenha($row->senha);
			$medico->setCRM($row->crm);
			$medico->setEspecialidade($row->especialidade);
			$medico->setGenero($row->genero);
		}

		return $medico;
	}

}
?>
