<?php
/**
 * Developed by:
 *     Renée Maksoud
 * 
 * All rights reserved - 2015-2019
 */

/* File: src/Template/Pages/home.ctp */
?>

<?= $this->Html->script('Chart'); ?>

<!-- /////////////////////////////////////////////////////////////////////// -->

<div class="col-xs-12 panel">
    <div class="col-xs-12 col-sm-4 text-nowrap">
        <h4><?= __('Bem vindo(a),'); ?> <?= $this->request->Session()->read('username'); ?></h4>
    </div>
    <div class="col-xs-12 col-sm-4 text-nowrap text-right pull-right">
        <span style="color:#777777;">
            <h4><?= $this->MyHtml->fullDate(date('Y-m-d')); ?> - <span id="timer"><?= date('H:i:s'); ?></span></h4>
        </span>
    </div>
</div>

<!-- /////////////////////////////////////////////////////////////////////// -->

<div class="col-xs-12 col-sm-5">

    <!-- SALDOS FINANCEIROS -->
    <div class="box panel panel-default box-shadow" style="padding:0;">
        <div class="panel-heading box-header" id="numero1" style="background-color:#d9edf7;">
            <span class="text-bold"><i class="fa fa-university"></i><?= __('Saldos de Bancos e Caixas'); ?>*</span>
            <h5><small>(*) <?= __('Saldos atualizados em'); ?> <?= date('d/m/Y'); ?></small></h5>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                    <i class="fa fa-minus-square-o"></i>
                </button>
            </div>
        </div>
        
        <div class="box-body panel-body">
            <div class="table-responsive">
                <table class="table no-margin font-12">
                    <thead>
                        <tr>
                            <th class="text-left"><?= __('Descrição'); ?></th>
                            <th class="text-right col-xs-1"><?= __('Valor'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>
                                <i class="fa fa-university"></i><?= __('Nome do Banco'); ?>
                            </th>
                            <td class="text-right"> 
                                <?= $this->Number->precision(1234.56, 2); ?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <i class="fa fa-money"></i><?= __('Nome do Caixa'); ?>
                            </th>
                            <td class="text-right"> 
                                <?= $this->Number->precision(1234.56, 2); ?>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr class="bg-gray">
                            <th><?= __('SALDO TOTAL'); ?> - <small><?= __('Bancos e Caixas'); ?></small></th>
                            <th class="text-right">
                                <?= $this->Number->precision(2469.12, 2); ?>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    
    <!-- /////////////////////////////////////////////////////////////////// -->
            
    <div class="box panel panel-default box-shadow" style="padding:0;">
        <div class="panel-heading box-header" id="numero1" style="background-color:#d9edf7;">
            <span class="text-bold"><i class="fa fa-credit-card-alt"></i><?= __('Limite de Cartões'); ?>*</span>
            <h5><small>(*) <?= __('Saldos atualizados em'); ?> <?= date('d/m/Y'); ?></small></h5>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                    <i class="fa fa-minus-square-o"></i>
                </button>
            </div>
        </div>

        <div class="box-body panel-body">
            <div class="table-responsive">
                <table class="table no-margin font-12">
                    <thead>
                        <tr>
                            <th class="text-left text-nowrap"><?= __('Descrição'); ?></th>
                            <th class="text-center col-xs-1 text-nowrap"><?= __('Limite'); ?></th>
                            <th class="text-center col-xs-1 text-nowrap"><?= __('Utilizado'); ?></th>
                            <th class="text-right col-xs-1 text-nowrap"><?= __('Disponível'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th class="text-nowrap">
                                <?= __('Nome do Cartão'); ?>
                            </th>
                            <td class="text-right">
                                <?= $this->Number->precision(1234.56, 2); ?>
                            </td>
                            <td class="text-right">
                                <!-- PERCENTUAL DO LIMITE DO CARTÃO UTILIZADO -->
                                <?= '100' ?>%
                            </td>
                            <td class="text-right">
                                <?= $this->Number->precision(0.00, 2); ?>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr class="bg-gray">
                            <th colspan="3"><?= __('CRÉDITO DISPONÍVEL'); ?></th>
                            <th class="text-right">
                                <?= $this->Number->precision(0.00, 2); ?>
                            </th>
                        </tr>
                        <tr class="bg-gray">
                            <th colspan="3"><?= __('CRÉDITO UTILIZADO'); ?></th>
                            <th class="text-right">
                                <?= $this->Number->precision(1234.56, 2); ?>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- /////////////////////////////////////////////////////////////////// -->

    <div class="box panel panel-default box-shadow" style="padding:0;">
        <div class="panel-heading box-header" id="numero1">
            <span class="text-bold">
                <i class="fa fa-trophy"></i><?= __('Progresso dos Planejamentos'); ?>
            </span>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                    <i class="fa fa-minus-square-o"></i>
                </button>
            </div>
        </div>

        <div class="box-body panel-body">
            <div class="table-responsive">
                <table class="table no-margin font-12">
                    <thead>
                        <tr>
                            <th class="text-left text-nowrap"><?= __('Descrição'); ?></th>
                            <th class="text-right col-xs-1 text-nowrap"><?= __('Meta'); ?></th>
                            <th class="text-center col-xs-1 text-nowrap"><?= __('Progresso'); ?></th>
                            <th class="text-right col-xs-1 text-nowrap"><?= __('Total Poupado'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th class="text-nowrap">
                                <?= __('Detalhamento'); ?>
                            </th>
                            <td class="text-right">
                                <?= $this->Number->precision(2469.12, 2); ?>
                            </td>
                            <td class="text-center">
                                <?= '50' ?>%
                            </td>
                            <td class="text-right">
                                <?= $this->Number->precision(1234.56, 2); ?>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr class="bg-gray">
                            <th colspan="3"><?= __('TOTAL POUPADO'); ?> </th>
                            <th class="text-right">
                                <?= $this->Number->precision(1234.56, 2); ?>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- /////////////////////////////////////////////////////////////////// -->
    
    <div class="box panel panel-default box-shadow" style="padding:0;">
        <div class="panel-heading box-header" id="numero2" style="background-color:#fcf8e3;">
            <span class="text-bold"><i class="fa fa-list-ul"></i><?= __('Extratos Financeiros'); ?>*</span>
            <h5><small>(*) <?= __('Vencimentos até'); ?> <?= date('t/m/Y'); ?></small></h5>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                    <i class="fa fa-minus-square-o"></i>
                </button>
            </div>
        </div>
        <div class="box-body panel-body table-responsive">
            <div class="table-responsive">
                <table class="table no-margin table-condensed font-12" style="margin:-10px 0 -15px -5px;">
                    <thead>
                        <th></th>
                        <th class="text-center text-nowrap">
                            <?= __('Em Atraso'); ?>
                        </th>
                        <th class="text-center text-nowrap">
                            <?= __('Hoje'); ?>
                        </th>
                        <th class="text-center text-nowrap">
                            <?= __('A Vencer'); ?>
                        </th>
                    </thead>
                    <tbody>
                        <!-- RECEITAS-->
                        <tr>
                            <td class="text-left">
                                <?= $this->Html->link(__('Receitas'), '#relacaoReceitas', ['class' => 'btn btn-default top-5 width-90 fa fa-plus-circle scroll', 'escape' => false]); ?>
                            </td>
                            <!-- VENCIDOS-->
                            <td class="text-center padding-15">
                                <?= $this->Number->precision(1234.56, 2); ?> (<?= '99' ?>)
                            </td>
                            <!-- VENCEM HOJE-->
                            <td class="text-center padding-15">
                                <?= $this->Number->precision(1234.56, 2); ?> (<?= '99' ?>)
                            </td>
                            <!-- A VENCER-->
                            <td class="text-center padding-15">
                                <?= $this->Number->precision(1234.56, 2); ?> (<?= '99' ?>)
                            </td>
                        </tr>
                        <!-- DESPESAS-->
                        <tr>
                            <td class="text-left">
                                <?= $this->Html->link(__('Despesas'), '#relacaoDespesas', ['class' => 'btn btn-default top-5 width-90 fa fa-minus-circle scroll', 'escape' => false]); ?>
                            </td>
                            <!-- ATRASADOS-->
                            <td class="text-center padding-15">
                                <?= $this->Number->precision(1234.56, 2); ?> (<?= '99' ?>)
                            </td>
                            <!-- VENCEM HOJE-->
                            <td class="text-center padding-15">
                                <?= $this->Number->precision(1234.56, 2); ?> (<?= '99' ?>)
                            </td>
                            <!-- A VENCER-->
                            <td class="text-center padding-15">
                                <?= $this->Number->precision(1234.56, 2); ?> (<?= '99' ?>)
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- /////////////////////////////////////////////////////////////////////// -->

<div class="col-xs-12 col-sm-4">

    <div class="box panel panel-default box-shadow" style="padding:0;">
        <div class="panel-heading box-header" id="numero3" style="background-color:#fcf8e3;">
            <span class="text-bold"><i class="fa fa-line-chart"></i><?= __('Receitas x Despesas'); ?>*</span>
            <h5><small>(*) <?= __('Vencimentos contábeis em '); ?><?= date('Y'); ?>, <?= __('provisionando os movimentos recorrentes.'); ?></small></h5>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                    <i class="fa fa-minus-square-o"></i>
                </button>
            </div>
        </div>
        <div class="box-body panel-body">
            <div class="text-center"><span class="text-bold"><?= __('Saúde Financeira').' '.(date('Y')); ?></span></div>
            <div class="progress" style="background-color:#777777;">
            <?php 
                //APRESENTA MENSAGEM
                if ($health_average_year < 0) {
                    echo "<div class='progress-bar progress-bar-danger' title='".__('Média Anual')."' style='width:".($health_average_year*-1)."%;max-width:100%;'></div>";
                } elseif ($health_average_year >= 0 && $health_average_year <= 20) {
                    echo "<div class='progress-bar progress-bar-warning' title='".__('Média Anual')."' style='width:".$health_average_year."%;max-width:100%;'></div>";
                } elseif ($health_average_year > 20) {
                    echo "<div class='progress-bar progress-bar-info' title='".__('Média Anual')."' style='width:".$health_average_year."%;max-width:100%;'></div>";
                }//elseif ($health_average_year > 20)
                echo "<div style='width:100%;position:absolute;text-align:center;color:white;'>".$health_average_year."%</div>";
            ?>
            </div>
            
            <!-- GRAPH -->
            <div class="top-10 panel">
                <canvas id="myChart" width="386" height="275"></canvas>
            </div>
            
            <script>
                var ctx = document.getElementById("myChart");
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ["<?= __('Janeiro') ?>", 
                                 "<?= __('Fevereiro') ?>", 
                                 "<?= __('Março') ?>", 
                                 "<?= __('Abril') ?>", 
                                 "<?= __('Maio') ?>", 
                                 "<?= __('Junho') ?>", 
                                 "<?= __('Julho') ?>", 
                                 "<?= __('Agosto') ?>", 
                                 "<?= __('Setembro') ?>", 
                                 "<?= __('Outubro') ?>", 
                                 "<?= __('Novembro') ?>", 
                                 "<?= __('Dezembro') ?>"],
                        datasets: [{
                            label: '<?= __('Realizado') ?>',
                            fill: false,
                            lineTension: 0.1,
                            backgroundColor: "rgba(75,192,192,0.4)",
                            borderColor: "rgba(75,192,192,1)",
                            borderCapStyle: 'butt',
                            borderDash: [],
                            borderDashOffset: 0.0,
                            borderJoinStyle: 'miter',
                            pointBorderColor: "rgba(75,192,192,1)",
                            pointBackgroundColor: "#fff",
                            pointBorderWidth: 1,
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: "rgba(75,192,192,1)",
                            pointHoverBorderColor: "rgba(220,220,220,1)",
                            pointHoverBorderWidth: 2,
                            pointRadius: 1,
                            pointHitRadius: 10,
                            data: [<?= implode(', ', $health_accomplished); ?>]
                        },{
                            label: '<?= __('Orçado') ?>',
                            backgroundColor: "rgba(179,181,198,0.2)",
                            borderColor: "rgba(179,181,198,1)",
                            pointBackgroundColor: "rgba(179,181,198,1)",
                            pointBorderColor: "#fff",
                            pointHoverBackgroundColor: "#fff",
                            pointHoverBorderColor: "rgba(179,181,198,1)",
                            data: [<?= implode(', ', $health_budgeted); ?>]
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    max: 100,
                                    min: -100
                                }
                            }]
                        }
                    }
                });
            </script>
            <!-- GRAPH -->
            
            <div class="col-xs-12 no-padding-lat bottom-0 font-9">
                <div class="table-responsive">
                    <table class="table no-margin table-condensed">
                        <thead>
                            <tr>
                                <th class="text-nowrap"><?= date('F Y'); ?></th>
                                <td class="text-right" title="<?= __('Não considera transferências ou lançamentos que não estejam no CPR.'); ?>"><?= __('Orçado') ?></td>
                                <td class="text-right" title="<?= __('Despesas e Receitas contábeis que já foram finalizadas.'); ?>"><?= __('Realizado') ?></td>
                                <td class="text-right" title="<?= __('Despesas e Receitas que ainda não foram pagas.'); ?>"><?= __('Em aberto') ?></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th><?= __('RECEITAS'); ?></th>
                                <th class="text-right"><label><?= $this->Number->precision($recipes_month_budgeted, 2); ?></label></th>
                                <th class="text-right"><label><?= $this->Number->precision($recipes_month_accomplished, 2); ?></label></th>
                                <th class="text-right"><label><?= $this->Number->precision($recipes_month_opened, 2); ?></label></th>
                            </tr>
                            <tr>
                                <th><?= __('DESPESAS'); ?></th>
                                <th class="text-right"><label><?= $this->Number->precision($expenses_month_budgeted, 2); ?></label></th>
                                <th class="text-right"><label><?= $this->Number->precision($expenses_month_accomplished, 2); ?></label></th>
                                <th class="text-right"><label><?= $this->Number->precision($expenses_month_opened, 2); ?></label></th>
                            </tr>
                            <tr style="color:#777;">
                                <th><?= __('RESULTADOS'); ?></th>
                                <th class="text-right" title="<?= $this->Number->precision($recipes_month_budgeted - $expenses_month_budgeted, 2); ?>"><?= $per_budgeted; ?>%</th>
                                <th class="text-right" title="<?= $this->Number->precision($recipes_month_accomplished - $expenses_month_accomplished, 2); ?>"><?= $per_accomplished; ?>%</th>
                                <th class="text-right" title="<?= $this->Number->precision($recipes_month_opened - $expenses_month_opened, 2); ?>"><?= $per_opened; ?>%</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
                
        </div>
    </div>
    
    <!-- /////////////////////////////////////////////////////////////////// -->
    
    <div class="box panel panel-default box-shadow" style="padding:0;">
        <div class="panel-heading box-header" style="background-color:#fcf8e3;">
            <span class="text-bold"><?= __('Faturas dos Cartões de Crédito'); ?>**</span>
            <h5>
                <small>(*) <?= __('Vencimentos até'); ?> <?= date('t/m/Y'); ?></small><br/>
                <small>(**) <?= __('Títulos recorrentes são gerados após o vencimento.'); ?></small>
            </h5>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                    <i class="fa fa-minus-square-o"></i>
                </button>
            </div>
        </div>
        <div class="box-body panel-body">
            <div class="table-responsive" style="max-height:300px;">
                <table class="table no-margin font-12">
                    <thead>
                        <tr>
                            <th class="text-left text-nowrap"><?= __('Cartão'); ?></th>
                            <th class="text-left col-xs-1 text-nowrap"><?= __('Venc.'); ?></th>
                            <th class="text-center col-xs-1 text-nowrap"><?= __('Valor'); ?></th>
                            <th class="text-center col-xs-1 text-nowrap"><?= __('Ações'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-left"><?= __('Nome do Cartão'); ?></td>
                            <td class="text-left"><?= date('d/m', strtotime('2020-01-01')); ?></td>
                            <td class="text-right"><?= $this->Number->precision(1234.56, 2); ?></td>
                            <td class="btn-actions-group">
                                <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'modalContent'], ['class' => 'btn btn-actions btn_modal fa fa-eye', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Dados do Cadastro'), 'title' => __('Visualizar')]); ?>
                                <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'modalContent'], ['class' => 'btn btn-actions btn_modal fa fa-arrow-circle-o-down', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Baixar Lançamento'), 'title' => __('Baixar')]); ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- /////////////////////////////////////////////////////////////////// -->
    
    <div class="box panel panel-default box-shadow" style="padding:0;">
        <div class="panel-heading box-header" id="numero4">
            <span class="text-bold"><i class="fa fa-newspaper-o"></i><?= __('Títulos por Plano de Contas'); ?>*</span>
            <h5><small>(*) <?= __('Vencimentos até'); ?> <?= date('t/m/Y'); ?></small></h5>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                    <i class="fa fa-minus-square-o"></i>
                </button>
            </div>
        </div>
        <div class="box-body panel-body table-responsive" style="max-height:277px;">
            <span class="text-bold"><?= __('Em Aberto'); ?></span>
            <span class="pull-right text-bold"><?= 'R$ ' . $this->Number->precision(2469.12, 2); ?></span>
            <table class="table no-margin font-12" style="margin-bottom:0;">
                <tbody>
                    <tr>
                        <td>
                            01.01 - <?= __('Plano de Contas'); ?>
                        </td>
                        <td class="text-right">
                            <?= $this->Number->precision(1234.56, 2); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            01.02 - <?= __('Plano de Contas'); ?>
                        </td>
                        <td class="text-right">
                            <?= $this->Number->precision(1234.56, 2); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- /////////////////////////////////////////////////////////////////// -->
    
    <div class="box panel panel-default box-shadow" style="padding:0;">
        <div class="panel-heading box-header" style="background-color:#fcf8e3;">
            <span class="text-bold"><?= __('Planejamentos & Metas'); ?>*</span>
            <h5><small>(*) <?= __('Vencimentos até'); ?> <?= date('t/m/Y'); ?></small></h5>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                    <i class="fa fa-minus-square-o"></i>
                </button>
            </div>
        </div>
        <div class="box-body panel-body">
            <div class="table-responsive" style="max-height:300px;overflow-x:hidden;">
                <table class="table no-margin font-12" style="margin-bottom:0;">
                    <thead>
                        <tr>
                            <th class="text-left col-xs-1 text-nowrap"><?= __('Data'); ?></th>
                            <th class="text-left text-nowrap"><?= __('Descrição'); ?></th>
                            <th class="text-center col-xs-1 text-nowrap"><?= __('Valor'); ?></th>
                            <th class="text-center col-xs-1 text-nowrap"><?= __('Ações'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= date('d/m', strtotime('2020-01-01')); ?></td>
                            <td><?= __('Detalhamento do lançamento'); ?></td>
                            <td class="text-right"><?= $this->Number->precision(1234.56, 2); ?></td>
                            <td class="btn-actions-group">
                                <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'modalContent'], ['class' => 'btn btn-actions btn_modal fa fa-eye', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Dados do Cadastro'), 'title' => __('Visualizar')]); ?>
                                <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'modalContent'], ['class' => 'btn btn-actions btn_modal fa fa-arrow-circle-o-down', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Baixar Lançamento'), 'title' => __('Baixar')]); ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</div>

<!-- /////////////////////////////////////////////////////////////////////// -->

<div class="col-xs-12 col-sm-3 pull-right">
    
    <div class="box panel panel-default box-shadow" style="padding:0;">
        <div class="panel-heading box-header" id="numero6" style="background-color:#dff0d8;">
            <span class="text-bold"><i class="fa fa-bell-o"></i><?= __('Você Sabia?'); ?></span>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                    <i class="fa fa-minus-square-o"></i>
                </button>
            </div>
        </div>
        <div class="box-body panel-body">
            <div class="table-responsive no-margin text-justify font-10" style="border:0;">
                "<?= __('Dicas aleatórias de uso do sistema'); ?>"
            </div>
        </div>
    </div>
    
    <!-- /////////////////////////////////////////////////////////////////// -->
    
    <div class="box panel panel-default box-shadow panel-shortcuts" style="padding:0;">
        <div class="panel-heading box-header" id="numero5" style="background-color:#fcf8e3">
            <span class="text-bold"><i class="fa fa-bolt"></i><?= __('Atalhos'); ?></span>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                    <i class="fa fa-minus-square-o"></i>
                </button>
            </div>
        </div>
        <div class="box-body panel-group bottom-0" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <?= $this->Html->link(__('Lançamentos'), '#collapseOne', ['class' => 'btn fa fa-list-ul fa-fw font-12', 'role' => 'button', 'data-toggle' => 'collapse', 'data-parent' => '#accordion', 'href' => '#collapseOne', 'aria-expanded' => true, 'aria-controls' => 'collapseOne', 'escape' => false]); ?>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <ul class="list-unstyled top_profiles scroll-view">
                        <li class="media event">
                            <a class="pull-left border-blue profile_thumb">
                                <i class="fa fa-folder-open-o blue"></i>
                            </a>
                            <div class="row media-body">
                                <div class="media-title"><?= __('CONTAS P/R'); ?></div>
                                <div>
                                    <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'modalContent'], ['class' => 'btn btn-actions btn_modal fa fa-plus', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Nova Conta a Pagar/Receber'), 'title' => __('Incluir Registros')]); ?>
                                    <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'content'], ['class' => 'btn btn-actions fa fa-search', 'data-loading-text' => __('Carregando...'), 'title' => __('Listar Registros')]); ?>
                                    <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'modalContent'], ['class' => 'btn btn-actions btn_modal fa fa-file-text-o', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Relatório - Movimentos Financeiros'), 'title' => __('Gerar Relatórios')]); ?>
                                </div>
                            </div>
                        </li>
                        <li class="media event">
                            <a class="pull-left border-blue profile_thumb">
                                <i class="fa fa-money blue"></i>
                            </a>
                            <div class="row media-body">
                                <div class="media-title"><?= __('CAIXAS'); ?></div>
                                <div>
                                    <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'modalContent'], ['class' => 'btn btn-actions btn_modal fa fa-plus', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Novo Movimento de Caixa'), 'title' => __('Incluir Registros')]); ?>
                                    <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'content'], ['class' => 'btn btn-actions fa fa-search', 'data-loading-text' => __('Carregando...'), 'title' => __('Listar Registros')]); ?>
                                    <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'modalContent'], ['class' => 'btn btn-actions btn_modal fa fa-file-text-o', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Relatório - Movimentos de Caixa'), 'title' => __('Gerar Relatórios')]); ?>
                                </div>
                            </div>
                        </li>
                        <li class="media event">
                            <a class="pull-left border-blue profile_thumb">
                                <i class="fa fa-university blue"></i>
                            </a>
                            <div class="row media-body">
                                <div class="media-title"><?= __('BANCOS'); ?></div>
                                <div>
                                    <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'modalContent'], ['class' => 'btn btn-actions btn_modal fa fa-plus', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Novo Movimento de Banco'), 'title' => __('Incluir Registros')]); ?>
                                    <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'content'], ['class' => 'btn btn-actions fa fa-search', 'data-loading-text' => __('Carregando...'), 'title' => __('Listar Registros')]); ?>
                                    <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'modalContent'], ['class' => 'btn btn-actions btn_modal fa fa-file-text-o', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Relatório - Movimentos de Banco'), 'title' => __('Gerar Relatórios')]); ?>
                                </div>
                            </div>
                        </li>
                        <li class="media event">
                            <div class="pull-left border-blue profile_thumb">
                                <i class="fa fa-credit-card blue"></i>
                            </div>
                            <div class="row media-body">
                                <div class="media-title"><?= __('CARTÕES'); ?></div>
                                <div>
                                    <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'modalContent'], ['class' => 'btn btn-actions btn_modal fa fa-plus', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Novo Movimento de Cartões'), 'title' => __('Incluir Registros')]); ?>
                                    <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'content'], ['class' => 'btn btn-actions fa fa-search', 'data-loading-text' => __('Carregando...'), 'title' => __('Listar Registros')]); ?>
                                    <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'modalContent'], ['class' => 'btn btn-actions btn_modal fa fa-file-text-o', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Relatório - Movimentos de Cartões'), 'title' => __('Gerar Relatórios')]); ?>
                                </div>
                            </div>
                        </li>
                        <li class="media event">
                            <div class="pull-left border-blue profile_thumb">
                                <i class="fa fa-exchange blue"></i>
                            </div>
                            <div class="row media-body">
                                <div class="media-title"><?= __('TRANSFERÊNCIAS'); ?></div>
                                <div>
                                    <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'modalContent'], ['class' => 'btn btn-actions btn_modal fa fa-plus', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Nova Transferência'), 'title' => __('Incluir Registros')]); ?>
                                    <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'content'], ['class' => 'btn btn-actions fa fa-search', 'data-loading-text' => __('Carregando...'), 'title' => __('Listar Registros')]); ?>
                                    <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'modalContent'], ['class' => 'btn btn-actions btn_modal fa fa-file-text-o', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Relatório - Transferências'), 'title' => __('Gerar Relatórios')]); ?>
                                </div>
                            </div>
                        </li>
                        <li class="media event">
                            <a class="pull-left border-blue profile_thumb">
                                <i class="fa fa-trophy blue"></i>
                            </a>
                            <div class="row media-body">
                                <div class="media-title"><?= __('PLANEJAMENTOS'); ?></div>
                                <div>
                                    <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'modalContent'], ['class' => 'btn btn-actions btn_modal fa fa-plus', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Novo Planejamento'), 'title' => __('Incluir Registros')]); ?>
                                    <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'content'], ['class' => 'btn btn-actions fa fa-search', 'data-loading-text' => __('Carregando...'), 'title' => __('Listar Registros')]); ?>
                                    <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'modalContent'], ['class' => 'btn btn-actions btn_modal fa fa-file-text-o', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Relatório - Planejamentos e Metas'), 'title' => __('Gerar Relatórios')]); ?>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="panel panel-default top-0">
                <div class="panel-heading" role="tab" id="headingTwo">
                    <?= $this->Html->link(__('Cadastros'), '#collapseTwo', ['class' => 'btn collapsed fa fa-pencil-square-o fa-fw font-12', 'role' => 'button', 'data-toggle' => 'collapse', 'data-parent' => '#accordion', 'href' => '#collapseTwo', 'aria-expanded' => false, 'aria-controls' => 'collapseTwo', 'escape' => false]); ?>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                    <ul class="list-unstyled top_profiles scroll-view">
                        <li class="media event">
                            <a class="pull-left border-blue profile_thumb">
                                <i class="fa fa-shopping-cart blue"></i>
                            </a>
                            <div class="row media-body">
                                <div class="media-title"><?= __('FORNECEDORES'); ?></div>
                                <div>
                                    <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'modalContent'], ['class' => 'btn btn-actions btn_modal fa fa-plus', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Novo Fornecedor'), 'title' => __('Incluir Registros')]); ?>
                                    <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'content'], ['class' => 'btn btn-actions fa fa-search', 'data-loading-text' => __('Carregando...'), 'title' => __('Listar Registros')]); ?>
                                </div>
                            </div>
                        </li>
                        <li class="media event">
                            <a class="pull-left border-blue profile_thumb">
                                <i class="fa fa-briefcase blue"></i>
                            </a>
                            <div class="row media-body">
                                <div class="media-title"><?= __('CLIENTES'); ?></div>
                                <div>
                                    <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'modalContent'], ['class' => 'btn btn-actions btn_modal fa fa-plus', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Novo Cliente'), 'title' => __('Incluir Registros')]); ?>
                                    <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'content'], ['class' => 'btn btn-actions fa fa-search', 'data-loading-text' => __('Carregando...'), 'title' => __('Listar Registros')]); ?>
                                </div>
                            </div>
                        </li>
                        <li class="media event">
                            <a class="pull-left border-blue profile_thumb">
                                <i class="fa fa-university blue"></i>
                            </a>
                            <div class="row media-body">
                                <div class="media-title"><?= __('BANCOS'); ?></div>
                                <div>
                                    <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'modalContent'], ['class' => 'btn btn-actions btn_modal fa fa-plus', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Novo Banco'), 'title' => __('Incluir Registros')]); ?>
                                    <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'content'], ['class' => 'btn btn-actions fa fa-search', 'data-loading-text' => __('Carregando...'), 'title' => __('Listar Registros')]); ?>
                                </div>
                            </div>
                        </li>
                        <li class="media event">
                            <a class="pull-left border-blue profile_thumb">
                                <i class="fa fa-money blue"></i>
                            </a>
                            <div class="row media-body">
                                <div class="media-title"><?= __('CAIXAS'); ?></div>
                                <div>
                                    <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'modalContent'], ['class' => 'btn btn-actions btn_modal fa fa-plus', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Novo Caixa'), 'title' => __('Incluir Registros')]); ?>
                                    <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'content'], ['class' => 'btn btn-actions fa fa-search', 'data-loading-text' => __('Carregando...'), 'title' => __('Listar Registros')]); ?>
                                </div>
                            </div>
                        </li>
                        <li class="media event">
                            <a class="pull-left border-blue profile_thumb">
                                <i class="fa fa-credit-card blue"></i>
                            </a>
                            <div class="row media-body">
                                <div class="media-title"><?= __('CARTÕES'); ?></div>
                                <div>
                                    <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'modalContent'], ['class' => 'btn btn-actions btn_modal fa fa-plus', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Novo Cartão'), 'title' => __('Incluir Registros')]); ?>
                                    <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'content'], ['class' => 'btn btn-actions fa fa-search', 'data-loading-text' => __('Carregando...'), 'title' => __('Listar Registros')]); ?>
                                </div>
                            </div>
                        </li>
                        <li class="media event">
                            <a class="pull-left border-blue profile_thumb">
                                <i class="fa fa-sort-amount-asc blue"></i>
                            </a>
                            <div class="row media-body">
                                <div class="media-title"><?= __('PLANO DE CONTAS'); ?></div>
                                <div>
                                <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'modalContent'], ['class' => 'btn btn-actions btn_modal fa fa-plus', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Novo Plano de Contas'), 'title' => __('Incluir Registros')]); ?>
                                <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'content'], ['class' => 'btn btn-actions fa fa-search', 'data-loading-text' => __('Carregando...'), 'title' => __('Listar Registros')]); ?>
                                </div>
                            </div>
                        </li>
                        <li class="media event">
                            <a class="pull-left border-blue profile_thumb">
                                <i class="fa fa-arrows-alt blue"></i>
                            </a>
                            <div class="row media-body">
                                <div class="media-title"><?= __('CENTRO DE CUSTOS'); ?></div>
                                <div>
                                    <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'modalContent'], ['class' => 'btn btn-actions btn_modal fa fa-plus', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Novo Centro de Custos'), 'title' => __('Incluir Registros')]); ?>
                                    <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'content'], ['class' => 'btn btn-actions fa fa-search', 'data-loading-text' => __('Carregando...'), 'title' => __('Listar Registros')]); ?>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
</div>

<!-- /////////////////////////////////////////////////////////////////////// -->

<div class="col-xs-12">

    <div class="box panel panel-default box-shadow" style="padding:0;">
        <div class="panel-heading box-header" style="background-color:#F4F2F3;">
            <span class="text-bold"><i class="fa fa-clock-o"></i><?= __('TRANSFERÊNCIAS PROGRAMADAS'); ?> (<?= '99' ?>)</span>
            <h5><small>(*) <?= __('Agendamentos de Resgates/Aplicações (Transferências)'); ?></small></h5>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                    <i class="fa fa-minus-square-o"></i>
                </button>
            </div>
        </div>
        <div class="box-body panel-body">
            <div class="table-responsive" style="max-height:500px;overflow-y:scroll;">
                <table class="table no-margin font-12 table-striped table-condensed">
                    <thead>
                        <tr>
                            <th class="text-left col-xs-1 text-nowrap"><?= __('Ordem'); ?></th>
                            <th class="text-center col-xs-1 text-nowrap"><?= __('Programação'); ?></th>
                            <th class="text-left text-nowrap"><?= __('Histórico'); ?></th>
                            <th class="text-center col-xs-1"></th>
                            <th class="text-right col-xs-1 text-nowrap"><?= __('Valor'); ?></th>
                            <th class="text-left col-xs-1 text-nowrap"><?= __('Origem'); ?></th>
                            <th class="text-left col-xs-1 text-nowrap"><?= __('Destino'); ?></th>
                            <th class="text-center col-xs-1 text-nowrap"><?= __('Ações'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-left"><?= str_pad('1234', 6, '0', STR_PAD_LEFT); ?></td>
                            <td class="text-left">
                                <span style="color:#2aabd2">
                                    <?= date('d/m/Y', strtotime('2020-01-01')); ?>
                                </span>
                            </td>
                            <td class="text-left"><?= __('Detalhamento da transferência'); ?></td>
                            <td class="text-right text-nowrap"><i class="fa fa-calendar"></i></td>
                            <td class="text-right text-nowrap"><?= $this->Number->precision(1234.56, 2); ?></td>
                            <td class="text-left"><?= __('Nome do Banco de Origem'); ?></td>
                            <td class="text-left"><?= __('Nome do Banco de Destino'); ?></td>
                            <td class="btn-actions-group">
                                <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'modalContent'], ['class' => 'btn btn-actions btn_modal fa fa-eye', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Dados do Cadastro'), 'title' => __('Visualizar')]); ?>
                                <?= $this->Form->postLink('', ['controller' => 'Pages', 'action' => 'content'], ['confirm' => __('Você tem certeza que deseja confimar a transferência na data programada?'), 'class' => 'btn btn-actions fa fa-check', 'data-loading-text' => __('Carregando...'), 'title' => 'Confirmar']); ?>
                                <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'modalContent'], ['class' => 'btn btn-actions btn_modal fa fa-pencil', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Dados do Cadastro'), 'title' => __('Editar')]); ?>
                                <?= $this->Form->postLink('', ['controller' => 'Pages', 'action' => 'content'], ['confirm' => __('Você tem certeza que deseja EXCLUIR o registro?'), 'class' => 'btn btn-actions fa fa-trash-o', 'title' => 'Excluir']); ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel-heading" style="font-size:11px;">
            <span class="text-bold"><?= __('Legenda:'); ?></span><br />
            <span style="color:#ce8483"><?= __('Datas de Agendamentos Vencidos,'); ?> </span>
            <span style="color:#0a0"><?= __('Agendamentos que Vencem Hoje e'); ?> </span>
            <span style="color:#2aabd2"><?= __('Agendamentos a Vencer.'); ?></span>
        </div>
    </div>
</div>

<!-- /////////////////////////////////////////////////////////////////////// -->

<div class="col-xs-12" id="relacaoReceitas">

    <div class="box panel panel-default bg-info box-shadow" style="padding:0;">
        <div class="panel-heading box-header" style="background-color:#D9EDF7;">
            <span class="text-bold"><?= __('CONTAS A RECEBER'); ?> (<?= '99' ?>)</span>
            <h5><small>(*) <?= __('Vencimentos até'); ?> <?= date('t/m/Y'); ?></small></h5>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                    <i class="fa fa-minus-square-o"></i>
                </button>
            </div>
        </div>
        <div class="box-body panel-body">
            <div class="table-responsive" style="max-height:500px;overflow-y:scroll;">
                <table class="table no-margin font-12 table-striped table-condensed">
                    <thead>
                        <tr>
                            <th class="text-left col-xs-1 text-nowrap"><?= __('Ordem'); ?></th>
                            <th class="text-left col-xs-1 text-nowrap"><?= __('Vencimento'); ?></th>
                            <th class="text-left col-xs-1 text-nowrap"><?= __('Documento'); ?></th>
                            <th class="text-left col-xs-1 text-nowrap"><?= __('Cliente/Fornecedor'); ?></th>
                            <th class="text-left text-nowrap"><?= __('Histórico'); ?></th>
                            <th class="text-right col-xs-1 text-nowrap"><?= __('Valor'); ?></th>
                            <th class="text-center col-xs-1"></th>
                            <th class="text-center col-xs-1 text-nowrap"><?= __('Status'); ?></th>
                            <th class="text-center col-xs-1 text-nowrap"><?= __('Ações'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-left"><?= str_pad('1234', 6, '0', STR_PAD_LEFT); ?></td>
                            <td class="text-left">
                            <span style="color:#2aabd2;">
                                <?= date('d/m/Y', strtotime('2020-01-01')); ?>
                            </span>
                            </td>
                            <td class="text-left"><?= __('Código de Referência'); ?></td>
                            <td class="text-left"><?= __('Nome do Cliente'); ?></td>
                            <td class="text-left"><?= __('Detalhamento do lançamento'); ?></td>
                            <td class="text-right text-nowrap"><?= $this->Number->precision(1234.56, 2); ?></td>
                            <td class="text-center">
                                <i class="fa fa-plus-circle" style="color:lightblue;" title="<?= __('Crédito'); ?>"></i>
                            </td>
                            <td class="text-center col-xs-1"><?= __('Aberto'); ?></td>
                            <td class="btn-actions-group">
                                <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'modalContent'], ['class' => 'btn btn-actions btn_modal fa fa-eye', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Dados do Cadastro'), 'title' => __('Visualizar'), 'escape' => false]); ?>
                                <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'modalContent'], ['class' => 'btn btn-actions btn_modal fa fa-arrow-circle-o-down', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Baixar Lançamento'), 'title' => __('Baixar'), 'escape' => false]); ?>
                                <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'modalContent'], ['class' => 'btn btn-actions btn_modal fa fa-pencil', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Editar Cadastro'), 'title' => __('Editar'), 'escape' => false]); ?>
                                <?= $this->Form->postLink('', ['controller' => 'Pages', 'action' => 'content'], ['confirm' => __('Você tem certeza que deseja EXCLUIR o registro?'), 'class' => 'btn btn-actions fa fa-trash-o', 'title' => __('Excluir'), 'escape' => false]); ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel-heading" style="font-size:11px;">
            <span class="text-bold"><?= __('Legenda:') ?></span><br />
            <span style="color:#ce8483;"><?= __('Datas de Contas Vencidas,'); ?> </span>
            <span style="color:#0a0;"><?= __('Contas que Vencem Hoje e'); ?> </span>
            <span style="color:#2aabd2;"><?= __('Contas a Vencer.'); ?></span>
        </div>
    </div>

</div>
<br />

<!-- /////////////////////////////////////////////////////////////////////// -->

<br />
<div class="col-xs-12" id="relacaoDespesas">

    <div class="box panel panel-default bg-danger box-shadow" style="padding:0;">
        <div class="panel-heading box-header" style="background-color:#f2dede;">
            <span class="text-bold"><?= __('CONTAS A PAGAR'); ?> (<?= '99' ?>)</span>
            <h5><small>(*) <?= __('Vencimentos até') ?> <?= date('t/m/Y'); ?></small></h5>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                    <i class="fa fa-minus-square-o"></i>
                </button>
            </div>
        </div>
        <div class="box-body panel-body">
            <div class="table-responsive" style="max-height:500px;overflow-y:scroll;">
                <table class="table no-margin font-12 table-striped table-condensed">
                    <thead>
                        <tr>
                            <th class="text-left col-xs-1 text-nowrap"><?= __('Ordem'); ?></th>
                            <th class="text-left col-xs-1 text-nowrap"><?= __('Vencimento'); ?></th>
                            <th class="text-left col-xs-1 text-nowrap"><?= __('Documento'); ?></th>
                            <th class="text-left col-xs-1 text-nowrap"><?= __('Cliente/Fornecedor'); ?></th>
                            <th class="text-left text-nowrap"><?= __('Histórico'); ?></th>
                            <th class="text-right col-xs-1 text-nowrap"><?= __('Valor'); ?></th>
                            <th class="text-center col-xs-1"></th>
                            <th class="text-center col-xs-1 text-nowrap"><?= __('Status'); ?></th>
                            <th class="text-center col-xs-1 text-nowrap"><?= __('Ações'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-left"><?= str_pad('1234', 6, '0', STR_PAD_LEFT); ?></td>
                            <td class="text-left">
                                <span style="color:#2aabd2;">
                                    <?= date('d/m/Y', strtotime('2020-01-01')); ?>
                                </span>
                            </td>
                            <td class="text-left"><?= __('Código de Referência'); ?></td>
                            <td class="text-left"><?= __('Nome do Fornecedor'); ?></td>
                            <td class="text-left"><?= __('Detalhamento'); ?></td>
                            <td class="text-right text-nowrap"><?= $this->Number->precision(1234.56, 2); ?></td>
                            <td class="text-center">
                                <i class="fa fa-minus-circle" style="color:#e4b9c0;" title="<?= __('Débito'); ?>"></i>
                            </td>
                            <td class="text-center col-xs-1"><?= __('Aberto'); ?></td>
                            <td class="btn-actions-group">
                                <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'modalContent'], ['class' => 'btn btn-actions btn_modal fa fa-eye', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Dados do Cadastro'), 'title' => __('Visualizar')]); ?>
                                <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'modalContent'], ['class' => 'btn btn-actions btn_modal fa fa-arrow-circle-o-down', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Baixar Lançamento'), 'title' => __('Baixar')]); ?>
                                <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'modalContent'], ['class' => 'btn btn-actions btn_modal fa fa-pencil', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Editar Cadastro'), 'title' => __('Editar')]); ?>
                                <?= $this->Form->postLink('', ['controller' => 'Pages', 'action' => 'content'], ['confirm' => __('Você tem certeza que deseja EXCLUIR o registro?'), 'class' => 'btn btn-actions fa fa-trash-o', 'title' => 'Excluir']); ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel-heading" style="font-size:11px;">
            <span class="text-bold"><?= __('Legenda:') ?></span><br />
            <span style="color:#ce8483;"><?= __('Datas de Contas Vencidas,'); ?> </span>
            <span style="color:#0a0;"><?= __('Contas que Vencem Hoje e'); ?> </span>
            <span style="color:#2aabd2;"><?= __('Contas a Vencer.'); ?></span>
        </div>
    </div>

</div>

<div class="col-xs-12 bottom-40">
    <div class="box panel panel-default bg-danger box-shadow" style="padding:20px;text-align:justify;">
        "Esse é o prótótipo do sistema financeiro e controle de estoques criado em 2017 e melhorado em 2019. Este protótipo possui seu código publicado no GitHub no endereço (https://github.com/Maksoud/Gentelella-Alela). O tema Gentelella-Alela foi adaptado para trabalhar no CakePHP 3.x e este protótipo foi desenvolvido para servir de portifólio e aulixiar na criação de novos projetos utilizando esse layout."
    </div>
    <div class="box panel panel-default bg-danger box-shadow" style="padding:20px;text-align:justify;">
        "This is a prototype of a financial and inventory control system created in 2017 and improved in 2019. This prototype has its code published in GitHub on (https://github.com/Maksoud/Gentelella-Alela). The Gentelella-Alela theme has been adapted to work on CakePHP 3.x and this prototype was developed to serve as a portfolio and help in the creation of new projects using this layout."
    </div>
</div>