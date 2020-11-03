<?php 
try
{
	$conn = new PDO('mysql: host=locahost; dbname=db_teste_tecnico;', 'root', '');

} catch (PDOException $e)
{
    echo "Erro!: " . $e->getMessage() . "<br/>";
    die();
}