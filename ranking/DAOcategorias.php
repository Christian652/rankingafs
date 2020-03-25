<?php 
require_once "conexao.php";
session_start();

class Categoria
{
	private $nome;
	private $notaMin;
	private $notaMax;
	private $c;

	public function __construct($nome,$notaMin,$notaMax)
	{
		$this->nome = filter_var($nome,FILTER_SANITIZE_SPECIAL_CHARS);
		$this->notaMin = filter_var($notaMin,FILTER_SANITIZE_SPECIAL_CHARS);
		$this->notaMax = filter_var($notaMax,FILTER_SANITIZE_SPECIAL_CHARS);
		$this->c = new Conn();
	}

	public function inserir()
	{
		if (
			!empty($this->nome) &&
			!empty($this->notaMin) && 
			!empty($this->notaMax) 
		) {
			$sql = "INSERT INTO categorias(nome,notaMinima,notaLimite) VALUES ('$this->nome','$this->notaMin','$this->notaMax');";
			$insert = $this->c->getConn()->prepare($sql);
			$insert->execute();

			if ($insert->rowCount()) {
				$_SESSION['msg'] = "CADASTRO BEM SUCEDIDO!!!";
				$_SESSION['cor'] = "success";

				header('Location: cadastrarCategorias.php');
			} else {
				$_SESSION['msg'] = "CADASTRO MAL SUCEDIDO!!!";
				$_SESSION['cor'] = "danger";

				header('Location: cadastrarCategorias.php');
			}	
		} else {
			$_SESSION['msg'] = "o cadastro não pode ocorrer por conta de haver campos vazios ou com valores invalidos pelo sistema!!!";
			$_SESSION['cor'] = "danger";

			header('Location: cadastrarCategorias.php');
		}
	}

	public function update()
	{
		if (
			!empty($this->nome) &&
			!empty($this->notaMin) && 
			!empty($this->notaMax) 
		) {
			$id = $_POST['id'];
			$sql = "UPDATE categorias set nome = '$this->nome', notaMinima = '$this->notaMin', notaLimite = '$this->notaMax' WHERE id = '$id'";
			$update = $this->c->getConn()->prepare($sql);
			$update->execute();

			if ($update->rowCount()) {
				$_SESSION['msg'] = "ATUALIZAÇÃO BEM SUCEDIDA!!!";
				$_SESSION['cor'] = "success";

				header('Location: listarCategorias.php');
			} else {
				$_SESSION['msg'] = "ATUALIZAÇÃO MAL SUCEDIDA!!!";
				$_SESSION['cor'] = "danger";

				header('Location: listarCategorias.php');
			}	
		} else {
			$_SESSION['msg'] = "a atualização não pode ocorrer por conta de haver campos vazios ou com valores invalidos pelo sistema!!!";
			$_SESSION['cor'] = "danger";

			header('Location: listarCategorias.php');
		}
	}
}

if (isset($_POST['btn-cadastrar'])) {
	$Categoria = new Categoria($_POST['nome'],$_POST['notaMinima'],$_POST['notaLimite']);	
	$Categoria->inserir();
} else if (isset($_POST['btn-atualizar'])) {
	$Categoria = new Categoria($_POST['nome'],$_POST['notaMinima'],$_POST['notaLimite']);	
	$Categoria->update();
}