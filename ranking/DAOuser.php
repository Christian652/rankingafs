<?php 
require_once "conexao.php";
session_start();

class User
{
	private $email;
	private $senha;
	private $c;

	public function __construct($email,$senha)
	{
		$this->email = filter_var($email,FILTER_SANITIZE_EMAIL);
		$this->senha = filter_var($senha,FILTER_SANITIZE_SPECIAL_CHARS);
		$this->c = new Conn();
	}

	public function inserir()
	{
		if (!empty($this->email) && !empty($this->senha)) {
			$sql = "INSERT INTO usuarios (email,senha) VALUES ('$this->email','$this->senha')";
			$insert = $this->c->getConn()->prepare($sql);
			$insert->execute();

			if ($insert->rowCount()) {
				$_SESSION['msg'] = "CADASTRO BEM SUCEDIDO!!!";
				$_SESSION['cor'] = "success";

				header('Location: cadastrarUser.php');
			} else {
				$_SESSION['msg'] = "CADASTRO MAL SUCEDIDO!!!";
				$_SESSION['cor'] = "danger";

				header('Location: cadastrarUser.php');
			}	
		} else {
			$_SESSION['msg'] = "o cadastro não pode ocorrer por conta de haver campos vazios ou com valores invalidos pelo sistema!!!";
			$_SESSION['cor'] = "danger";

			header('Location: cadastrarUser.php');
		}
	}

	public function update()
	{
		if (!empty($this->email) && !empty($this->senha)) {
			$id = $_POST['id'];
			$sql = "UPDATE usuarios set email = '$this->email', senha = '$this->senha' WHERE id = '$id'";
			$update = $this->c->getConn()->prepare($sql);
			$update->execute();

			if ($update->rowCount()) {
				$_SESSION['msg'] = "ATUALIZAÇÃO BEM SUCEDIDA!!!";
				$_SESSION['cor'] = "success";

				header('Location: listarUser.php');
			} else {
				$_SESSION['msg'] = "ATUALIZAÇÃO MAL SUCEDIDA!!!";
				$_SESSION['cor'] = "danger";

				header('Location: listarUser.php');
			}	
		} else {
			$_SESSION['msg'] = "a atualização não pode ocorrer por conta de haver campos vazios ou com valores invalidos pelo sistema!!!";
			$_SESSION['cor'] = "danger";

			header('Location: listarUser.php');
		}
	}
}

if (isset($_POST['btn-cadastrar'])) {
	$aluno = new User($_POST['email'],$_POST['senha']);	
	$aluno->inserir();
} else if (isset($_POST['btn-atualizar'])) {
	$aluno = new User($_POST['email'],$_POST['senha']);	
	$aluno->update();
}