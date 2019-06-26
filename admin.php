<?php
include 'index-include/sidenav_admin.php';
require_once 'config/segurancaAdmin.php';
?>
<!-- Tags em aberto: <html>, <body>, <div class="d-flex" id="wrapper">, <div id="page-content-wrapper"> -->




<div class="container-fluid" style="padding: 30px 20px;">

<div id="pacientes">
    <!-- botao de adicionar e input de busca -->
    <div class="row" >
        <div class="col-sm"><button class="btn btn-dark" data-toggle="modal" data-target=".bd-example-modal-md"><i class="fas fa-user-plus"></i></button></div>
        <!-- Modal de adicionar paciente -->
        <div class="modal fade bd-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content p-3">

                    <form id="form_adicionarPaciente" method="post" action="ajax/admin_adicionarPaciente.php">
                        <!-- input para enviar crm do médico a cadastrar a consulta -->

                        <div class="form-row">
                            <div class="form-group col-md">
                            <label for="inputNomePaciente">Nome do Paciente</label>
                            <input type="text" class="form-control" name="inputNomePaciente" id="inputNomePaciente" placeholder="" value="" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                            <label for="inputEnderecoPaciente">Endereço</label>
                            <input type="text" class="form-control" name="inputEnderecoPaciente" id="inputEnderecoPaciente" placeholder="" value="" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                            <label for="inputTelefonePaciente">Telefone</label>
                            <input type="tel" class="form-control" name="inputTelefonePaciente" id="inputTelefonePaciente" placeholder="" value="" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                            <label for="inputEmailPaciente">E-Mail</label>
                            <input type="email" class="form-control" name="inputEmailPaciente" id="inputEmailPaciente" placeholder="" value="" required>
                            </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md">
                            <label for="inputGenderPaciente">Gênero</label>
                            <select  name="inputGenderPaciente" id="inputGenderPaciente" class="form-control" required>
                                <option name="inputGenderPaciente" value="Feminino">Feminino</option>
                                <option name="inputGenderPaciente" value="Masculino">Masculino</option>
                                <option name="inputGenderPaciente" value="Outro">Outro</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md">
                            <label for="inputAgePaciente">Idade</label>
                            <input type="number" class="form-control" name="inputAgePaciente" id="inputAgePaciente" value="" placeholder="" required>
                          </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                            <label for="inputCpfPaciente">CPF do Paciente</label>
                            <input type="text" class="form-control" name="inputCpfPaciente" id="inputCpfPaciente" placeholder="" value="" required>
                            <label id="validarCPF" style="display: none; color: red;">CPF inválido ou já cadastrado!</label>
                            </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md">
                            <label for="inputPasswordPaciente">Senha</label>
                            <input type="password" class="form-control" name="inputPasswordPaciente" id="inputPasswordPaciente" value="" placeholder="" required>
                          </div>
                        </div>


                        <div class="col-12 text-center"><button type="submit" id="admin_adicionarPaciente" name="admin_adicionarPaciente" class="btn btn-dark">Salvar</button></div>
                    </form>



                </div>
            </div>
        </div>

        <div class="row col-sm" style="padding: 0;">
            <input type="text" class=" col-10" name="inputPesquisaPaciente" id="inputPesquisaPaciente">
            <button id="admin_procurarPaciente" name="admin_procurarPaciente" class=" btn btn-dark col-1.5"><i class="fas fa-search"></i></button>
        </div>
    </div>

    <!-- tabela -->
    <div>
        <table class="table table-hover table-bordered table-striped table-dark text-center">
        <thead>
            <tr>
            <th scope="col">PACIENTE</th>
            <th scope="col">ENDEREÇO</th>
            <th scope="col">TELEFONE</th>
            <th scope="col">E-MAIL</th>
            <th scope="col">GÊNERO</th>
            <th scope="col">IDADE</th>
            <th scope="col">CPF</th>
            <th scope="col" style="color: #c2c3c5;">TOTAL</th>
            </tr>
        </thead>
        <tbody id="mostraPacientes">
        <?php
            # função que vai retornar rows em formato html contendo as CONSULTAS realizadas pelo medico atual (depende do crm)
            $universal->mostrarPacientes();
        ?>

        </tbody>
        </table>
    </div>
</div>


<div id="medicos">
    <!-- botao de adicionar e input de busca -->
    <div class="row" >
        <div class="col-sm"><button class="btn btn-dark" data-toggle="modal" data-target="#modalMedico"><i class="fas fa-user-plus"></i></button></div>
        <!-- Modal de adicionar medico -->
        <div class="modal fade bd-example-modal-md" id="modalMedico" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content p-3">

                    <form id="form_adicionarMedico" method="post" action="ajax/admin_adicionarMedico.php">
                        <!-- input para enviar crm do médico a cadastrar a consulta -->

                        <div class="form-row">
                            <div class="form-group col-md">
                            <label for="inputNomeMedico">Nome do Médico</label>
                            <input type="text" class="form-control" name="inputNomeMedico" id="inputNomeMedico" placeholder="" value="" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                            <label for="inputEnderecoMedico">Endereço</label>
                            <input type="text" class="form-control" name="inputEnderecoMedico" id="inputEnderecoMedico" placeholder="" value="" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                            <label for="inputTelefoneMedico">Telefone</label>
                            <input type="tel" class="form-control" name="inputTelefoneMedico" id="inputTelefoneMedico" placeholder="" value="" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                            <label for="inputEmailMedico">E-Mail</label>
                            <input type="email" class="form-control" name="inputEmailMedico" id="inputEmailMedico" placeholder="" value="" required>
                            </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md">
                            <label for="inputGenderMedico">Gênero</label>
                            <select  name="inputGenderMedico" id="inputGenderMedico" class="form-control" required>
                                <option name="inputGenderMedico" value="Feminino">Feminino</option>
                                <option name="inputGenderMedico" value="Masculino">Masculino</option>
                                <option name="inputGenderMedico" value="Outro">Outro</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                            <label for="inputCrmMedico">CRM do Médico</label>
                            <input type="text" class="form-control" name="inputCrmMedico" id="inputCrmMedico" placeholder="" value="" required>
                            <label id="validarCRM" style="display: none; color: red;">CRM inválido ou já cadastrado!</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                            <label for="inputEspecialidade">Especialidade</label>
                            <input type="text" class="form-control" name="inputEspecialidade" id="inputEspecialidade" placeholder="" value="" required>
                            </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md">
                            <label for="inputPasswordMedico">Senha</label>
                            <input type="password" class="form-control" name="inputPasswordMedico" id="inputPasswordMedico" value="" placeholder="" required>
                          </div>
                        </div>


                        <div class="col-12 text-center"><button type="submit" id="admin_adicionarMedico" name="admin_adicionarMedico" class="btn btn-dark">Salvar</button></div>
                    </form>

                </div>
            </div>
        </div>

        <div class="row col-sm" style="padding: 0;">
            <input type="text" class=" col-10" name="inputPesquisaMedico" id="inputPesquisaMedico">
            <button id="admin_procurarMedico" name="admin_procurarMedico" class=" btn btn-dark col-1.5"><i class="fas fa-search"></i></button>
        </div>
    </div>

    <!-- tabela -->
    <div>
        <table class="table table-hover table-bordered table-striped table-dark text-center">
        <thead>
            <tr>
            <th scope="col">MÉDICO</th>
            <th scope="col">ENDEREÇO</th>
            <th scope="col">TELEFONE</th>
            <th scope="col">E-MAIL</th>
            <th scope="col">GÊNERO</th>
            <th scope="col">ESPECIALIDADE</th>
            <th scope="col">CRM</th>
            <th scope="col" style="color: #c2c3c5;">TOTAL</th>
            </tr>
        </thead>
        <tbody id="mostraMedicos">
        <?php
            # função que vai retornar rows em formato html contendo as CONSULTAS realizadas pelo medico atual (depende do crm)
            $universal->mostrarMedicos();
        ?>

        </tbody>
        </table>
    </div>
</div>

<div id="laboratorios">
    <!-- botao de adicionar e input de busca -->
    <div class="row" >
        <div class="col-sm"><button class="btn btn-dark" data-toggle="modal" data-target="#modalLab"><i class="fas fa-user-plus"></i></button></div>
        <!-- Modal de adicionar medico -->
        <div class="modal fade bd-example-modal-md" id="modalLab" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content p-3">

                    <form id="form_adicionarLaboratorio" method="post" action="ajax/admin_adicionarLaboratorio.php">
                        <!-- input para enviar crm do médico a cadastrar a consulta -->

                        <div class="form-row">
                            <div class="form-group col-md">
                            <label for="inputNomeLaboratorio">Nome do Laboratório</label>
                            <input type="text" class="form-control" name="inputNomeLaboratorio" id="inputNomeLaboratorio" placeholder="" value="" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                            <label for="inputEnderecoLaboratorio">Endereço</label>
                            <input type="text" class="form-control" name="inputEnderecoLaboratorio" id="inputEnderecoLaboratorio" placeholder="" value="" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                            <label for="inputTelefoneLaboratorio">Telefone</label>
                            <input type="tel" class="form-control" name="inputTelefoneLaboratorio" id="inputTelefoneLaboratorio" placeholder="" value="" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                            <label for="inputEmailLaboratorio">E-Mail</label>
                            <input type="email" class="form-control" name="inputEmailLaboratorio" id="inputEmailLaboratorio" placeholder="" value="" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                            <label for="inputCnpjLaboratorio">CNPJ do Laboratório</label>
                            <input type="text" class="form-control" name="inputCnpjLaboratorio" id="inputCnpjLaboratorio" placeholder="" value="" required>
                            <label id="validarCNPJ" style="display: none; color: red;">CNPJ inválido ou já cadastrado!</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                            <label for="inputTiposExames">Tipos de Exame</label>
                            <input type="text" class="form-control" name="inputTiposExames" id="inputTiposExames" placeholder="" value="" required>
                            </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md">
                            <label for="inputPasswordLaboratorio">Senha</label>
                            <input type="password" class="form-control" name="inputPasswordLaboratorio" id="inputPasswordLaboratorio" value="" placeholder="" required>
                          </div>
                        </div>


                        <div class="col-12 text-center"><button type="submit" id="admin_adicionarLaboratorio" name="admin_adicionarLaboratorio" class="btn btn-dark">Salvar</button></div>
                    </form>

                </div>
            </div>
        </div>

        <div class="row col-sm" style="padding: 0;">
            <input type="text" class=" col-10" name="inputPesquisaLaboratorio" id="inputPesquisaLaboratorio">
            <button id="admin_procurarLaboratorio" name="admin_procurarLaboratorio" class=" btn btn-dark col-1.5"><i class="fas fa-search"></i></button>
        </div>
    </div>

    <!-- tabela -->
    <div>
        <table class="table table-hover table-bordered table-striped table-dark text-center">
        <thead>
            <tr>
            <th scope="col">LABORATÓRIO</th>
            <th scope="col">ENDEREÇO</th>
            <th scope="col">TELEFONE</th>
            <th scope="col">E-MAIL</th>
            <th scope="col">TIPOS DE EXAME</th>
            <th scope="col">CNPJ</th>
            <th scope="col" style="color: #c2c3c5;">TOTAL</th>
            </tr>
        </thead>
        <tbody id="mostraLaboratorios">
        <?php
            # função que vai retornar rows em formato html contendo as CONSULTAS realizadas pelo medico atual (depende do crm)
            $universal->mostrarLaboratorios();
        ?>

        </tbody>
        </table>
    </div>
</div>

</div>

</div> <!-- / id="page-content-wrapper" | todo o conteúdo deve ficar aqui dentro -->
</div> <!-- / class="d-flex" id="wrapper" -->
  <!-- Javascript/Jquery functions for Bootstrap internal use -->
  <?php include 'js/scripts_include.html'; ?>
  <!-- chama arquivo de funções js -->
  <script src="js/admin.js"></script>
  <script src="js/sidebar.js"></script>

        </body>
