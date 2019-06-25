<?php
ini_set('display_errors', 1);
$raiz = $_SERVER['DOCUMENT_ROOT'];
include_once $raiz.'/MedicineSystem/model/administrador.php';
include_once $raiz.'/MedicineSystem/model/laboratorio.php';
include_once $raiz.'/MedicineSystem/model/medico.php';
include_once $raiz.'/MedicineSystem/model/paciente.php';


$admin = new Administrador();
$listaAdmins = $admin->listaAdmins();
$medico = new Medico();
$listaMedicos = $medico->listaMedicos();
$laboratorio = new Laboratorio();
$listaLaboratorios = $laboratorio->listaLaboratorios();
$paciente = new Paciente();
$listaPacientes = $paciente->listaPacientes();


if (!isset($_SESSION)){
  $cache_expire = session_cache_expire(60);
  session_start();
}

if(isset($_SESSION['usuario'])){
  echo "<script>window.location.href='../index.php';</script>";
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $trimusuario = trim($_POST['usuario']);
  $trimsenha = trim($_POST['senha']);

  if(isset($trimusuario) && isset($trimsenha)){
    switch ($_POST['sessao']){
      case 'admin':
          foreach ($listaAdmins as $adm) {
              if ($adm->getLogin()==$trimusuario && $adm->getSenha()==md5($trimsenha)) {
                  $_SESSION['usuario'] = $adm->getLogin();
                  $_SESSION['senha'] = $adm->getSenha();
                  $_SESSION['administrador'] = true;
                  echo "<script>window.location.href='../admin.php';</script>";
                  break;
              }
          }
          break;
      case 'medico':
          foreach ($listaMedicos as $med) {
              if ($med->getCRM()==$_POST['usuario'] && $med->getSenha()==md5($_POST['senha'])) {
                  $_SESSION['usuario'] = $med->getCRM();
                  $_SESSION['senha'] = $med->getSenha();
                  $_SESSION['medico'] = true;
                  echo "<script>window.location.href='../medico.php';</script>";
                  break;
              }
          }
          break;
      case 'laboratorio':
          foreach ($listaLaboratorios as $lab) {
              if ($lab->getCNPJ()==$_POST['usuario'] && $lab->getSenha()==md5($_POST['senha'])) {
                  $_SESSION['usuario'] = $lab->getCNPJ();
                  $_SESSION['senha'] = $lab->getSenha();
                  $_SESSION['laboratorio'] = true;
                  echo "<script>window.location.href='../laboratorio.php';</script>";
                  break;
              }
          }

          break;
      case 'paciente':
          foreach ($listaPacientes as $pac) {
              if ($pac->getCPF()==$_POST['usuario'] && $pac->getSenha()==md5($_POST['senha'])) {
                  $_SESSION['usuario'] = $pac->getCPF();
                  $_SESSION['senha'] = $pac->getSenha();
                  $_SESSION['laboratorio'] = true;
                  echo "<script>window.location.href='../paciente.php';</script>";
                  break;
              }
          }
          break;
    }
  } else {
    echo "<script>window.location.href='../index.php';</script>";
  }
}

?>
