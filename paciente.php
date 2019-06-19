<?php include 'index-include/sidenav_paciente.php'; ?>
<!-- Tags em aberto: <html>, <body>, <div class="d-flex" id="wrapper">, <div id="page-content-wrapper"> -->

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

            # apagar depois
            $cpf = "036.225.895-12";
            # função que vai retornar rows em formato html contendo as CONSULTAS realizadas pelo medico atual (depende do crm)
            $universal->mostrarConsultas($cpf, "paciente");
            



        ?>
        
        </tbody>
        </table>
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