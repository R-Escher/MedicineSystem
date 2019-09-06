<!doctype html>
<html lang="pt-BR">
  <?php 
    include_once 'head.php';
    $medico = new Medico;
    $crm = $_COOKIE['medico_crm'];
  ?>
    <body>

        <div class="d-flex" id="wrapper">

            <!-- Sidebar -->
            <div class="bg-dark" id="sidebar-wrapper">
                <div class="sidebar-heading" style="background-color: #1a1d20; color: #eaebeb;">Médico</div>
                <div class="list-group list-group-flush" >
                    <a href="#" class="list-group-item list-group-item-action bg-dark" id="consultas-toggle" style="color: #c2c3c5">Consultas</a>
                    <a href="#" class="list-group-item list-group-item-action bg-dark" id="meuperfil-toggle" style="color: #c2c3c5">Meu Perfil</a>
                    <a href="config/logout.php" class="list-group-item list-group-item-action bg-dark" id="sair-toggle" style="color: #c2c3c5">Sair</a>
                </div>
            </div>
            <!-- /#sidebar-wrapper -->

            <!-- Page Content -->
            <div id="page-content-wrapper">

                <!-- navbar superior -->
                <nav class="navbar navbar-expand-lg navbar-light border-bottom" style="background-color: #1a1d20; color: #eaebeb; padding: 7.2px 16px; ">
                    <button class="btn btn-dark" id="menu-toggle" style="padding: 3px 9px; "><i class="fas fa-bars fa-2x"></i></button>

                    <div class="collapse navbar-collapse pl-3" id="navbarSupportedContent">
                    <img src="archive/medicineSystem.png"title="Medicine System"/>
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" style="color: #c2c3c5; font-size: 18px;" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php
                                $medico = $medico->buscaMedico($crm, "medico");
                                echo "Dr. ".$medico->getNome();
                            ?>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <?php $numeroConsultas = $universal->contaConsultas($crm, "medico"); ?>
                            <label class="dropdown-item">Total de Consultas:
                                <?php echo $numeroConsultas[0]; ?>
                            </label>
                            <div class="dropdown-divider"></div>
                            <label class="dropdown-item">Consultas este mês:
                                <?php echo $numeroConsultas[1]; ?>
                            </label>
                            <div class="dropdown-divider"></div>
                            <label class="dropdown-item">Consultas hoje:
                                <?php echo $numeroConsultas[2]; ?>
                            </label>
                            </div>
                        </li>



                    </ul>
                    </div>
                </nav>
