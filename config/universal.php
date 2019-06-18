<?php 

$universal = new universal;

class universal{

    protected $paciente;
    protected $medico;
    protected $laboratorio;
    //protected $admin;

    public function __construct(){

        $this->paciente = new Paciente;
        $this->medico = new Medico;
        $this->laboratorio = new Laboratorio;

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

            foreach ($xml_consultas->children() as $c) {
                $medico = $this->medico->buscaMedico($c->medico);
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

            foreach ($xml_consultas->children() as $c) {
                $paciente = $this->paciente->buscapaciente($c->paciente);
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












}
?>