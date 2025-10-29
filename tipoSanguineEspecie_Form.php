<?php
include("BDO/tipoSanguineoEspecie/tipoSanguineoEspecie_especie_select.php");
include("BDO/tipoSanguineoEspecie/tipoSanguineoEspecie_tipoSanguineo_select.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tipo Sanguíneo Espécie</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
<?php require_once 'NavBar.html';?>

<div class="container">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6"><h2><b>Ligação do Tipo Sanguíneo X Espécie</b></h2></div>
                <div class="col-sm-6">
                    <a href="" class="adcBtn btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Adicionar</span></a>
                </div>
            </div>
        </div>

        <input class="form-control" id="myInput" type="text" placeholder="Procurar..">

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th width="10%"></th>
                    <th width="10%">Código</th>
                    <th width="45%">Espécie</th>
                    <th width="45%">Tipo Sanguíneo</th>
                </tr>
            </thead>
            <tbody id="myTable">
                <?php 
                include("BDO/tipoSanguineoEspecie/tipoSanguineoEspecie_select.php");
                $result = $stmt->fetchAll();
                foreach ($result as $value) { ?>
                <tr class="trCad">
                    <td width="10%">
                        <a href="" class="editbtn edit" data-toggle="modal"><i class="material-icons" title="Editar">&#xE254;</i></a>
                        <a href="" class="delbtn delete" data-toggle="modal"><i class="material-icons" title="Excluir">&#xE872;</i></a>
                    </td>
                    <td width="10%"><?php echo $value['codigo']; ?></td>
                    <td width="45%"><?php echo $value['especie']; ?></td>
                    <td width="45%"><?php echo $value['tipoSanguineo']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- MODAIS -->

<!-- Adicionar -->
<div id="addEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h4 class="modal-title">Adicionar</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Espécie</label>
                        <select id="salvando_especie" class="form-control" required>
                            <option></option>
                            <?php foreach ($arrCombo as $value) { ?>
                                <option value="<?php echo $value['codigo']; ?>"><?php echo $value['nome']; ?></option>
                            <?php } ?>
                        </select>
                        <label>Tipo Sanguíneo</label>
                        <select id="salvando_tipoSanguineo" class="form-control" required>
                            <option></option>
                            <?php foreach ($arrCombo2 as $value) { ?>
                                <option value="<?php echo $value['codigo']; ?>"><?php echo $value['nome']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                    <input id="salvar_cadastro" type="submit" class="btn btn-success" value="Adicionar">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Editar -->
<div id="editEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h4 class="modal-title">Editar</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="update_codigo">
                    <div class="form-group">
                        <label>Espécie</label>
                        <select id="update_especie" class="form-control" required>
                            <option></option>
                            <?php foreach ($arrCombo as $value) { ?>
                                <option value="<?php echo $value['codigo']; ?>"><?php echo $value['nome']; ?></option>
                            <?php } ?>
                        </select>
                        <label>Tipo Sanguíneo</label>
                        <select id="update_tipoSanguineo" class="form-control" required>
                            <option></option>
                            <?php foreach ($arrCombo2 as $value) { ?>
                                <option value="<?php echo $value['codigo']; ?>"><?php echo $value['nome']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                    <input id="alterar_cadastro" type="submit" class="btn btn-info" value="Salvar">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Excluir -->
<div id="deleteEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h4 class="modal-title">Excluir</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="delete_codigo">
                    <p>Tem certeza de que deseja excluir este registro?</p>
                    <p class="text-warning"><small>Essa ação não pode ser desfeita.</small></p>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                    <input id="deletar_cadastro" type="submit" class="btn btn-danger" value="Excluir">
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {

    // Abrir modal Adicionar
    $('.adcBtn').on('click', function() {
        $('#addEmployeeModal').modal('show');
    });

    // Inserir registro
    $("#salvar_cadastro").on('click', function(e) {
        e.preventDefault();
        $.ajax({
            url: 'BDO/tipoSanguineoEspecie/tipoSanguineoEspecie_insert.php',
            type: 'POST',
            data: {
                codEspecie: $('#salvando_especie').val(),
                codTipoSanguineo: $('#salvando_tipoSanguineo').val()
            },
            success: function(data) {
                $('#addEmployeeModal').modal('hide');
                location.reload();
            },
            error: function(xhr) {
                alert('Erro ao adicionar: ' + xhr.responseText);
            }
        });
    });

    // Abrir modal Editar
    $('.editbtn').on('click', function() {
        $('#editEmployeeModal').modal('show');
        var $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() { return $(this).text(); }).get();
        $.ajax({
            url: 'BDO/tipoSanguineoEspecie/tipoSanguineoEspecie_selectConsulta.php',
            type: 'POST',
            data: { codigo: data[1] },
            success: function(resp) {
                var obj = $.parseJSON(resp);
                $('#update_codigo').val(obj[0].codigo);
                $('#update_especie').val(obj[0].codEspecie);
                $('#update_tipoSanguineo').val(obj[0].codTipoSanguineo);
            },
            error: function(xhr) {
                alert('Erro ao carregar dados para edição: ' + xhr.responseText);
            }
        });
    });

    // Alterar registro
    $("#alterar_cadastro").on('click', function(e) {
        e.preventDefault();
        $.ajax({
            url: 'BDO/tipoSanguineoEspecie/tipoSanguineoEspecie_update.php',
            type: 'POST',
            data: {
                codigo: $('#update_codigo').val(),
                codEspecie: $('#update_especie').val(),
                codTipoSanguineo: $('#update_tipoSanguineo').val()
            },
            success: function(data) {
                $('#editEmployeeModal').modal('hide');
                location.reload();
            },
            error: function(xhr) {
                alert('Erro ao atualizar: ' + xhr.responseText);
            }
        });
    });

    // Excluir registro
    $('.delbtn').on('click', function() {
        $('#deleteEmployeeModal').modal('show');
        var $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() { return $(this).text(); }).get();
        $('#delete_codigo').val(data[1]);
    });

    $("#deletar_cadastro").on('click', function(e) {
        e.preventDefault();
        $.ajax({
            url: 'BDO/tipoSanguineoEspecie/tipoSanguineoEspecie_delete.php',
            type: 'POST',
            data: { codigo: $('#delete_codigo').val() },
            success: function(data) {
                $('#deleteEmployeeModal').modal('hide');
                location.reload();
            },
            error: function(xhr) {
                alert('Erro ao excluir: ' + xhr.responseText);
            }
        });
    });

    // Filtro de pesquisa
    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

});
</script>
</body>
</html>
