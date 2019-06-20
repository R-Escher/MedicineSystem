<?php include 'index-include/sidenav_paciente.php'; ?>
<!-- Tags em aberto: <html>, <body>, <div class="d-flex" id="wrapper">, <div id="page-content-wrapper"> -->

<?php 
            $paciente = new Paciente;
            # apagar depois
            $cpf = "036.225.895-12";
?>

<div class="container-fluid" style="padding: 30px 20px;">

    <!-- tabela -->
    <div>
        <table class="table table-hover table-bordered table-striped table-dark text-center">
        <thead>
            <tr>
            <th scope="col">DATA</th>
            <th scope="col">MÉDICO</th>
            <th scope="col">TELEFONE</th>
            <th scope="col">REQUISIÇÃO DE EXAME</th>
            <th scope="col">RECEITA</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            # função que vai retornar rows em formato html contendo as CONSULTAS realizadas pelo medico atual (depende do cpf)
            $universal->mostrarConsultas($cpf, "paciente");
        ?>
        
        </tbody>
        </table>
    </div>

<div id="meuperfil">

    <!-- Usa funcao buscaMedico para disponibilizar os dados do medico nos campos input -->
    <?php $paciente = $paciente->buscapaciente($cpf);?>

    <form id="form_meuperfil" method="post" action="ajax/paciente_meuperfil.php">

        <div class="form-row">
            <!-- input para enviar cpf do paciente a alterar dados pessoais -->
            <input type="text" class="form-control d-none" name="inputCpf" id="inputCpf" value="<?php echo $cpf ?>">

            <div class="form-group col-md-6">
            <label for="inputName">Nome</label>
            <input type="text" class="form-control" name="inputName" id="inputName" value="<?php echo $medico->getNome()?>" required>
            </div>
            <div class="form-group col-md-6">
            <label for="inputAddress">Endereço</label>
            <input type="text" class="form-control" name="inputAddress" id="inputAddress" value="<?php echo $medico->getEndereco()?>" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="inputTel">Telefone</label>
            <input type="tel" class="form-control" name="inputTel" id="inputTel" value="<?php echo $medico->getTelefone()?>" required>
            </div>
            <div class="form-group col-md-6">
            <label for="inputEmail">E-mail</label>
            <input type="email" class="form-control" name="inputEmail" id="inputEmail" value="<?php echo $medico->getEmail()?>" required>
            </div>
        </div>     
        <div class="form-row">
            <div class="form-group col-md">
                <label for="inputAge">Idade</label>
                <input type="number" class="form-control" name="inputAge" id="inputAge" placeholder="" required>
            </div>          
            <div class="form-group col-md-6">
                <label for="inputGender">Gênero</label>
                <select name="inputGender" id="inputGender" class="form-control">
                    <option name="inputGender" value="Feminino" <?php if($medico->getGenero()=='Feminino'){ echo 'selected'; } ?> >Feminino</option>
                    <option name="inputGender" value="Masculino" <?php if($medico->getGenero()=='Masculino'){ echo 'selected'; } ?> > Masculino</option>
                    <option name="inputGender" value="Outro" <?php if($medico->getGenero()=='Outro'){ echo 'selected'; } ?> >Outro</option>
                </select>
            </div>
        </div> 
        <div class="form-row">
        <div class="form-group col-md-6">
            <label for="showCpf">CPF</label>
            <input type="text" class="form-control" name="showCpf" id="showCpf" value="<?php echo $cpf ?>" disabled>
        </div>        
        <div class="form-group col-md-6">
            <label for="inputPassword">Senha</label>
            <input type="password" class="form-control" name="inputPassword" id="inputPassword" value="" required>
        </div>
        </div>                     

        <div class="col-12 text-center">
    <input type="submit" value="Alterar Dados" name="medico_meuperfil"  class="btn btn-dark col-4"><!--<button type="submit" id="medico_meuperfil_submit" class="btn btn-dark col-4">Alterar Dados</button>-->
        </div>
    </form>
</div>




</div>








</div> <!-- / id="page-content-wrapper" | todo o conteúdo deve ficar aqui dentro -->
</div> <!-- / class="d-flex" id="wrapper" -->
  <!-- Javascript/Jquery functions for Bootstrap internal use -->
  <?php include 'js/scripts_include.html'; ?>
  <!-- chama arquivo de funções js 
  <script src="js/index.js"></script> -->     
  <script src="js/sidebar.js"></script>  

        </body>