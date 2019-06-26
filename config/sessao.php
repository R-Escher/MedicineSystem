<?php
$raiz = $_SERVER['DOCUMENT_ROOT'];
include_once $raiz.'/MedicineSystem/model/administrador.php';
include_once $raiz.'/MedicineSystem/model/laboratorio.php';
include_once $raiz.'/MedicineSystem/model/medico.php';
include_once $raiz.'/MedicineSystem/model/paciente.php';
include_once $raiz.'/MedicineSystem/config/universal.php';


$admin = new Administrador();
$listaAdmins = $admin->listaAdmins();
$medico = new Medico();
$listaMedicos = $medico->listaMedicos();
$laboratorio = new Laboratorio();
$listaLaboratorios = $laboratorio->listaLaboratorios();
$paciente = new Paciente();
$listaPacientes = $paciente->listaPacientes();


if (session_status() == PHP_SESSION_NONE){
  $cache_expire = session_cache_expire(300);
  session_start();
}


if(isset($_SESSION['usuario'])){
  echo "<script>window.location.href='../index.php';</script>";
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {

  // Elimina possivel mascara
  $trimusuario = preg_replace("/[^0-9a-zA-Z]/", "", $_POST['usuario']);
  $trimsenha = preg_replace("/[^0-9]/", "", $_POST['senha']);

  $trimusuario = trim($universal->testaEntrada($trimusuario));
  $trimsenha = trim($universal->testaEntrada($trimsenha));

  if(isset($trimusuario) && isset($trimsenha)){
    switch ($_POST['sessao']){
      case 'admin':
          foreach ($listaAdmins as $adm) {
              if ($adm->getLogin()==$trimusuario && $adm->getSenha()==md5($trimsenha)) {
                  $_SESSION['usuario'] = $adm->getLogin();
                  $_SESSION['senha'] = $adm->getSenha();
                  setcookie('administrador', 'verdade', time()+ 300,'/');
                  echo "<script>window.location.href='../admin.php';</script>";
                  break;
              }
          }
          setcookie('invalido', 'verdade', time()+ 300,'/');
          echo "<script>window.location.href='../index.php';</script>";
          break;
      case 'medico':
          foreach ($listaMedicos as $med) {
              if ($med->getCRM()==$trimusuario && $med->getSenha()==md5($trimsenha)) {
                  $_SESSION['usuario'] = $med->getCRM();
                  $_SESSION['senha'] = $med->getSenha();
                  setcookie('medico', 'verdade', time()+ 300,'/');
                  setcookie('medico_crm', $med->getCRM(), time()+ 300,'/');
                  echo "<script>window.location.href='../medico.php';</script>";
                  break;
              }
          }
          setcookie('invalido', 'verdade', time()+ 300,'/');
          echo "<script>window.location.href='../index.php';</script>";
          break;
      case 'laboratorio':
          foreach ($listaLaboratorios as $lab) {
              if ($lab->getCNPJ()==$trimusuario && $lab->getSenha()==md5($trimsenha)) {
                  $_SESSION['usuario'] = $lab->getCNPJ();
                  $_SESSION['senha'] = $lab->getSenha();
                  setcookie('laboratorio', 'verdade', time()+ 300,'/');
                  setcookie('laboratorio_cnpj', $lab->getCNPJ(), time()+ 300,'/');
                  echo "<script>window.location.href='../laboratorio.php';</script>";
                  break;
              }
          }
          setcookie('invalido', 'verdade', time()+ 300,'/');
          echo "<script>window.location.href='../index.php';</script>";
          break;
      case 'paciente':
          foreach ($listaPacientes as $pac) {
              if ($pac->getCPF()==$trimusuario && $pac->getSenha()==md5($trimsenha)) {
                  $_SESSION['usuario'] = $pac->getCPF();
                  $_SESSION['senha'] = $pac->getSenha();
                  setcookie('paciente', 'verdade', time()+ 300,'/');
                  setcookie('paciente_cpf', $pac->getCPF(), time()+ 300,'/');
                  echo "<script>window.location.href='../paciente.php';</script>";
                  break;
              }
          }
          setcookie('invalido', 'verdade', time()+ 300,'/');
          echo "<script>window.location.href='../index.php';</script>";
          break;
    }
  } else {
    echo "<script>window.location.href='../index.php';</script>";
  }
}

?>
