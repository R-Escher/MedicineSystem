<?php

class Administrador {

    private $login;
    private $senha;

    public function __construct(){
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
