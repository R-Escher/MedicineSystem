<?php
include_once 'base.php';

class Medico extends Base {

	private $crm;
	private $especialidade;
	private $genero;

	public function __construct(){
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
		$instance->alterarXML();

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

	public function alterarXML(){

		$salvar_medico = $this;
		# CASO O MEDICO JÁ EXISTA, DELETAR PARA ALTERAR
		$this->deletarMedico();



		libxml_use_internal_errors(true);
		$xml_medicos = simplexml_load_file("dados/medicos.xml");

		$medico = $xml_medicos->addChild("medico");
		$medico->addChild("crm", $salvar_medico->getCRM());
		$medico->addChild("nome", $salvar_medico->getNome());
		$medico->addChild("endereco", $salvar_medico->getEndereco());
		$medico->addChild("telefone", $salvar_medico->getTelefone());
		$medico->addChild("email", $salvar_medico->getEmail());
		$medico->addChild("senha", $salvar_medico->getSenha());
		$medico->addChild("especialidade", $salvar_medico->getEspecialidade());
		$medico->addChild("genero", $salvar_medico->getGenero());

		$dom = new DOMDocument("1.0");
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput = true;
		$dom->loadXML($xml_medicos->asXML());

		$file = fopen("dados/medicos.xml", "w");
		fwrite($file, $dom->saveXML());
		fclose($file);
	}

	public function deletarMedico(){

		$validar_exclusao = false;
		libxml_use_internal_errors(true);
		$xml_medicos = simplexml_load_file("dados/medicos.xml");
		$formatado = dom_import_simplexml($xml_medicos);
		foreach ($xml_medicos->children() as $medico) {
			if ($medico->crm == (string) $this->getCRM()) {
				$dom=dom_import_simplexml($medico);
				$formatado->removeChild($dom);
				$export = simplexml_import_dom($formatado);
				$export->saveXML("dados/medicos.xml");
				$this->__destruct();
				$validar_exclusao = true;
			}
		}
		return $validar_exclusao;
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
				$medico->setGenero($m->genero);
				$medicos_array[] = $medico;
			}

			return $medicos_array;
		}
	}

	public static function buscaMedico($crm_entrada) {
		$crm_entrada = strval($crm_entrada);
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
					$medico->setGenero($m->genero);
				}
			}

			return $medico;
		}
	}


}
?>
