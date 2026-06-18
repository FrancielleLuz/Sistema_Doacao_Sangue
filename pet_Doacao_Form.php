<?php
// pet.php (arquivo principal)
include("BDO/pet/pet_especie_select.php");        // define $arrCombo (especies)
include("BDO/pet/pet_tipoSanguineo_select.php"); // define $arrCombo2 (tipos sanguineos gerais)
include("BDO/pet/pet_tutor_select.php");         // define $arrCombo4 (tutores)
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Próxima Doação</title>
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
                <div class="col-sm-6"><h2><b>Próxima Doação</b></h2></div>
            </div>
        </div>

        <input class="form-control" id="myInput" type="text" placeholder="Procurar..">

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th width="25%">Nome</th>
                    <th width="5%">Data Nascimento</th>
                    <th width="5%">Sexo</th>
                    <th width="5%">Doador</th>
                    <th width="10%">Espécie</th>
                    <th width="10%">Tipo Sanguíneo</th>
					<th width="10%">Tutor</th>
					<th width="10%">Telefone</th>
					<th width="10%">E-mail</th>
                </tr>
            </thead>
            <tbody id="myTable">
                <?php 
                include("BDO/pet/pet_proxima_doacao_select.php");
                $result = $stmt->fetchAll();
                foreach ($result as $value) { ?>
                <tr class="trCad">
                    <!-- ================= BOTÕES ================= -->                    
                    <td><a href="pet_Comp_Form.php?id=<?php echo $value['codigo']; ?>"><?php echo $value['nome']; ?></a></td>                   
					<td><?php echo date('d/m/Y', strtotime($value['dtNascimento'])); ?></td>
                    <td><?php echo $value['sexo']; ?></td>
                    <td><?php echo $value['doador']; ?></td>
                    <td><?php echo $value['especie']; ?></td>
                    <td><?php echo $value['tipoSanguineo']; ?></td>
					<td><a href="tutor_Comp_Form.php?id=<?php echo $value['codtutor']; ?>"><?php echo $value['tutor']; ?></a></td>
					<td>
						<a href="https://wa.me/<?php echo preg_replace('/\D/', '', $value['telefone']); ?>" target="_blank">
							<?php echo $value['telefone']; ?>
						</a>
					</td>
					<td><?php echo $value['email']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>