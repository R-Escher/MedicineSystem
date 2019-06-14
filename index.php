<?php include 'index-include/sidenav.php'; ?>
<!-- Tags em aberto: <html>, <body>, <div class="d-flex" id="wrapper">, <div id="page-content-wrapper"> -->

<div class="container">
  
  <!-- LOGIN PACIENTE -->
  <div class="row">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
      <div class="card card-signin my-5">
        <div class="card-body">
          <h5 class="card-title text-center">Paciente</h5>
          <form class="form-signin">
            <div class="form-label-group">
              <br>
              <label for="inputEmail">Digite seu CPF</label>
              <input type="email" id="inputEmail" class="form-control" placeholder="Ex: 123456789-00" required autofocus>
            </div>

            <div class="form-label-group">
              <label for="inputPassword">Digite sua senha</label>
              <input type="password" id="inputPassword" class="form-control" placeholder="Senha" required>
            </div>
            <br>
            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Entrar</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- LOGIN MEDICO -->
  <div class="row">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
      <div class="card card-signin my-5">
        <div class="card-body">
          <h5 class="card-title text-center">Médico</h5>
          <form class="form-signin">
            <div class="form-label-group">
              <br>
              <label for="inputEmail">Digite seu CRM</label>
              <input type="email" id="inputEmail" class="form-control" placeholder="Ex: procurar padrao CRM" required autofocus>
            </div>

            <div class="form-label-group">
              <label for="inputPassword">Digite sua senha</label>
              <input type="password" id="inputPassword" class="form-control" placeholder="Senha" required>
            </div>
            <br>
            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Entrar</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- LOGIN PACIENTE -->
  <div class="row">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
      <div class="card card-signin my-5">
        <div class="card-body">
          <h5 class="card-title text-center">Laboratório</h5>
          <form class="form-signin">
            <div class="form-label-group">
              <br>
              <label for="inputEmail">Digite seu CNPJ</label>
              <input type="email" id="inputEmail" class="form-control" placeholder="Ex: procurar padrão CNPJ" required autofocus>
            </div>

            <div class="form-label-group">
              <label for="inputPassword">Digite sua senha</label>
              <input type="password" id="inputPassword" class="form-control" placeholder="Senha" required>
            </div>
            <br>
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
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>        

  <!-- Menu Toggle Script--> 
  <script>
          $("#menu-toggle").click(function(e) {
          e.preventDefault();
          $("#wrapper").toggleClass("toggled");
          });
  </script>        
        </body>