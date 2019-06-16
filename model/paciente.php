<?php
#include_once 'base.php';

class Paciente extends Base {

	private $cpf;
	private $idade;
	private $genero;

  function __construct($nome_entrada, $endereco_entrada, $telefone_entrada, $email_entrada, $senha_entrada, $cpf_entrada, $idade_entrada, $genero_entrada) {
      parent::__construct($nome_entrada, $endereco_entrada, $telefone_entrada, $email_entrada, $senha_entrada);
      $this->cpf = $cpf_entrada;
      $this->idade = $idade_entrada;
			$this->genero = $genero_entrada;
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
}
?>
