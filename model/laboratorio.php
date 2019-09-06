<?php
include_once 'base.php';

class Laboratorio extends Base {

	private $cnpj;
	private $tipos_exames;

	public function __construct(){
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
		$instance->alterarXML();

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
		$query = $DB->prepare("SELECT cnpj FROM laboratorios WHERE cnpj = ?");
		$query->bindParam(1, $this->getCNPJ());
		$query->execute();

		$row = $query->fetch(PDO::FETCH_OBJ);

		if ($row==null){ # LAB NÃO CADASTRADO
			$query = $DB->prepare("INSERT INTO laboratorios (cnpj, nome, endereco, telefone, email, senha, tipos_exame) VALUES (:cnpj, :nome, :endereco, :telefone, :email, :senha, :tipos_exame)");
			$query->execute(array(":cnpj" => $this->getCNPJ(), ":nome" => $this->getNome(), ":endereco" => $this->getEndereco(), ":telefone" => $this->getTelefone(), ":email" => $this->getEmail(), ":senha" => $this->getSenha(), ":tipos_exame" => $this->getTipos_exames));

		} else {         # LAB CADASTRADO
			$query = $DB->prepare("UPDATE laboratorios SET cnpj = :cnpj, nome = :nome, endereco = :endereco, telefone = :telefone, email = :email, senha = :senha, tipos_exame = :tipos_exames WHERE cnpj = :cnpj");
			$query->execute(array(":cnpj" => $this->getCNPJ(), ":nome" => $this->getNome(), ":endereco" => $this->getEndereco(), ":telefone" => $this->getTelefone(), ":email" => $this->getEmail(), ":senha" => $this->getSenha(), ":tipos_exame" => $this->getTipos_exames));
		}        
  	}

	public function deletarLaboratorio(){

		$query = $DB->prepare("DELETE FROM laboratorios WHERE cnpj = ?");
		$query->bindParam(1, $this->getCNPJ());
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

		$query->prepare("SELECT * FROM laboratorios");
		$query->execute();

		$rows = $query->fetchAll();

		$laboratorios_array = array();

		foreach ($rows as $l) {
			$laboratorio = new Laboratorio();

			$laboratorio->comArgumentos(
				$l[0], //nome
				$l[1], //endereco
				$l[2], //telefone
				$l[3], //email
				$l[4], //senha
				$l[5], //cnpj
				$l[6]  //tipos_exames
			);
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

		$query->prepare("SELECT * FROM laboratorios WHERE cnpj = ?");
		$query->bindParam(1, $cnpj_entrada);
		$query->execute();

		$row = $query->fetch(PDO::FETCH_OBJ);

		$laboratorio = new laboratorio();
		  
		$laboratorio->comArgumentos(
			$row->nome, //nome
			$row->endereco, //endereco
			$row->telefone, //telefone
			$row->email, //email
			$row->senha, //senha
			$row->cnpj, //cnpj
			$row->tipos_exames  //tipos_exames
		);

		return $laboratorio;
	
	}
}
?>
