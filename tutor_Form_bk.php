<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tutor</title>
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


            <!-- Inicio  - Informações Top da tela -->
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2><b>Tutor</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="" class="adcBtn btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Adicionar</span></a>
                    </div>
                </div>
            </div>
            <!-- Fim  - Informações Top da tela -->

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th width="10%">
                            <p>
                        </th>
                        <th width="10%">Código</th>
                        <th width="20%">Nome</th>
                        <th width="15%">CPF</th>
                        <th width="25%">E-mail</th>
                        <th width="20%">Telefone</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                	 include("BDO/tutor/tutor_select.php");
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
                        <td width="20%"><?php echo $value['nome']; ?></td>
                        <td width="10%"><?php echo Mask("###.###.###-##",$value['cpf']).'<BR>'; ?></td>
                        <td width="25%"><?php echo $value['email']; ?></td>
                        <td width="20%"><?php echo Mask("(##) #####-####",$value['telefone']).'<BR>'; ?></td>
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
                            <label>Nome Completo</label>
                            <input id="salvando_nome" type="text" class="form-control" required>
                            <label>CPF</label>
                            <input id="salvando_cpf" type="text" class="form-control" required>
                            <label>Data de Nascimento</label>
                            <input id="salvando_dtnascimento" type="text" class="form-control" required>
                            <label>CEP</label>
                            <input id="salvando_cep" type="text" class="form-control" required>
                            <label>Rua</label>
                            <input id="salvando_rua" type="text" class="form-control" required>
                            <label>Complemento</label>
                            <input id="salvando_complemento" type="text" class="form-control">
                            <label>Bairro</label>
                            <input id="salvando_bairro" type="text" class="form-control" required>
                            <label>Cidade</label>
                            <select id="salvando_cidade" class="form-control" name="cidades" required>
                                <option></option>
                                <?php foreach ($arrCombo as $value) { ?>
									<option value="<?php echo $value['codigo']; ?>"><?php echo $value['cidade']; ?></option>
                                <?php } ?>
                            </select>
                            <label>E-mail</label>
                            <input id="salvando_email" type="text" class="form-control" required>
                            <label>Telefone</label>
                            <input id="salvando_telefone" type="text" class="form-control" required>
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
                            <label>Nome Completo</label>
                            <input id="update_nome" type="text" class="form-control" required>
                            <label>CPF</label>
                            <input id="update_cpf" type="text" class="form-control" required>
                            <label>Data de Nascimento</label>
                            <input id="update_dtnascimento" type="text" class="form-control" required>
                            <label>CEP</label>
                            <input id="update_cep" type="text" class="form-control" required>
                            <label>Rua</label>
                            <input id="update_rua" type="text" class="form-control" required>
                            <label>Complemento</label>
                            <input id="update_complemento" type="text" class="form-control">
                            <label>Bairro</label>
                            <input id="update_bairro" type="text" class="form-control" required>
                            <label>Cidade</label>
                            <select id="update_cidade" class="form-control" required>
                                <option></option>
                                <?php foreach ($arrCombo as $value) { ?>
                                <option value="<?php echo $value['codigo']; ?>"><?php echo $value['cidade']; ?></option>
                                <?php } ?>
                            </select>
                            <label>E-mail</label>
                            <input id="update_email" type="text" class="form-control" required>
                            <label>Telefone</label>
                            <input id="update_telefone" type="text" class="form-control" required>
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

            //Botão Editar - carregando informações na tela
            $('.editbtn').on('click', function() {

                $('#editEmployeeModal').modal('show');

                $tr = $(this).closest('tr');
                var resultado = $tr.children("td").map(function() {
                    return $(this).text().trim();
                }).get();

                $.ajax({
                    url: 'BDO/tutor/tutor_selectConsulta.php',
                    type: 'POST',
                    data: {
                        codigo: resultado[1]
                    },
                    success: function(data) {
                        var obj = $.parseJSON(data);
						
                        $('#update_codigo').val(obj[0].codigo);
                        $('#update_nome').val(obj[0].nome);
                        $('#update_cpf').val(obj[0].cpf);
                        $('#update_dtnascimento').val(obj[0].dtnascimento);
                        $('#update_cep').val(obj[0].cep);
                        $('#update_rua').val(obj[0].rua);
                        $('#update_complemento').val(obj[0].complemento);
                        $('#update_bairro').val(obj[0].bairro);
						
						// Seleciona a cidade correta no select
						$('#update_cidade').val(obj[0].cidadeestado).prop('selected', true);
                        //$('#update_cidade').val(obj[0].cidadeestado);
						
                        $('#update_email').val(obj[0].email);
                        $('#update_telefone').val(obj[0].telefone);
                    },
                    error: function(data) {
                        alert('Erro ao carregar os dados do tutor.');
						console.error(data);
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

            // Inicio - BOTÃO ADICIONAR - Inserindo informação no Banco
            $("#salvar_cadastro").on('click', function() {
                var select = document.getElementById('salvando_cidade');
                var valueCidade = select.options[select.selectedIndex].value;
                $.ajax({
                    url: 'BDO/tutor/tutor_insert.php',
                    type: 'POST',
                    data: {
                        nome: $("#salvando_nome").val(),
                        cpf: $("#salvando_cpf").val(),
                        dtnascimento: $("#salvando_dtnascimento").val(),
                        cep: $("#salvando_cep").val(),
                        rua: $("#salvando_rua").val(),
                        complemento: $("#salvando_complemento").val(),
                        bairro: $("#salvando_bairro").val(),
                        cidadeestado: valueCidade,
                        email: $("#salvando_email").val(),
                        telefone: $("#salvando_telefone").val()
                    },
                    success: function(data) {
                        $("#addEmployeeModal").html(data);
						location.reload(); // recarrega a página para ver a alteração
                    },
                    error: function(data) {
                        alert(data);
                    }
                });
            });
            // Fim - Inserindo informação no Banco

            // Inicio - BOTÃO EDITAR - Alterando informação no Banco
            $("#alterar_cadastro").on('click', function() {
			
                var select = document.getElementById('update_cidade');
                var valueCidade = select.options[select.selectedIndex].value;
                
				$.ajax({
                    url: 'BDO/tutor/tutor_update.php',
                    type: 'POST',
                    data: {
                        codigo: $('#update_codigo').val(),
                        nome: $('#update_nome').val(),
                        cpf: $('#update_cpf').val(),
                        dtnascimento: $('#update_dtnascimento').val(),
                        cep: $('#update_cep').val(),
                        rua: $('#update_rua').val(),
                        complemento: $('#update_complemento').val(),
                        bairro: $('#update_bairro').val(),
                        cidadeestado: valueCidade,
                        email: $('#update_email').val(),
                        telefone: $('#update_telefone').val()
                    },
                    success: function(data) {
                        $("#editEmployeeModal").html(data);
						location.reload(); // recarrega a página para ver a alteração
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
                    url: 'BDO/tutor/tutor_delete.php',
                    type: 'POST',
                    data: {
                        codigo: $("#delete_codigo").val()
                    },
                    success: function(data) {
                        $("#deleteEmployeeModal").html(hide);
						location.reload(); // recarrega a página para ver a alteração
                    },
                    error: function(data) {
                        alert(data);
                    }
                });

            });
            // Fim - Excluindo informação no Banco
        });

    </script>
</body>

</html>
