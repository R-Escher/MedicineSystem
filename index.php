<?php 
 
// Transformando arquivo XML em Objeto
$xml = simplexml_load_file('vendas.xml');
 
// Exibe as informações do XML
echo 'Título: ' . $xml->titulo . '<br>';
echo 'Data de Atualização: ' . $xml->data_atualizacao . '<br>';
 

function pesquisaNome ($xml,$nome){	
	// Percorre todos os registros de vendas
	foreach($xml->venda as $registro):
		//FILTRO PRA BUSCA TODOS COM O RESPECTIVO $nome
		if (stripos($registro->cliente, $nome) !== false){
			echo 'Código da Venda: ' . $registro->cod_venda . '<br>';
			echo 'Cliente: ' . $registro->cliente . '<br>';
			echo 'Email: ' . $registro->email . '<br>';

			// Percorre todos os itens da venda
			foreach($registro->itens->item as $item):
				echo 'Código do Produto: ' . $item->cod_produto . '<br>';
				echo 'Quantidade: ' . $item->qtde . '<br>';
				echo 'Descrição do Produto: ' . $item->descricao . '<br>';
			endforeach;
			echo '<hr>';
		}

	endforeach;
}
//MODIFICA VALOR E DEPOIS GRAVA NO XML
//$xml->venda->cod_venda = 002; 
//$xml->asXML('vendas.xml');
pesquisaNome($xml,'joão')

?>