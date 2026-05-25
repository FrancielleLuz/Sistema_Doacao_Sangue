<?php  

include("BDO/etiqueta/etiqueta_select.php");

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
    <h4>Etiqueta de Coleta</h4>
    <p><strong>Lote:</strong> <?php echo $dado['codlot']; ?></p>
    <p><strong>Tipo:</strong> <?php echo $dado['nomeTip']; ?></p>
    <p><strong>Qtd:</strong> <?php echo $dado['qtdcol']; ?> ml</p>
    <p><strong>Validade:</strong> <?php echo $dado['datven']; ?></p>
</div>

</body>
</html>