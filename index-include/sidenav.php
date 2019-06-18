<!doctype html>
<html lang="pt-BR">
  <?php include_once 'head.php'; ?>
    <body>

        <div class="d-flex" id="wrapper">

            <!-- Sidebar -->
            <div class="bg-dark" id="sidebar-wrapper">
                <div class="sidebar-heading" style="background-color: #1a1d20; color: #eaebeb;">Medicine System</div>
                <div class="list-group list-group-flush" >
                <a href="#" class="list-group-item list-group-item-action bg-dark" id="paciente-toggle" style="color: #c2c3c5">Paciente</a>
                <a href="#" class="list-group-item list-group-item-action bg-dark" id="medico-toggle" style="color: #c2c3c5">Médico</a>
                <a href="#" class="list-group-item list-group-item-action bg-dark" id="laboratorio-toggle" style="color: #c2c3c5">Laboratório</a>
                <a href="#" class="list-group-item list-group-item-action bg-dark" id="admin-toggle" style="color: #c2c3c5">Administração</a>
                </div>
            </div>
            <!-- /#sidebar-wrapper -->

            <!-- Page Content -->
            <div id="page-content-wrapper">

                <!-- navbar superior -->
                <nav class="navbar navbar-expand-lg navbar-light border-bottom" style="background-color: #1a1d20; color: #eaebeb; padding: 7.2px 16px; ">
                    <button class="btn btn-dark" id="menu-toggle" style="padding: 3px 9px; "><i class="fas fa-bars fa-2x"></i></button>

                     <!--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>-->

                    <div class="collapse navbar-collapse pl-3" id="navbarSupportedContent">
                        <img src="archive/medicineSystem.png"title="Medicine System"/>
                        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link text-light" href="#">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#">Link</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>
                        </ul>
                    </div>
                </nav>
