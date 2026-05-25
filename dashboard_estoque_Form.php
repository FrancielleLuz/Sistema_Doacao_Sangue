<?php

include("BDO/estoque/estoque_por_especie.php");
$rows = $stmt_estoque->fetchAll(PDO::FETCH_ASSOC);

include("BDO/estoque/dashboard_kpi.php");
include("BDO/estoque/alertas_select.php");

// Agrupa por espécie
$estoque_por_especie = [];
foreach ($rows as $row) {
    $esp_id = $row['cod_especie'] ?? 0;
    if (!isset($estoque_por_especie[$esp_id])) {
        $estoque_por_especie[$esp_id] = [
            'nome'  => $row['nome_especie'] ?? 'Geral',
            'tipos' => []
        ];
    }
    $estoque_por_especie[$esp_id]['tipos'][] = $row;
}

// Ícones por espécie
$icones_especie = [
    'Cachorro' => '🐕',
    'Gato'     => '🐱',
];

$total_volume_fmt = number_format($kpi['total_volume'], 0, ',', '.');
$mes_atual = mb_strtoupper(strftime('%B/%Y'));
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard — Estoque de Sangue</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="css/style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
<?php require_once 'NavBar.html'; ?>

<div class="container mt-4">
<div class="table-wrapper">

    <!-- Título -->
    <div class="table-title">
        <div class="row">
            <div class="col-sm-6">
                <h2><b>Dashboard — Estoque de Sangue</b></h2>
            </div>
        </div>
    </div>

    <!-- PAINEL DE ALERTAS -->
    <?php if (!empty($alertasCritico) || !empty($alertasVencendo)): ?>
    <div style="margin-top: 15px;">

        <?php foreach ($alertasCritico as $ac): ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>🚨 Estoque crítico:</strong>
            <?= htmlspecialchars($ac['nomeTip']) ?> (<?= htmlspecialchars($ac['nomeEspecie']) ?>) —
            <?php if ($ac['qtd_bolsas'] == 0): ?>
                <strong>sem bolsas disponíveis!</strong>
            <?php else: ?>
                apenas <strong><?= $ac['qtd_bolsas'] ?></strong> bolsa(s) disponível(is).
            <?php endif; ?>
        </div>
        <?php endforeach; ?>

        <?php foreach ($alertasVencendo as $av):
            $diasR = (int) $av['dias_restantes'];
            $dtVen = DateTime::createFromFormat('Y-m-d', $av['datven'])->format('d/m/Y');
            $classe = $diasR <= 2 ? 'alert-danger' : 'alert-warning';
            $emoji  = $diasR <= 2 ? '🔴' : '🟡';
        ?>
        <div class="alert <?= $classe ?> alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong><?= $emoji ?> Bolsa vencendo:</strong>
            Lote <strong><?= htmlspecialchars($av['codlot']) ?></strong> |
            <?= htmlspecialchars($av['nomeTip']) ?> (<?= htmlspecialchars($av['nomeEspecie']) ?>) |
            Vence em <strong><?= $dtVen ?></strong>
            <?php if ($diasR == 0): ?>
                — <strong>vence hoje!</strong>
            <?php elseif ($diasR == 1): ?>
                — amanhã.
            <?php else: ?>
                — em <strong><?= $diasR ?></strong> dia(s).
            <?php endif; ?>
        </div>
        <?php endforeach; ?>

    </div>
    <?php endif; ?>

    <!-- KPIs -->
    <div class="row" style="margin-top: 20px;">

        <div class="col-md-3 col-sm-6">
            <div class="kpi-card">
                <i class="fa fa-tint kpi-icon kpi-azul"></i>
                <div class="kpi-numero kpi-azul"><?= $kpi['total_bolsas'] ?></div>
                <div class="kpi-label">Bolsas disponíveis</div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="kpi-card">
                <i class="fa fa-flask kpi-icon kpi-verde"></i>
                <div class="kpi-numero kpi-verde"><?= $total_volume_fmt ?> ml</div>
                <div class="kpi-label">Volume total em estoque</div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="kpi-card <?= $kpi['vencendo_7d'] > 0 ? 'kpi-borda-vermelho' : '' ?>">
                <i class="fa fa-exclamation-triangle kpi-icon kpi-vermelho"></i>
                <div class="kpi-numero kpi-vermelho"><?= $kpi['vencendo_7d'] ?></div>
                <div class="kpi-label">Bolsas vencendo em 7 dias</div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="kpi-card">
                <i class="fa fa-calendar kpi-icon kpi-azul-claro"></i>
                <div class="kpi-numero kpi-azul-claro"><?= $kpi['doacoes_mes'] ?></div>
                <div class="kpi-label">Coletas em <?= date('m/Y') ?></div>
            </div>
        </div>

    </div>

    <!-- Filtro por espécie -->
    <div class="filtro-especie" style="margin-top: 10px; margin-bottom: 5px;">
        <strong>Filtrar por espécie:</strong><br>
        <button class="btn btn-default filtro-btn ativo" data-filtro="todos">🐾 Todos</button>
        <?php foreach ($estoque_por_especie as $esp_id => $especie): 
            $icone = $icones_especie[$especie['nome']] ?? '🐾';
        ?>
        <button class="btn btn-default filtro-btn" data-filtro="<?= $esp_id ?>">
            <?= $icone ?> <?= htmlspecialchars($especie['nome']) ?>
        </button>
        <?php endforeach; ?>
    </div>

    <!-- Cards por espécie -->
    <?php foreach ($estoque_por_especie as $esp_id => $especie):
        $icone = $icones_especie[$especie['nome']] ?? '🐾';
    ?>
    <div class="secao-especie" data-secao="<?= $esp_id ?>">
        <?= $icone ?> <?= htmlspecialchars($especie['nome']) ?>
    </div>

    <div class="row cards-especie" data-grupo="<?= $esp_id ?>">
        <?php foreach ($especie['tipos'] as $tipo):
            $qtd    = (int) $tipo['qtd_bolsas'];
            $volume = number_format($tipo['total_volume'], 2, ',', '.');
            $venc   = (int) $tipo['vencendo_7d'];

            if ($qtd <= 2) {
                $classe = 'card-critico';
                $status = 'CRÍTICO';
            } elseif ($qtd <= 5) {
                $classe = 'card-alerta';
                $status = 'ATENÇÃO';
            } else {
                $classe = 'card-ok';
                $status = 'OK';
            }
        ?>
        <div class="col-md-3" style="margin-bottom: 20px;">
            <div class="card-dashboard <?= $classe ?> card-clicavel"
                 data-toggle="modal" data-target="#modalLotes"
                 data-codtip="<?= $tipo['codtip'] ?>"
                 data-nome="<?= htmlspecialchars($tipo['nome_tipo'], ENT_QUOTES) ?>"
                 style="cursor:pointer;">
                <div class="card-titulo">🩸 <?= htmlspecialchars($tipo['nome_tipo']) ?></div>
                <div class="card-valor"><?= $qtd ?> <small style="font-size:18px;">bolsas</small></div>
                <div class="card-sub"><?= $volume ?> ml</div>
                <div class="card-sub"><strong><?= $status ?></strong></div>
                <?php if ($venc > 0): ?>
                <div style="margin-top:6px;">
                    <span class="badge-vencendo">⚠️ <?= $venc ?> vencendo em 7d</span>
                </div>
                <?php endif; ?>
                <div style="margin-top:8px; font-size:11px; opacity:0.75;">🔍 clique para ver lotes</div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <?php endforeach; ?>

</div>
</div>

<!-- MODAL LOTES -->
<div id="modalLotes" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background:#435d7d; color:#fff; border-radius:3px 3px 0 0;">
                <button type="button" class="close" data-dismiss="modal" style="color:#fff;">&times;</button>
                <h4 class="modal-title" id="modalLotesTitulo">Lotes disponíveis</h4>
            </div>
            <div class="modal-body">
                <div id="modalLotesConteudo">
                    <p class="text-center text-muted">Carregando...</p>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {

    // ABRIR MODAL DE LOTES AO CLICAR NO CARD
    $(document).on('click', '.card-clicavel', function () {
        var codtip = $(this).data('codtip');
        var nome   = $(this).data('nome');

        $('#modalLotesTitulo').text('🩸 Lotes disponíveis — ' + nome);
        $('#modalLotesConteudo').html('<p class="text-center text-muted">Carregando...</p>');

        $.ajax({
            url: 'BDO/estoque/estoque_lotes_por_tipo.php',
            type: 'POST',
            data: { codtip: codtip },
            dataType: 'json',
            success: function (res) {
                if (res.status !== 'ok' || res.lotes.length === 0) {
                    $('#modalLotesConteudo').html('<p class="text-center text-muted">Nenhuma bolsa disponível para este tipo sanguíneo.</p>');
                    return;
                }

                var html = '<table class="table table-striped table-hover">';
                html += '<thead><tr>';
                html += '<th>Lote</th><th>Pet Doador</th><th>Data Coleta</th><th>Validade</th><th>Qtd (ml)</th><th>Situação</th><th>Veterinário</th>';
                html += '</tr></thead><tbody>';

                $.each(res.lotes, function (i, l) {
                    var dias = parseInt(l.dias_validade);
                    var sit;
                    if (dias < 0)       sit = '<span class="label label-default">Vencida</span>';
                    else if (dias <= 2)  sit = '<span class="label label-danger">Vence hoje/amanhã</span>';
                    else if (dias <= 7)  sit = '<span class="label label-warning">Vence em ' + dias + 'd</span>';
                    else                 sit = '<span class="label label-success">OK</span>';

                    // formata datas DD/MM/AAAA
                    function fmtData(d) {
                        if (!d) return '';
                        var p = d.split('-');
                        return p[2]+'/'+p[1]+'/'+p[0];
                    }

                    html += '<tr>';
                    html += '<td><strong>' + l.codlot + '</strong></td>';
                    html += '<td>' + l.nomePet + '</td>';
                    html += '<td>' + fmtData(l.datent) + '</td>';
                    html += '<td>' + fmtData(l.datven) + '</td>';
                    html += '<td>' + parseFloat(l.qtdcol).toFixed(2) + '</td>';
                    html += '<td>' + sit + '</td>';
                    html += '<td>' + l.nomeVet + '</td>';
                    html += '</tr>';
                });

                html += '</tbody></table>';
                $('#modalLotesConteudo').html(html);
            },
            error: function () {
                $('#modalLotesConteudo').html('<p class="text-center text-danger">Erro ao carregar lotes.</p>');
            }
        });
    });

    $('.filtro-btn').on('click', function () {
        $('.filtro-btn').removeClass('ativo');
        $(this).addClass('ativo');

        var filtro = $(this).data('filtro');

        if (filtro === 'todos') {
            $('.secao-especie, .cards-especie').show();
        } else {
            $('.secao-especie').each(function () {
                $(this).data('secao') == filtro ? $(this).show() : $(this).hide();
            });
            $('.cards-especie').each(function () {
                $(this).data('grupo') == filtro ? $(this).show() : $(this).hide();
            });
        }
    });

});
</script>

</body>
</html>