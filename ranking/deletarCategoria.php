<?php
session_start(); 
require_once 'conexao.php';

$c = new Conn();
$id = $_GET['id'];
$sqlDelete = "DELETE FROM categorias WHERE id = '$id'";
$delete = $c->getConn()->prepare($sqlDelete);
$delete->execute();

if ($delete->rowCount()) {
	header('Location: listarCategorias.php');

	$_SESSION['msg'] = "CATEGORIA DELETADA COM SUCESSO!";
	$_SESSION['cor'] = "success";
} else {
	header('Location: listarCategorias.php');

	$_SESSION['msg'] = "Falha Ao Deletar Categoria!";
	$_SESSION['cor'] = "warning";
}



