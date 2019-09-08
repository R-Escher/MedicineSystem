<?php


$universal = new universal;

class universal{

    public $paciente;
    public $medico;
    public $laboratorio;
    //protected $admin;

    public function __construct(){

        //$this->paciente = new Paciente;
        //$this->medico = new Medico;
        //$this->laboratorio = new Laboratorio;

    }

    public function mostrarConsultas($chavePrimaria, $pessoa){
        # ChavePrimária vai o CPF ou CRM, dependendo de quem pede a função.
        # Pessoa determina se é para buscar consulta baseado no MEDICO ou PACIENTE (CRM/CPF)
        #
        
        if ($pessoa == "paciente"){
            $medico = new Medico; # para pegar nome do medico usando seu CRM

            $query = $DB->prepare("SELECT * FROM consultas WHERE paciente = ?");
            $query->bindParam(1, $chavePrimaria);
            $query->execute();
            $rows = $query->fetchAll(PDO::FETCH_OBJ);

            foreach ($rows as $c){
                $medico = $medico->buscaMedico($c->medico);
                $consulta = 
                '<tr>
                    <th>'.$c->data.'</th>
                    <td>'.$medico->getNome().'</td>
                    <td>'.$medico->getTelefone().'</td>
                    <td>'.$c->requisicao.'</td>
                    <td>'.$c->receita.'</td>
                </tr>
                ';     
                echo $consulta;               
            }

        }elseif ($pessoa == "medico"){
            $paciente = new Paciente; # para pegar nome do paciente usando seu CPF

            $query = $DB->prepare("SELECT * FROM consultas WHERE medico = ?");
            $query->bindParam(1, $chavePrimaria);
            $query->execute();
            $rows = $query->fetchAll(PDO::FETCH_OBJ);

            foreach ($rows as $c){
                $paciente = $paciente->buscaPaciente($c->paciente);
                $consulta =
                '<tr>
                    <th>'.$paciente->getNome().'</th>
                    <td>'.$c->data.'</td>
                    <td>'.$paciente->getTelefone().'</td>
                    <td>'.$paciente->getEmail().'</td>
                    <td>'.$c->receita.'</td>
                    <td>'.$c->requisicao.'</td>
                    <td>'.$c->observacoes.'</td>
                </tr>
                ';
                echo $consulta;              
            }
        }
    }

    public function procurarConsultas($nome, $crm){
        # Função de pesquisar consulta dado um nome do paciente. Utilizada na search box do medico.php e no admin.php
        # NOME e CRM para procurar consulta que contém os dois, ou só nome caso seja o admin.

        $query = $DB->prepare("SELECT * FROM consultas WHERE medico = ?");
        $query->bindParam(1, $chavePrimaria);
        $query->execute();
        $rows = $query->fetchAll(PDO::FETCH_OBJ);

        $paciente = new Paciente; # para buscar NOME baseado no cpf
        foreach ($rows as $c){
            $paciente = $paciente->buscapaciente($c->paciente);
            if (stripos($paciente->getNome(), $nome) !== false) { # SE NOME DIGITADO ESTÁ EM CONSULTA

                $consulta =
                '<tr>
                    <th>'.$paciente->getNome().'</th>
                    <td>'.$c->data.'</td>
                    <td>'.$paciente->getTelefone().'</td>
                    <td>'.$paciente->getEmail().'</td>
                    <td>'.$c->receita.'</td>
                    <td>'.$c->requisicao.'</td>
                    <td>'.$c->observacoes.'</td>
                </tr>

                ';
                echo $consulta;
            }
        }
    }


    public function cadastraConsulta($crm, $cpf, $data, $receita, $requisicaoExame, $observacao){
        $query = $DB->prepare("INSERT INTO consultas (data, medico, paciente, receita, observacoes, requisicao) VALUES (:data, :medico, :paciente, :receita, :observacoes, :requisicao)");
        $query->execute(array(":data" => $data, ":medico" => $crm, ":paciente" => $cpf, ":receita" => $receita, ":observacoes" => $observacao, ":requisicao" => $requisicaoExame));
    }


    public function contaConsultas($chave, $pessoa){
        date_default_timezone_set('America/Sao_Paulo');
        $date = date('Y-m-d');
        $mes = date('m');
        $ano = date('y');

        $consultasTotal = 0;
        $consultasMes = 0;
        $consultasHoje = 0;

        if($pessoa=="medico"){

            $query = $DB->prepare("SELECT COUNT(*) as cont FROM consultas WHERE medico = :medico AND data >= :data");

            #consultasHOJE
            $query->execute(array(":medico" => $chave, ":data" => $date));
            $row = $query->fetch(PDO::FETCH_OBJ);
            $consultasHoje = $row->cont;

            #consultasMES
            $dataAnoMes = $ano . '-' . $mes . '-' . '00';
            $query->execute(array(":medico" => $chave, ":data" => $dataAnoMes));
            $row = $query->fetch(PDO::FETCH_OBJ);
            $consultasMes = $row->cont;

            #consultasTOTAL
            $query->execute(array(":medico" => $chave, ":data" => '00'));
            $row = $query->fetch(PDO::FETCH_OBJ);
            $consultasTotal = $row->cont;

        }elseif($pessoa=="paciente"){

            $query = $DB->prepare("SELECT COUNT(*) as cont FROM consultas WHERE paciente = :paciente AND data >= :data");

            #consultasHOJE
            $query->execute(array(":paciente" => $chave, ":data" => $date));
            $row = $query->fetch(PDO::FETCH_OBJ);
            $consultasHoje = $row->cont;

            #consultasMES
            $dataAnoMes = $ano . '-' . $mes . '-' . '00';
            $query->execute(array(":paciente" => $chave, ":data" => $dataAnoMes));
            $row = $query->fetch(PDO::FETCH_OBJ);
            $consultasMes = $row->cont;

            #consultasTOTAL
            $query->execute(array(":paciente" => $chave, ":data" => '00'));
            $row = $query->fetch(PDO::FETCH_OBJ);
            $consultasTotal = $row->cont;
        }

        $consultas = array($consultasTotal, $consultasMes, $consultasHoje);
        return $consultas;
    }

    public function contaExames($chave, $pessoa){
        date_default_timezone_set('America/Sao_Paulo');
        $date = date('Y-m-d');
        $mes = date('m');

        $examesTotal = 0;
        $examesMes = 0;
        $examesHoje = 0;

        $raiz = $_SERVER['DOCUMENT_ROOT'];
        libxml_use_internal_errors(true);
        $xml_exames = simplexml_load_file($raiz.'/MedicineSystem/dados/exames.xml');
        if ($xml_exames === false) {
            echo "Erro no XML Exames: ";
            foreach (libxml_get_errors() as $error) {
                echo "<br>", $error->message;
            }
        }else{
            if($pessoa=="laboratorio"){

                foreach ($xml_exames->children() as $c) {
                    #examesHOJE
                    if (($c->laboratorio == $chave) && ($c->data == $date)) {
                        $examesHoje += 1;
                    }

                    #examesMES
                    $dataExame = date_create($c->data);
                    $dataExame = date_format($dataExame, "m");

                    if (($c->laboratorio == $chave) && ($mes == $dataExame)){
                        $examesMes += 1;
                    }

                    #examesTOTAL
                    if ($c->laboratorio == $chave){
                        $examesTotal += 1;
                    }

                }
            }elseif($pessoa=="paciente"){

                foreach ($xml_exames->children() as $c) {
                    #examesHOJE
                    if (($c->paciente == $chave) && ($c->data == $date)) {
                        $examesHoje += 1;
                    }

                    #examesMES
                    $dataExame = date_create($c->data);
                    $dataExame = date_format($dataExame, "m");

                    if (($c->paciente == $chave) && ($mes == $dataExame)){
                        $examesMes += 1;
                    }

                    #examesTOTAL
                    if ($c->paciente == $chave){
                        $examesTotal += 1;
                    }

                }

            }

        }


        $exames = array($examesTotal, $examesMes, $examesHoje);
        return $exames;
    }

    public function mostrarExames($chavePrimaria, $pessoa){
        # ChavePrimária vai o CPF ou CNPJ, dependendo de quem pede a função.
        # Pessoa determina se é para buscar exame baseado no LAB ou PACIENTE (CNPJ/CPF)
        #
        $raiz = $_SERVER['DOCUMENT_ROOT'];
        libxml_use_internal_errors(true);
        $xml_exames = simplexml_load_file($raiz.'/MedicineSystem/dados/exames.xml');
        if ($xml_exames === false) {
            echo "Erro no XML Exames: ";
            foreach (libxml_get_errors() as $error) {
                echo "<br>", $error->message;
            }
        }elseif ($pessoa == "paciente"){
            $lab = new Laboratorio; # para buscar nome do lab baseado em seu CNPJ
            foreach ($xml_exames->children() as $c) {
                $lab = $lab->buscaLaboratorio($c->laboratorio);
                if ($c->paciente == $chavePrimaria) {
                    $exame =
                    '<tr>
                        <th>'.$c->data.'</th>
                        <td>'.$lab->getNome().'</td>
                        <td>'.$lab->getTelefone().'</td>
                        <td>'.$c->tipos_exame.'</td>
                        <td>'.$c->resultado.'</td>
                    </tr>

                    ';
                    echo $exame;
                }
            }
        }elseif ($pessoa == "laboratorio"){
            $paciente = new Paciente; # para pegar nome do paciente baseado em seu CPF
            foreach ($xml_exames->children() as $c) {
                $paciente = $paciente->buscapaciente($c->paciente);
                if ($c->laboratorio == $chavePrimaria) {

                    $exame =
                    '<tr>
                        <th>'.$paciente->getNome().'</th>
                        <td>'.$c->data.'</td>
                        <td>'.$paciente->getTelefone().'</td>
                        <td>'.$paciente->getEmail().'</td>
                        <td>'.$c->tipos_exame.'</td>
                        <td>'.$c->resultado.'</td>
                    </tr>

                    ';
                    echo $exame;
                }
            }

        }
    }

    public function procurarExames($nome, $cnpj){
        # Função de pesquisar consulta dado um nome do paciente. Utilizada na search box do medico.php e no admin.php
        # NOME e CNPJ para procurar consulta que contém os dois, ou só nome caso seja o admin.

        $raiz = $_SERVER['DOCUMENT_ROOT'];
        libxml_use_internal_errors(true);
        $xml_exames = simplexml_load_file($raiz.'/MedicineSystem/dados/exames.xml');
        if ($xml_exames === false) {
            echo "Erro no XML Exames: ";
            foreach (libxml_get_errors() as $error) {
                echo "<br>", $error->message;
            }
        }else{

            $paciente = new Paciente; # para buscar NOME baseado no cpf
            foreach ($xml_exames->children() as $c) {
                $paciente = $paciente->buscapaciente($c->paciente);
                if (($c->laboratorio == $cnpj) && (stripos($paciente->getNome(), $nome) !== false)) {
                    $exame =
                    '<tr>
                        <th>'.$paciente->getNome().'</th>
                        <td>'.$c->data.'</td>
                        <td>'.$paciente->getTelefone().'</td>
                        <td>'.$paciente->getEmail().'</td>
                        <td>'.$c->tipos_exame.'</td>
                        <td>'.$c->resultado.'</td>
                    </tr>

                    ';
                    echo $exame;
                }
            }

        }

    }

    public function cadastraExame($data, $cnpj, $cpf, $exames, $resultado){

        $raiz = $_SERVER['DOCUMENT_ROOT'];
        libxml_use_internal_errors(true);
        $xml_exames = simplexml_load_file($raiz.'/MedicineSystem/dados/exames.xml');
        if ($xml_exames === false) {
            echo "Erro no XML Exames: ";
            foreach (libxml_get_errors() as $error) {
                echo "<br>", $error->message;
            }
        }else{
            # Descobrir último (maior) ID utilizado.
            $maiorID = 0;
            foreach ($xml_exames->children() as $c){
                if ((int)($c->idExame) > $maiorID){
                    $maiorID =(int)($c->idExame);
                }
            }

            $exame = $xml_exames->addChild("exame");
            $exame->addChild("idExame", $maiorID+1);
            $exame->addChild("data", $data);
            $exame->addChild("laboratorio", $cnpj);
            $exame->addChild("paciente", $cpf);
            $exame->addChild("tipos_exame", $exames);
            $exame->addChild("resultado", $resultado);

            $dom = new DOMDocument("1.0");
            $dom->preserveWhiteSpace = false;
            $dom->formatOutput = true;
            $dom->loadXML($xml_exames->asXML());

            $file = fopen($raiz.'/MedicineSystem/dados/exames.xml', "w");
            fwrite($file, $dom->saveXML());
            fclose($file);
        }
    }

    //
    // FUNÇÕES EXCLUSIVAS DO ADMIN.PHP
    //
    public function mostrarPacientes(){

        $raiz = $_SERVER['DOCUMENT_ROOT'];
        libxml_use_internal_errors(true);
        $xml_pacientes = simplexml_load_file($raiz.'/MedicineSystem/dados/pacientes.xml');
        if ($xml_pacientes === false) {
            echo "Erro no XML Pacientes: ";
            foreach (libxml_get_errors() as $error) {
                echo "<br>", $error->message;
            }
        }else{
            //$paciente = new Paciente; # para buscar nome do lab baseado em seu CNPJ
            foreach ($xml_pacientes->children() as $c) {
                //$paciente = $paciente->buscapaciente($c->paciente);
                $numeroConsultas = $this->contaConsultas(strval($c->cpf),"paciente");
                $numeroExames = $this->contaExames(strval($c->cpf),"paciente");
                $paciente =
                '<tr>
                    <th>'.$c->nome.'</th>
                    <td>'.$c->endereco.'</td>
                    <td>'.$c->telefone.'</td>
                    <td>'.$c->email.'</td>
                    <td>'.$c->genero.'</td>
                    <td>'.$c->idade.'</td>
                    <td>'.$c->cpf.'</td>
                    <td> 
                    
                    <li class="nav-item" style="list-style: none;">
                        <a class="nav-link dropdown-toggle" style="color: #c2c3c5; font-size: 12px; padding: 0;" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        '. 'Consultas' .'
                        </a>                    
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <label class="dropdown-item">Total de Consultas:
                            '. $numeroConsultas[0] .'
                            </label>
                            <div class="dropdown-divider"></div>
                            <label class="dropdown-item">Consultas este mês:
                            '. $numeroConsultas[1] .'
                            </label>
                            <div class="dropdown-divider"></div>
                            <label class="dropdown-item">Consultas hoje:
                            '. $numeroConsultas[2] .'
                            </label>
                        </div>
                    </li>
                    <li class="nav-item" style="list-style: none;">
                        <a class="nav-link dropdown-toggle" style="color: #c2c3c5; font-size: 12px; padding: 0;" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        '. 'Exames' .'
                        </a>                    
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown2">
                            <label class="dropdown-item">Total de Exames:
                            '. $numeroExames[0] .'
                            </label>
                            <div class="dropdown-divider"></div>
                            <label class="dropdown-item">Exames este mês:
                            '. $numeroExames[1] .'
                            </label>
                            <div class="dropdown-divider"></div>
                            <label class="dropdown-item">Exames hoje:
                            '. $numeroExames[2] .'
                            </label>
                        </div>
                        </li>
                    '.'
                                      
                    
                    
                    </td>
                </tr>';

                echo $paciente;
            }
        }
    }

    public function mostrarMedicos(){

        $raiz = $_SERVER['DOCUMENT_ROOT'];
        libxml_use_internal_errors(true);
        $xml_medicos = simplexml_load_file($raiz.'/MedicineSystem/dados/medicos.xml');
        if ($xml_medicos === false) {
            echo "Erro no XML medicos: ";
            foreach (libxml_get_errors() as $error) {
                echo "<br>", $error->message;
            }
        }else{
            //$paciente = new Paciente; # para buscar nome do lab baseado em seu CNPJ
            foreach ($xml_medicos->children() as $c) {
                //$paciente = $paciente->buscapaciente($c->paciente);
                $numeroConsultas = $this->contaConsultas(strval($c->crm),"medico");
                $medico =
                '<tr>
                    <th>'.$c->nome.'</th>
                    <td>'.$c->endereco.'</td>
                    <td>'.$c->telefone.'</td>
                    <td>'.$c->email.'</td>
                    <td>'.$c->genero.'</td>
                    <td>'.$c->especialidade.'</td>
                    <td>'.$c->crm.'</td>

                    <td>
                    <a class="nav-link dropdown-toggle" style="color: #c2c3c5; font-size: 12px; padding: 0;" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    '. 'Consultas' .'
                    </a>                    
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <label class="dropdown-item">Total de Consultas:
                        '. $numeroConsultas[0] .'
                        </label>
                        <div class="dropdown-divider"></div>
                        <label class="dropdown-item">Consultas este mês:
                        '. $numeroConsultas[1] .'
                        </label>
                        <div class="dropdown-divider"></div>
                        <label class="dropdown-item">Consultas hoje:
                        '. $numeroConsultas[2] .'
                        </label>
                    </div>
                    '.'
                    </td>                    
                </tr>
                ';
                echo $medico;
            }
        }
    }

    public function mostrarLaboratorios(){

        $raiz = $_SERVER['DOCUMENT_ROOT'];
        libxml_use_internal_errors(true);
        $xml_lab = simplexml_load_file($raiz.'/MedicineSystem/dados/laboratorios.xml');
        if ($xml_lab === false) {
            echo "Erro no XML laboratorios: ";
            foreach (libxml_get_errors() as $error) {
                echo "<br>", $error->message;
            }
        }else{
            //$paciente = new Paciente; # para buscar nome do lab baseado em seu CNPJ
            foreach ($xml_lab->children() as $c) {
                //$paciente = $paciente->buscapaciente($c->paciente);
                $numeroExames = $this->contaExames(strval($c->cnpj),"laboratorio");
                $lab =
                '<tr>
                    <th>'.$c->nome.'</th>
                    <td>'.$c->endereco.'</td>
                    <td>'.$c->telefone.'</td>
                    <td>'.$c->email.'</td>
                    <td>'.$c->tipos_exame.'</td>
                    <td>'.$c->cnpj.'</td>

                    <td>
                    <a class="nav-link dropdown-toggle" style="color: #c2c3c5; font-size: 12px; padding: 0;" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    '. 'Exames' .'
                    </a>                    
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <label class="dropdown-item">Total de Exames:
                        '. $numeroExames[0] .'
                        </label>
                        <div class="dropdown-divider"></div>
                        <label class="dropdown-item">Exames este mês:
                        '. $numeroExames[1] .'
                        </label>
                        <div class="dropdown-divider"></div>
                        <label class="dropdown-item">Exames hoje:
                        '. $numeroExames[2] .'
                        </label>
                    </div>
                    '.'
                    </td> 

                </tr>
                ';
                echo $lab;
            }
        }
    }

    public function procurarPacientes($nome){

        $raiz = $_SERVER['DOCUMENT_ROOT'];
        libxml_use_internal_errors(true);
        $xml_pacientes = simplexml_load_file($raiz.'/MedicineSystem/dados/pacientes.xml');
        if ($xml_pacientes === false) {
            echo "Erro no XML Pacientes: ";
            foreach (libxml_get_errors() as $error) {
                echo "<br>", $error->message;
            }
        }else{

            foreach ($xml_pacientes->children() as $c) {
                if (stripos($c->nome, $nome) !== false) {
                    $numeroConsultas = $this->contaConsultas(strval($c->cpf),"paciente");
                    $numeroExames = $this->contaExames(strval($c->cpf),"paciente");                    
                    $paciente =
                    '<tr>
                        <th>'.$c->nome.'</th>
                        <td>'.$c->endereco.'</td>
                        <td>'.$c->telefone.'</td>
                        <td>'.$c->email.'</td>
                        <td>'.$c->genero.'</td>
                        <td>'.$c->idade.'</td>
                        <td>'.$c->cpf.'</td>

                        <td> 
                    
                        <li class="nav-item" style="list-style: none;">
                            <a class="nav-link dropdown-toggle" style="color: #c2c3c5; font-size: 12px; padding: 0;" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            '. 'Consultas' .'
                            </a>                    
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <label class="dropdown-item">Total de Consultas:
                                '. $numeroConsultas[0] .'
                                </label>
                                <div class="dropdown-divider"></div>
                                <label class="dropdown-item">Consultas este mês:
                                '. $numeroConsultas[1] .'
                                </label>
                                <div class="dropdown-divider"></div>
                                <label class="dropdown-item">Consultas hoje:
                                '. $numeroConsultas[2] .'
                                </label>
                            </div>
                        </li>
                        <li class="nav-item" style="list-style: none;">
                            <a class="nav-link dropdown-toggle" style="color: #c2c3c5; font-size: 12px; padding: 0;" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            '. 'Exames' .'
                            </a>                    
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown2">
                                <label class="dropdown-item">Total de Exames:
                                '. $numeroExames[0] .'
                                </label>
                                <div class="dropdown-divider"></div>
                                <label class="dropdown-item">Exames este mês:
                                '. $numeroExames[1] .'
                                </label>
                                <div class="dropdown-divider"></div>
                                <label class="dropdown-item">Exames hoje:
                                '. $numeroExames[2] .'
                                </label>
                            </div>
                            </li>
                        '.'
                        </td>                        

                    </tr>
                    ';
                    echo $paciente;
                }
            }

        }

    }

    public function procurarMedicos($nome){

        $raiz = $_SERVER['DOCUMENT_ROOT'];
        libxml_use_internal_errors(true);
        $xml_medicos = simplexml_load_file($raiz.'/MedicineSystem/dados/medicos.xml');
        if ($xml_medicos === false) {
            echo "Erro no XML medicos: ";
            foreach (libxml_get_errors() as $error) {
                echo "<br>", $error->message;
            }
        }else{

            foreach ($xml_medicos->children() as $c) {
                if (stripos($c->nome, $nome) !== false) {
                    $numeroConsultas = $this->contaConsultas(strval($c->crm),"medico");
                    $medico =
                    '<tr>
                        <th>'.$c->nome.'</th>
                        <td>'.$c->endereco.'</td>
                        <td>'.$c->telefone.'</td>
                        <td>'.$c->email.'</td>
                        <td>'.$c->genero.'</td>
                        <td>'.$c->especialidade.'</td>
                        <td>'.$c->crm.'</td>

                        <td>
                        <a class="nav-link dropdown-toggle" style="color: #c2c3c5; font-size: 12px; padding: 0;" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        '. 'Consultas' .'
                        </a>                    
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <label class="dropdown-item">Total de Consultas:
                            '. $numeroConsultas[0] .'
                            </label>
                            <div class="dropdown-divider"></div>
                            <label class="dropdown-item">Consultas este mês:
                            '. $numeroConsultas[1] .'
                            </label>
                            <div class="dropdown-divider"></div>
                            <label class="dropdown-item">Consultas hoje:
                            '. $numeroConsultas[2] .'
                            </label>
                        </div>
                        '.'
                        </td>                         
                    </tr>
                    ';
                    echo $medico;
                }
            }

        }

    }

    public function procurarLaboratorios($nome){

        $raiz = $_SERVER['DOCUMENT_ROOT'];
        libxml_use_internal_errors(true);
        $xml_laboratorios = simplexml_load_file($raiz.'/MedicineSystem/dados/laboratorios.xml');
        if ($xml_laboratorios === false) {
            echo "Erro no XML laboratorios: ";
            foreach (libxml_get_errors() as $error) {
                echo "<br>", $error->message;
            }
        }else{

            foreach ($xml_laboratorios->children() as $c) {
                if (stripos($c->nome, $nome) !== false) {
                    $numeroExames = $this->contaExames(strval($c->cnpj),"laboratorio");                    
                    $lab =
                    '<tr>
                        <th>'.$c->nome.'</th>
                        <td>'.$c->endereco.'</td>
                        <td>'.$c->telefone.'</td>
                        <td>'.$c->email.'</td>
                        <td>'.$c->tipos_exame.'</td>
                        <td>'.$c->cnpj.'</td>

                        <td>
                        <a class="nav-link dropdown-toggle" style="color: #c2c3c5; font-size: 12px; padding: 0;" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        '. 'Exames' .'
                        </a>                    
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <label class="dropdown-item">Total de Exames:
                            '. $numeroExames[0] .'
                            </label>
                            <div class="dropdown-divider"></div>
                            <label class="dropdown-item">Exames este mês:
                            '. $numeroExames[1] .'
                            </label>
                            <div class="dropdown-divider"></div>
                            <label class="dropdown-item">Exames hoje:
                            '. $numeroExames[2] .'
                            </label>
                        </div>
                        '.'
                        </td>                         
                    </tr>
                    ';
                    echo $lab;
                }
            }

        }

    }

    //
    // GERAL
    //
    public function testaEntrada($var){
        /* remove barras invertidas e caracteres especiais do input */
        $var = stripslashes($var);
        $var = htmlspecialchars($var);
        return $var;
    }
}
?>
