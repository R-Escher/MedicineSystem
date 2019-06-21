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
        libxml_use_internal_errors(true);
        $xml_consultas = simplexml_load_file("dados/consultas.xml");    
        if ($xml_consultas === false) {
            echo "Erro no XML Consultas: ";
            foreach (libxml_get_errors() as $error) {
                echo "<br>", $error->message;
            }
        }elseif ($pessoa == "paciente"){
            $medico = new Medico; # para pegar nome do medico usando seu CRM
            foreach ($xml_consultas->children() as $c) {
                $medico = $medico->buscaMedico($c->medico);
                if ($c->paciente == $chavePrimaria) {
                    $consulta = 
                    '<tr>
                        <td>'.$c->data.'</td>
                        <th>'.$medico->getNome().'</th>
                        <td>'.$medico->getTelefone().'</td>
                        <td>'.$c->requisicao.'</td>
                        <td>'.$c->receita.'</td>
                    </tr>
                        
                    ';
                    echo $consulta;
                }
            }
        }elseif ($pessoa == "medico"){
            $paciente = new Paciente;
            foreach ($xml_consultas->children() as $c) {
                $paciente = $paciente->buscapaciente($c->paciente);
                if ($c->medico == $chavePrimaria) {
                    
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
    }

    public function procurarConsultas($nome, $crm){
        # Função de pesquisar consulta dado um nome do paciente. Utilizada na search box do medico.php e no admin.php
        # NOME e CRM para procurar consulta que contém os dois, ou só nome caso seja o admin.

        libxml_use_internal_errors(true);
        $xml_consultas = simplexml_load_file("../dados/consultas.xml");    
        if ($xml_consultas === false) {
            echo "Erro no XML Consultas: ";
            foreach (libxml_get_errors() as $error) {
                echo "<br>", $error->message;
            }
        }else{

            $paciente = new Paciente; # para buscar NOME baseado no cpf
            foreach ($xml_consultas->children() as $c) {
                $paciente = $paciente->buscapaciente($c->paciente);
                if (($c->medico == $crm) && (stripos($paciente->getNome(), $nome) !== false)) {
                    
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

    }

    public function cadastraConsulta($crm, $cpf, $data, $receita, $requisicaoExame, $observacao){

        libxml_use_internal_errors(true);
        $xml_consultas = simplexml_load_file("../dados/consultas.xml");    
        if ($xml_consultas === false) {
            echo "Erro no XML Consultas: ";
            foreach (libxml_get_errors() as $error) {
                echo "<br>", $error->message;
            }
        }else{
            # Descobrir último (maior) ID utilizado.
            $maiorID = 0;
            foreach ($xml_consultas->children() as $c){
                if ((int)($c->idConsulta) > $maiorID){
                    $maiorID =(int)($c->idConsulta);
                } 
            }

            $consulta = $xml_consultas->addChild("consulta");
            $consulta->addChild("idConsulta", $maiorID+1);
            $consulta->addChild("data", $data);
            $consulta->addChild("medico", $crm);
            $consulta->addChild("paciente", $cpf);
            $consulta->addChild("receita", $receita);
            $consulta->addChild("observacoes", $observacao);
            $consulta->addChild("requisicao", $requisicaoExame);

            $dom = new DOMDocument("1.0");
            $dom->preserveWhiteSpace = false;
            $dom->formatOutput = true;
            $dom->loadXML($xml_consultas->asXML());          
            
            $file = fopen("../dados/consultas.xml", "w");
            fwrite($file, $dom->saveXML());
            fclose($file);              
        }        
    }

    public function contaConsultas($chave, $pessoa){
        date_default_timezone_set('America/Sao_Paulo'); 
        $date = date('Y-m-d');
        $mes = date('m');
        
        $consultasTotal = 0;
        $consultasMes = 0;
        $consultasHoje = 0;

        libxml_use_internal_errors(true);
        $xml_consultas = simplexml_load_file("dados/consultas.xml");
        if ($xml_consultas === false) {
            echo "Erro no XML Consultas: ";
            foreach (libxml_get_errors() as $error) {
                echo "<br>", $error->message;
            }
        }else{
            
            if($pessoa=="medico"){

                foreach ($xml_consultas->children() as $c) {
                    #consultasHOJE
                    if (($c->medico == $chave) && ($c->data == $date)) {
                        $consultasHoje += 1;
                    }
                    
                    #consultasMES
                    $dataConsulta = date_create($c->data);
                    $dataConsulta = date_format($dataConsulta, "m");

                    if (($c->medico == $chave) && ($mes == $dataConsulta)){
                        $consultasMes += 1;
                    }

                    #consultasTOTAL
                    if ($c->medico == $chave){
                        $consultasTotal += 1;
                    }

                }
            }elseif($pessoa=="paciente"){
                foreach ($xml_consultas->children() as $c) {
                    #consultasHOJE
                    if (($c->paciente == $chave) && ($c->data == $date)) {
                        $consultasHoje += 1;
                    }
                    
                    #consultasMES
                    $dataConsulta = date_create($c->data);
                    $dataConsulta = date_format($dataConsulta, "m");

                    if (($c->paciente == $chave) && ($mes == $dataConsulta)){
                        $consultasMes += 1;
                    }

                    #consultasTOTAL
                    if ($c->paciente == $chave){
                        $consultasTotal += 1;
                    }

                }                
            }
            
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

        libxml_use_internal_errors(true);
        $xml_exames = simplexml_load_file("dados/exames.xml");
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
        libxml_use_internal_errors(true);
        $xml_exames = simplexml_load_file("dados/exames.xml");    
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
                        <td>'.$c->data.'</td>
                        <th>'.$lab->getNome().'</th>
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

        libxml_use_internal_errors(true);
        $xml_exames = simplexml_load_file("../dados/exames.xml");    
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

        libxml_use_internal_errors(true);
        $xml_exames = simplexml_load_file("../dados/exames.xml");    
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
            $exame->addChild("idConsulta", $maiorID+1);
            $exame->addChild("data", $data);
            $exame->addChild("laboratorio", $cnpj);
            $exame->addChild("paciente", $cpf);
            $exame->addChild("tipos_exame", $exames);
            $exame->addChild("resultado", $resultado);

            $dom = new DOMDocument("1.0");
            $dom->preserveWhiteSpace = false;
            $dom->formatOutput = true;
            $dom->loadXML($xml_exames->asXML());          
            
            $file = fopen("../dados/exames.xml", "w");
            fwrite($file, $dom->saveXML());
            fclose($file);              
        }        
    }

    //
    // FUNÇÕES EXCLUSIVAS DO ADMIN.PHP
    //
    public function mostrarPacientes(){

        libxml_use_internal_errors(true);
        $xml_pacientes = simplexml_load_file("dados/pacientes.xml");    
        if ($xml_pacientes === false) {
            echo "Erro no XML Pacientes: ";
            foreach (libxml_get_errors() as $error) {
                echo "<br>", $error->message;
            }
        }else{
            //$paciente = new Paciente; # para buscar nome do lab baseado em seu CNPJ
            foreach ($xml_pacientes->children() as $c) {
                //$paciente = $paciente->buscapaciente($c->paciente);
                $paciente = 
                '<tr>
                    <td>'.$c->nome.'</td>
                    <th>'.$c->endereco.'</th>
                    <td>'.$c->telefone.'</td>
                    <td>'.$c->email.'</td>
                    <td>'.$c->genero.'</td>
                    <td>'.$c->idade.'</td>
                    <td>'.$c->cpf.'</td>
                </tr>
                ';
                echo $paciente;
            }
        }
    }    

    public function mostrarMedicos(){

        libxml_use_internal_errors(true);
        $xml_medicos = simplexml_load_file("dados/medicos.xml");    
        if ($xml_medicos === false) {
            echo "Erro no XML medicos: ";
            foreach (libxml_get_errors() as $error) {
                echo "<br>", $error->message;
            }
        }else{
            //$paciente = new Paciente; # para buscar nome do lab baseado em seu CNPJ
            foreach ($xml_medicos->children() as $c) {
                //$paciente = $paciente->buscapaciente($c->paciente);
                $medico = 
                '<tr>
                    <td>'.$c->nome.'</td>
                    <th>'.$c->endereco.'</th>
                    <td>'.$c->telefone.'</td>
                    <td>'.$c->email.'</td>
                    <td>'.$c->genero.'</td>
                    <td>'.$c->especialidade.'</td>
                    <td>'.$c->crm.'</td>
                </tr>
                ';
                echo $medico;
            }
        }
    }

    public function mostrarLaboratorios(){

        libxml_use_internal_errors(true);
        $xml_lab = simplexml_load_file("dados/laboratorios.xml");    
        if ($xml_lab === false) {
            echo "Erro no XML laboratorios: ";
            foreach (libxml_get_errors() as $error) {
                echo "<br>", $error->message;
            }
        }else{
            //$paciente = new Paciente; # para buscar nome do lab baseado em seu CNPJ
            foreach ($xml_lab->children() as $c) {
                //$paciente = $paciente->buscapaciente($c->paciente);
                $lab = 
                '<tr>
                    <td>'.$c->nome.'</td>
                    <th>'.$c->endereco.'</th>
                    <td>'.$c->telefone.'</td>
                    <td>'.$c->email.'</td>
                    <td>'.$c->tipos_exame.'</td>
                    <td>'.$c->cnpj.'</td>
                </tr>
                ';
                echo $lab;
            }
        }
    }

    public function procurarPacientes($nome){

        libxml_use_internal_errors(true);
        $xml_pacientes = simplexml_load_file("../dados/pacientes.xml");    
        if ($xml_pacientes === false) {
            echo "Erro no XML Pacientes: ";
            foreach (libxml_get_errors() as $error) {
                echo "<br>", $error->message;
            }
        }else{

            foreach ($xml_pacientes->children() as $c) {
                if (stripos($c->nome, $nome) !== false) {
                    $paciente = 
                    '<tr>
                        <td>'.$c->nome.'</td>
                        <th>'.$c->endereco.'</th>
                        <td>'.$c->telefone.'</td>
                        <td>'.$c->email.'</td>
                        <td>'.$c->genero.'</td>
                        <td>'.$c->idade.'</td>
                        <td>'.$c->cpf.'</td>
                    </tr>
                    ';
                    echo $paciente;
                }
            }
            
        }

    }

    public function procurarMedicos($nome){

        libxml_use_internal_errors(true);
        $xml_medicos = simplexml_load_file("../dados/medicos.xml");    
        if ($xml_medicos === false) {
            echo "Erro no XML medicos: ";
            foreach (libxml_get_errors() as $error) {
                echo "<br>", $error->message;
            }
        }else{

            foreach ($xml_medicos->children() as $c) {
                if (stripos($c->nome, $nome) !== false) {
                    $medico = 
                    '<tr>
                        <td>'.$c->nome.'</td>
                        <th>'.$c->endereco.'</th>
                        <td>'.$c->telefone.'</td>
                        <td>'.$c->email.'</td>
                        <td>'.$c->genero.'</td>
                        <td>'.$c->especialidade.'</td>
                        <td>'.$c->crm.'</td>
                    </tr>
                    ';
                    echo $medico;
                }
            }
            
        }

    }

    public function procurarLaboratorios($nome){

        libxml_use_internal_errors(true);
        $xml_laboratorios = simplexml_load_file("../dados/laboratorios.xml");    
        if ($xml_laboratorios === false) {
            echo "Erro no XML laboratorios: ";
            foreach (libxml_get_errors() as $error) {
                echo "<br>", $error->message;
            }
        }else{

            foreach ($xml_laboratorios->children() as $c) {
                if (stripos($c->nome, $nome) !== false) {
                    $lab = 
                    '<tr>
                        <td>'.$c->nome.'</td>
                        <th>'.$c->endereco.'</th>
                        <td>'.$c->telefone.'</td>
                        <td>'.$c->email.'</td>
                        <td>'.$c->tipos_exame.'</td>
                        <td>'.$c->cnpj.'</td>
                    </tr>
                    ';
                    echo $lab;
                }
            }
            
        }

    }    

}
?>