<?php include 'index-include/sidenav_medico.php'; ?>
<!-- Tags em aberto: <html>, <body>, <div class="d-flex" id="wrapper">, <div id="page-content-wrapper"> -->
<?php
    # apagar depois
    $crm = "4123-9"; 
?>

<div class="container-fluid" style="padding: 30px 20px;">

<div id="consultas">
    <!-- botao de adicionar e input de busca -->
    <div class="row" >
        <div class="col-sm"><button class="btn btn-dark" data-toggle="modal" data-target=".bd-example-modal-md"><i class="fas fa-user-plus"></i></button></div>
        <!-- Modal de adicionar consulta -->
        <div class="modal fade bd-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content p-3">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md">
                            <label for="inputCpf">CPF do Paciente</label>
                            <input type="number" class="form-control" id="inputCpf" placeholder="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                            <label for="inputDate">Data da Consulta</label>
                            <input type="date" class="form-control" id="inputDate" placeholder="">
                            </div>
                        </div>  
                        <div class="form-row">
                            <div class="form-group col-md">
                            <label for="inputReceita">Receita</label>
                            <input type="text" class="form-control" id="inputReceita" placeholder="">
                            </div>
                        </div> 
                        <div class="form-row">
                            <div class="form-group col-md">
                            <label for="inputRequisicao">Requisição de Exames</label>
                            <input type="text" class="form-control" id="inputRequisicao" placeholder="">
                            </div>
                        </div> 
                        <div class="form-row">
                            <div class="form-group col-md">
                            <label for="inputObervacao">Observação</label>
                            <input type="text" class="form-control" id="inputObervacao" placeholder="">
                            </div>
                        </div>                                                                                                                                             

                        <div class="col-12 text-center"><button type="submit" class="btn btn-dark">Salvar</button></div>
                    </form>                
                
                
                
                </div>
            </div>
        </div>

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

            # função que vai retornar rows em formato html contendo as CONSULTAS realizadas pelo medico atual (depende do crm)
            $universal->mostrarConsultas($crm, "medico");

        ?>

        </tbody>
        </table>
    </div>
</div>    

<div id="meuperfil">

    <!-- Usa funcao buscaMedico para disponibilizar os dados do medico nos campos input -->
    <?php $medico = $universal->medico->buscaMedico($crm);?>

    <form id="form_meuperfil" action="" method="post">
    
        <div class="form-row">
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
            <div class="form-group col-md-6">
            <label for="inputGender">Gênero</label>
            <select name="inputGender" id="inputGender" class="form-control">
                <option name="inputGender" value="Feminino" <?php if($medico->getGenero()=='Feminino'){ echo 'selected'; } ?> >Feminino</option>
                <option name="inputGender" value="Masculino" <?php if($medico->getGenero()=='Masculino'){ echo 'selected'; } ?> > Masculino</option>
                <option name="inputGender" value="Outro" <?php if($medico->getGenero()=='Outro'){ echo 'selected'; } ?> >Outro</option>
            </select>
            </div>
            <div class="form-group col-md-6">
            <label for="inputCrm">CRM</label>
            <input type="text" class="form-control" name="inputCrm" id="inputCrm" value="<?php echo $crm ?>" disabled>
            </div>            
        </div> 
        <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputEspecialidade">Especialidade</label>
            <input type="text" class="form-control" name="inputEspecialidade" id="inputEspecialidade" value="" required>
            </div>        
            <div class="form-group col-md-6">
            <label for="inputPassword">Senha</label>
            <input type="password" class="form-control" name="inputPassword" id="inputPassword" value="" required>
            </div>
        </div>                     

        <div class="col-12 text-center"><button type="submit" id="medico_meuperfil_submit" class="btn btn-dark col-4">Alterar Dados</button></div>
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