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

<div class="container">
    <div class="table-wrapper">

        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
					<h2><b>Registro de Coleta</b></h2>
				</div>
                <div class="col-sm-6">
                    <a href="#" class="adcBtn btn btn-success">
                        <span>Adicionar</span>
                    </a>
                </div>
            </div>
        </div>

        <input class="form-control" id="myInput" placeholder="Procurar..">
		
		<select class="form-control" id="filtroStatus" style="margin-top:10px;">
			<option value="">Todos os Status</option>
			<option value="Disponível">Disponível</option>
			<option value="Utilizada">Utilizada</option>
			<option value="Vencida">Vencida</option>
			<option value="Vence Hoje">Vence Hoje</option>
		</select>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th></th>
                    <th  width="10%">Data</th>
                    <th  width="30%">Tipo Sanguíneo</th>
                    <th  width="10%">Qtd</th>
                    <th  width="10%">Validade</th>
                    <th  width="20%">Lote</th>
					<th  width="20%">Status</th>
					<th  width="10%">Etiqueta</th>
                </tr>
            </thead>
			
            <tbody id="myTable">
                <?php 
                include("BDO/doacao_entrada/doacao_entrada_select.php");
                foreach ($stmt->fetchAll() as $value) { ?>
                    <tr class="trCad">
                        <!-- ================= BOTÕES ================= -->
						<td>
                            <a href="#" class="delbtn delete" data-toggle="modal"><i class="material-icons" title="Excluir">&#xE872;</i></a>
                        </td>

						
						<td width="10%"><a href="doacao_entrada_Comp_Form.php?id=<?php echo $value['codigo']; ?>"><?php echo formatarDataBR($value['datent']); ?></a></td>
						
                        <td width="30%"><?php echo $value['nomeTip']; ?></td>
						<td width="10%"><?php echo $value['qtdcol']; ?> ml</td>
                        <td width="10%"><?php echo formatarDataBR($value['datven']); ?></td>
                        <td width="20%"><?php echo $value['codlot']; ?></td>
						<td width="20%" style="
							color: <?php 
								echo ($value['status'] == 'Disponível') ? 'green' :
									 (($value['status'] == 'Vencida') ? 'red' :
									 (($value['status'] == 'Vence Hoje') ? 'orange' :
									 (($value['status'] == 'Utilizada') ? 'blue' : 'black')));
							?>">
							<?php echo $value['status']; ?>
						</td>
						<!-- ✅ BOTÃO ETIQUETA (AGORA CORRETO) -->
						<td width="10%">
							<?php if ($value['status'] == 'Disponível') { ?>
								<a href="etiqueta.php?id=<?php echo $value['codigo']; ?>" 
								   target="_blank" 
								   class="btn btn-info btn-sm">
									Etiqueta
								</a>
							<?php } ?>
						</td>
					</tr>
				<?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- ================= MODAL ADD ================= -->
<div id="addModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formAdd">
                <div class="modal-header">
                    <h4>Adicionar Coleta</h4>
                </div>

                <div class="modal-body">

                    <label>Data Coleta</label>
                    <input name="datent" type="date" class="form-control" required>

                    <label>Hora</label>
                    <input name="horent" type="time" class="form-control" required>

                    <label>Animal</label>
                    <select id="codpet" name="codpet" class="form-control" required>
                        <option value="">Selecione</option>
                        <?php 
                        include("BDO/pet/pet_select_combo.php");
                        foreach ($stmt->fetchAll() as $pet) {
                            echo "<option value='{$pet['codigo']}'>{$pet['nome']}</option>";
                        }
                        ?>
                    </select>

                    <label>Tipo Sanguíneo</label>
                    <input id="codtip_nome" class="form-control" readonly>
					<input type="hidden" id="codtip" name="codtip">

                    <label>Quantidade (ml)</label>
                    <input name="qtdcol" type="number" class="form-control" required>

                    <label>Validade</label>
                    <input name="datven" type="date" class="form-control" required>

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
                    <input name="obsdoc" type="text" class="form-control">

                </div>

                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-success" type="submit">Salvar</button>
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
        $('#formAdd')[0].reset();
        $('#codtip').val('');
        $('#addModal').modal('show');
    });

    // BUSCAR TIPO SANGUÍNEO
    $(document).on('change', '#codpet', function(){

        var codPet = $(this).val();

        if (!codPet) {
            $('#codtip').val('');
            return;
        }

        $.ajax({
            url: 'BDO/pet/pet_tipoSanguineo_por_pet.php',
            type: 'POST',
            data: { codPet: codPet },
            dataType: 'json',

            success: function(res){
                console.log('RETORNO:', res);

                if(res.status === 'ok'){
                    $('#codtip_nome').val(res.tipoSanguineo);
					$('#codtip').val(res.codigo);
                } else {
                    $('#codtip').val('');
                }
            },

            error: function(xhr){
                console.log('ERRO AJAX:', xhr.responseText);
                $('#codtip').val('');
            }
        });

    });

    // INSERT
    $('#formAdd').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            url: 'BDO/doacao_entrada/doacao_entrada_insert.php',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',

            success: function(res){
                if(res.status === 'ok'){
                    alert(res.msg);
                    location.reload();
                } else {
                    alert(res.msg);
                }
            },

            error: function(xhr){
                console.log(xhr.responseText);
                alert('Erro ao salvar');
            }
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
            url: 'BDO/doacao_entrada/doacao_entrada_delete.php',
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


	// FILTRANDO PELO STATUS DA BOLSA DE SANGUE
$('#filtroStatus').on('change', function() {

    var statusSelecionado = $(this).val().toLowerCase().trim();

    $('#myTable tr').each(function() {

        var statusLinha = $(this).find('td:eq(6)').text().toLowerCase().trim();

        if (statusSelecionado === "") {
            $(this).show();
        } else if (statusLinha.includes(statusSelecionado)) {
            $(this).show();
        } else {
            $(this).hide();
        }

    });

});


});
</script>

</body>
</html>