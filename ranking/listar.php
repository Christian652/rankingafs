<?php 
require_once "seguranca.php";
require_once "conexao.php";
$c = new Conn();
$sqlSelect = "select alunos.id,alunos.nome,alunos.curso,alunos.serie,categorias.nome as categ,alunos.media from alunos
inner join categorias on alunos.categoria = categorias.id
WHERE alunos.categoria = categorias.id order by categorias.notaMinima desc, alunos.media desc;
";
$select = $c->getConn()->prepare($sqlSelect);
$select->execute();
 ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body style="padding-top: 1px;">
	<nav class="navbar navbar-expand navbar-dark bg-dark">

	  <a class="sidebar-toggle text-light mr-3" id="btn-toggle">
	  	<span class="navbar-toggler-icon"></span>
	  </a>
	  <a class="navbar-brand" href="index.html">SRAAFS</a>
	</nav>
	<div class="d-flex">
		<nav class="sidebar" id="menu-lateral">
			<ul class="list-unstyled">
				<li><a href="dashboard.php">Home</a></li>
				<li><a href="cadastrar.php">Cadastrar Aluno</a></li>
				<li><a href="listar.php">Listar Alunos</a></li>
				<li><a href="cadastrarCategorias.php">Cadastrar Categoria</a></li>
				<li><a href="listarCategorias.php">Listar Categorias</a></li>
				<li><a href="cadastrarUser.php">Cadastrar Administrador</a></li>
				<li><a href="listarUser.php">Usuarios ADM</a></li>
				<li><a href="sair.php">Deslogar</a></li>
			</ul>
		</nav>

		<div class="content p-1 w-100">
			<div class="container">
				<div class="row">
				<?php if(isset($_SESSION['msg']) && isset($_SESSION['cor'])){ ?>
					<div class="col-12">
						<div class="alert alert-dismissible fade show alert-<?php echo $_SESSION['cor'];?>" role="alert">
							<?php echo $_SESSION['msg']; ?>
							<?php 
							if (isset($_SESSION['msg2'])) {
								echo $_SESSION['msg2'];
								unset($_SESSION['msg2']);
							}
							 ?>
							<button class="close" data-dismiss="alert">
								<span>&times;</span>
							</button>
						</div>
					</div>
				<?php 
				unset($_SESSION['msg']);
				unset($_SESSION['cor']);
			} ?>
				</div>

				<div class="row">
					<div class="col">
						<h1 class="display-4">Listar Alunos Cadastrados SRTAAFS</h1>
					</div>
				</div>

				<div class="row">
					<div class="col-12">
						<table class="table table-bordered table-hover">
							<thead>
								<th>Nome</th>
								<th>Série</th>
								<th>Curso</th>
								<th>Media</th>
								<th>Categoria</th>
								<th><button class="btn btn-success btn-block">Edit</button></th>
								<th><button class="btn btn-danger btn-block">Delete</button></th>
							</thead>
							<tbody>
								<?php while($row = $select->fetch(PDO::FETCH_ASSOC)): ?>
								<tr>
									<td><?php echo $row['nome']; ?></td>
									<td><?php echo $row['serie']; ?></td>
									<td><?php echo $row['curso']; ?></td>
									<td><?php echo $row['media']; ?></td>
									<td><?php echo $row['categ']; ?></td>
									<td><a href="update.php?id=<?php echo $row['id'];?>" class="btn btn-success btn-block">Edit</a></td>
									<td><a href="deletar.php?id=<?php echo $row['id'];?>" class="btn btn-danger btn-block">Delete</a></td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	</div>
	
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/navbar.js"></script>
</body>
</html>