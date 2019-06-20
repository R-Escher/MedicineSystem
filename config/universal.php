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
            $medico = new Medico;
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
        # Função de pesquisar consulta dado um nome do paciente. Utilizada na search box do medico.php
        # NOME e CRM para procurar consulta que contém os dois.

        libxml_use_internal_errors(true);
        $xml_consultas = simplexml_load_file("../dados/consultas.xml");    
        if ($xml_consultas === false) {
            echo "Erro no XML Consultas: ";
            foreach (libxml_get_errors() as $error) {
                echo "<br>", $error->message;
            }
        }elseif ($pessoa == "medico"){
            $paciente = new Paciente;
            foreach ($xml_consultas->children() as $c) {
                $paciente = $paciente->buscapaciente($c->paciente);
                if (($c->medico == $crm) && ($c->paciente == $nome)) {
                    
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


}
?>