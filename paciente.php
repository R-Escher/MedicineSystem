<?php
error_reporting(E_ERROR | E_PARSE);
include 'index-include/sidenav_paciente.php';
require_once 'config/segurancaPaciente.php';
?>
<!-- Tags em aberto: <html>, <body>, <div class="d-flex" id="wrapper">, <div id="page-content-wrapper"> -->

<div class="container-fluid" style="padding: 30px 20px;">

<div id="consultas">
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
            # função que vai retornar rows em formato html contendo as CONSULTAS realizadas pelo paciente atual (depende do cpf)
            $universal->mostrarConsultas($cpf, "paciente");
        ?>

        </tbody>
        </table>
    </div>
</div>

<div id="exames">
    <!-- tabela -->
    <div>
        <table class="table table-hover table-bordered table-striped table-dark text-center">
        <thead>
            <tr>
            <th scope="col">DATA</th>
            <th scope="col">LABORATÓRIO</th>
            <th scope="col">TELEFONE</th>
            <th scope="col">EXAMES</th>
            <th scope="col">RESULTADO</th>
            </tr>
        </thead>
        <tbody>
        <?php
            # função que vai retornar rows em formato html contendo as CONSULTAS realizadas pelo medico atual (depende do cpf)
            $universal->mostrarExames($cpf, "paciente");
        ?>

        </tbody>
        </table>
    </div>
</div>

<div id="meuperfil">

    <!-- Usa funcao buscaPaciente para disponibilizar os dados do paciente nos campos input -->
    <?php $paciente = $paciente->buscapaciente($cpf);?>

    <form id="form_meuperfil" method="post" action="ajax/paciente_meuperfil.php">

        <div class="form-row">
            <!-- input para enviar cpf do paciente a alterar dados pessoais -->
            <input type="text" class="form-control d-none" name="inputCpf" id="inputCpf" value="<?php echo $cpf ?>">

            <div class="form-group col-md-6">
            <label for="inputName">Nome</label>
            <input type="text" class="form-control" name="inputName" id="inputName" value="<?php echo $paciente->getNome()?>" required>
            </div>
            <div class="form-group col-md-6">
            <label for="inputAddress">Endereço</label>
            <input type="text" class="form-control" name="inputAddress" id="inputAddress" value="<?php echo $paciente->getEndereco()?>" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="inputTel">Telefone</label>
            <input type="tel" class="form-control" name="inputTel" id="inputTel" value="<?php echo $paciente->getTelefone()?>" required>
            </div>
            <div class="form-group col-md-6">
            <label for="inputEmail">E-mail</label>
            <input type="email" class="form-control" name="inputEmail" id="inputEmail" value="<?php echo $paciente->getEmail()?>" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md">
                <label for="inputAge">Idade</label>
                <input type="number" class="form-control" name="inputAge" id="inputAge" value="<?php echo $paciente->getIdade()?>" placeholder="" required>
            </div>
            <div class="form-group col-md-6">
                <label for="inputGender">Gênero</label>
                <select name="inputGender" id="inputGender" class="form-control" required>
                    <option name="inputGender" value="Feminino" <?php if($paciente->getGenero()=='Feminino'){ echo 'selected'; } ?> >Feminino</option>
                    <option name="inputGender" value="Masculino" <?php if($paciente->getGenero()=='Masculino'){ echo 'selected'; } ?> > Masculino</option>
                    <option name="inputGender" value="Outro" <?php if($paciente->getGenero()=='Outro'){ echo 'selected'; } ?> >Outro</option>
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
    <input type="submit" value="Alterar Dados" name="paciente_meuperfil"  class="btn btn-dark col-4"><!--<button type="submit" id="paciente_meuperfil_submit" class="btn btn-dark col-4">Alterar Dados</button>-->
        </div>
    </form>
</div>




</div>








</div> <!-- / id="page-content-wrapper" | todo o conteúdo deve ficar aqui dentro -->
</div> <!-- / class="d-flex" id="wrapper" -->
  <!-- Javascript/Jquery functions for Bootstrap internal use -->
  <?php include 'js/scripts_include.html'; ?>
  <!-- chama arquivo de funções js -->
  <script src="js/paciente.js"></script>
  <script src="js/sidebar.js"></script>

        </body>
