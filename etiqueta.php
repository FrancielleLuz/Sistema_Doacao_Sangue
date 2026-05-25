<?php  

include("BDO/etiqueta/etiqueta_select.php");

// Função padrão data BR
function formatarDataBR($data) {
    if (empty($data) || $data == '0000-00-00') return '';
    $dt = DateTime::createFromFormat('Y-m-d', $data);
    return $dt ? $dt->format('d/m/Y') : $data;
}

?>

<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial; }
        .etiqueta {
            width: 300px;
            border: 1px solid #000;
            padding: 10px;
        }
    </style>
</head>
<body onload="window.print()">

	<div class="etiqueta">
		<h3 style="text-align:center;">Banco de Sangue</h3>

		<p><strong>Lote:</strong> <?php echo $dado['codlot']; ?></p>
		<p><strong>Tipo:</strong> <?php echo $dado['nomeTip']; ?></p>

		<p style="font-size:18px;">
			<strong>Qtd: <?php echo $dado['qtdcol']; ?> ml</strong>
		</p>

		<p style="color:red;">
			<strong>Validade: <?php echo formatarDataBR($dado['datven']); ?></strong>
		</p>
		
		<img src="https://api.qrserver.com/v1/create-qr-code/?size=80x80&data=<?php echo $dado['codlot']; ?>">
		
	</div>


</body>
</html>

