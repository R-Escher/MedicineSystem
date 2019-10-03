<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];
include_once $raiz.'/MedicineSystem/config/database/database.php';
include_once 'base.php';

class Paciente extends Base {

	private $cpf;
	private $idade;
	private $genero;

	public function __construct(){
		self::$DB = new DB;
		self::$database = DB::_conectaDB();
	}
	
	public function __destruct(){
	}

    public function comArgumentos($nome_entrada, $endereco_entrada, $telefone_entrada, $email_entrada, $senha_entrada, $cpf_entrada, $idade_entrada, $genero_entrada) {

        $instance = new Self();

        $instance->setNome($nome_entrada);
        $instance->setEndereco($endereco_entrada);
        $instance->setTelefone($telefone_entrada);
        $instance->setEmail($email_entrada);
        $instance->setSenha(md5($senha_entrada));
        $instance->setCPF($cpf_entrada);
        $instance->setIdade($idade_entrada);
        $instance->setGenero($genero_entrada);
        $instance->alterarDB();

        return $instance;
    }

	public function setCPF($cpf) {
		$this->cpf = $cpf;
	}

	public function getCPF() {
		return $this->cpf;
	}

	public function setIdade($idade) {
		$this->idade = $idade;
	}

	public function getIdade() {
		return $this->idade;
	}

	public function setGenero($genero) {
		$this->genero = $genero;
	}

	public function getGenero() {
		return $this->genero;
	}

	public function alterarDB(){
		###
		# FUNÇÃO UTILIZADA PARA CRIAR 
		# UM MEDICO NO SQL
		###
		
		# VERIFICA SE JÁ EXISTE NO DATABASE
		$query = self::$database->prepare("SELECT cpf FROM pacientes WHERE cpf = ?");
		$cpf = $this->getCPF();
		$query->bindParam(1, $cpf);
		$query->execute();

		$row = $query->fetch(PDO::FETCH_OBJ);

		if ($row==null){ # PACIENTE NÃO CADASTRADO
			$query = self::$database->prepare("INSERT INTO pacientes (cpf, nome, endereco, telefone, email, senha, idade, genero) VALUES (:cpf, :nome, :endereco, :telefone, :email, :senha, :idade, :genero)");
			$query->execute(array(":cpf" => $this->getCPF(), ":nome" => $this->getNome(), ":endereco" => $this->getEndereco(), ":telefone" => $this->getTelefone(), ":email" => $this->getEmail(), ":senha" => $this->getSenha(), ":idade" => $this->getIdade(), ":genero" => $this->getGenero()));

		} else {         # PACIENTE CADASTRADO
			$query = self::$database->prepare("UPDATE pacientes SET cpf = :cpf, nome = :nome, endereco = :endereco, telefone = :telefone, email = :email, senha = :senha, idade = :idade, genero = :genero WHERE cpf = :cpf");
			$query->execute(array(":cpf" => $this->getCPF(), ":nome" => $this->getNome(), ":endereco" => $this->getEndereco(), ":telefone" => $this->getTelefone(), ":email" => $this->getEmail(), ":senha" => $this->getSenha(), ":idade" => $this->getIdade(), ":genero" => $this->getGenero()));
		}
	}

	public function deletarPaciente(){

		$query = self::$database->prepare("DELETE FROM pacientes WHERE cpf = ?");
		$cpf = $this->getCPF();
		$query->bindParam(1, $cpf);
		$success = $query->execute();

		if ($success == true){
			return true;
		} else {
			return false;
		}
	}

	public static function listaPacientes() {
		/* 
		*  RETORNA LISTA DE LABORATORIOS
		*  E SEUS DADOS

		TESTAR ESSE METODO ! ################################################################

		*/

		$query = self::$database->prepare("SELECT * FROM pacientes");
		$query->execute();

		$rows = $query->fetchAll(PDO::FETCH_OBJ);

		$pacientes_array = array();

		foreach ($rows as $p) {
			$paciente = new Paciente();

			$paciente->setNome($p->nome);
			$paciente->setEndereco($p->endereco);
			$paciente->setTelefone($p->telefone);
			$paciente->setEmail($p->email);
			$paciente->setSenha($p->senha);
			$paciente->setCPF($p->cpf);
			$paciente->setIdade($p->idade);
			$paciente->setGenero($p->genero);

			$pacientes_array[] = $paciente;
		}

		return $pacientes_array;
	
	}

	public static function buscapaciente($cpf_entrada) {
		# transforma para string pois recebe tipo object
        $cpf_entrada = strval($cpf_entrada);
                
		/* 
		*  RETORNA PACIENTES pesquisado
		*  E SEUS DADOS
		*/		

		$query = self::$database->prepare("SELECT * FROM pacientes WHERE cpf = ?");
		$query->bindParam(1, $cpf_entrada);
		$query->execute();

		$row = $query->fetch(PDO::FETCH_OBJ);
		$paciente = new Paciente();

		if ($row != null){
			
			$paciente->setNome($row->nome);
			$paciente->setEndereco($row->endereco);
			$paciente->setTelefone($row->telefone);
			$paciente->setEmail($row->email);
			$paciente->setSenha($row->senha);
			$paciente->setCPF($row->cpf);
			$paciente->setIdade($row->idade);
			$paciente->setGenero($row->genero);	
		}

		return $paciente;
	}
}
?>
