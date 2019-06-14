<!DOCTYPE html>
<html>
<body>
<?php

libxml_use_internal_errors(true);

$xml = simplexml_load_file('medicos.xml');
if ($xml === false){
    echo "falha ao carregar xml: ";
    foreach (libxml_get_errors() as $error) {
       echo "<br>", $error->message;
    }
} else {
    foreach ($xml->children() as $medico) {
        echo $medico->crm . ", ";
        echo $medico->nome . ", ";
        echo $medico->endereco . ", ";
        echo $medico->telefone . ", ";
        echo $medico->especialidade . ", ";
        echo $medico->email . ", ";
        echo "<br><br>";
    }
}
//echo "<br>" .$xml->medico[0]->crm;

//$xml->medico[0]->crm = "4565-1";

//$xml->asXML('medicos.xml');

$xml->asXML('medicos.xml');
?>
</body>
</html>