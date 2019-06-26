<?php
error_reporting(E_ERROR | E_PARSE);
include 'index-include/sidenav.php';
require_once 'config/segurancaIndex.php';
?>
<!-- Tags em aberto: <html>, <body>, <div class="d-flex" id="wrapper">, <div id="page-content-wrapper"> -->

<div class="container">
  <?php
  if (isset($_COOKIE)) {
    if ($_COOKIE['invalido'] == 'verdade') {
      echo '<div class="row"><div class="col-sm-9 col-md-7 col-lg-5 mx-auto">';
      echo '<br><div class="alert alert-danger" style="height:80%" role="alert">';
      echo '<h4 align="center" style="padding-top: 15px;">Usuário Inválido - Tente Novamente</h4>';
      echo '</div></div></div>';
    }
  }
  ?>

  <!-- LOGIN PACIENTE -->
  <div class="row" id="paciente-login">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
      <div class="card card-signin my-5">
        <div class="card-body">
          <h5 class="card-title text-center">Paciente</h5>
          <form class="form-signin" action="config/sessao.php" method="post">
            <div class="form-label-group">

              <label for="inputCpf">Digite seu CPF</label>
              <input name="usuario" type="" id="inputCpf" class="form-control" placeholder="Ex: 123456789-00" required autofocus>
            </div>

            <div class="form-label-group">
              <label for="inputPassword">Digite sua senha</label>
              <input name="senha" type="password" id="inputPassword" class="form-control" placeholder="Senha" required>
            </div>
            <input type="hidden" name="sessao" value="paciente">

            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Entrar</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- LOGIN MEDICO -->
  <div class="row" id="medico-login">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
      <div class="card card-signin my-5">
        <div class="card-body">
          <h5 class="card-title text-center">Médico</h5>
          <form class="form-signin" action="config/sessao.php" method="post">
            <div class="form-label-group">

              <label for="inputCrm">Digite seu CRM</label>
              <input name="usuario" type="" id="inputCrm" class="form-control" placeholder="Ex: procurar padrao CRM" required autofocus>
            </div>

            <div class="form-label-group">
              <label for="inputPassword">Digite sua senha</label>
              <input name="senha" type="password" id="inputPassword" class="form-control" placeholder="Senha" required>
            </div>
            <input type="hidden" name="sessao" value="medico">

            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Entrar</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- LOGIN LABORATORIO -->
  <div class="row" id="laboratorio-login">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
      <div class="card card-signin my-5">
        <div class="card-body">
          <h5 class="card-title text-center">Laboratório</h5>
          <form class="form-signin" action="config/sessao.php" method="post">
            <div class="form-label-group">

              <label for="inputCnpj">Digite seu CNPJ</label>
              <input name="usuario" type="" id="inputCnpj" class="form-control" placeholder="Ex: procurar padrão CNPJ" required autofocus>
            </div>

            <div class="form-label-group">
              <label for="inputPassword">Digite sua senha</label>
              <input name="senha" type="password" id="inputPassword" class="form-control" placeholder="Senha" required>
            </div>
            <input type="hidden" name="sessao" value="laboratorio">

            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Entrar</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- LOGIN ADMIN -->
  <div class="row" id="admin-login">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
      <div class="card card-signin my-5">
        <div class="card-body">
          <h5 class="card-title text-center">Administração</h5>
          <form class="form-signin" action="config/sessao.php" method="post">
            <div class="form-label-group">

              <label for="inputLogin">Digite seu login</label>
              <input name="usuario" type="" id="inputLogin" class="form-control" placeholder="Ex: admin" required autofocus>
            </div>

            <div class="form-label-group">
              <label for="inputPassword">Digite sua senha</label>
              <input name="senha" type="password" id="inputPassword" class="form-control" placeholder="Senha" required>
            </div>
            <input type="hidden" name="sessao" value="admin">
            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Entrar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
















</div>















</div> <!-- / id="page-content-wrapper" | todo o conteúdo deve ficar aqui dentro -->
</div> <!-- / class="d-flex" id="wrapper" -->
  <!-- Javascript/Jquery functions for Bootstrap internal use -->
  <?php include 'js/scripts_include.html'; ?>
  <!-- chama arquivo de funções js -->
  <script src="js/index.js"></script>
  <script src="js/sidebar.js"></script>

        </body>
