<?php
 session_start(); 
 require_once "conexao.php";

 $c = new Conn();
 $sqlAll = "select alunos.id,alunos.nome,alunos.curso,alunos.serie,categorias.nome as categ,alunos.media from alunos
inner join categorias on alunos.categoria = categorias.id
WHERE alunos.categoria = categorias.id order by alunos.serie ,categorias.notaMinima desc, alunos.media desc;";
$selectAll = $c->getConn()->prepare($sqlAll);
$selectAll->execute();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta charset="UTF-8">
	<title>Pagina Inicial Ranking AFS</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="navbar navbar-dark bg-success navbar-expand-lg fixed-top">
		<a href="index.php" class="navbar-brand">SRAAFS</a>

		<button class="navbar-toggler" data-toggle="collapse" data-target="#menu">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse justify-content-end" id="menu">
			<ul class="navbar-nav nav px-md-5">
				<li class="nav-item">
					<a href="index.php" class="nav-link">Home</a>
				</li>
				<li class="nav-item">
					<a href="#login" class="nav-link" data-toggle="modal">Login</a>
				</li>
			</ul>
		</div>
	</div>

	<div class="container" style="margin-top: 5%;">
		<div class="row">
			<?php if(isset($_SESSION['msg']) && isset($_SESSION['cor'])): ?>
			<div class="col-12">
				<div class="alert alert-dismissible fade show alert-<?php echo $_SESSION['cor'];?>" role="alert">
					<?php echo $_SESSION['msg']; ?>
					<button class="close" data-dismiss="alert">
						<span>&times;</span>
					</button>
				</div>
			</div>
			<?php
			session_unset();
			 endif; 
			 ?>
			<div class="col-12">
				<h1 class="display-4 text-center">Ranking De Alunos AFS</h1>
			</div>
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						Alunos 2019
					</div>

					<table class="table table-bordered m-0">
						<thead class="bg-success text-white p-0">
							<th class="py-1">Nome</th>
							<th class="py-1">Curso</th>
							<th class="py-1 text-center">Serie</th>
							<th class="py-1">Categoria</th>
							<th class="py-1">Media Geral</th>
						</thead>
						<tbody>
							<?php 
							while($row1 = $selectAll->fetch(PDO::FETCH_ASSOC)): 
								if ($row1['categ'] == "diamante") {
									$corCategoria = "info";
								} else if ($row1['categ'] == "ouro") {
									$corCategoria = "yellow";
								} else if ($row1['categ'] == "prata") {
									$corCategoria = "secondary";
								} else if ($row1['categ'] == "bronze") {
									$corCategoria = "warning";
								} else {
									$corCategoria = "light";
								}

							?>
							<tr>
								<td><?php echo $row1['nome']; ?></td>
								<td><?php echo $row1['curso']; ?></td>
								<td class="text-center"><?php echo $row1['serie']."° ano"; ?></td>
								<td class="table-<?php echo $corCategoria;?>"><?php echo $row1['categ']; ?></td>
								<td><?php echo $row1['media']; ?></td>
							</tr>
							<?php endwhile; ?>
						</tbody>
					</table>

					<div class="card-footer py-1">
						<ol class="pagination justify-content-center m-0">
							<li class="page-item"><a href="#" class="page-link">Prev</a></li>
							<li class="page-item"><a href="#" class="page-link">1</a></li>
							<li class="page-item"><a href="#" class="page-link">2</a></li>
							<li class="page-item"><a href="#" class="page-link">3</a></li>
							<li class="page-item"><a href="#" class="page-link">4</a></li>
							<li class="page-item"><a href="#" class="page-link">5</a></li>
							<li class="page-item"><a href="#" class="page-link">Prox</a></li>
						</ol>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="login">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12">
							<div class="card m-0 p-0">
								<div class="card-header">
									Login SRAFS
								</div>
								<div class="card-body">
									<form action="validaLogin.php" method="POST">
										<div class="form-group">
											<label>Email</label>
											<input type="text" name="email" class="form-control form-control-lg" placeholder="digite aqui seu email">
										</div>

										<div class="form-group">
											<label>Senha</label>
											<input type="text" name="senha" class="form-control form-control-lg" placeholder="digite aqui sua senha">
										</div>

										<button class="btn btn-primary px-5" name="btn-logar">Login</button>
										<a href="index.php" class="btn btn-secondary">Voltar</a>
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
</body>
</html>