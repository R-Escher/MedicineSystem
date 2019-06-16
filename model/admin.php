<?php

class Admin {

	private $login;
  private $senha;

  function __construct($login_entrada, $senha_entrada) {
      $this->login = $login_entrada;
      $this->senha = md5($senha_entrada);
  }

	public function setLogin($login) {
		$this->login = $login;
	}

	public function getLogin() {
		return $this->login;
	}
	
	public function setSenha($senha) {
		$this->senha = $senha;
	}

	public function getSenha() {
		return $this->senha;
	}
}
?>
