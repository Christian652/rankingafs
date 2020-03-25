<?php 
require_once "seguranca.php";
require_once "conexao.php";
$c = new Conn();
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
						<h1 class="display-4">Cadastrar Usuarios De ADM No SRTAAFS</h1>
							<div class="card">
								<?php 
								$id = $_GET['id'];
								$sqlSelect = "SELECT * FROM usuarios WHERE id = '$id'";
								$select = $c->getConn()->prepare($sqlSelect);
								$select->execute();

								$result = $select->fetch(PDO::FETCH_ASSOC);
								 ?>
								<div class="card-body">
									<form method="POST" action="DAOuser.php">
										<div class="form-group">
											<label>Email</label>
											<input type="email" maxlength="200" name="email" class="form-control form-control-lg" value="<?php echo $result['email'];?>">	
										</div>

										<div class="form-group">
											<label>Senha</label>
											<input type="text" name="senha" maxlength="100" class="form-control form-control-lg" value="<?php echo $result['senha'];?>">	
											<input type="hidden" name="id" value="<?php echo $result['id'];?>">
										</div>
										<button class="btn btn-primary" name="btn-atualizar">
											Atualizar
										</button>
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