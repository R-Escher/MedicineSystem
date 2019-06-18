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
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>        
  <!-- chama arquivo de funções js 
  <script src="js/index.js"></script> -->     
  <script src="js/sidebar.js"></script>  

        </body>