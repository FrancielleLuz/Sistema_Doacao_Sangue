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
    <title>Registro de Doação</title>
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
					<h2><b>Registro de doação</b></h2>
				</div>
                <div class="col-sm-6">
                    <a href="#" class="adcBtn btn btn-success">
                        <span>Adicionar</span>
                    </a>
                </div>
            </div>
        </div>

	<input class="form-control" id="myInput" placeholder="Procurar..">
    
	<table class="table table-striped">
        <thead>
            <tr>
				<th></th>
                <th width="10%">Data</th>
				<th width="20%">Lote</th>             
                <th width="30%">Pet</th>
                <th width="10%">Qtd</th>
                <th width="30%">Veterinário</th>
            </tr>
        </thead>

        <tbody id="myTable">
            <?php 
            include("BDO/doacao_saida/doacao_saida_select.php");
            foreach ($stmt->fetchAll() as $row) { ?>
                <tr class="trCad">
                    <!-- ================= BOTÕES ================= -->
					<td>
						<a href="#" class="delbtn delete" data-toggle="modal"><i class="material-icons" title="Excluir">&#xE872;</i></a>
                    </td>
                    
					<td width="10%"><a href="doacao_saida_Comp_Form.php?id=<?php echo $row['codigo']; ?>"><?php echo date('d/m/Y', strtotime($row['datasaida'])); ?></a></td>
                    
					<td width="20%"><?php echo $row['codlot']; ?></td>
                    <td width="30%"><?php echo $row['nomePet']; ?></td>
                    <td width="10%"><?php echo $row['qtdsaida']; ?></td>
                    <td width="30%"><?php echo $row['nomeVet']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

	</div>
</div>

<!-- MODAL (SEU FORM ADAPTADO) -->
<div id="addModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">

			<form id="formSaida">

			<div class="modal-header">
				<h4>Registrar Saída</h4>
			</div>

			<div class="modal-body">

			<label>Lote</label>
			<select id="codentdoa" name="codentdoa" class="form-control" required>
				<option value="">Selecione</option>
				<?php 
				include("BDO/doacao_saida/doacao_saida_buscar_lote.php");
				foreach ($stmtLote ->fetchAll() as $row) {
					echo "<option value='{$row['codigo']}'>Lote {$row['codlot']}</option>";
				}
				?>
			</select>

			<label>Pet Doador</label>
			<input id="pet" class="form-control" readonly>
			<input type="hidden" id="codpet" name="codpet">

			<label>Tipo</label>
			<input id="tipo" class="form-control" readonly>

			<label>Validade</label>
			<input id="validade" class="form-control" readonly>

			<label>Qtd Coletada</label>
			<input id="qtd" class="form-control" readonly>

			<label>Qtd Saída</label>
			<input name="qtdsaida" class="form-control" required>

			<label>Pet Receptor</label>
			<select name="codpetrec" class="form-control" required>
				<option value="">Selecione</option>
				<?php 
				include("BDO/pet/pet_select_combo.php");
				foreach ($stmt->fetchAll() as $pet) {
					echo "<option value='{$pet['codigo']}'>{$pet['nome']}</option>";
				}
				?>
			</select>

			<label>Veterinário</label>
			<select name="codvet" class="form-control" required>
				<option value="">Selecione</option>
				<?php 
				include("BDO/veterinario/veterinario_select.php");
				foreach ($stmt->fetchAll() as $vet) {
					echo "<option value='{$vet['codigo']}'>{$vet['nome']}</option>";
				}
				?>
			</select>

			<label>Observação</label>
			<input name="obsdoc" class="form-control">

			</div>

			<div class="modal-footer">
				<button class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button class="btn btn-success">Salvar</button>
			</div>

			</form>

		</div>
	</div>
</div>

<!-- ================= MODAL DELETE ================= -->
<div id="deleteModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formDelete">
                <div class="modal-header">
                    <h4>Excluir</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="delete_id" name="codigo">
                    <p>Deseja excluir?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-danger" type="submit">Excluir</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- ================= SCRIPT ================= -->
<script>
$(document).ready(function(){
    // ABRIR MODAL
    $('.adcBtn').on('click', function(e){
        e.preventDefault();
        $('#formSaida')[0].reset();
        $('#codlot').val('');
        $('#addModal').modal('show');
    });
	
	$(document).ready(function(){
		// AJAX carregar dados
		$('#codentdoa').change(function(){

			var cod = $(this).val();

			$.post('BDO/doacao_saida/doacao_saida_buscar_entrada.php',
				{codentdoa: cod},
				function(res){

					if(res.status === 'ok'){
						$('#pet').val(res.pet);
						$('#codpet').val(res.codpet);
						$('#tipo').val(res.tipo);
						$('#validade').val(res.validade);
						$('#qtd').val(res.qtd);

						$("select[name='codpetrec'] option").show();
						$("select[name='codpetrec'] option[value='"+res.codpet+"']").hide();
					}
				},
				'json'
			);
		});

		// insert
		$('#formSaida').submit(function(e){
			e.preventDefault();

			$.post('BDO/doacao_saida/doacao_saida_insert.php',
				$(this).serialize(),
				function(res){
					alert(res.msg);
					if(res.status === 'ok') location.reload();
				},
				'json'
			);
		});
	});
	
	// DELETE
    $(document).on('click', '.delbtn', function(){
        var codigo = $(this).closest('tr').data('id');
        $('#delete_id').val(codigo);
        $('#deleteModal').modal('show');
    });

    $('#formDelete').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            url: 'BDO/doacao_saida/doacao_saida_delete.php',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',

            success: function(res){
                if(res.status === 'ok'){
                    alert(res.msg);
                    location.reload();
                }
            }
        });
    });

});

</script>

<script>
console.log('JS carregou');
</script>

</body>
</html>