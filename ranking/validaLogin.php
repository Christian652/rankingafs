<?php
require_once "conexao.php"; 
if (isset($_POST['btn-logar'])) {
	if (!empty($_POST['email']) && !empty($_POST['senha'])) {

		$c = new Conn();

		$email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
		$senha = filter_var($_POST['senha'],FILTER_SANITIZE_SPECIAL_CHARS);

		$sqlLogin = "SELECT * FROM usuarios WHERE email='$email' AND senha='$senha' limit '1';";
		$logar = $c->getConn()->prepare($sqlLogin);
		$logar->execute();

		$result = $logar->fetch(PDO::FETCH_ASSOC);
		if(isset($result)):
			$_SESSION['emailLogado'] = $result['email'];
			$_SESSION['senhaLogada'] = $result['senha'];
			$_SESSION['msg'] = "Logado Com Sucesso!!!";
			$_SESSION['cor'] = "success";

			header('Location: dashboard.php');
		else:
			$_SESSION['msg'] = "Não foi encontrado nenhum usuario adm cadastrado com esse email e senha!!!";
			$_SESSION['cor'] = "warning";

			header('Location: index.php');
		endif;
	} else {
		$_SESSION['msg'] = "há campos vazios preencha os campos corretamente!!!";
		$_SESSION['cor'] = "warning";

		header('Location: index.php');
	}
} else {
	echo "o botão não foi cllicado";
}

