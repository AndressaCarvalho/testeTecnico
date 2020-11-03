<?php
header('Content-Type: application/json; charset=utf-8'); 

require 'repository/bicicleta.php';

class Rest
{
	public static function abrir($requisicao)
	{
		$url = explode('/', $requisicao['url']);
		
		$classe = ucfirst($url[0]);
		array_shift($url);

		$metodo = $url[0];
		array_shift($url);

		$jParametros = (array) $requisicao;
		array_shift($jParametros);
		$parametros = array();
		$parametros = $jParametros;


		$dataBody = json_decode(file_get_contents("php://input"));

		
		try {
			if (class_exists($classe)) {
				if (method_exists($classe, $metodo)) {
					$produto = new $classe;

					$produto->descricao = (isset($dataBody->descricao)) ? $dataBody->descricao : NULL;
					$produto->valor 	= (isset($dataBody->valor)) ? $dataBody->valor : NULL;

					$retorno = call_user_func_array(array($produto, $metodo), $parametros);

					return json_encode(array('sucesso' => 1, 'dados' => $retorno));
				} else {
					return json_encode(array('sucesso' => 0, 'dados' => 'Método inexistente!'));
				}
			} else {
				return json_encode(array('sucesso' => 0, 'dados' => 'Classe inexistente!'));
			}	
		} catch (Exception $e) {
			return json_encode(array('sucesso' => 0, 'dados' => $e->getMessage()));
		}
		
	}
}