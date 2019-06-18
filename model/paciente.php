<?php
include_once 'base.php';

class Paciente extends Base {

	private $cpf;
	private $idade;
	private $genero;

	public function __construct(){
	}
	public function __destruct(){
	}

  public static function comArgumentos($nome_entrada, $endereco_entrada, $telefone_entrada, $email_entrada, $senha_entrada, $cpf_entrada, $idade_entrada, $genero_entrada) {

			$instance = new Self();

			$instance->setNome($nome_entrada);
			$instance->setEndereco($endereco_entrada);
			$instance->setTelefone($telefone_entrada);
			$instance->setEmail($email_entrada);
			$instance->setSenha(md5($senha_entrada));
			$instance->setCPF($cpf_entrada);
      $instance->setIdade($idade_entrada);
			$instance->setGenero($genero_entrada);
			$instance->alterarXML();

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

	public function alterarXML(){

		$salvar_paciente = $this;
		# CASO O PACIENTE JÁ EXISTA, DELETAR PARA ALTERAR
		$this->deletarPaciente();

		libxml_use_internal_errors(true);
		$xml_pacientes = simplexml_load_file("dados/pacientes.xml");

		$paciente = $xml_pacientes->addChild("paciente");
		$paciente->addChild("cpf", $salvar_paciente->getCPF());
		$paciente->addChild("nome", $salvar_paciente->getNome());
		$paciente->addChild("endereco", $salvar_paciente->getEndereco());
		$paciente->addChild("telefone", $salvar_paciente->getTelefone());
		$paciente->addChild("email", $salvar_paciente->getEmail());
		$paciente->addChild("senha", $salvar_paciente->getSenha());
		$paciente->addChild("idade", $salvar_paciente->getIdade());
		$paciente->addChild("genero", $salvar_paciente->getGenero());

		$dom = new DOMDocument("1.0");
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput = true;
		$dom->loadXML($xml_pacientes->asXML());

		$file = fopen("dados/pacientes.xml", "w");
		fwrite($file, $dom->saveXML());
		fclose($file);
	}

	public function deletarPaciente(){

		$validar_exclusao = false;
		libxml_use_internal_errors(true);
		$xml_pacientes = simplexml_load_file("dados/pacientes.xml");
		$formatado = dom_import_simplexml($xml_pacientes);
		foreach ($xml_pacientes->children() as $paciente) {
			if ($laboratorio->cpf == (string) $this->getCPF()) {
				$dom=dom_import_simplexml($paciente);
				$formatado->removeChild($dom);
				$export = simplexml_import_dom($formatado);
				$export->saveXML("dados/pacientes.xml");
				$this->__destruct();
				$validar_exclusao = true;
			}
		}
		return $validar_exclusao;
	}

	public static function listaPacientes() {
		libxml_use_internal_errors(true);
		$xml_pacientes = simplexml_load_file("dados/pacientes.xml");

		if ($xml_pacientes === false) {
			echo "Erro no XML Pacientes: ";
			foreach (libxml_get_errors() as $error) {
				echo "<br>", $error->message;
			}
		} else {

			$pacientes_array = array();

			foreach ($xml_pacientes->children() as $p) {
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
	}

	public static function buscapaciente($cpf_entrada) {
		libxml_use_internal_errors(true);
		$xml_pacientes = simplexml_load_file("dados/pacientes.xml");

		if ($xml_pacientes === false) {
			echo "Erro no XML Pacientes: ";
			foreach (libxml_get_errors() as $error) {
				echo "<br>", $error->message;
			}
		} else {

			$paciente = new Paciente();

			foreach ($xml_pacientes->children() as $p) {
				if ($p->cpf == $cpf_entrada) {
					$paciente->setNome($p->nome);
					$paciente->setEndereco($p->endereco);
					$paciente->setTelefone($p->telefone);
					$paciente->setEmail($p->email);
					$paciente->setSenha($p->senha);
					$paciente->setCPF($p->cpf);
					$paciente->setIdade($p->idade);
					$paciente->setGenero($p->genero);
				}
			}

			return $paciente;
		}
	}
}
?>
