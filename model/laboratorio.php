<?php
include_once 'base.php';

class Laboratorio extends Base {

	private $cnpj;
	private $tipos_exames;

	public function __construct(){
	}

	public function __destruct(){
	}

  public static function comArgumentos($nome_entrada, $endereco_entrada, $telefone_entrada, $email_entrada, $senha_entrada, $cnpj_entrada, $tipos_exames_entrada) {

			$instance = new Self();

			$instance->setNome($nome_entrada);
			$instance->setEndereco($endereco_entrada);
			$instance->setTelefone($telefone_entrada);
			$instance->setEmail($email_entrada);
			$instance->setSenha(md5($senha_entrada));
			$instance->setCNPJ($cnpj_entrada);
      		$instance->setTipos_exames($tipos_exames_entrada);
			$instance->alterarXML();

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

	public function alterarXML(){
        ###
        # FUNÇÃO UTILIZADA PARA CRIAR 
        # UM LABORATORIO NO SQL
        ###
        
        # VERIFICA SE JÁ EXISTE NO DATABASE
        $query = $DB->prepare("SELECT cnpj FROM laboratorios WHERE cnpj = ?");
        $query->bindParam(1, $this->getCNPJ());
        $query->execute();

        $row = $query->fetch(PDO::FETCH_OBJ);

        if ($row==null){ # LAB NÃO CADASTRADO
            $query = $DB->prepare("INSERT INTO laboratorios (cnpj, nome, endereco, telefone, email, senha, tipos_exame) VALUES (:cnpj, :nome, :endereco, :telefone, :email, :senha, :tipos_exame)");
            $query->execute(array(":cnpj" => $this->getCNPJ(), ":nome" => $this->getNome(), ":endereco" => $this->getEndereco(), ":telefone" => $this->getTelefone(), ":email" => $this->getEmail(), ":senha" => $this->getSenha(), ":tipos_exame" => $this->getTipos_exames));

        } else {         # LAB CADASTRADO
            $query = $DB->prepare("UPDATE laboratorios SET cnpj = :cnpj, nome = :nome, endereco = :endereco, telefone = :telefone, email = :email, senha = :senha, tipos_exame = :tipos_exames WHERE cnpj = :cnpj");
            $query->execute(array(":cnpj" => $this->getCNPJ(), ":nome" => $this->getNome(), ":endereco" => $this->getEndereco(), ":telefone" => $this->getTelefone(), ":email" => $this->getEmail(), ":senha" => $this->getSenha(), ":tipos_exame" => $this->getTipos_exames));
        }        
	}

	public function deletarLaboratorio(){

		$validar_exclusao = false;

		$raiz = $_SERVER['DOCUMENT_ROOT'];
		libxml_use_internal_errors(true);
		$xml_laboratorios = simplexml_load_file($raiz.'/MedicineSystem/dados/laboratorios.xml');
		$formatado = dom_import_simplexml($xml_laboratorios);
		foreach ($xml_laboratorios->children() as $laboratorio) {
			if ($laboratorio->cnpj == (string) $this->getCNPJ()) {
				$dom=dom_import_simplexml($laboratorio);
				$formatado->removeChild($dom);
				$export = simplexml_import_dom($formatado);
				$export->saveXML($raiz.'/MedicineSystem/dados/laboratorios.xml');
				$this->__destruct();
				$validar_exclusao = true;
			}
		}
		return $validar_exclusao;
	}

	public static function listaLaboratorios() {
		$raiz = $_SERVER['DOCUMENT_ROOT'];
		libxml_use_internal_errors(true);
		$xml_laboratorios = simplexml_load_file($raiz.'/MedicineSystem/dados/laboratorios.xml');

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
				//$tipos_exames = explode(';', $l->tipos_exame);
				//$laboratorio->setTipos_exames($tipos_exames);
				$laboratorio->setTipos_exames($l->tipos_exame);
				$laboratorios_array[] = $laboratorio;
			}

			return $laboratorios_array;
		}
	}

	public static function buscaLaboratorio($cnpj_entrada) {
		$cnpj_entrada = strval($cnpj_entrada);

		$raiz = $_SERVER['DOCUMENT_ROOT'];
		libxml_use_internal_errors(true);
		$xml_laboratorios = simplexml_load_file($raiz.'/MedicineSystem/dados/laboratorios.xml');

		if ($xml_laboratorios === false) {
			//echo "Erro no XML laboratorios: ";
			foreach (libxml_get_errors() as $error) {
				//echo "<br>", $error->message;
			}
			$xml_laboratorios = simplexml_load_file($raiz.'/MedicineSystem/dados/laboratorios.xml');
		}
		if ($xml_laboratorios === false) {
			//echo "Erro no XML laboratorios: ";
			foreach (libxml_get_errors() as $error) {
				//echo "<br>", $error->message;
			}
		}else{

			$laboratorio = new laboratorio();

			foreach ($xml_laboratorios->children() as $l) {
				if ($l->cnpj == $cnpj_entrada) {
					$laboratorio->setNome($l->nome);
					$laboratorio->setEndereco($l->endereco);
					$laboratorio->setTelefone($l->telefone);
					$laboratorio->setEmail($l->email);
					$laboratorio->setSenha($l->senha);
					$laboratorio->setCNPJ($l->cnpj);
					//$tipos_exames = explode(';', $l->tipos_exame);
					//$laboratorio->setTipos_exames($tipos_exames);
					$laboratorio->setTipos_exames($l->tipos_exame);
				}
			}

			return $laboratorio;
		}
	}
}
?>
