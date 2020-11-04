<?php
header('Content-Type: application/json; charset=utf-8'); 

require 'repository/bicicleta.php';
require 'tests/removerAcentosHelperTester.php';

class Rest
{
	public static function abrir($requisicao)
	{
		$url 			= explode('/', $requisicao['url']);
		
		$classe 		= ucfirst($url[0]);

		$metodo 		= $_SERVER['REQUEST_METHOD'];

		$jParametros 	= (array) $requisicao;
		array_shift($jParametros);
		$parametros 	= array();
		$parametros 	= $jParametros;

		$dataBody 		= json_decode(file_get_contents("php://input"));

		
		try {
			if (class_exists($classe)) {
				$bike = new $classe;

				$funcao = '';
				if ($metodo == 'GET') {
					if (empty($parametros)) {
						$funcao = 'listar';
					} else {
						$funcao = 'listarPorId';
					}
				} elseif ($metodo == 'POST') {
					$funcao = 'inserir';
				} elseif ($metodo == 'PATCH') {
					$funcao = 'atualizar';
				} elseif ($metodo == 'PUT') {
					$funcao = 'atualizarTudo';
				} elseif ($metodo == 'DELETE') {
					$funcao = 'deletar';
				} else {
					return json_encode(array('sucesso' => 0, 'dados' => 'Metodo inexistente!'));
				}

				if (method_exists($classe, $funcao)) {
					$bike->descricao = (isset($dataBody->descricao)) ? $dataBody->descricao : NULL;
					$bike->valor 	= (isset($dataBody->valor)) ? $dataBody->valor : NULL;

					$retorno = call_user_func_array(array($bike, $funcao), $parametros);

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