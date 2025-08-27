<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Clinica</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<link href="css/style.css" rel="stylesheet">
</head>
<body>
	<?php
		require_once 'NavBar.html';
	?>
    <div class="container">
        <div class="table-wrapper">
            

           <!-- Inicio  - Informações Top da tela -->
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2><b>Clínica</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="" class="editbtn edit btn btn-danger" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Editar">&#xE254;</i> <span>Editar</span></a>					
					</div>
                </div>
            </div>
            <!-- Fim  - Informações Top da tela -->

            <table class="table table-striped table-hover">
                <thead>
                	<?php 
                	 include("BDO/clinica/clinica_select.php");
                     $result = $stmt->fetchAll();
                     foreach ($result as $value) {                 
                    ?>
                    <tr>
                    	<td width="10%" align="right"><b>Razão Social:</b></td>
                        <td width="90%" id="razaoSocial"><?php echo $value['razaoSocial']; ?></td>
                    </tr>               
                    <tr>
                        <td width="10%" align="right"><b>CNPJ:</b></td>
                        <td width="90%" id="cnpj"><?php echo Mask("##.###.###/####-##",$value['cnpj']).'<BR>';?></td>
                    </tr>  
                    <tr>
                        <td width="10%" align="right"><b>CEP:</b></td>
                        <td width="90%" id="cep"><?php echo Mask("#####-###",$value['cep']).'<BR>'; ?></td>
                    </tr> 
                    <tr>
                        <td width="10%" align="right"><b>Endereço:</b></td>
                        <td width="90%" id="rua"><?php echo $value['rua']; ?></td>
                    </tr> 
                    <tr>
                        <td width="10%" align="right"><b>Complemento:</b></td>
                        <td width="90%" id="complemento"><?php echo $value['complemento']; ?></td>
                    </tr>    
                    <tr>
                        <td width="10%" align="right"><b>Bairro:</b></td>
                        <td width="90%" id="bairro"><?php echo $value['bairro']; ?></td>
                    </tr>   
                  
                    <tr>
                        <td width="10%" align="right"><b>Cidade:</b></td>
                        <td width="90%" id="cidade"><?php echo $value['cidade']; ?></td>
                    </tr>     
                    <tr>
                        <td width="10%" align="right"><b>Estado:</b></td>
                        <td width="90%" id="estado"><?php echo $value['nome']; ?></td>
                    </tr>     
                    <tr>
                        <td width="10%" align="right"><b>Usuário:</b></td>
                        <td width="90%" id="usuario"><?php echo $value['usuAdm']; ?></td>
                    </tr>               
                    <?php } ?>
                </thead>
            </table>
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
							<label for="editando_razao_social">Razão Social</label>
							<input id="update_razaoSocial" type="text" class="form-control" required>
						</div>	
						<div class="form-group">
							<label for="editando_cep">CEP</label>
							<input id="update_cep" type="text" class="form-control" required>
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

<!-- ********************************* SCRIPT *******************************************  -->
<?php
function Mask($mask,$str){

    $str = str_replace(" ","",$str);

    for($i=0;$i<strlen($str);$i++){
        $mask[strpos($mask,"#")] = $str[$i];
    }

    return $mask;
}
?>

<script type="text/javascript">
$(document).ready(function(){
 

	//Botão Editar
	$('.editbtn').on('click', function(){

		$('#editEmployeeModal').modal('show');

		$tr = $(this).closest('tr');
  		var data = $tr.children("td").map(function(){
  			return $(this).text();
  		}).get();

  		$('#update_codigo').val(data[1]);
  		$('#update_razaoSocial').val(data[2]);
  		$('#update_cep').val(data[3])
	}); 

	
	// Inicio - Alterando informação no Banco
	$("#alterar_cadastro").on('click', function(){
        $.ajax({
            url:'BDO/clinica/clinica_update.php',
            type:'POST', 
            data:{
            	 codigo:$("#update_codigo").val(),
                 razaoSocial:$("#update_razaoSocial").val(),
                 cep:$("#update_cep").val()
            },
            success: function(data){
                $("#editEmployeeModal").html(data);
            },
            error:function(data){
                alert(data);
            }
        });
    });
    // Fim - Alterando informação no Banco



});
</script>
</body>
</html>  
