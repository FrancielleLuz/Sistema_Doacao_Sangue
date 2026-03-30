<?php
// Função padrão data BR
function formatarDataBR($data) {
    if (empty($data) || $data == '0000-00-00') return '';
    $dt = DateTime::createFromFormat('Y-m-d', $data);
    return $dt ? $dt->format('d/m/Y') : $data;
}

include("BDO/doacao_entrada/doacao_entrada_select_Composicao.php");
?>




<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detalhes da Coleta</title>
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

	<div class="container">
    <div class="table-wrapper">
	
		<div class="table-title">
			<div class="row">
				<div class="col-sm-6">
					<h2><b>Detalhes da Coleta</b></h2>
				</div>
			</div>
		</div>

    <table class="table table-bordered">

        <tr>
            <th>Data Coleta</th>
            <td><?php echo date('d/m/Y', strtotime($dados['datent'])); ?></td>
        </tr>

        <tr>
            <th>Hora</th>
            <td><?php echo $dados['horent']; ?></td>
        </tr>

        <tr>
            <th>Pet</th>
            <td><?php echo $dados['nomePet']; ?></td>
        </tr>

        <tr>
            <th>Tipo Sanguíneo</th>
            <td><?php echo $dados['nomeTip']; ?></td>
        </tr>

        <tr>
            <th>Quantidade</th>
            <td><?php echo $dados['qtdcol']; ?> ml</td>
        </tr>

        <tr>
            <th>Validade</th>
            <td><?php echo date('d/m/Y', strtotime($dados['datven'])); ?></td>
        </tr>

        <tr>
            <th>Veterinário</th>
            <td><?php echo $dados['nomeVet']; ?></td>
        </tr>

        <tr>
            <th>Lote</th>
            <td><?php echo $dados['codlot']; ?></td>
        </tr>

        <tr>
            <th>Observação</th>
            <td><?php echo $dados['obsdoc']; ?></td>
        </tr>

        <tr>
            <th>Data Registro</th>
			<td><?php echo date('d/m/Y', strtotime($dados['datres'])); ?></td>
        </tr>

        <tr>
            <th>Hora Registro</th>
            <td><?php echo $dados['horres']; ?></td>
        </tr>

    </table>

    <a href="doacao_Entrada_Form.php" class="btn btn-primary">Voltar</a>
</div>
</div>

</body>
</html>