<?php 
$codPet = $_GET['id'];

// Função para converter data do formato YYYY-MM-DD para DD/MM/YYYY
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
    <title>Ficha do Tutor</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link href="css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Merienda+One" rel="stylesheet">
</head>

<body>
    <?php require_once 'NavBar.html';?>

    <div class="container">
        <div class="table-wrapper">

            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2><b>Ficha do Tutor</b></h2>
                    </div>
                </div>
            </div>

            <?php 
				include("BDO/tutor/tutor_select2.php");
                $result = $stmt->fetchAll();
                foreach ($result as $value) {                 
            ?>

            <div class="modal-body">
                <div class="form-group">
                    <div class="divPai">
                        <div class="divFilha1">
                            <label>Nome</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($value['nome']); ?>" disabled>
                        </div>
                    </div>

                    <div class="divPai">
                        <div class="divFilha">
                            <label>Data Nascimento</label>
                            <input type="text" class="form-control" value="<?php echo formatarDataBR($value['dtnascimento']); ?>" disabled>
                        </div>
                        <div class="divFilha">
                            <label>CPF</label>
                            <input type="text" class="form-control" value="<?php echo formatarDataBR($value['cpf']); ?>" disabled>
                        </div>
						<div class="divFilha">
                            <label>Telefone</label>
                            <input type="text" class="inputTres form-control" value="<?php echo htmlspecialchars($value['telefone']); ?>" disabled>
                        </div>
                    </div>

                    <div class="divPai">
                        <div class="divFilha">
                            <label>E-mail</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($value['email']); ?>" disabled>
                        </div>
                    </div>
					
                    <div class="divPai">
                        <div class="divFilha">
                            <label>CEP</label>
                            <input type="text" class="inputTres form-control" value="<?php echo htmlspecialchars($value['cep']); ?>" disabled>
                        </div>
                        <div class="divFilha">
                            <label>Rua</label>
                            <input type="text" class="inputTres form-control" value="<?php echo htmlspecialchars($value['rua']); ?>" disabled>
                        </div>
						<div class="divFilha">
                            <label>Complemento</label>
                            <input type="text" class="inputTres form-control" value="<?php echo htmlspecialchars($value['complemento']); ?>" disabled>
                        </div>
						<div class="divFilha">
                            <label>Bairro</label>
                            <input type="text" class="inputTres form-control" value="<?php echo htmlspecialchars($value['bairro']); ?>" disabled>
                        </div>
						<div class="divFilha">
                            <label>Cidade</label>
                            <input type="text" class="inputTres form-control" value="<?php echo htmlspecialchars($value['cidade']); ?>" disabled>
                        </div>
						<div class="divFilha">
                            <label>Estado</label>
                            <input type="text" class="inputTres form-control" value="<?php echo htmlspecialchars($value['estado']); ?>" disabled>
                        </div>
                    </div>

                    <!-- ---------- Animais ---------- -->
					<div class="divPai">
						<div class="divFilha1">
							<div class="table-titlefilho">
								<div class="row">
									<div class="col-sm-6"><h2><b>Animais</b></h2></div>
								</div>
							</div>

							<table class="table table-striped table-hover">
								<thead>
									<tr>
										<th width="60%">Nome</th>
										<th width="20%">Espécie</th>
										<th width="20%">Doador?</th>
									</tr>
								</thead>
								<tbody id="AnimalTable">
									<?php 
										include("BDO/tutor/tutor_pet.php");
										$rowsVacina = $stmt->fetchAll(PDO::FETCH_ASSOC);
										foreach ($rowsVacina as $v) {
											$id = $v['codigo'] ?? '';
											$pet = $v['pet'] ?? ($v['pet'] ?? '');
											$doador = $v['doador'] ?? ($v['doador'] ?? '');
											$especie = $v['especie'] ?? ($v['especie'] ?? '');
											echo "<td>".htmlspecialchars($pet)."</td>";
											echo "<td>".htmlspecialchars($especie)."</td>";
											echo "<td>".htmlspecialchars($doador)."</td>";
											echo "</tr>";
										}
									?>
								</tbody>
							</table>
						</div>
					</div>
            <?php }?>
        </div>
    </div>

</script>

</body>

</html>