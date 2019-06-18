<?php include 'index-include/sidenav_medico.php'; ?>
<!-- Tags em aberto: <html>, <body>, <div class="d-flex" id="wrapper">, <div id="page-content-wrapper"> -->


<div class="container-fluid" style="padding: 30px 20px;">

<div id="consultas">
    <!-- botao de adicionar e input de busca -->
    <div class="row" >
        <div class="col-sm"><button class="btn btn-dark"><i class="fas fa-user-plus"></i></button></div>
        <div class="row col-sm" style="padding: 0;">
            <input type="email" class="form-control col-10" name="" id="">
            <button class="btn btn-dark col-1.5"><i class="fas fa-search"></i></button>
        </div>
    </div>

    <!-- tabela -->
    <div>
        <table class="table table-hover table-bordered table-striped table-dark text-center">
        <thead>
            <tr>
            <th scope="col">PACIENTE</th>
            <th scope="col">DATA</th>
            <th scope="col">TELEFONE</th>
            <th scope="col">E-MAIL</th>
            <th scope="col">RECEITA</th>
            <th scope="col">REQUISIÇÃO DE EXAME</th>
            <th scope="col">OBSERVAÇÃO</th>
            </tr>
        </thead>
        <tbody>
        <?php 

            # apagar depois
            $crm = "4123-9";
            # função que vai retornar rows em formato html contendo as CONSULTAS realizadas pelo medico atual (depende do crm)
            $universal->mostrarConsultas($crm, "medico");
            



        ?>

        </tbody>
        </table>
    </div>
</div>    
<div id="meuperfil">
    <form>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="inputName">Nome</label>
            <input type="text" class="form-control" id="inputName" placeholder="">
            </div>
            <div class="form-group col-md-6">
            <label for="inputAddress">Endereço</label>
            <input type="text" class="form-control" id="inputAddress" placeholder="">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="inputTel">Telefone</label>
            <input type="tel" class="form-control" id="inputTel" placeholder="">
            </div>
            <div class="form-group col-md-6">
            <label for="inputEmail">E-mail</label>
            <input type="email" class="form-control" id="inputEmail" placeholder="">
            </div>
        </div>     
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="inputBirth">Data de Nascimento</label>
            <input type="date" class="form-control" id="inputBirth" placeholder="">
            </div>
            <div class="form-group col-md-6">
            <label for="inputGender">Gênero</label>
            <select id="inputGender" class="form-control">
                <option>Masculino</option>
                <option>Feminino</option>
                <option>Outro</option>
            </select>
            </div>
        </div> 
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="inputCrm">CRM</label>
            <input type="text" class="form-control" id="inputCrm" placeholder="" disabled>
            </div>
            <div class="form-group col-md-6">
            <label for="inputPassword">Senha</label>
            <input type="password" class="form-control" id="inputPassword" placeholder="">
            </div>
        </div>                     

        <button type="submit" class="btn btn-dark">Salvar</button>
    </form>
</div>





</div>







</div> <!-- / id="page-content-wrapper" | todo o conteúdo deve ficar aqui dentro -->
</div> <!-- / class="d-flex" id="wrapper" -->
  <!-- Javascript/Jquery functions for Bootstrap internal use -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>        
  <!-- chama arquivo de funções js -->
  <script src="js/medico.js"></script>      
  <script src="js/sidebar.js"></script>  

        </body>