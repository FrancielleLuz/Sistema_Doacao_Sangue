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
    <title>Ficha do Animal</title>

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
                        <h2><b>Ficha do Animal</b></h2>
                    </div>
                </div>
            </div>

            <?php 
				include("BDO/pet/pet_select2.php");
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
                            <input type="text" class="form-control" value="<?php echo formatarDataBR($value['dtNascimento']); ?>" disabled>
                        </div>
                        <div class="divFilha">
                            <label>Data Falecimento</label>
                            <input type="text" class="form-control" value="<?php echo formatarDataBR($value['dtFalecimento']); ?>" disabled>
                        </div>
                    </div>

                    <div class="divPai">
                        <div class="divFilha">
                            <label>Sexo</label>
                            <input type="text" class="inputTres form-control" value="<?php echo htmlspecialchars($value['sexo']); ?>" disabled>
                        </div>
                        <div class="divFilha">
                            <label>Doador</label>
                            <input type="text" class="inputTres form-control" value="<?php echo htmlspecialchars($value['doador']); ?>" disabled>
                        </div>
                        <div class="divFilha">
                            <label>Tipo Sanguíneo</label>
                            <input type="text" class="inputTres form-control" value="<?php echo htmlspecialchars($value['tipoSanguineo']); ?>" disabled>
                        </div>
                    </div>

                    <div class="divPai">
                        <div class="divFilha1">
                            <label>Comportamento</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($value['comportamento']); ?>" disabled>
                        </div>
                    </div>

                    <div class="divPai">
                        <div class="divFilha">
                            <label>Espécie</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($value['especie']); ?>" disabled>
                        </div>
                        <div class="divFilha">
                            <label>Raça</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($value['raca']); ?>" disabled>
                        </div>
                    </div>

                    <div class="divPai">
                        <div class="divFilha1">
                            <label>Tutor</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($value['tutor']); ?>" disabled>
                        </div>
                    </div>

                    <!-- ---------- VACINAS ---------- -->
					<div class="divPai">
						<div class="divFilha1">
							<div class="table-titlefilho">
								<div class="row">
									<div class="col-sm-6"><h2><b>Vacinas</b></h2></div>
									<div class="col-sm-6">
										<a href="#" class="btn btn-success adcVacinaBtn" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Adicionar</span></a>
									</div>
								</div>
							</div>

							<table class="table table-striped table-hover">
								<thead>
									<tr>
										<td width="10%"></td>
										<th width="20%">Data</th>
										<th width="20%">Vacina</th>
										<th width="50%">Observação</th>
									</tr>
								</thead>
								<tbody id="vacinaTable">
									<?php 
										include("BDO/vacina_pet/vacinapet_select.php");
										$rowsVacina = $stmt->fetchAll(PDO::FETCH_ASSOC);
										foreach ($rowsVacina as $v) {
											$id = $v['codigo'] ?? '';
											$dt = $v['dtVacina'] ?? ($v['dtvacina'] ?? '');
											$nomeVac = $v['nomeVacina'] ?? ($v['nome'] ?? '');
											$desc = $v['descricao'] ?? '';
											$codVacina = $v['codVacina'] ?? ($v['codvacina'] ?? '');
											
											echo "<tr data-codigo='{$id}' data-dt='{$dt}' data-codvacina='{$codVacina}' data-nomevacina='".htmlspecialchars($nomeVac, ENT_QUOTES)."' data-desc='".htmlspecialchars($desc, ENT_QUOTES)."'>";
											echo "<td width='5%'>
													<a href='#' class='editVacinaBtn edit'><i class='material-icons' data-toggle='tooltip' title='Editar'>&#xE254;</i></a>
													<a href='#' class='delVacinaBtn delete'><i class='material-icons' data-toggle='tooltip' title='Excluir'>&#xE872;</i></a>
												  </td>";
											echo "<td>".formatarDataBR($dt)."</td>";
											echo "<td>".htmlspecialchars($nomeVac)."</td>";
											echo "<td>".htmlspecialchars($desc)."</td>";
											echo "</tr>";
										}
									?>
								</tbody>
							</table>
						</div>
					</div>
                    <!-- ---------- DOENÇAS ---------- -->
                    <div class="divPai">
                        <div class="divFilha1">
                            <div class="table-titlefilho">
                                <div class="row">
                                    <div class="col-sm-6"><h2><b>Doenças</b></h2></div>
                                    <div class="col-sm-6">
                                        <a href="#" class="btn btn-success adcDoencaBtn" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Adicionar</span></a>
                                    </div>
                                </div>
                            </div>

                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
										<td width="10%">
                                        <th width="20%">Data</th>
                                        <th width="20%">Doença</th>
                                        <th width="50%">Observação</th>
                                    </tr>
                                </thead>
                                <tbody id="doencaTable">
                                    <?php
										include("BDO/doenca_pet/doencapet_select.php");
										$rowsDoenca = $stmt->fetchAll(PDO::FETCH_ASSOC);
										foreach ($rowsDoenca as $d) {
											$id = $d['codigo'] ?? '';
											$dt = $d['dtDoenca'] ?? ($d['dtdoenca'] ?? '');
											$nomeDo = $d['nomeDoenca'] ?? ($d['nome'] ?? '');
											$desc = $d['descricao'] ?? '';
											$codDoenca = $d['codDoenca'] ?? ($d['coddoenca'] ?? '');
											
											echo "<tr data-codigo='{$id}' data-dt='{$dt}' data-coddoenca='{$codDoenca}' data-nomedoenca='".htmlspecialchars($nomeDo, ENT_QUOTES)."' data-desc='".htmlspecialchars($desc, ENT_QUOTES)."'>";
											echo "<td width='5%'>
													<a href='#' class='editDoencaBtn edit'><i class='material-icons' data-toggle='tooltip' title='Editar'>&#xE254;</i></a>
													<a href='#' class='delDoencaBtn delete'><i class='material-icons' data-toggle='tooltip' title='Excluir'>&#xE872;</i></a>
												  </td>";
											echo "<td>".formatarDataBR($dt)."</td>";
											echo "<td>".htmlspecialchars($nomeDo)."</td>";
											echo "<td>".htmlspecialchars($desc)."</td>";
											echo "</tr>";
										}
									?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- ---------- EXAMES ---------- -->
                    <div class="divPai">
                        <div class="divFilha1">
                            <div class="table-titlefilho">
                                <div class="row">
                                    <div class="col-sm-6"><h2><b>Exames</b></h2></div>
                                    <div class="col-sm-6">
                                        <a href="#" class="btn btn-success adcExameBtn" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Adicionar</span></a>
                                    </div>
                                </div>
                            </div>

                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
										<td width="10%">
                                        <th width="20%">Data</th>
                                        <th width="20%">Exame</th>
                                        <th width="50%">Observação</th>
                                    </tr>
                                </thead>
                                <tbody id="exameTable">
                                    <?php
										include("BDO/exame_pet/examepet_select.php");
										$rowsExame = $stmt->fetchAll(PDO::FETCH_ASSOC);
										foreach ($rowsExame as $e) {
											$id = $e['codigo'] ?? '';
											$dt = $e['dtExame'] ?? ($e['dtexame'] ?? '');
											$nomeEx = $e['nomeExame'] ?? ($e['nome'] ?? '');
											$desc = $e['descricao'] ?? '';
											$codExame = $e['codExame'] ?? ($e['codexame'] ?? '');
											
											echo "<tr data-codigo='{$id}' data-dt='{$dt}' data-codexame='{$codExame}' data-nomeexame='".htmlspecialchars($nomeEx, ENT_QUOTES)."' data-desc='".htmlspecialchars($desc, ENT_QUOTES)."'>";
											echo "<td width='5%'>
													<a href='#' class='editExameBtn edit'><i class='material-icons' data-toggle='tooltip' title='Editar'>&#xE254;</i></a>
													<a href='#' class='delExameBtn delete'><i class='material-icons' data-toggle='tooltip' title='Excluir'>&#xE872;</i></a>
												  </td>";
											echo "<td>".formatarDataBR($dt)."</td>";
											echo "<td>".htmlspecialchars($nomeEx)."</td>";
											echo "<td>".htmlspecialchars($desc)."</td>";
											echo "</tr>";
										}
									?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- ---------- HISTÓRICO PESO ---------- -->
                    <div class="divPai">
                        <div class="divFilha1">
                            <div class="table-titlefilho">
                                <div class="row">
                                    <div class="col-sm-6"><h2><b>Histórico Peso</b></h2></div>
                                    <div class="col-sm-6">
                                        <a href="#" class="btn btn-success adcPesoBtn" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Adicionar</span></a>
                                    </div>
                                </div>
                            </div>

                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
										<td width="10%">
                                        <th width="20%">Data</th>
                                        <th width="20%">Peso</th>
                                        <th width="50%">Observação</th>
                                    </tr>
                                </thead>
                                <tbody id="pesoTable">
                                    <?php
                                        include("BDO/peso_pet/pesopet_select.php");
                                        $rowsPeso = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($rowsPeso as $p) {
                                            $id = $p['codigo'] ?? '';
                                            $dt = $p['dtPeso'] ?? '';
                                            $peso = $p['peso'] ?? '';
                                            $desc = $p['descricao'] ?? '';
                                            echo "<tr data-codigo='{$id}' data-dt='{$dt}' data-peso='{$peso}' data-desc='".htmlspecialchars($desc, ENT_QUOTES)."'>";
                                            echo "<td width='5%'>
                                                    <a href='#' class='editPesoBtn edit'><i class='material-icons' data-toggle='tooltip' title='Editar'>&#xE254;</i></a>
                                                    <a href='#' class='delPesoBtn delete'><i class='material-icons' data-toggle='tooltip' title='Excluir'>&#xE872;</i></a>
                                                  </td>";
                                            echo "<td>".formatarDataBR($dt)."</td>";
                                            echo "<td>".htmlspecialchars($peso)."</td>";
                                            echo "<td>".htmlspecialchars($desc)."</td>";
                                            echo "</tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

            <?php } // foreach pet ?>
        </div>
    </div>

<!-- ==================== MODAIS Vacina ==================== -->
<!-- ADD Vacina -->
<div id="addVacinaModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="formVacinaAdd">
				<div class="modal-header"><h4 class="modal-title">Adicionar Vacina</h4><button type="button" class="close" data-dismiss="modal">&times;</button></div>
				<div class="modal-body">
					<input type="hidden" id="codPetVac" value="<?php echo $codPet; ?>">
					<div class="form-group">
						<label>Data</label>
						<input id="vacina_data" type="date" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Vacina</label>
						<select id="vacina_codigo" class="form-control" required>
							<option value="">Selecione</option>
							<?php
								include("BDO/vacina/vacina_select.php");
								$vacinas = $stmt->fetchAll(PDO::FETCH_ASSOC);
								foreach ($vacinas as $vv) {
									echo "<option value='".$vv['codigo']."'>".htmlspecialchars($vv['nome'])."</option>";
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Descrição</label>
						<textarea id="vacina_descricao" class="form-control"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-default" data-dismiss="modal" type="button">Cancelar</button>
					<button class="btn btn-success" type="submit">Salvar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- EDIT Vacina -->
<div id="editVacinaModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="formVacinaEdit">
				<div class="modal-header"><h4 class="modal-title">Editar Vacina</h4><button type="button" class="close" data-dismiss="modal">&times;</button></div>
				<div class="modal-body">
					<input type="hidden" id="edit_vacina_id">
					<input type="hidden" id="edit_vacina_codPet">
					<div class="form-group">
						<label>Data</label>
						<input id="edit_vacina_data" type="date" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Vacina</label>
						<select id="edit_vacina_codigo" class="form-control" required>
							<option value="">Selecione</option>
							<?php
								foreach ($vacinas as $vv) {
									echo "<option value='".$vv['codigo']."'>".htmlspecialchars($vv['nome'])."</option>";
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Descrição</label>
						<textarea id="edit_vacina_descricao" class="form-control"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-default" data-dismiss="modal" type="button">Cancelar</button>
					<button class="btn btn-info" type="submit">Salvar Alteração</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- ==================== MODAIS Doença ==================== -->
<!-- ADD Doenca -->
<div id="addDoencaModal" class="modal fade">
	<div class="modal-dialog"><div class="modal-content">
		<form id="formDoencaAdd">
			<div class="modal-header"><h4 class="modal-title">Adicionar Doença</h4><button type="button" class="close" data-dismiss="modal">&times;</button></div>
			<div class="modal-body">
				<input type="hidden" id="codPetDoenca" value="<?php echo $codPet; ?>">
				<div class="form-group">
					<label>Data</label>
					<input id="doenca_data" type="date" class="form-control" required>
				</div>
				<div class="form-group">
					<label>Doença</label>
					<select id="doenca_codigo" class="form-control" required>
						<option value="">Selecione</option>
						<?php
							include("BDO/doenca/doenca_select.php");
							$doencas = $stmt->fetchAll(PDO::FETCH_ASSOC);
							foreach ($doencas as $dd) echo "<option value='".$dd['codigo']."'>".htmlspecialchars($dd['nome'])."</option>";
						?>
					</select>
				</div>
				<div class="form-group"><label>Descrição</label><textarea id="doenca_descricao" class="form-control"></textarea></div>
			</div>
			<div class="modal-footer"><button class="btn btn-default" data-dismiss="modal" type="button">Cancelar</button><button class="btn btn-success" type="submit">Salvar</button></div>
		</form>
	</div></div>
</div>

<!-- EDIT Doenca -->
<div id="editDoencaModal" class="modal fade">
	<div class="modal-dialog"><div class="modal-content">
		<form id="formDoencaEdit">
			<div class="modal-header"><h4 class="modal-title">Editar Doença</h4><button type="button" class="close" data-dismiss="modal">&times;</button></div>
			<div class="modal-body">
				<input type="hidden" id="edit_doenca_id">
				<input type="hidden" id="edit_doenca_codPet">
				<div class="form-group"><label>Data</label><input id="edit_doenca_data" type="date" class="form-control" required></div>
				<div class="form-group">
					<label>Doença</label>
					<select id="edit_doenca_codigo" class="form-control" required>
						<option value="">Selecione</option>
						<?php foreach ($doencas as $dd) echo "<option value='".$dd['codigo']."'>".htmlspecialchars($dd['nome'])."</option>"; ?>
					</select>
				</div>
				<div class="form-group"><label>Descrição</label><textarea id="edit_doenca_descricao" class="form-control"></textarea></div>
			</div>
			<div class="modal-footer"><button class="btn btn-default" data-dismiss="modal" type="button">Cancelar</button><button class="btn btn-info" type="submit">Salvar Alteração</button></div>
		</form>
	</div></div>
</div>

<!-- ==================== MODAIS Exame ==================== -->
<!-- ADD Exame -->
<div id="addExameModal" class="modal fade">
	<div class="modal-dialog"><div class="modal-content">
		<form id="formExameAdd">
			<div class="modal-header"><h4 class="modal-title">Adicionar Exame</h4><button type="button" class="close" data-dismiss="modal">&times;</button></div>
			<div class="modal-body">
				<input type="hidden" id="codPetExame" value="<?php echo $codPet; ?>">
				<div class="form-group"><label>Data</label><input id="exame_data" type="date" class="form-control" required></div>
				<div class="form-group">
					<label>Exame</label>
					<select id="exame_codigo" class="form-control" required>
						<option value="">Selecione</option>
						<?php
							include("BDO/exame/exame_select.php");
							$exames = $stmt->fetchAll(PDO::FETCH_ASSOC);
							foreach ($exames as $ee) echo "<option value='".$ee['codigo']."'>".htmlspecialchars($ee['nome'])."</option>";
						?>
					</select>
				</div>
				<div class="form-group"><label>Descrição</label><textarea id="exame_descricao" class="form-control"></textarea></div>
			</div>
			<div class="modal-footer"><button class="btn btn-default" data-dismiss="modal" type="button">Cancelar</button><button class="btn btn-success" type="submit">Salvar</button></div>
		</form>
	</div></div>
</div>

<!-- EDIT Exame -->
<div id="editExameModal" class="modal fade">
	<div class="modal-dialog"><div class="modal-content">
		<form id="formExameEdit">
			<div class="modal-header"><h4 class="modal-title">Editar Exame</h4><button type="button" class="close" data-dismiss="modal">&times;</button></div>
			<div class="modal-body">
				<input type="hidden" id="edit_exame_id">
				<input type="hidden" id="edit_exame_codPet">
				<div class="form-group"><label>Data</label><input id="edit_exame_data" type="date" class="form-control" required></div>
				<div class="form-group">
					<label>Exame</label>
					<select id="edit_exame_codigo" class="form-control" required>
						<option value="">Selecione</option>
						<?php foreach ($exames as $ee) echo "<option value='".$ee['codigo']."'>".htmlspecialchars($ee['nome'])."</option>"; ?>
					</select>
				</div>
				<div class="form-group"><label>Descrição</label><textarea id="edit_exame_descricao" class="form-control"></textarea></div>
			</div>
			<div class="modal-footer"><button class="btn btn-default" data-dismiss="modal" type="button">Cancelar</button><button class="btn btn-info" type="submit">Salvar Alteração</button></div>
		</form>
	</div></div>
</div>

<!-- ==================== MODAIS Peso ==================== -->
<!-- ADD Peso -->
<div id="addPesoModal" class="modal fade">
	<div class="modal-dialog"><div class="modal-content">
		<form id="formPesoAdd">
			<div class="modal-header"><h4 class="modal-title">Adicionar Peso</h4><button type="button" class="close" data-dismiss="modal">&times;</button></div>
			<div class="modal-body">
				<input type="hidden" id="codPetPeso" value="<?php echo $codPet; ?>">
				<div class="form-group"><label>Data</label><input id="peso_data" type="date" class="form-control" required></div>
				<div class="form-group"><label>Peso (kg)</label><input id="peso_valor" type="number" step="0.01" class="form-control" required></div>
				<div class="form-group"><label>Descrição</label><textarea id="peso_descricao" class="form-control"></textarea></div>
			</div>
			<div class="modal-footer"><button class="btn btn-default" data-dismiss="modal" type="button">Cancelar</button><button class="btn btn-success" type="submit">Salvar</button></div>
		</form>
	</div></div>
</div>

<!-- EDIT Peso -->
<div id="editPesoModal" class="modal fade">
	<div class="modal-dialog"><div class="modal-content">
		<form id="formPesoEdit">
			<div class="modal-header"><h4 class="modal-title">Editar Peso</h4><button type="button" class="close" data-dismiss="modal">&times;</button></div>
			<div class="modal-body">
				<input type="hidden" id="edit_peso_id">
				<input type="hidden" id="edit_peso_codPet">
				<div class="form-group"><label>Data</label><input id="edit_peso_data" type="date" class="form-control" required></div>
				<div class="form-group"><label>Peso (kg)</label><input id="edit_peso_valor" type="number" step="0.01" class="form-control" required></div>
				<div class="form-group"><label>Descrição</label><textarea id="edit_peso_descricao" class="form-control"></textarea></div>
			</div>
			<div class="modal-footer"><button class="btn btn-default" data-dismiss="modal" type="button">Cancelar</button><button class="btn btn-info" type="submit">Salvar Alteração</button></div>
		</form>
	</div></div>
</div>

<!-- EXCLUIR genérico -->
<div id="deleteEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formDelete">
                <div class="modal-header">
                    <h4 class="modal-title">Excluir</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="delete_id">
                    <input type="hidden" id="delete_tipo">
                    <p>Tem certeza que deseja excluir este registro?</p>
                    <p class="text-warning"><small>Essa ação não pode ser desfeita.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {

    // ==================== VACINAS ====================
    
    // Abrir modal ADICIONAR Vacina
    $('.adcVacinaBtn').on('click', function(e) {
        e.preventDefault();
        $('#formVacinaAdd')[0].reset();
        $('#addVacinaModal').modal('show');
    });

    // SUBMIT Adicionar Vacina
    $('#formVacinaAdd').on('submit', function(e) {
        e.preventDefault();
        
        var codPet = $('#codPetVac').val();
        var codVacina = $('#vacina_codigo').val();
        var dtVacina = $('#vacina_data').val();
        var descricao = $('#vacina_descricao').val();

        $.ajax({
            url: 'BDO/vacina_pet/vacinapet_insert.php',
            type: 'POST',
            data: {
                codPet: codPet,
                codVacina: codVacina,
                dtVacina: dtVacina,
                descricao: descricao
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'ok') {
                    alert(response.msg);
                    $('#addVacinaModal').modal('hide');
                    location.reload();
                } else {
                    alert('Erro: ' + response.msg);
                }
            },
            error: function(xhr, status, error) {
                console.error('Erro:', xhr.responseText);
                alert('Erro ao salvar vacina');
            }
        });
    });

    // Abrir modal EDITAR Vacina
    $(document).on('click', '.editVacinaBtn', function(e) {
        e.preventDefault();
        var $tr = $(this).closest('tr');
        
        var codigo = $tr.data('codigo');
        var dt = $tr.data('dt');
        var codVacina = $tr.data('codvacina');
        var desc = $tr.data('desc');

        $('#edit_vacina_id').val(codigo);
        $('#edit_vacina_data').val(dt);
        $('#edit_vacina_codigo').val(codVacina);
        $('#edit_vacina_descricao').val(desc);
        
        $('#editVacinaModal').modal('show');
    });

    // SUBMIT Editar Vacina
    $('#formVacinaEdit').on('submit', function(e) {
        e.preventDefault();
        
        var codigo = $('#edit_vacina_id').val();
        var codVacina = $('#edit_vacina_codigo').val();
        var dtVacina = $('#edit_vacina_data').val();
        var descricao = $('#edit_vacina_descricao').val();

        $.ajax({
            url: 'BDO/vacina_pet/vacinapet_update.php',
            type: 'POST',
            data: {
                codigo: codigo,
                codVacina: codVacina,
                dtVacina: dtVacina,
                descricao: descricao
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'ok') {
                    alert(response.msg);
                    $('#editVacinaModal').modal('hide');
                    location.reload();
                } else {
                    alert('Erro: ' + response.msg);
                }
            },
            error: function(xhr, status, error) {
                console.error('Erro:', xhr.responseText);
                alert('Erro ao atualizar vacina');
            }
        });
    });

    // Abrir modal EXCLUIR Vacina
    $(document).on('click', '.delVacinaBtn', function(e) {
        e.preventDefault();
        var $tr = $(this).closest('tr');
        var codigo = $tr.data('codigo');
        
        $('#delete_id').val(codigo);
        $('#delete_tipo').val('vacina');
        $('#deleteEmployeeModal').modal('show');
    });

    // ==================== DOENÇAS ====================
    
    // Abrir modal ADICIONAR Doença
    $('.adcDoencaBtn').on('click', function(e) {
        e.preventDefault();
        $('#formDoencaAdd')[0].reset();
        $('#addDoencaModal').modal('show');
    });

    // SUBMIT Adicionar Doença
    $('#formDoencaAdd').on('submit', function(e) {
        e.preventDefault();
        
        var codPet = $('#codPetDoenca').val();
        var codDoenca = $('#doenca_codigo').val();
        var dtDoenca = $('#doenca_data').val();
        var descricao = $('#doenca_descricao').val();

        $.ajax({
            url: 'BDO/doenca_pet/doencapet_insert.php',
            type: 'POST',
            data: {
                codPet: codPet,
                codDoenca: codDoenca,
                dtDoenca: dtDoenca,
                descricao: descricao
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'ok') {
                    alert(response.msg);
                    $('#addDoencaModal').modal('hide');
                    location.reload();
                } else {
                    alert('Erro: ' + response.msg);
                }
            },
            error: function(xhr, status, error) {
                console.error('Erro:', xhr.responseText);
                alert('Erro ao salvar doença');
            }
        });
    });

    // Abrir modal EDITAR Doença
    $(document).on('click', '.editDoencaBtn', function(e) {
        e.preventDefault();
        var $tr = $(this).closest('tr');
        
        var codigo = $tr.data('codigo');
        var dt = $tr.data('dt');
        var codDoenca = $tr.data('coddoenca');
        var desc = $tr.data('desc');

        $('#edit_doenca_id').val(codigo);
        $('#edit_doenca_data').val(dt);
        $('#edit_doenca_codigo').val(codDoenca);
        $('#edit_doenca_descricao').val(desc);
        
        $('#editDoencaModal').modal('show');
    });

    // SUBMIT Editar Doença
    $('#formDoencaEdit').on('submit', function(e) {
        e.preventDefault();
        
        var codigo = $('#edit_doenca_id').val();
        var codDoenca = $('#edit_doenca_codigo').val();
        var dtDoenca = $('#edit_doenca_data').val();
        var descricao = $('#edit_doenca_descricao').val();

        $.ajax({
            url: 'BDO/doenca_pet/doencapet_update.php',
            type: 'POST',
            data: {
                codigo: codigo,
                codDoenca: codDoenca,
                dtDoenca: dtDoenca,
                descricao: descricao
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'ok') {
                    alert(response.msg);
                    $('#editDoencaModal').modal('hide');
                    location.reload();
                } else {
                    alert('Erro: ' + response.msg);
                }
            },
            error: function(xhr, status, error) {
                console.error('Erro:', xhr.responseText);
                alert('Erro ao atualizar doença');
            }
        });
    });

    // Abrir modal EXCLUIR Doença
    $(document).on('click', '.delDoencaBtn', function(e) {
        e.preventDefault();
        var $tr = $(this).closest('tr');
        var codigo = $tr.data('codigo');
        
        $('#delete_id').val(codigo);
        $('#delete_tipo').val('doenca');
        $('#deleteEmployeeModal').modal('show');
    });

    // ==================== EXAMES ====================
    
    // Abrir modal ADICIONAR Exame
    $('.adcExameBtn').on('click', function(e) {
        e.preventDefault();
        $('#formExameAdd')[0].reset();
        $('#addExameModal').modal('show');
    });

    // SUBMIT Adicionar Exame
    $('#formExameAdd').on('submit', function(e) {
        e.preventDefault();
        
        var codPet = $('#codPetExame').val();
        var codExame = $('#exame_codigo').val();
        var dtExame = $('#exame_data').val();
        var descricao = $('#exame_descricao').val();

        $.ajax({
            url: 'BDO/exame_pet/examepet_insert.php',
            type: 'POST',
            data: {
                codPet: codPet,
                codExame: codExame,
                dtExame: dtExame,
                descricao: descricao
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'ok') {
                    alert(response.msg);
                    $('#addExameModal').modal('hide');
                    location.reload();
                } else {
                    alert('Erro: ' + response.msg);
                }
            },
            error: function(xhr, status, error) {
                console.error('Erro:', xhr.responseText);
                alert('Erro ao salvar exame');
            }
        });
    });

    // Abrir modal EDITAR Exame
    $(document).on('click', '.editExameBtn', function(e) {
        e.preventDefault();
        var $tr = $(this).closest('tr');
        
        var codigo = $tr.data('codigo');
        var dt = $tr.data('dt');
        var codExame = $tr.data('codexame');
        var desc = $tr.data('desc');

        $('#edit_exame_id').val(codigo);
        $('#edit_exame_data').val(dt);
        $('#edit_exame_codigo').val(codExame);
        $('#edit_exame_descricao').val(desc);
        
        $('#editExameModal').modal('show');
    });

    // SUBMIT Editar Exame
    $('#formExameEdit').on('submit', function(e) {
        e.preventDefault();
        
        var codigo = $('#edit_exame_id').val();
        var codExame = $('#edit_exame_codigo').val();
        var dtExame = $('#edit_exame_data').val();
        var descricao = $('#edit_exame_descricao').val();

        $.ajax({
            url: 'BDO/exame_pet/examepet_update.php',
            type: 'POST',
            data: {
                codigo: codigo,
                codExame: codExame,
                dtExame: dtExame,
                descricao: descricao
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'ok') {
                    alert(response.msg);
                    $('#editExameModal').modal('hide');
                    location.reload();
                } else {
                    alert('Erro: ' + response.msg);
                }
            },
            error: function(xhr, status, error) {
                console.error('Erro:', xhr.responseText);
                alert('Erro ao atualizar exame');
            }
        });
    });

    // Abrir modal EXCLUIR Exame
    $(document).on('click', '.delExameBtn', function(e) {
        e.preventDefault();
        var $tr = $(this).closest('tr');
        var codigo = $tr.data('codigo');
        
        $('#delete_id').val(codigo);
        $('#delete_tipo').val('exame');
        $('#deleteEmployeeModal').modal('show');
    });

    // ==================== PESO ====================
    
    // Abrir modal ADICIONAR Peso
    $('.adcPesoBtn').on('click', function(e) {
        e.preventDefault();
        $('#formPesoAdd')[0].reset();
        $('#addPesoModal').modal('show');
    });

    // SUBMIT Adicionar Peso
    $('#formPesoAdd').on('submit', function(e) {
        e.preventDefault();
        
        var codPet = $('#codPetPeso').val();
        var dtPeso = $('#peso_data').val();
        var peso = $('#peso_valor').val();
        var descricao = $('#peso_descricao').val();

        $.ajax({
            url: 'BDO/peso_pet/pesopet_insert.php',
            type: 'POST',
            data: {
                codPet: codPet,
                dtPeso: dtPeso,
                peso: peso,
                descricao: descricao
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'ok') {
                    alert(response.msg);
                    $('#addPesoModal').modal('hide');
                    location.reload();
                } else {
                    alert('Erro: ' + response.msg);
                }
            },
            error: function(xhr, status, error) {
                console.error('Erro:', xhr.responseText);
                alert('Erro ao salvar peso');
            }
        });
    });

    // Abrir modal EDITAR Peso
    $(document).on('click', '.editPesoBtn', function(e) {
        e.preventDefault();
        var $tr = $(this).closest('tr');
        
        var codigo = $tr.data('codigo');
        var dt = $tr.data('dt');
        var peso = $tr.data('peso');
        var desc = $tr.data('desc');

        $('#edit_peso_id').val(codigo);
        $('#edit_peso_data').val(dt);
        $('#edit_peso_valor').val(peso);
        $('#edit_peso_descricao').val(desc);
        
        $('#editPesoModal').modal('show');
    });

    // SUBMIT Editar Peso
    $('#formPesoEdit').on('submit', function(e) {
        e.preventDefault();
        
        var codigo = $('#edit_peso_id').val();
        var dtPeso = $('#edit_peso_data').val();
        var peso = $('#edit_peso_valor').val();
        var descricao = $('#edit_peso_descricao').val();

        $.ajax({
            url: 'BDO/peso_pet/pesopet_update.php',
            type: 'POST',
            data: {
                codigo: codigo,
                dtPeso: dtPeso,
                peso: peso,
                descricao: descricao
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'ok') {
                    alert(response.msg);
                    $('#editPesoModal').modal('hide');
                    location.reload();
                } else {
                    alert('Erro: ' + response.msg);
                }
            },
            error: function(xhr, status, error) {
                console.error('Erro:', xhr.responseText);
                alert('Erro ao atualizar peso');
            }
        });
    });

// Abrir modal EXCLUIR Peso
    $(document).on('click', '.delPesoBtn', function(e) {
        e.preventDefault();
        var $tr = $(this).closest('tr');
        var codigo = $tr.data('codigo');
        
        $('#delete_id').val(codigo);
        $('#delete_tipo').val('peso');
        $('#deleteEmployeeModal').modal('show');
    });

    // ==================== EXCLUIR GENÉRICO ====================
    
    // SUBMIT do formulário de exclusão (funciona para todos os tipos)
    $('#formDelete').on('submit', function(e) {
        e.preventDefault();
        
        var codigo = $('#delete_id').val();
        var tipo = $('#delete_tipo').val();
        
        var urlMap = {
            'vacina': 'BDO/vacina_pet/vacinapet_delete.php',
            'doenca': 'BDO/doenca_pet/doencapet_delete.php',
            'exame': 'BDO/exame_pet/examepet_delete.php',
            'peso': 'BDO/peso_pet/pesopet_delete.php'
        };
        
        var url = urlMap[tipo];
        
        if (!url) {
            alert('Tipo de exclusão inválido');
            return;
        }

        $.ajax({
            url: url,
            type: 'POST',
            data: { codigo: codigo },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'ok') {
                    alert(response.msg);
                    $('#deleteEmployeeModal').modal('hide');
                    location.reload();
                } else {
                    alert('Erro: ' + response.msg);
                }
            },
            error: function(xhr, status, error) {
                console.error('Erro:', xhr.responseText);
                alert('Erro ao excluir registro');
            }
        });
    });

});
</script>

</body>

</html>