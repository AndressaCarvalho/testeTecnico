<?php
require 'include/connect.php'; 
require 'include/functions.php';

class Bike
{
	public $id;
	public $descricao;
	public $id_cor;
	public $id_material;
	public $id_marca_modelo;
	public $id_loja;
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

		$idBike = (empty($idBike)) ? $this->id : $idBike;
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


	public function inserir($desc = NULL, $idCor = NULL, $idMaterial = NULL, $idMarcaModelo = NULL, $idLoja = NULL, $val = NULL)
	{
		global $conn;

		$desc 			= (empty($desc)) ? $this->descricao : $desc;
		$idCor 			= (empty($idCor)) ? $this->id_cor : $idCor;
		$idMaterial 	= (empty($idMaterial)) ? $this->id_material : $idMaterial;
		$idMarcaModelo 	= (empty($idMarcaModelo)) ? $this->id_marca_modelo : $idMarcaModelo;
		$idLoja 		= (empty($idLoja)) ? $this->id_loja : $idLoja;
		$val 			= (empty($val)) ? $this->valor : $val;
		$stm = "INSERT INTO tb_bicicleta (descricao, id_cor, id_material, id_marca_modelo, id_loja, valor) VALUES ('".utf8_decode(addslashes(strtoupper(tirarAcentos(trim($desc)))))."', ".trim($idCor).", ".trim($idMaterial).", ".trim($idMarcaModelo).", ".trim($idLoja).", ".trim($val).")";
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


	public function atualizar($idBike = NULL, $desc = NULL, $idCor = NULL, $idMaterial = NULL, $idMarcaModelo = NULL, $idLoja = NULL, $val = NULL)
	{
		global $conn;

		$idBike 		= (empty($idBike)) ? $this->id : $idBike;
		$desc 			= (empty($desc)) ? $this->descricao : $desc;
		$idCor 			= (empty($idCor)) ? $this->id_cor : $idCor;
		$idMaterial 	= (empty($idMaterial)) ? $this->id_material : $idMaterial;
		$idMarcaModelo 	= (empty($idMarcaModelo)) ? $this->id_marca_modelo : $idMarcaModelo;
		$idLoja 		= (empty($idLoja)) ? $this->id_loja : $idLoja;
		$val 			= (empty($val)) ? $this->valor : $val;

		$stm = "UPDATE tb_bicicleta SET ";
		$desc 			= (!empty($desc)) ? $stm .= " descricao = '".utf8_decode(addslashes(strtoupper(tirarAcentos(trim($desc)))))."' " : "";
		$idCor 			= (!empty($idCor)) ? $stm .= " id_cor = ".trim($idCor)." " : "";
		$idMaterial 	= (!empty($idMaterial)) ? $stm .= " id_material = ".trim($idMaterial)." " : "";
		$idMarcaModelo 	= (!empty($idMarcaModelo)) ? $stm .= " id_marca_modelo = ".trim($idMarcaModelo)." " : "";
		$idLoja 		= (!empty($idLoja)) ? $stm .= " id_loja = ".trim($idLoja)." " : "";
		$val 			= (!empty($val)) ? $stm .= " valor = ".trim($val)." " : "";
		$stm .= " WHERE id = ".trim($idBike);

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


	public function atualizarTudo($idBike = NULL, $desc = NULL, $idCor = NULL, $idMaterial = NULL, $idMarcaModelo = NULL, $idLoja = NULL, $val = NULL)
	{
		global $conn;

		$idBike 		= (empty($idBike)) ? $this->id : $idBike;
		$desc 			= (empty($desc)) ? $this->descricao : $desc;
		$idCor 			= (empty($idCor)) ? $this->id_cor : $idCor;
		$idMaterial 	= (empty($idMaterial)) ? $this->id_material : $idMaterial;
		$idMarcaModelo 	= (empty($idMarcaModelo)) ? $this->id_marca_modelo : $idMarcaModelo;
		$idLoja 		= (empty($idLoja)) ? $this->id_loja : $idLoja;
		$val 			= (empty($val)) ? $this->valor : $val;
		$stm = "UPDATE tb_bicicleta SET descricao = '".utf8_decode(addslashes(strtoupper(tirarAcentos(trim($desc)))))."', id_cor = ".trim($idCor).", id_material = ".trim($idMaterial).", id_marca_modelo = ".trim($idMarcaModelo).", id_loja = ".trim($idLoja).", valor = ".trim($val)." WHERE id = ".trim($idBike);
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