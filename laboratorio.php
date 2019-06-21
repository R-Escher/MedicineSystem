<?php include 'index-include/sidenav_laboratorio.php'; ?>
<!-- Tags em aberto: <html>, <body>, <div class="d-flex" id="wrapper">, <div id="page-content-wrapper"> -->
<?php
    $lab = new Laboratorio;
    # apagar depois
    $cnpj = "3057439-9"; 
?>

<div class="container-fluid" style="padding: 30px 20px;">

<div id="exames">
    <!-- botao de adicionar e input de busca -->
    <div class="row" >
        <div class="col-sm"><button class="btn btn-dark" data-toggle="modal" data-target=".bd-example-modal-md"><i class="fas fa-user-plus"></i></button></div>
        <!-- Modal de adicionar exame -->
        <div class="modal fade bd-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content p-3">
                    <form id="form_adicionarExame" method="post" action="ajax/laboratorio_adicionarExame.php">
                        <!-- input para enviar cnpj do Lab a cadastrar a exame -->
                        <input type="text" class="form-control d-none" name="inputCnpj" id="inputCnpj" value="<?php echo $cnpj ?>">

                        <div class="form-row">
                            <div class="form-group col-md">
                            <label for="inputCpf">CPF do Paciente</label>
                            <input type="text" class="form-control" name="inputCpf" id="inputCpf" placeholder="" value="" required>
                            <label id="validarCPF" style="display: none; color: red;">CPF não cadastrado!</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                            <label for="inputDate">Data do Exame</label>
                            <input type="date" min="2000-01-01" max="<?php date_default_timezone_set('America/Sao_Paulo'); echo date('Y-m-d'); ?>" class="form-control" name="inputDate" id="inputDate" placeholder="" required>
                            </div>
                        </div>  
                        <div class="form-row">
                            <div class="form-group col-md">
                            <label for="inputExames">Exames</label>
                            <input type="text" class="form-control" name="inputExames" id="inputExames" placeholder="">
                            </div>
                        </div>           
                        <div class="form-row">
                            <div class="form-group col-md">
                            <label for="inputResultado">Resultado</label>
                            <input type="text" class="form-control" name="inputResultado" id="inputResultado" placeholder="">
                            </div>
                        </div>                                                                                                                                                            

                        <div class="col-12 text-center"><button type="submit" id="lab_adicionarExame" name="lab_adicionarExame" class="btn btn-dark" disabled>Salvar</button></div>
                    </form>                
                
                
                
                </div>
            </div>
        </div>

        <div class="row col-sm" style="padding: 0;">
            <input type="text" class="form-control col-10"  name="inputPesquisa" id="inputPesquisa">
            <button id="lab_procurarExame" name="lab_procurarExame" class="btn btn-dark col-1.5"><i class="fas fa-search"></i></button>
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
            <th scope="col">EXAMES</th>
            <th scope="col">RESULTADO</th>
            </tr>
        </thead>
        <tbody id="mostraExames">
        <?php 

            # função que vai retornar rows em formato html contendo os EXAMES realizadas pelo lab atual (depende do cnpj)
            $universal->mostrarExames($cnpj, "laboratorio");

        ?>

        </tbody>
        </table>
    </div>
</div>    

<div id="meuperfil">

    <!-- Usa funcao buscaLab para disponibilizar os dados do lab nos campos input -->
    <?php $lab = $lab->buscaLaboratorio($cnpj);?>

    <form id="form_meuperfil" method="post" action="ajax/laboratorio_meuperfil.php">
    
        <!-- este é para enviar o cnpj do lab, necessário para edição do mesmo-->
        <input type="text" class="form-control d-none" name="inputCnpj" id="inputCnpj" value="<?php echo $cnpj ?>"> 

        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="inputName">Nome</label>
            <input type="text" class="form-control" name="inputName" id="inputName" value="<?php echo $lab->getNome()?>" required>
            </div>
            <div class="form-group col-md-6">
            <label for="inputAddress">Endereço</label>
            <input type="text" class="form-control" name="inputAddress" id="inputAddress" value="<?php echo $lab->getEndereco()?>" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="inputTel">Telefone</label>
            <input type="tel" class="form-control" name="inputTel" id="inputTel" value="<?php echo $lab->getTelefone()?>" required>
            </div>
            <div class="form-group col-md-6">
            <label for="inputEmail">E-mail</label>
            <input type="email" class="form-control" name="inputEmail" id="inputEmail" value="<?php echo $lab->getEmail()?>" required>
            </div>
        </div>     
        <div class="form-row">
            <div class="form-group col-md">
            <label for="inputExames">Tipos de Exames</label>
            <textarea rows = "4" cols = "60" class="form-control" name="inputExames" id="inputExames" required><?php echo $lab->getTipos_exames()?></textarea>
            </div>
        </div>         
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="showCnpj">CNPJ</label>
            <input type="text" class="form-control" name="showCnpj" id="showCnpj" value="<?php echo $cnpj ?>" disabled>
            </div>        
            <div class="form-group col-md-6">
            <label for="inputPassword">Senha</label>
            <input type="password" class="form-control" name="inputPassword" id="inputPassword" value="" required>
            </div>
        </div>                     

        <div class="col-12 text-center">
    <input type="submit" value="Alterar Dados" name="laboratorio_meuperfil"  class="btn btn-dark col-4">
        </div>
    </form>
</div>





</div>







</div> <!-- / id="page-content-wrapper" | todo o conteúdo deve ficar aqui dentro -->
</div> <!-- / class="d-flex" id="wrapper" -->
  <!-- Javascript/Jquery functions for Bootstrap internal use -->
  <?php include 'js/scripts_include.html'; ?>
  <!-- chama arquivo de funções js -->
  <script src="js/laboratorio.js"></script>      
  <script src="js/sidebar.js"></script>  

        </body>