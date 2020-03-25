<?php
session_start(); 
require_once 'conexao.php';

$c = new Conn();
$id = $_GET['id'];
$sqlDelete = "DELETE FROM alunos WHERE id = '$id'";
$delete = $c->getConn()->prepare($sqlDelete);
$delete->execute();

if ($delete->rowCount()) {
	header('Location: listar.php');

	$_SESSION['msg'] = "ALUNO DELETADO COM SUCESSO!";
	$_SESSION['cor'] = "success";
} else {
	header('Location: listar.php');

	$_SESSION['msg'] = "Falha Ao Deletar Aluno!";
	$_SESSION['cor'] = "warning";
}



