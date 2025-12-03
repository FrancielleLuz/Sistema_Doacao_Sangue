<?php
// pet.php (arquivo principal)
include("BDO/pet/pet_especie_select.php");        // define $arrCombo (especies)
include("BDO/pet/pet_tipoSanguineo_select.php"); // define $arrCombo2 (tipos sanguineos gerais)
include("BDO/pet/pet_tutor_select.php");         // define $arrCombo4 (tutores)
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Animal</title>
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
                <div class="col-sm-6"><h2><b>Animal</b></h2></div>
                <div class="col-sm-6">
                    <a href="#" class="adcBtn btn btn-success" data-toggle="modal">
                        <i class="material-icons">&#xE147;</i> <span>Adicionar</span>
                    </a>
                </div>
            </div>
        </div>

        <input class="form-control" id="myInput" type="text" placeholder="Procurar..">

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th width="10%"></th>
                    <th width="10%">Codigo</th>
                    <th width="30%">Nome</th>
                    <th width="10%">Data Nascimento</th>
                    <th width="10%">Sexo</th>
                    <th width="10%">Doador</th>
                    <th width="10%">Espécie</th>
                    <th width="10%">Tipo Sanguíneo</th>
                </tr>
            </thead>
            <tbody id="myTable">
                <?php 
                include("BDO/pet/pet_select.php");
                $result = $stmt->fetchAll();
                foreach ($result as $value) { ?>
                <tr class="trCad">
                    <td>
                        <a href="#" class="editbtn edit" data-toggle="modal"><i class="material-icons" title="Editar">&#xE254;</i></a>
                        <a href="#" class="delbtn delete" data-toggle="modal"><i class="material-icons" title="Excluir">&#xE872;</i></a>
                    </td>
                    <td><?php echo $value['codigo']; ?></td>
                    <td><a href="pet_Comp_Form.php?id=<?php echo $value['codigo']; ?>"><?php echo $value['nome']; ?></a></td>
                    <td><?php echo $value['dtNascimento']; ?></td>
                    <td><?php echo $value['sexo']; ?></td>
                    <td><?php echo $value['doador']; ?></td>
                    <td><?php echo $value['especie']; ?></td>
                    <td><?php echo $value['tipoSanguineo']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- ADICIONAR -->
<div id="addEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formAdicionar">
                <div class="modal-header">
                    <h4 class="modal-title">Adicionar</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nome</label>
                        <input id="salvando_nome" name="nome" type="text" class="form-control" required>

                        <label>Data Nascimento</label>
                        <input id="salvando_dtNascimento" name="dtNascimento" type="text" class="form-control" required>

                        <label>Sexo</label>
                        <select id="salvando_sexo" name="sexo" class="form-control" required>
                            <option value=""></option>
                            <option value="F">Fêmea</option>
                            <option value="M">Macho</option>
                        </select>

                        <label>Doador</label>
                        <select id="salvando_doador" name="doador" class="form-control" required>
                            <option value=""></option>
                            <option value="S">Sim</option>
                            <option value="N">Não</option>
                        </select>

                        <label>Espécie</label>
                        <select id="salvando_especie" name="codEspecie" class="form-control" required>
                            <option value=""></option>
                            <?php foreach ($arrCombo as $value) { ?>
                                <option value="<?php echo $value['codigo']; ?>"><?php echo $value['nome']; ?></option>
                            <?php } ?>
                        </select>

                        <label>Raça</label>
                        <select id="salvando_raca" name="codRaca" class="form-control" required>
                            <option value="">Selecione a espécie primeiro</option>
                        </select>

                        <label>Tipo Sanguíneo</label>
                        <select id="salvando_tipoSanguineo" name="codTipoSanguineo" class="form-control" required>
                            <option value="">Selecione a espécie primeiro</option>
                        </select>

                        <label>Tutor</label>
                        <select id="salvando_tutor" name="codTutor" class="form-control" required>
                            <option value=""></option>
                            <?php foreach ($arrCombo4 as $value) { ?>
                                <option value="<?php echo $value['codigo']; ?>"><?php echo $value['nome']; ?></option>
                            <?php } ?>
                        </select>

                        <label>Comportamento</label>
                        <input id="salvando_comportamento" name="comportamento" type="text" class="form-control" maxlength="200" required>

                        <label>Caracteristica</label>
                        <input id="salvando_caracteristica" name="caracteristica" type="text" class="form-control" maxlength="300" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button id="salvar_cadastro" type="submit" class="btn btn-success">Adicionar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- EDITAR -->
<div id="editEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formEditar">
                <div class="modal-header">
                    <h4 class="modal-title">Editar</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="update_codigo" id="update_codigo">
                    <div class="form-group">
                        <label>Nome</label>
                        <input id="update_nome" name="nome" type="text" class="form-control" required>

                        <label>Data Nascimento</label>
                        <input id="update_dtNascimento" name="dtNascimento" type="text" class="form-control" required>

                        <label>Data Falecimento</label>
                        <input id="update_dtFalecimento" name="dtFalecimento" type="text" class="form-control">

                        <label>Sexo</label>
                        <select id="update_sexo" name="sexo" class="form-control" required>
                            <option value=""></option>
                            <option value="F">Fêmea</option>
                            <option value="M">Macho</option>
                        </select>

                        <label>Doador</label>
                        <select id="update_doador" name="doador" class="form-control" required>
                            <option value=""></option>
                            <option value="S">Sim</option>
                            <option value="N">Não</option>
                        </select>

                        <label>Espécie</label>
                        <select id="update_especie" name="codEspecie" class="form-control" required>
                            <option value=""></option>
                            <?php foreach ($arrCombo as $value) { ?>
                                <option value="<?php echo $value['codigo']; ?>"><?php echo $value['nome']; ?></option>
                            <?php } ?>
                        </select>

                        <label>Raça</label>
                        <select id="update_raca" name="codRaca" class="form-control" required>
                            <option value="">Selecione a espécie primeiro</option>
                        </select>

                        <label>Tipo Sanguíneo</label>
                        <select id="update_tipoSanguineo" name="codTipoSanguineo" class="form-control" required>
                            <option value="">Carregando...</option>
                        </select>

                        <label>Tutor</label>
                        <select id="update_tutor" name="codTutor" class="form-control" required>
                            <option value=""></option>
                            <?php foreach ($arrCombo4 as $value) { ?>
                                <option value="<?php echo $value['codigo']; ?>"><?php echo $value['nome']; ?></option>
                            <?php } ?>
                        </select>

                        <label>Comportamento</label>
                        <input id="update_comportamento" name="comportamento" type="text" class="form-control" maxlength="200" required>

                        <label>Caracteristica</label>
                        <input id="update_caracteristica" name="caracteristica" type="text" class="form-control" maxlength="300" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button id="alterar_cadastro" type="submit" class="btn btn-info">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- EXCLUIR -->
<div id="deleteEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formDelete">
                <div class="modal-header">
                    <h4 class="modal-title">Excluir</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="delete_codigo" id="delete_codigo">
                    <p>Tem certeza de que deseja excluir esses registros?</p>
                    <p class="text-warning"><small>Essa ação não pode ser desfeita.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button id="deletar_cadastro" type="submit" class="btn btn-danger">Excluir</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
$(document).ready(function() {
    // Máscaras de data
    $('#salvando_dtNascimento').mask('00/00/0000');
    $('#update_dtNascimento').mask('00/00/0000');
    $('#update_dtFalecimento').mask('00/00/0000');

    // Formata data do formato YYYY-MM-DD para DD/MM/YYYY
    function formatDateToDisplay(dateStr) {
        if (!dateStr) return '';
        if (/^\d{2}\/\d{2}\/\d{4}$/.test(dateStr)) return dateStr;
        var m = dateStr.match(/^(\d{4})-(\d{2})-(\d{2})/);
        if (m) return m[3] + '/' + m[2] + '/' + m[1];
        return dateStr;
    }

    // Carregar raças baseado na espécie
    function carregarRacas(selectId, codEspecie, selectedRaca = null, callback = null) {
        if (!codEspecie) {
            $(selectId).html('<option value="">Selecione a espécie primeiro</option>');
            if (callback) callback();
            return;
        }
        $.ajax({
            url: 'BDO/pet/pet_raca_select.php',
            method: 'POST',
            data: { codEspecie: codEspecie },
            dataType: 'json',
            success: function(resposta) {
                $(selectId).empty();
                if (resposta && resposta.length > 0) {
                    $(selectId).append('<option value="">Selecione...</option>');
                    resposta.forEach(function(item) {
                        $(selectId).append('<option value="'+item.codigo+'">'+item.nome+'</option>');
                    });
                    if (selectedRaca) {
                        $(selectId).val(selectedRaca);
                    }
                } else {
                    $(selectId).append('<option value="">Nenhuma raça encontrada</option>');
                }
                if (callback) callback();
            },
            error: function(xhr, status, error) {
                console.error('Erro ao carregar raças:', error);
                $(selectId).html('<option value="">Erro ao carregar</option>');
                if (callback) callback();
            }
        });
    }

    // Carregar tipos sanguíneos baseado na espécie
    function carregarTiposSanguineos(selectId, codEspecie, selectedTipo = null, callback = null) {
        if (!codEspecie) {
            $(selectId).html('<option value="">Selecione a espécie primeiro</option>');
            if (callback) callback();
            return;
        }
        $.ajax({
            url: 'BDO/pet/pet_tipoSanguineo_por_especie.php',
            method: 'POST',
            data: { codEspecie: codEspecie },
            dataType: 'json',
            success: function(resposta) {
                $(selectId).empty();
                if (resposta && resposta.length > 0) {
                    $(selectId).append('<option value="">Selecione...</option>');
                    resposta.forEach(function(item) {
                        var label = item.tipoSanguineo ? item.tipoSanguineo : (item.nome ? item.nome : '');
                        $(selectId).append('<option value="'+item.codigo+'">'+label+'</option>');
                    });
                    if (selectedTipo) {
                        $(selectId).val(selectedTipo);
                    }
                } else {
                    $(selectId).append('<option value="">Nenhum tipo sanguíneo encontrado</option>');
                }
                if (callback) callback();
            },
            error: function(xhr, status, error) {
                console.error('Erro ao carregar tipos sanguíneos:', error);
                $(selectId).html('<option value="">Erro ao carregar</option>');
                if (callback) callback();
            }
        });
    }

    // Evento change na espécie do formulário ADICIONAR
    $('#salvando_especie').on('change', function() {
        var cod = $(this).val();
        carregarRacas('#salvando_raca', cod);
        carregarTiposSanguineos('#salvando_tipoSanguineo', cod);
    });

    // Evento change na espécie do formulário EDITAR
    $('#update_especie').on('change', function() {
        var cod = $(this).val();
        carregarRacas('#update_raca', cod);
        carregarTiposSanguineos('#update_tipoSanguineo', cod);
    });

    // Botão ADICIONAR - Abrir modal
    $('.adcBtn').on('click', function(e) {
        e.preventDefault();
        $('#formAdicionar')[0].reset();
        $('#salvando_raca').html('<option value="">Selecione a espécie primeiro</option>');
        $('#salvando_tipoSanguineo').html('<option value="">Selecione a espécie primeiro</option>');
        $('#addEmployeeModal').modal('show');
    });

    // SUBMIT do formulário ADICIONAR
    $('#formAdicionar').on('submit', function(e) {
        e.preventDefault();
        
        var formData = $(this).serialize();
        
        $.ajax({
            url: 'BDO/pet/pet_insert.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'ok') {
                    alert(response.msg);
                    $('#addEmployeeModal').modal('hide');
                    location.reload();
                } else {
                    alert('Erro: ' + response.msg);
                }
            },
            error: function(xhr, status, error) {
                console.error('Erro:', xhr.responseText);
                try {
                    var resposta = JSON.parse(xhr.responseText);
                    alert('Erro: ' + resposta.msg);
                } catch(e) {
                    alert('Erro ao salvar: ' + error);
                }
            }
        });
    });

    // Botão EDITAR - Abrir modal e carregar dados
    $('.editbtn').on('click', function(e) {
        e.preventDefault();
        $('#formEditar')[0].reset();
        $('#update_raca').html('<option value="">Carregando...</option>');
        $('#update_tipoSanguineo').html('<option value="">Carregando...</option>');
        $('#editEmployeeModal').modal('show');

        var $tr = $(this).closest('tr');
        var resultado = $tr.children('td').map(function() { return $(this).text().trim(); }).get();

        $.ajax({
            url: 'BDO/pet/pet_selectConsulta.php',
            type: 'POST',
            data: { codigo: resultado[1] },
            dataType: 'json',
            success: function(obj) {
                if (!obj || !obj[0]) {
                    alert('Registro não encontrado.');
                    return;
                }
                var registro = obj[0];

                // Preenche os campos básicos
                $('#update_codigo').val(registro.codigo);
                $('#update_nome').val(registro.nome);
                $('#update_dtNascimento').val(formatDateToDisplay(registro.dtNascimento));
                $('#update_dtFalecimento').val(formatDateToDisplay(registro.dtFalecimento));
                $('#update_sexo').val(registro.sexo);
                $('#update_doador').val(registro.doador);
                $('#update_comportamento').val(registro.comportamento);
                $('#update_caracteristica').val(registro.caracteristicas);
                $('#update_especie').val(registro.codEspecie);
                $('#update_tutor').val(registro.codTutor);

                // Carrega raças e tipos sanguíneos com os valores selecionados
                carregarRacas('#update_raca', registro.codEspecie, registro.codRaca);
                carregarTiposSanguineos('#update_tipoSanguineo', registro.codEspecie, registro.codTipoSanguineo);
            },
            error: function(xhr, status, error) {
                alert('Erro ao buscar dados: ' + error);
            }
        });
    });

    // SUBMIT do formulário EDITAR
    $('#formEditar').on('submit', function(e) {
        e.preventDefault();
        
        var formData = $(this).serialize();
        
        $.ajax({
            url: 'BDO/pet/pet_update.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'ok') {
                    alert(response.msg);
                    $('#editEmployeeModal').modal('hide');
                    location.reload();
                } else {
                    alert('Erro: ' + response.msg);
                }
            },
            error: function(xhr, status, error) {
                console.error('Erro completo:', xhr.responseText);
                try {
                    var resposta = JSON.parse(xhr.responseText);
                    alert('Erro: ' + resposta.msg);
                } catch(e) {
                    alert('Erro ao salvar: ' + error);
                }
            }
        });
    });

    // Botão EXCLUIR - Abrir modal
    $('.delbtn').on('click', function(e) {
        e.preventDefault();
        $('#deleteEmployeeModal').modal('show');

        var $tr = $(this).closest('tr');
        var resultado = $tr.children('td').map(function() { return $(this).text().trim(); }).get();
        
        // Pega o código do pet (segunda coluna)
        var codigo = resultado[1];
        $('#delete_codigo').val(codigo);
    });

    // SUBMIT do formulário EXCLUIR
    $('#formDelete').on('submit', function(e) {
        e.preventDefault();
        
        var formData = $(this).serialize();
        
        $.ajax({
            url: 'BDO/pet/pet_delete.php',
            type: 'POST',
            data: formData,
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
                console.error('Erro completo:', xhr.responseText);
                try {
                    var resposta = JSON.parse(xhr.responseText);
                    alert('Erro: ' + resposta.msg);
                } catch(e) {
                    alert('Erro ao excluir: ' + error);
                }
            }
        });
    });

    // Filtro de busca na tabela
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