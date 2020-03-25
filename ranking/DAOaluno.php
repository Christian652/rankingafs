<?php 
require_once "conexao.php";
session_start();

class Aluno
{
	private $nome;
	private $curso;
	private $serie;
	private $categoria;
	private $media;
	private $c;

	public function __construct($nome,$serie,$curso,$media)
	{
		$this->nome = filter_var($nome,FILTER_SANITIZE_SPECIAL_CHARS);
		$this->serie = filter_var($serie,FILTER_SANITIZE_NUMBER_INT);
		$this->curso = filter_var($curso,FILTER_SANITIZE_SPECIAL_CHARS);
		$this->media = filter_var($media,FILTER_SANITIZE_SPECIAL_CHARS);
		$this->c = new Conn();
		$this->setCategoria();
	}

	public function inserir()
	{
		if (
			!empty($this->nome) &&
			!empty($this->serie) && 
			!empty($this->curso) && 
			!empty($this->media) && 
			!empty($this->categoria)
		) {
			$sql = "INSERT INTO alunos(nome,serie,curso,media,categoria) VALUES ('$this->nome','$this->serie','$this->curso',$this->media,$this->categoria)";
			$insert = $this->c->getConn()->prepare($sql);
			$insert->execute();

			if ($insert->rowCount()) {
				$_SESSION['msg'] = "CADASTRO BEM SUCEDIDO!!!";
				$_SESSION['cor'] = "success";

				header('Location: cadastrar.php');
			} else {
				$_SESSION['msg'] = "CADASTRO MAL SUCEDIDO!!!";
				$_SESSION['cor'] = "danger";

				header('Location: cadastrar.php');
			}	
		} else {
			$_SESSION['msg'] = "o cadastro não pode ocorrer por conta de haver campos vazios ou com valores invalidos pelo sistema!!!";
			$_SESSION['cor'] = "danger";

			header('Location: cadastrar.php');
		}
	}

	public function update()
	{
		if (
			!empty($this->nome) &&
			!empty($this->serie) && 
			!empty($this->curso) && 
			!empty($this->media) && 
			!empty($this->categoria)
		) {
			$id = $_POST['id'];
			$sql = "UPDATE alunos set 
			 nome = '$this->nome',
			 serie = '$this->serie', 
			 curso = '$this->curso', 
			 media = '$this->media', 
			 categoria = '$this->categoria' 
			 WHERE id = '$id'";
			 
			$update = $this->c->getConn()->prepare($sql);
			$update->execute();

			if ($update->rowCount()) {
				$_SESSION['msg'] = "ATUALIZAÇÃO BEM SUCEDIDA!!!";
				$_SESSION['cor'] = "success";

				header('Location: listar.php');
			} else {
				$_SESSION['msg'] = "ATUALIZAÇÃO MAL SUCEDIDA!!!";
				$_SESSION['cor'] = "danger";

				header('Location: listar.php');
			}	
		} else {
			$_SESSION['msg'] = "a atualização não pode ocorrer por conta de haver campos vazios ou com valores invalidos pelo sistema!!!";
			$_SESSION['cor'] = "danger";

			header('Location: cadastrar.php');
		}
	}

	private function setCategoria()
	{
		if (!empty($this->media)) {
			$sqlSelect = "SELECT * FROM categorias";
			$select = $this->c->getConn()->prepare($sqlSelect);
			$select->execute();
//ENQUANTO HOUVER REGISTROS ELE VERIFICA COM UM IF SE A MEDIA SE CLASSIFICA NA CATEGORIA DO REGISTRO ATUAL PELA NOTA MINIMA E LIMITE DA CATEGORIA POR MEIO DE UM SELECT
			while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
				if ($this->media >= $row['notaMinima'] && $this->media <= $row['notaLimite']) {
					$this->categoria = $row['id'];
				}
			}
		} else {
			$_SESSION['msg2'] = "<br>ocorreu um erro ao processar a categoria por conta de o campo de media estar vazio!!!";
			$_SESSION['cor'] = "danger";

			header('Location: dashboard.php');	
		}
	}
}

if (isset($_POST['btn-cadastrar'])) {
	$aluno = new Aluno($_POST['nome'],$_POST['serie'],$_POST['curso'],$_POST['media']);	
	$aluno->inserir();
} else if (isset($_POST['btn-atualizar'])) {
	$aluno = new Aluno($_POST['nome'],$_POST['serie'],$_POST['curso'],$_POST['media']);	
	$aluno->update();
}