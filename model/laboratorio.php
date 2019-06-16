<?php
#include_once 'base.php';

class Laboratorio extends Base {

	private $cnpj;
	private $tipos_exames;

  function __construct($nome_entrada, $endereco_entrada, $telefone_entrada, $email_entrada, $senha_entrada, $cnpj_entrada, $tipos_exames_entrada) {
      parent::__construct($nome_entrada, $endereco_entrada, $telefone_entrada, $email_entrada, $senha_entrada);
      $this->cnpj = $cnpj_entrada;
      $this->tipos_exames = $tipos_exames_entrada;
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

}
?>
