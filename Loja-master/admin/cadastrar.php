<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="dist/css/bootstrap.min.css">
</head>

<?php
error_reporting(0);
$nomep = $_POST['nomep'];
$quant = $_POST['quant'];
$valoru = $_POST['valoru'];
$descri = $_POST['descri'];

$dir = "img/";

$sql = "INSERT INTO produtos VALUES (default,'$nomep' , '$quant' , '$valoru' , '$descri')";
$res = mysqli_query($conexao, $sql);

$sqlPg = "SELECT LAST_INSERT_ID()";
$queryPg = mysqli_query($conexao, $sqlPg);

	if ($queryPg) {
	$codPgIndice = mysqli_fetch_row($queryPg);
	$salva = $codPgIndice[0];	

	if ($res) {

		$imagem = $_POST['img'];

	
		if (isset($_FILES['img'])) {

			$ext = strtolower(substr($_FILES['img']['name'],-4));
			$novo_nome = microtime().$ext;

			$sal = move_uploaded_file($_FILES['img']['tmp_name'], $dir.$novo_nome);
			
			if ($sal) {
				echo "otorrinolaringologista";
			}

			$sql_img = "INSERT INTO imagem (id, id_produto, imagem) VALUES (default, '".
              $salva."', '$novo_nome')";
			$queryImg = mysqli_query($conexao, $sql_img);

			//$cat = $_POST['cate'];
			//$sql_cat =  "INSERT INTO categoria (categoria , id_produto) VALUES (default, '".$salva."' , '$cat' );";
			//$queryCat = mysqli_query($conexao, $sql_cat);
			
			//$cores = $_POST['cor'];

			//$sql_cor =  "INSERT INTO cor (cor , id_produto) VALUES ('$cores' , '$id_p');";
			//$querycor = mysqli_query($conexao, $sql_cor);

			if($queryImg){
					echo "Foi"; 
				}

				echo "<script>alert('Cadastrado!!')</script>";
			} else {
				echo "<script>alert('Erro!')</script>";		
			}

}
}

 ?>


<body>

<br><br>
	<div class="container" style="margin-left: 50px;">
		<div class="row">
			<div class="col-md-6">
				<legend>Cadastrar produto</legend>
				<form method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label>Nome do produto</label>
						<input placeholder="Nome do produto" class="form-control" type="text" name="nomep" style="width: 2000px;">
					</div>
					<div class="form-group">
						<label>Valor por unidade</label>
						<div class="input-group col-md-4">
					<input placeholder="Valor unitário" class="form-control" type="number" name="valoru" style="width: 2000px;">
						</div>
					</div>
					<div class="form-group">
						<label>Quantidade</label>
						<div class="input-group col-md-4">
							<input placeholder="Quantidade" class="form-control" type="text" name="quant" style="width: 2000px;">
						</div>
					</div>
						<div class="form-group">
						<label>Descrição</label>
						<textarea class="form-control" placeholder="Descrição" style="max-width: 2000px; min-width: 560px; max-height: 150px; min-height: 100px; width: 2000px;" name="descri" ></textarea>
						</div>
					 <div class="form-group">
						<label>Foto</label>
						<input type="file" name="img">
						</div>
					<div class="form-group">
						<label>Categoria: </label></br>
						<select name="cate" style="width: 2000px; height: 30px;">
							<option>infantil</option>
							<option>PP</option>
							<option>P</option>
							<option>M</option>
							<option>G</option>
							<option>GG</option> 
						    </select></div> </br>
						    <div class="form-group">
							<label>Cor: </label>
							<select name="cor">
							<option>Branco</option>
							<option>Preto</option> 
						</select><br>

					<input class="btn btn-success" value="Cadastrar" type="submit" name="submit" style="width: 500px; margin-left: 150px;">
					<br><br>
				</form>
			</div>
		</div>	
	</div>


</body>
</html>