<?php include 'index-include/sidenav.php'; ?>
<!-- Tags em aberto: <html>, <body>, <div class="d-flex" id="wrapper">, <div id="page-content-wrapper"> -->

<div class="container">
  
  <!-- LOGIN PACIENTE -->
  <div class="row" id="paciente-login">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
      <div class="card card-signin my-5">
        <div class="card-body">
          <h5 class="card-title text-center">Paciente</h5>
          <form class="form-signin">
            <div class="form-label-group">
              
              <label for="inputCpf">Digite seu CPF</label>
              <input type="" id="inputCpf" class="form-control" placeholder="Ex: 123456789-00" required autofocus>
            </div>

            <div class="form-label-group">
              <label for="inputPassword">Digite sua senha</label>
              <input type="password" id="inputPassword" class="form-control" placeholder="Senha" required>
            </div>
            
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
          <form class="form-signin">
            <div class="form-label-group">
              
              <label for="inputCrm">Digite seu CRM</label>
              <input type="" id="inputCrm" class="form-control" placeholder="Ex: procurar padrao CRM" required autofocus>
            </div>

            <div class="form-label-group">
              <label for="inputPassword">Digite sua senha</label>
              <input type="password" id="inputPassword" class="form-control" placeholder="Senha" required>
            </div>
            
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
          <form class="form-signin">
            <div class="form-label-group">
              
              <label for="inputCnpj">Digite seu CNPJ</label>
              <input type="" id="inputCnpj" class="form-control" placeholder="Ex: procurar padrão CNPJ" required autofocus>
            </div>

            <div class="form-label-group">
              <label for="inputPassword">Digite sua senha</label>
              <input type="password" id="inputPassword" class="form-control" placeholder="Senha" required>
            </div>
            
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
          <form class="form-signin">
            <div class="form-label-group">
              
              <label for="inputLogin">Digite seu login</label>
              <input type="email" id="inputLogin" class="form-control" placeholder="Ex: admin" required autofocus>
            </div>

            <div class="form-label-group">
              <label for="inputPassword">Digite sua senha</label>
              <input type="password" id="inputPassword" class="form-control" placeholder="Senha" required>
            </div>
            
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
  <?php include 'js/scripts_include.php'; ?>
  <!-- chama arquivo de funções js -->
  <script src="js/index.js"></script>  
  <script src="js/sidebar.js"></script>       

        </body>