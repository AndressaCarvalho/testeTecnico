<?php 
require 'helpers/removerAcentosHelper.php';

class RemoverAcentosTester
{
	public static function removerAcentuacaoTester() 
	{
		$testeCAcento = "ACENTUAÇÃO";
		$testeSAcento = "ACENTUACAO";

		$rAcentuacao = new RemoverAcentos;
		$retorno = $rAcentuacao->removerAcentuacao($testeCAcento);

		if ($retorno === $testeSAcento) {
			$resultado = array('mensagem' => 'Sucesso!', 'retorno' => $retorno);
		} else {
			$resultado = array('mensagem' => 'Falha!');
		}
	    return $resultado;
	}
}