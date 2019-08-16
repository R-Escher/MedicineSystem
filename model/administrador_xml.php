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

	public function listaAdmins() {
		$raiz = $_SERVER['DOCUMENT_ROOT'];
		libxml_use_internal_errors(true);
		$xml_admins = simplexml_load_file($raiz.'/MedicineSystem/dados/admins.xml');

		if ($xml_admins === false) {
			echo "Erro no XML Admins: ";
			foreach (libxml_get_errors() as $error) {
				echo "<br>", $error->message;
			}
		} else {

			$admins_array = array();

			foreach ($xml_admins->children() as $a) {
				$admin = new Administrador();
				$admin->setLogin($a->login);
				$admin->setSenha($a->senha);
				$admins_array[] = $admin;
			}

			return $admins_array;
		}
	}
}
?>
