<?php

// Função padrão data BR
function formatarDataBR($data) {
    if (empty($data) || $data == '0000-00-00') return '';
    $dt = DateTime::createFromFormat('Y-m-d', $data);
    return $dt ? $dt->format('d/m/Y') : $data;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro de Coleta</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="css/style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
<?php require_once 'NavBar.html';?>

<div class="container mt-4">
<div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
					<h2><b>Estoque de Sangue</b></h2>
				</div>
            </div>
        </div>


    <div class="row">

        <?php 
		
		
		include("BDO/estoque/estoque_select.php");
		$result = $stmt->fetchAll();

		
		foreach ($result as $row): 

            $codtip = $row['codtip'];
			$nome = $row['nome'];
            $qtd = $row['qtd_bolsas'];
            $volume = number_format($row['total_volume'], 2, ',', '.');

            // regra de cores
			if ($qtd <= 2) {
				$classe = "card-critico";
				$status = "CRÍTICO";
			} elseif ($qtd <= 5) {
				$classe = "card-alerta";
				$status = "ATENÇÃO";
			} else {
				$classe = "card-ok";
				$status = "OK";
			}
        ?>

		<div class="col-md-3" style="margin-bottom: 20px;">
			<div class="card-dashboard <?= $classe ?>">
				<div class="card-titulo">🩸 Tipo Sanguíneo: <?= $nome ?></div>
				<div class="card-valor">Bolsas <?= $qtd ?></div>
				<div class="card-sub"><?= $volume ?> ml</div>
				<div class="card-sub"><strong><?= $status ?></strong></div>
			</div>
		</div>

        <?php endforeach; ?>

    </div>

</div>

</body>
</html>