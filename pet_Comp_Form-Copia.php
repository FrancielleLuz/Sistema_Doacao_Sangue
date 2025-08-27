<?php 
$codPet = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="en">

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
                        <h2><b>Animal</b></h2>
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
                            <input type="text" class="form-control" value="<?php echo $value['nome']; ?>" disabled>
                        </div>
                    </div>

                    <div class="divPai">
                        <div class="divFilha">
                            <label>Data Nascimento</label>
                            <input type="text" class="form-control" value="<?php echo $value['dtNascimento']; ?>" disabled>
                        </div>
                        <div class="divFilha">
                            <label>Data Falecimento</label>
                            <input type="text" class="form-control" value="<?php echo $value['dtFalecimento']; ?>" disabled>
                        </div>
                    </div>

                    <div class="divPai">
                        <div class="divFilha">
                            <label>Sexo</label>
                            <input type="text" class="inputTres form-control" value="<?php echo $value['sexo']; ?>" disabled>
                        </div>
                        <div class="divFilha">
                            <label>Doador</label>
                            <input type="text" class="inputTres form-control" value="<?php echo $value['doador']; ?>" disabled>
                        </div>
                        <div class="divFilha">
                            <label>Tipo Sanguíneo</label>
                            <input type="text" class="inputTres form-control" value="<?php echo $value['tipoSanguineo']; ?>" disabled>
                        </div>
                    </div>

                    <div class="divPai">
                        <div class="divFilha1">
                            <label>Comportamento</label>
                            <input type="text" class="form-control" value="<?php echo $value['comportamento']; ?>" disabled>
                        </div>
                    </div>

                    <div class="divPai">
                        <div class="divFilha">
                            <label>Espécie</label>
                            <input type="text" class="form-control" value="<?php echo $value['especie']; ?>" disabled>
                        </div>
                        <div class="divFilha">
                            <label>Raça</label>
                            <input type="text" class="form-control" value="<?php echo $value['raca']; ?>" disabled>
                        </div>
                    </div>

                    <div class="divPai">
                        <div class="divFilha1">
                            <label>Tutor</label>
                            <input type="text" class="form-control" value="<?php echo $value['tutor']; ?>" disabled>
                        </div>
                    </div>

                    <div class="divPai">
                        <div class="divFilha1">
                            <div class="table-titlefilho">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h2><b>Vacinas</b></h2>
                                    </div>
                                    <div class="col-sm-6">
                                        <a href="" class="adcBtn btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Adicionar</span></a>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th width="30%">Codigo</th>
                                        <th width="70%">Nome</th>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                    <?php 
                	                          include("BDO/pet/pet_selectVacina.php");
                                              $result = $stmt->fetchAll();
                                              foreach ($result as $value) {                 
                                            ?>
                                    <tr class="trCad">
                                        <td width="30%"><?php echo $value['codigo']; ?></td>
                                        <td width="70%"><?php echo $value['nome']; ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="divPai">
                        <div class="divFilha1">
                            <div class="table-titlefilho">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h2><b>Doenças</b></h2>
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
                                        <th width="30%">Codigo</th>
                                        <th width="70%">Nome</th>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                    <?php 
                                               include("BDO/pet/pet_selectDoenca.php");
                                                $result = $stmt->fetchAll();
                                                foreach ($result as $value) {                 
                                            ?>
                                    <tr class="trCad">
                                        <td width="30%"><?php echo $value['codigo']; ?></td>
                                        <td width="70%"><?php echo $value['nome']; ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="divPai">
                        <div class="divFilha1">
                            <div class="table-titlefilho">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h2><b>Exames</b></h2>
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
                                        <th width="30%">Codigo</th>
                                        <th width="70%">Nome</th>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                    <?php 
                                               include("BDO/pet/pet_selectExame.php");
                                                $result = $stmt->fetchAll();
                                                foreach ($result as $value) {                 
                                            ?>
                                    <tr class="trCad">
                                        <td width="30%"><?php echo $value['codigo']; ?></td>
                                        <td width="70%"><?php echo $value['nome']; ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="divPai">
                        <div class="divFilha1">
                            <div class="table-titlefilho">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h2><b>Histórico Peso</b></h2>
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
                                        <th width="30%">Codigo</th>
                                        <th width="70%">Nome</th>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                    <?php 
                                             include("BDO/pet/pet_selectVacina.php");
                                             $result = $stmt->fetchAll();
                                             foreach ($result as $value) {                 
                                             ?>
                                    <tr class="trCad">
                                        <td width="30%"><?php echo $value['codigo']; ?></td>
                                        <td width="70%"><?php echo $value['nome']; ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>


            <?php } ?>



            <!-- Fim  - Informações Top da tela -->

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
                            <label>Data Nascimento</label>
                            <input id="salvando_dtNascimento" type="text" class="form-control" required>
                            <label>Sexo</label>
                            <select id="salvando_sexo" class="form-control" required>
                                <option></option>
                                <option value="Fêmea">Fêmea</option>
                                <option value="Macho">Macho</option>
                            </select>
                            <label>Doador</label>
                            <select id="salvando_doador" class="form-control" required>
                                <option></option>
                                <option value="Sim">Sim</option>
                                <option value="Não">Não</option>
                            </select>
                            <label>Comportamento</label>
                            <input id="salvando_comportamento" type="text" class="form-control" required>

                            <label>Espécie</label>
                            <select id="salvando_especie" class="form-control" required>
                                <option></option>
                                <?php foreach ($arrCombo as $value) { ?>
                                <option value="<?php echo $value['codigo']; ?>"><?php echo $value['nome']; ?></option>
                                <?php } ?>
                            </select>

                            <label>Raça</label>
                            <select id="salvando_raca" class="form-control" required>
                                <option></option>
                                <?php foreach ($arrCombo3 as $value) { ?>
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

                            <label>Tutor</label>
                            <select id="salvando_tutor" class="form-control" required>
                                <option></option>
                                <?php foreach ($arrCombo4 as $value) { ?>
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


            /*
                        $.ajax({
                            url: 'BDO/pet/pet_selectConsulta.php',
                            type: 'POST',
                            data: {
                                codigo: resultado[1]
                            },
                            success: function(data) {
                                var obj = $.parseJSON(data);
                                $('#update_codigo').val(obj[0].codigo);
                                $('#update_nome').val(obj[0].nome);
                                $('#update_dtNascimento').val(obj[0].dtNascimento);
                                $('#update_dtFalecimento').val(obj[0].dtFalecimento);
                                $('#update_sexo').val(obj[0].sexo);
                                $('#update_doador').val(obj[0].doador);
                                $('#update_comportamento').val(obj[0].comportamento);
                                $('#update_especie').val(obj[0].codEspecie);
                                $('#update_raca').val(obj[0].codRaca);
                                $('#update_tipoSanguineo').val(obj[0].codTipoSanguineo);
                                $('#update_tutor').val(obj[0].codTutor);
                            },
                            error: function(data) {
                                alert(data);
                            }
                        });

            */
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

                var select2 = document.getElementById('salvando_tipoSanguineo');
                var valueTipoSanguineo = select2.options[select2.selectedIndex].value;

                var select3 = document.getElementById('salvando_raca');
                var valueRaca = select3.options[select3.selectedIndex].value;

                var select4 = document.getElementById('salvando_tutor');
                var valueTutor = select4.options[select4.selectedIndex].value;

                $.ajax({
                    url: 'BDO/pet/pet_insert.php',
                    type: 'POST',
                    data: {
                        nome: $("#salvando_nome").val(),
                        dtNascimento: $("#salvando_dtNascimento").val(),
                        sexo: $("#salvando_sexo").val(),
                        doador: $("#salvando_doador").val(),
                        comportamento: $("#salvando_comportamento").val(),
                        codEspecie: valueEspecie,
                        codRaca: valueRaca,
                        codTipoSanguineo: valueTipoSanguineo,
                        codTutor: valueTutor,
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

                var select2 = document.getElementById('update_tipoSanguineo');
                var valueTipoSanguineo = select2.options[select2.selectedIndex].value;

                var select3 = document.getElementById('update_raca');
                var valueRaca = select3.options[select3.selectedIndex].value;

                var select4 = document.getElementById('update_tutor');
                var valueTutor = select4.options[select4.selectedIndex].value;

                $.ajax({
                    url: 'BDO/pet/pet_update.php',
                    type: 'POST',
                    data: {
                        codigo: $('#update_codigo').val(),
                        nome: $("#update_nome").val(),
                        dtNascimento: $("#update_dtNascimento").val(),
                        dtfacelimento: $("#update_dtFalecimento").val(),
                        sexo: $("#update_sexo").val(),
                        doador: $("#update_doador").val(),
                        comportamento: $("#update_comportamento").val(),
                        codEspecie: valueEspecie,
                        codRaca: valueRaca,
                        codTipoSanguineo: valueTipoSanguineo,
                        codTutor: valueTutor,
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
                    url: 'BDO/pet/pet_delete.php',
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
