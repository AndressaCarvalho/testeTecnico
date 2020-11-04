<?php
header('Content-Type: application/json; charset=utf-8'); 

require 'tests/removerAcentosHelperTester.php';

class Testes
{
	public static function teste($requisicao)
	{
		$url 			= explode('/', $requisicao['url']);
		
		$classe 		= ucfirst($url[0]);
		array_shift($url);

		$funcao 		= $url[0];

		$parametros 	= array();

		
		try {
			if (class_exists($classe)) {
				$test = new $classe;

				if (method_exists($classe, $funcao)) {
					$retorno = call_user_func_array(array($test, $funcao), $parametros);

					return json_encode(array('sucesso' => 1, 'dados' => $retorno));
				} else {
					return json_encode(array('sucesso' => 0, 'dados' => 'Metodo inexistente!'));
				}
			} else {
				return json_encode(array('sucesso' => 0, 'dados' => 'Classe inexistente!'));
			}	
		} catch (Exception $e) {
			return json_encode(array('sucesso' => 0, 'dados' => $e->getMessage()));
		}
		
	}
}