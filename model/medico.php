<?php
include_once 'base.php';

class Medico extends Base {

	private $crm;
	private $especialidade;

	function __construct(){
	}

  public static function comArgumentos($nome_entrada, $endereco_entrada, $telefone_entrada, $email_entrada, $senha_entrada, $crm_entrada, $especialidade_entrada) {

			$instance = new Self();

			$instance->setNome($nome_entrada);
			$instance->setEndereco($endereco_entrada);
			$instance->setTelefone($telefone_entrada);
			$instance->setEmail($email_entrada);
			$instance->setSenha(md5($senha_entrada));
      $instance->setCRM($crm_entrada);
      $instance->setEspecialidade($especialidade_entrada);
			$instance->saveXML();

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

	public function saveXML(){


		libxml_use_internal_errors(true);
		$xml_medicos = simplexml_load_file("dados/medicos.xml");

		$medico = $xml_medicos->addChild("medico");
		$medico->addChild("crm", $this->getCRM());
		$medico->addChild("nome", $this->getNome());
		$medico->addChild("endereco", $this->getEndereco());
		$medico->addChild("telefone", $this->getTelefone());
		$medico->addChild("email", $this->getEmail());
		$medico->addChild("senha", $this->getSenha());
		$medico->addChild("especialidade", $this->getEspecialidade());

		$export = simplexml_import_dom($xml_medicos);
		$export->saveXML("dados/medicos.xml");
	}

	public function listaMedicos() {

		libxml_use_internal_errors(true);
		$xml_medicos = simplexml_load_file("dados/medicos.xml");

		if ($xml_medicos === false) {
			echo "Erro no XML Médicos: ";
			foreach (libxml_get_errors() as $error) {
				echo "<br>", $error->message;
			}
		} else {

			$medicos_array = array();

			foreach ($xml_medicos->children() as $m) {
				$medico = new Medico();
				$medico->setNome($m->nome);
				$medico->setEndereco($m->endereco);
				$medico->setTelefone($m->telefone);
				$medico->setEmail($m->email);
				$medico->setSenha($m->senha);
				$medico->setCRM($m->crm);
				$medico->setEspecialidade($m->especialidade);
				$medicos_array[] = $medico;
			}

			return $medicos_array;
		}
	}

	public static function buscaMedico($crm_entrada) {
		libxml_use_internal_errors(true);
		$xml_medicos = simplexml_load_file("dados/medicos.xml");

		if ($xml_medicos === false) {
			echo "Erro no XML Médicos: ";
			foreach (libxml_get_errors() as $error) {
				echo "<br>", $error->message;
			}
		} else {

			$medico = new Medico();

			foreach ($xml_medicos->children() as $m) {
				if ($m->crm == $crm_entrada) {
					$medico->setNome($m->nome);
					$medico->setEndereco($m->endereco);
					$medico->setTelefone($m->telefone);
					$medico->setEmail($m->email);
					$medico->setSenha($m->senha);
					$medico->setCRM($m->crm);
					$medico->setEspecialidade($m->especialidade);
				}
			}

			return $medico;
		}
	}


}
?>
