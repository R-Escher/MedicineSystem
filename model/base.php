<?php
abstract class Base {

	private $nome;
	private $endereco;
  private $telefone;
  private $email;
  private $senha;

	public function setNome($nome) {
		$this->nome = $nome;
	}

	public function getNome() {
		return $this->nome;
	}

	public function setEndereco($endereco) {
		$this->endereco = $endereco;
	}

	public function getEndereco() {
		return $this->endereco;
	}

	public function setTelefone($telefone) {
		$this->telefone = $telefone;
	}

	public function getTelefone() {
		return $this->telefone;
	}

  public function setEmail($email) {
    $this->email = $email;
  }

  public function getEmail() {
    return $this->email;
  }

	public function setSenha($senha) {
		$this->senha = $senha;
	}

	public function getSenha() {
		return $this->senha;
	}

	abstract protected function saveXML();
	abstract protected function comArgumentos();
}
?>
