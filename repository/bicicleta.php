<?php
require 'include/conexao.php'; 
require 'include/funcoes.php';

class Bike
{
	public $descricao;
	public $valor;

	public function listar()
	{
		global $conn;

		$stm = "SELECT b.id, b.descricao, c.cor, mat.material, mar.marca, model.modelo, l.nome_fantasia, b.valor FROM tb_bicicleta AS b 
				LEFT JOIN tb_cor AS c ON b.id_cor = c.id 
			    LEFT JOIN tb_material AS mat ON b.id_material = mat.id 
			    LEFT JOIN tb_marca_modelo AS mar_model ON b.id_marca_modelo = mar_model.id 
			    LEFT JOIN tb_marca AS mar ON mar_model.id_marca = mar.id 
			    LEFT JOIN tb_modelo AS model ON mar_model.id_modelo = model.id 
			    LEFT JOIN tb_loja AS l ON b.id_loja = l.id 
			ORDER BY b.id ASC";
		$stm = $conn->prepare($stm);
		$stm->execute();

		$resultados = array();

		while($row = $stm->fetch(PDO::FETCH_ASSOC)) {
			$resultados[] = $row;
		}

		if (!$resultados) {
			throw new Exception("Nenhuma bicicleta encontrado!");
		}
		
		return $resultados;
	}

	public function listarPorId($idBike = NULL)
	{
		global $conn;

		$stm = "SELECT b.id, b.descricao, c.cor, mat.material, mar.marca, model.modelo, l.nome_fantasia, b.valor FROM tb_bicicleta AS b 
				LEFT JOIN tb_cor AS c ON b.id_cor = c.id 
			    LEFT JOIN tb_material AS mat ON b.id_material = mat.id 
			    LEFT JOIN tb_marca_modelo AS mar_model ON b.id_marca_modelo = mar_model.id 
			    LEFT JOIN tb_marca AS mar ON mar_model.id_marca = mar.id 
			    LEFT JOIN tb_modelo AS model ON mar_model.id_modelo = model.id 
			    LEFT JOIN tb_loja AS l ON b.id_loja = l.id 
			WHERE b.id = ".$idBike." ORDER BY b.id ASC";
		$stm = $conn->prepare($stm);
		$stm->execute();

		$resultados = array();

		while($row = $stm->fetch(PDO::FETCH_ASSOC)) {
			$resultados[] = $row;
		}

		if (!$resultados) {
			throw new Exception("Nenhuma bicicleta encontrado!");
		}
		
		return $resultados;
	}


	public function inserir($idCor = NULL, $idMaterial = NULL, $idMarcaModelo = NULL, $idLoja = NULL)
	{
		global $conn;

		$stm = "INSERT INTO tb_bicicleta (descricao, id_cor, id_material, id_marca_modelo, id_loja, valor) VALUES ('".utf8_decode(addslashes(strtoupper(tirarAcentos(trim($this->descricao)))))."', ".trim($idCor).", ".trim($idMaterial).", ".trim($idMarcaModelo).", ".trim($idLoja).", ".trim($this->valor).")";
		$stm = $conn->prepare($stm);
		$ret = $stm->execute();

		if ($ret) 
		{
			$resultados = array('id' => $conn->lastInsertId(), 'mensagem' => 'Bicicleta inserida');
		}
		else {
			$resultados = array('mensagem' => $stm->errorInfo());
		}
		
		return $resultados;
	}


	public function atualizar($idBike = NULL, $idCor = NULL, $idMaterial = NULL, $idMarcaModelo = NULL, $idLoja = NULL)
	{
		global $conn;

		$stm = "UPDATE tb_bicicleta SET ";
		$stm .= (!empty($this->descricao)) ? " descricao = '".utf8_decode(addslashes(strtoupper(tirarAcentos(trim($this->descricao)))))."', " : "";
		$stm .= (!empty($idCor)) ? " id_cor = ".trim($idCor).", " : "";
		$stm .= (!empty($idMaterial)) ? " id_material = ".trim($idMaterial).", " : "";
		$stm .= (!empty($idMarcaModelo)) ? " id_marca_modelo = ".trim($idMarcaModelo).", " : "";
		$stm .= (!empty($idLoja)) ? " id_loja = ".trim($idLoja).", " : "";
		$stm .= (!empty($this->valor)) ? " valor = ".trim($this->valor)." " : "";
		$stm .= " WHERE id = ".trim($idBike);
		$stm = str_replace(", WHERE", " WHERE", $stm);

		$stm = $conn->prepare($stm);
		$ret = $stm->execute();

		if ($ret) 
		{
			$resultados = array('id' => $idBike, 'mensagem' => 'Bicicleta atualizada');
		}
		else {
			$resultados = array('mensagem' => $stm->errorInfo());
		}
		
		return $resultados;
	}


	public function atualizarTudo($idBike = NULL, $idCor = NULL, $idMaterial = NULL, $idMarcaModelo = NULL, $idLoja = NULL)
	{
		global $conn;

		$stm = "UPDATE tb_bicicleta SET descricao = '".utf8_decode(addslashes(strtoupper(tirarAcentos(trim($this->descricao)))))."', id_cor = ".trim($idCor).", id_material = ".trim($idMaterial).", id_marca_modelo = ".trim($idMarcaModelo).", id_loja = ".trim($idLoja).", valor = ".trim($this->valor)." WHERE id = ".trim($idBike);
		$stm = $conn->prepare($stm);
		$ret = $stm->execute();

		if ($ret) 
		{
			$resultados = array('id' => $idBike, 'mensagem' => 'Bicicleta completamente atualizada');
		}
		else {
			$resultados = array('mensagem' => $stm->errorInfo());
		}
		
		return $resultados;
	}


	public function deletar($idBike = NULL)
	{
		global $conn;

		$stm = "DELETE FROM tb_bicicleta WHERE id = ".$idBike;
		$stm = $conn->prepare($stm);
		$ret = $stm->execute();

		if ($ret) 
		{
			$resultados = array('id' => $idBike, 'mensagem' => 'Bicicleta deletada');
		}
		else {
			$resultados = array('mensagem' => $stm->errorInfo());
		}
		
		return $resultados;
	}
}