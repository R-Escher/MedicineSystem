<?php
#include_once 'base.php';

class Laboratorio extends Base {

	private $cnpj;
	private $tipos_exames;

  function __construct($nome_entrada, $endereco_entrada, $telefone_entrada, $email_entrada, $senha_entrada, $cnpj_entrada, $tipos_exames_entrada) {

			$instance-> new Self();

			$instance->setNome($nome_entrada);
			$instance->setEndereco($endereco_entrada);
			$instance->setTelefone($telefone_entrada);
			$instance->setEmail($email_entrada);
			$instance->setSenha(md5($senha_entrada));
			$instance->setCNPJ($cnpj_entrada);
      $instance->setTipos_exames($tipos_exames_entrada);

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

	public static function listaLaboratorios() {
		libxml_use_internal_errors(true);
		$xml_laboratorios = simplexml_load_file("dados/laboratorios.xml");

		if ($xml_laboratorios === false) {
			echo "Erro no XML laboratorios: ";
			foreach (libxml_get_errors() as $error) {
				echo "<br>", $error->message;
			}
		} else {

			$laboratorios_array = array();

			foreach ($xml_laboratorios->children() as $l) {
				$laboratorio = new Laboratorio();
				$laboratorio->setNome($l->nome);
				$laboratorio->setEndereco($l->endereco);
				$laboratorio->setTelefone($l->telefone);
				$laboratorio->setEmail($l->email);
				$laboratorio->setSenha($l->senha);
				$laboratorio->setCNPJ($l->cnpj);
				$tipos_exames = explode (";", $l->tipos_exames);
				$laboratorio->setTipos_exames($tipos_exames);
				$laboratorios_array[] = $laboratorio;
			}

			return $laboratorios_array;
		}
	}

	public static function buscaLaboratorio($cnpj_entrada) {
		libxml_use_internal_errors(true);
		$xml_laboratorios = simplexml_load_file("dados/laboratorios.xml");

		if ($xml_laboratorios === false) {
			echo "Erro no XML laboratorios: ";
			foreach (libxml_get_errors() as $error) {
				echo "<br>", $error->message;
			}
		} else {

			$laboratorio = new laboratorio();

			foreach ($xml_laboratorios->children() as $l) {
				if ($p->cnpj == $cnpj_entrada) {
					$laboratorio->setNome($l->nome);
					$laboratorio->setEndereco($l->endereco);
					$laboratorio->setTelefone($l->telefone);
					$laboratorio->setEmail($l->email);
					$laboratorio->setSenha($l->senha);
					$laboratorio->setCNPJ($l->cnpj);
					$tipos_exames = explode (";", $l->tipos_exames);
					$laboratorio->setTipos_exames($tipos_exames);
				}
			}

			return $laboratorio;
		}
	}
}
?>
