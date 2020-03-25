<?php
session_start(); 
require_once 'conexao.php';

$c = new Conn();
$id = $_GET['id'];
$sqlDelete = "DELETE FROM usuarios WHERE id = '$id'";
$delete = $c->getConn()->prepare($sqlDelete);
$delete->execute();

if ($delete->rowCount()) {
	header('Location: listarUser.php');

	$_SESSION['msg'] = "USUARIO DELETADO COM SUCESSO!";
	$_SESSION['cor'] = "success";
} else {
	header('Location: listarUser.php');

	$_SESSION['msg'] = "Falha Ao Deletar Usuario!";
	$_SESSION['cor'] = "warning";
}



