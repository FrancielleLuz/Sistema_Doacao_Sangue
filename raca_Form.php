<?php
include("BDO/raca/raca_especie_select.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Raça</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Merienda+One" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

</head>

<body>
    <?php require_once 'NavBar.html';?>

    <div class="container">
        <div class="table-wrapper">


            <!-- Inicio  - Informações Top da tela -->
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2><b>Raça</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="" class="adcBtn btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Adicionar</span></a>
                    </div>
                </div>
            </div>

            <input class="form-control" id="myInput" type="text" placeholder="Procurar..">
            <!-- Fim  - Informações Top da tela -->

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th width="10%">
                            <p>
                        </th>
                        <th width="10%">Código</th>
                        <th width="45%">Nome</th>
                        <th width="55%">Espécie</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    <?php 
                	 include("BDO/raca/raca_select.php");
                     $result = $stmt->fetchAll();
                     foreach ($result as $value) {                 
                    ?>
                    <tr class="trCad">
                        <td width="10%">
                            <!-- Botão de EDITAR -->
                            <a href="" class="editbtn edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Editar">&#xE254;</i></a>

                            <!-- Botão de EXCLUIR -->
                            <a href="" class="delbtn delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Excluir">&#xE872;</i></a>
                        </td>
                        <td width="10%"><?php echo $value['codigo']; ?></td>
                        <td width="45%"><?php echo $value['nome']; ?></td>
                        <td width="45%"><?php echo $value['especie']; ?></td>
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
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Adicionar</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nome</label>
                            <input id="salvando_nome" type="text" class="form-control" required>
                            

                            <label>Espécie</label>

                           <select id="salvando_especie" class="form-control" required>
                                <option></option>
                                <?php foreach ($arrCombo as $value) { ?>
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



    <!-- ALTERAR -->
    <div id="editEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Editar</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="update_codigo" id="update_codigo">
                        <div class="form-group">
                            <label>Nome</label>
                            <input id="update_nome" type="text" class="form-control" required>
                            <label>Espécie</label>
                            <select id="update_especie" class="form-control" required>
                                <option></option>
                                <?php foreach ($arrCombo as $value) { ?>
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



    <!-- EXCLUIR -->
    <div id="deleteEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Excluir</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="delete_codigo" id="delete_codigo">
                        <p>Tem certeza de que deseja excluir esses registros?</p>
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
    <?php 
function Mask($mask,$str){

    $str = str_replace(" ","",$str);

    for($i=0;$i<strlen($str);$i++){
        $mask[strpos($mask,"#")] = $str[$i];
    }

    return $mask;
}

?>

    <!-- ********************************* SCRIPT *******************************************  -->
    <script type="text/javascript">
        $(document).ready(function() {

            //Botão Adicionar
            $('.adcBtn').on('click', function() {
                $('#addEmployeeModal').modal('show');
            });

            //Botão Editar
            $('.editbtn').on('click', function() {

                $('#editEmployeeModal').modal('show');

                $tr = $(this).closest('tr');
                var resultado = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                $.ajax({
                    url: 'BDO/raca/raca_selectConsulta.php',
                    type: 'POST',
                    data: {
                        codigo: resultado[1]
                    },
                    success: function(data) {
                        var obj = $.parseJSON(data);
                        $('#update_codigo').val(obj[0].codigo);
                        $('#update_nome').val(obj[0].nome);
                        $('#update_especie').val(obj[0].especie);
                    },
                    error: function(data) {
                        alert(data);
                    }
                });
            });

            //Botão Excluir
            $('.delbtn').on('click', function() {

                $('#deleteEmployeeModal').modal('show');

                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                $('#delete_codigo').val(data[1]);
            });

            // Inicio - Inserindo informação no Banco
            $("#salvar_cadastro").on('click', function() {
                var select = document.getElementById('salvando_especie');
                var valueEspecie = select.options[select.selectedIndex].value;
                $.ajax({
                    url: 'BDO/raca/raca_insert.php',
                    type: 'POST',
                    data: {
                        nome: $("#salvando_nome").val(),
                        especie: valueEspecie,
                    },
                    success: function(data) {
                        $("#addEmployeeModal").html(data);
                    },
                    error: function(data) {
                        alert(data);
                    }
                });
            });
            // Fim - Inserindo informação no Banco

            // Inicio - Alterando informação no Banco
            $("#alterar_cadastro").on('click', function() {
                var select = document.getElementById('update_especie');
                var valueEspecie = select.options[select.selectedIndex].value;
                $.ajax({
                    url: 'BDO/raca/raca_update.php',
                    type: 'POST',
                    data: {
                        codigo: $('#update_codigo').val(),
                        nome: $('#update_nome').val(),
                        especie: valueEspecie
                    },
                    success: function(data) {
                        $("#editEmployeeModal").html(data);
                    },
                    error: function(data) {
                        alert(data);
                    }
                });
            });
            // Fim - Alterando informação no Banco

            // Inicio - Excluindo informação no Banco
            $("#deletar_cadastro").on('click', function() {
                $.ajax({
                    url: 'BDO/raca/raca_delete.php',
                    type: 'POST',
                    data: {
                        codigo: $("#delete_codigo").val()
                    },
                    success: function(data) {
                        $("#deleteEmployeeModal").html(data);
                    },
                    error: function(data) {
                        alert(data);
                    }
                });

            });
            // Fim - Excluindo informação no Banco
        });

        //Inicio - Procurar
        $(document).ready(function() {
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
        //Fim - Procurar

    </script>
</body>

</html>