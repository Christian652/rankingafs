<?php 
require_once "seguranca.php";
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
					<div class="col-sm-12">
						<h1 class="display-4">Cadastrar Alunos No SRTAAFS</h1>
							<div class="card">
								<div class="card-body">
									<form method="POST" action="DAOaluno.php">
										<div class="form-group form-row">
											<div class="col-md-8">
												<label>Nome</label>
												<input type="text" maxlength="100" name="nome" class="form-control form-control-lg" placeholder="digite o nome completo do aluno">	
											</div>
											<div class="col-md-4">
												<label>Curso</label>
												<input type="text" maxlength="120" name="curso" class="form-control form-control-lg" placeholder="digite o curso do aluno">	
											</div>
										</div>
										<div class="form-group form-row">
											<div class="col-md-7">
												<label>Media Geral</label>
												<input type="text" name="media" maxlength="5" class="form-control form-control-lg" placeholder="digite o a media geral do aluno">	
											</div>
											
											<div class="col-md-5">
												<label>Serie</label>
												<select name="serie" class="form-control form-control-lg">
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
												</select>
											</div>
										</div>
										<button class="btn btn-primary" name="btn-cadastrar">Cadastrar</button>
									</form>
								</div>
							</div>			
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