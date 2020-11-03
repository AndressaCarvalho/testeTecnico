<?php
require 'db/conexao.php'; 
require 'helpers/removerAcentosHelper.php';

class Bike
{
	public $descricao;
	public $valor;


	public function listar()
	{
		global $conn;

		$stm = "SELECT * FROM tb_bicicleta ORDER BY id ASC";
		$stm = $conn->prepare($stm);
		$stm->execute();

		$resultados = array();

		while($row = $stm->fetch(PDO::FETCH_ASSOC)) {
			$resultados[] = $row;
		}

		if (!$resultados) {
			throw new Exception("Nenhuma bicicleta encontrada!");
		}
		
		return $resultados;
	}

	public function listarPorId($idBike = NULL)
	{
		global $conn;

		$stm = "SELECT * FROM tb_bicicleta WHERE id = ".trim($idBike)." ORDER BY id ASC";
		$stm = $conn->prepare($stm);
		$stm->execute();

		$resultados = array();

		while($row = $stm->fetch(PDO::FETCH_ASSOC)) {
			$resultados[] = $row;
		}

		if (!$resultados) {
			throw new Exception("Nenhuma bicicleta encontrada!");
		}
		
		return $resultados;
	}


	public function inserir()
	{
		global $conn;
		$rAcentuacao = new RemoverAcentos;

		$stm = "INSERT INTO tb_bicicleta (descricao, valor) VALUES ('".utf8_decode(addslashes(strtoupper($rAcentuacao->removerAcentuacao(trim($this->descricao)))))."', ".trim($this->valor).")";
		$stm = $conn->prepare($stm);
		$ret = $stm->execute();

		if ($ret) 
		{
			$resultados = array('id' => $conn->lastInsertId(), 'mensagem' => 'Bicicleta inserida!');
		}
		else {
			$resultados = array('mensagem' => $stm->errorInfo());
		}
		
		return $resultados;
	}


	public function atualizar($idBike = NULL)
	{
		global $conn;
		$rAcentuacao = new RemoverAcentos;

		$stm = "UPDATE tb_bicicleta SET ";
		$stm .= (!empty($this->descricao)) ? " descricao = '".utf8_decode(addslashes(strtoupper($rAcentuacao->removerAcentuacao(trim($this->descricao)))))."', " : "";
		$stm .= (!empty($this->valor)) ? " valor = ".trim($this->valor)." " : "";
		$stm .= " WHERE id = ".trim($idBike);
		$stm = str_replace(", WHERE", " WHERE", $stm);

		$stm = $conn->prepare($stm);
		$ret = $stm->execute();

		if ($ret) 
		{
			$resultados = array('id' => $idBike, 'mensagem' => 'Bicicleta atualizada!');
		}
		else {
			$resultados = array('mensagem' => $stm->errorInfo());
		}
		
		return $resultados;
	}


	public function atualizarTudo($idBike = NULL)
	{
		global $conn;
		$rAcentuacao = new RemoverAcentos;

		$stm = "UPDATE tb_bicicleta SET descricao = '".utf8_decode(addslashes(strtoupper($rAcentuacao->removerAcentuacao(trim($this->descricao)))))."', valor = ".trim($this->valor)." WHERE id = ".trim($idBike);
		$stm = $conn->prepare($stm);
		$ret = $stm->execute();

		if ($ret) 
		{
			$resultados = array('id' => $idBike, 'mensagem' => 'Bicicleta completamente atualizada!');
		}
		else {
			$resultados = array('mensagem' => $stm->errorInfo());
		}
		
		return $resultados;
	}


	public function deletar($idBike = NULL)
	{
		global $conn;

		$stm = "DELETE FROM tb_bicicleta WHERE id = ".trim($idBike);
		$stm = $conn->prepare($stm);
		$ret = $stm->execute();

		if ($ret) 
		{
			$resultados = array('id' => $idBike, 'mensagem' => 'Bicicleta deletada!');
		}
		else {
			$resultados = array('mensagem' => $stm->errorInfo());
		}
		
		return $resultados;
	}
}