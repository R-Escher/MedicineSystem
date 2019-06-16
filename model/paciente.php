<?php
#include_once 'base.php';

class Paciente extends Base {

	private $cpf;
	private $idade;
	private $genero;

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
