<?php
/**
 * Developed by:
 *     Renée Maksoud
 * 
 * All rights reserved - 2015-2019
 */

/* File: src/Template/Pages/modal-content.ctp */
?>

<?php $this->layout = 'ajax'; ?>
<?= $this->Form->create('form', ['type' => 'file']) ?>

<?= $this->Html->css('bootstrap-multiselect.min') ?>
<?= $this->Html->script('bootstrap-multiselect.min') ?>
<?= $this->Html->script(['add-items.min',
                         'maksoud-text.min'
                        ]) ?>

<?php 
    $single = 'col-xs-12 bottom-10';
    $double = 'col-xs-12 col-sm-6 bottom-10';
    $quad   = 'col-xs-12 col-sm-3 bottom-10';
    $label  = 'control-label text-nowrap';
    $input  = 'form-control';
    
    //Classified by importance
    $unidades = ['UN' => 'UN',  //Unity
                 'PÇ' => 'PÇ',  //Piece
                 'PR' => 'PR',  //Pair
                 'RL' => 'RL',  //Roll
                 'PT' => 'PT',  //Package
                 'CT' => 'CT',  //Card
                 'CX' => 'CX',  //Box
                 'ML' => 'ML',  //Mililiters
                 'L'  => 'L',   //Liters
                 'TN' => 'TN',  //Tons
                 'KG' => 'KG',  //Kilogram
                 'G'  => 'G',   //Gram
                 'MM' => 'MM',  //Millimeters
                 'CM' => 'CM',  //Centimeters
                 'M'  => 'M',   //Meters
                 'KM' => 'KM',  //Kilometers
                 'MM²'=> 'MM²', //Square Millimeter
                 'CM²'=> 'CM²', //Square Centimeter
                 'M²' => 'M²',  //Square Meter
                 'MM³'=> 'MM³', //Cubin Millimiter
                 'CM³'=> 'CM³', //Cubic Centimeter
                 'M³' => 'M³',  //Cubic Meter
                ];
?>

    <div class="container-fluid">
        <div class="row">
            <div id="ajax-retorno" class="col-xs-12"></div>
        </div>
        
        <div class="row">
            <div class="<?= $double ?> well" style="min-height: 188px;">
                <div class="row top-10">
                    <div class="<?= $double ?>">
                        <label class="<?= $label ?>">
                            <?= __('Código') ?>
                            <i class="fa fa-info-circle" data-toggle="tooltip" title="<?= __('Código único com 6 dígitos para identificação do registro.') ?>"></i>
                        </label>
                        <?= $this->Form->control('code', ['label' => false, 'type' => 'text', 'maxlength' => '6', 'class' => $input, 'value' => str_pad(1234, 6, '0', STR_PAD_LEFT), 'disabled' => true]) ?>
                    </div>
                    <div class="<?= $double ?>">
                        <label class="<?= $label ?>">
                            <?= __('Data do Lançamento') ?>
                            <i class="fa fa-info-circle" data-toggle="tooltip" title="<?= __('Informe a data da requisição.') ?>"></i>
                        </label>
                        <?= $this->Form->control('date', ['label' => false, 'autocomplete' => 'off', 'type' => 'text', 'value' => date('d/m/Y'), 'class' => $input . ' focus datepicker datemask controldate', 'placeholder' => __('Ex. 31/12/2020'), 'required' => true]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="<?= $double ?>">
                        <label class="<?= $label ?>">
                            <?= __('Pedido do Cliente') ?>
                            <i class="fa fa-info-circle" data-toggle="tooltip" title="<?= __('Informe o código de pedido do cliente.') ?>"></i>
                        </label>
                        <?= $this->Form->control('customercode', ['label' => false, 'type' => 'text', 'maxlength' => '25', 'class' => $input]) ?>
                    </div>
                    <div class="<?= $double ?>">
                        <label class="<?= $label ?>">
                            <?= __('Cliente') ?>
                        </label>
                        <div class="input-group">
                            <div class="input-group-addon input-border-left">
                                <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'modal2'], ['class' => 'btn_modal2 btn btn-primary btn-custom fa fa-plus', 'data-loading-text' => '', 'data-title' => __('Novo Cliente'), 'data-toggle' => 'modal', 'data-target' => '#myModal2', 'data-size' => 'lg', 'title' => __('Adicionar Cliente'), 'escape' => false]) ?>
                            </div>
                            <input id="customers_title" class="form-control input-border-right" type="text" autocomplete="off" placeholder="<?= __('Digite o nome do cliente ou adicione') ?>"><div class="loadingCustomers"></div>
                        </div>
                        <input name="customers_id" id="customers_id" type="hidden">
                    </div>
                </div>
            </div>

            <div class="<?= $double ?> box" style="min-height: 188px;">
                <div class="row top-10">
                    <div class="<?= $double ?> bottom-0">
                        <div class="row">
                            <div class="<?= $double ?>">
                                <label class="<?= $label ?>">
                                    <?= __('Tipo Frete') ?>
                                    <i class="fa fa-info-circle" data-toggle="tooltip" title="<?= __('CIF - Pago pelo fornecedor, FOB - Pago pelo cliente.') ?>"></i>
                                </label>
                                <?= $this->Form->control('freighttype', ['label' => false, 'type' => 'select', 'class' => $input, 'options' => ['C' => __('CIF'), 'F' => __('FOB')]]) ?>
                            </div>
                            <div class="<?= $double ?>">
                                <label class="<?= $label ?>">
                                    <?= __('Valor Frete') ?>
                                    <i class="fa fa-info-circle" data-toggle="tooltip" title="<?= __('Informe o valor do frete.') ?>"></i>
                                </label>
                                <?= $this->Form->control('totalfreight', ['label' => false, 'type' => 'text', 'class' => $input.' valuemask', 'style' => 'width:100px;margin-left:-24px;']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="<?= $double ?>">
                        <label class="<?= $label ?>">
                            <?= __('Data de Embarque') ?>
                            <i class="fa fa-info-circle" data-toggle="tooltip" title="<?= __('Informe a data limite para entrega da venda.') ?>"></i>
                        </label>
                        <?= $this->Form->control('shipment', ['label' => false, 'autocomplete' => 'off', 'type' => 'text', 'class' => $input . ' datepicker datemask controldate', 'placeholder' => __('Ex. 31/12/2020'), 'required' => true]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="<?= $double ?>">
                        <label class="<?= $label ?>">
                            <?= __('Tipo de Pagamento') ?>
                            <i class="fa fa-info-circle" data-toggle="tooltip" title="<?= __('Informe a forma de pagamento acertado ou adicione nas observações.') ?>"></i>
                        </label>
                        <?= $this->Form->control('paymenttype', ['label' => false, 'type' => 'text', 'maxlength' => '60', 'class' => $input]) ?>
                    </div>
                    <div class="<?= $double ?>">
                        <label class="<?= $label ?>">
                            <?= __('Prazo de Entrega') ?>
                            <i class="fa fa-info-circle" data-toggle="tooltip" title="<?= __('Informe a data limite para entrega da venda.') ?>"></i>
                        </label>
                        <?= $this->Form->control('deadline', ['label' => false, 'autocomplete' => 'off', 'type' => 'text', 'class' => $input . ' datepicker datemask controldate', 'placeholder' => __('Ex. 31/12/2020'), 'required' => true]) ?>
                    </div>
                </div>
            </div>

            <div class="<?= $single ?> well" style="height: 365px;">
                <div class="row top-10">
                    <div class="<?= $double ?>">

                        <div class="bottom-10" style="float: left;">
                            <div style="float: left;">
                                <label class="<?= $label ?>">
                                    <?= __('Produtos') ?>
                                    <i class="fa fa-info-circle" data-toggle="tooltip" title="<?= __('Informe ao menos 3 caracteres do nome do produto para listar os itens.') ?>"></i>
                                </label>
                                <div class="input-group">
                                    <div class="input-group-addon input-border-left">
                                        <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'modal2'], ['class' => 'btn_modal2 btn btn-primary btn-custom fa fa-plus', 'data-loading-text' => '', 'data-title' => __('Novo Produto'), 'data-toggle' => 'modal', 'data-target' => '#myModal2', 'data-size' => 'lg', 'title' => __('Adicionar Produto'), 'escape' => false]) ?>
                                    </div>
                                    <input id="products_title" class="form-control input-border-right" type="text" autocomplete="off" placeholder="<?= __('Digite o nome do produto ou adicione') ?>"><div class="loadingProducts" style="right:37px;"></div>
                                    <div style="padding:6px 16px; font-size:14px; font-weight:400; line-height:1; color:#555; text-align:center; border:1px solid #ccc; width:1%; white-space:nowrap; vertical-align:middle; display:table-cell; margin:0;">
                                        <i data-toggle="tooltip" title="<?= __('Uso e Consumo/Imobilizado: Estes produtos não consideram o valor do IPI para base de cálculo do ICMS.') ?>">
                                            <?= $this->Form->control('imobilizado', ['label' => false, 'type' => 'checkbox', 'hiddenField' => false, 'style' => 'margin:-9px;left:3px;', 'id' => 'edt_imobilizado']) ?>
                                        </i>
                                    </div>
                                </div>
                                <input name="products_id" id="products_id" type="hidden">
                            </div>
                        </div>

                        <div class="<?= $single ?>">
                            <div class="row">
                                <div class="<?= $quad ?>">
                                    <div class="row">
                                        <label class="<?= $label ?>">
                                            <?= __('Unidade') ?>
                                        </label>
                                        <?= $this->Form->control('unity', ['label' => false, 'type' => 'select', 'class' => $input, 'id' => 'edt_unity', 'options' => $unidades]) ?>
                                    </div>
                                </div>
                                <div class="<?= $quad ?>">
                                    <div class="row">
                                        <label class="<?= $label ?>">
                                            <?= __('Quantidade') ?>
                                        </label>
                                        <?= $this->Form->control('quantity', ['label' => false, 'type' => 'text', 'class' => $input.' fourdecimals', 'id' => 'edt_quantity']) ?>
                                    </div>
                                </div>
                                <div class="<?= $quad ?>">
                                    <div class="row">
                                        <label class="<?= $label ?>">
                                            <?= __('Vl. Unit.') ?>(<?= __('R$') ?>)
                                        </label>
                                        <?= $this->Form->control('vlunity', ['label' => false, 'type' => 'text', 'class' => $input.' fourdecimals', 'id' => 'edt_vlunity']) ?>
                                    </div>
                                </div>
                                <div class="<?= $quad ?>">
                                    <div class="row">
                                        <label class="<?= $label ?>">
                                            <?= __('Desconto') ?>(<?= __('R$') ?>)
                                        </label>
                                        <?= $this->Form->control('vldiscount', ['label' => false, 'type' => 'text', 'class' => $input.' valuemask', 'id' => 'edt_vldiscount']) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="<?= $quad ?>">
                                    <div class="row">
                                        <label class="<?= $label ?>">
                                            <?= __('IPI') ?> (%)
                                        </label>
                                        <?= $this->Form->control('peripi', ['label' => false, 'type' => 'text', 'class' => $input.' valuemask', 'id' => 'edt_peripi']) ?>
                                    </div>
                                </div>
                                <div class="<?= $quad ?>">
                                    <div class="row">
                                        <label class="<?= $label ?>">
                                            <?= __('IPI') ?> (<?= __('R$') ?>)
                                        </label>
                                        <?= $this->Form->control('ipi', ['label' => false, 'type' => 'text', 'class' => $input.' valuemask', 'id' => 'edt_ipi']) ?>
                                    </div>
                                </div>
                                <div class="<?= $quad ?>">
                                    <div class="row">
                                        <label class="<?= $label ?>">
                                            <?= __('ICMS') ?> (%)
                                        </label>
                                        <?= $this->Form->control('pericms', ['label' => false, 'type' => 'text', 'class' => $input.' valuemask', 'id' => 'edt_pericms']) ?>
                                    </div>
                                </div>
                                <div class="<?= $quad ?>">
                                    <div class="row">
                                        <label class="<?= $label ?>">
                                            <?= __('ICMS') ?> (<?= __('R$') ?>)
                                        </label>
                                        <?= $this->Form->control('icms', ['label' => false, 'type' => 'text', 'class' => $input.' valuemask', 'id' => 'edt_icms']) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="<?= $double ?>">
                                    <div class="row">
                                        <!-- -->
                                    </div>
                                </div>
                                <div class="<?= $quad ?>">
                                    <div class="row">
                                        <!-- -->
                                    </div>
                                </div>
                                <div class="<?= $quad ?> box">
                                    <div class="row" style="margin:0;">
                                        <button onclick="AddTableRow()" type="button" class="btn btn-default fa fa-plus" style="margin-top: -1px; margin-left: 10px;"> </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    
                    <div class="<?= $double ?> box" style="height: 294px;">
                        <label class="text-center bottom-20"><?= __('TOTAIS') ?></label>
                        <table class="table table-hover" style="margin-bottom: -1px; font-size: 13px;">
                            <tbody class="bg-gray">
                                <tr>
                                    <th><?= __('Total Produtos') ?></th>
                                    <th class="text-right">
                                        <input type="hidden" name="totalproducts" id="vltotalproducts" value="0.00">
                                        <span id="totalproducts"><?= __('0,00') ?></span>
                                    </th>
                                </tr>
                                <tr>
                                    <th><?= __('Desconto Total') ?></th>
                                    <th class="text-right">
                                        <input type="hidden" name="totaldiscount" id="vltotaldiscount" value="0.00">
                                        <span id="totaldiscount"><?= __('0,00') ?></span>
                                    </th>
                                </tr>
                                <tr>
                                    <th><?= __('IPI Total') ?></th>
                                    <th class="text-right">
                                        <input type="hidden" name="totalipi" id="vltotalipi" value="0.00">
                                        <span id="totalipi"><?= __('0,00') ?></span>
                                    </th>
                                </tr>
                                <tr>
                                    <th><?= __('ICMS Total') ?></th>
                                    <th class="text-right">
                                        <input type="hidden" name="totalicms" id="vltotalicms" value="0.00">
                                        <span id="totalicms"><?= __('0,00') ?></span>
                                    </th>
                                </tr>
                                <tr>
                                    <th><?= __('Total Geral') ?> <?= __('(Produtos + IPI)') ?></th>
                                    <th class="text-right">
                                        <input type="hidden" name="grandtotal" id="vlgrandtotal" value="0.00">
                                        <span id="grandtotal"><?= __('0,00') ?></span>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="<?= $single ?> box">
                <h5><strong><?= __('ITENS DO PEDIDO') ?></strong></h5>
                <table id="products-table" class="table table-hover table-bordered table-condensed table-striped" style="margin-bottom: -1px;">
                    <thead class="bg-gray">
                        <tr style="font-size: 12px;">
                            <th colspan="3" class="text-nowrap"><?= __('Descrição') ?></th>
                            <th class="text-center col-xs-1"><?= __('Unidade') ?></th>
                            <th class="text-center text-nowrap col-xs-1"><?= __('Quantidade') ?></th>
                            <th rowspan="2" class="col-xs-1 text-center" style="vertical-align: middle;"><?= __('Ações') ?></th>
                        </tr>
                        <tr style="font-size: 12px;">
                            <th class="text-center text-nowrap col-xs-1"><?= __('Unitário') ?> (<?= __('R$') ?>)</th>
                            <th class="text-center text-nowrap col-xs-1"><?= __('Desconto') ?> (<?= __('R$') ?>)</th>
                            <th class="text-center text-nowrap col-xs-1"><?= __('IPI') ?> (<?= __('R$') ?>)/(%)</th>
                            <th class="text-center text-nowrap col-xs-1"><?= __('ICMS') ?> (<?= __('R$') ?>)/(%)</th>
                            <th class="text-center text-nowrap"><?= __('Total') ?> (<?= __('R$') ?>)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- CONTENT -->
                    </tbody>
                </table>
            </div>
            
            <div class="<?= $single ?> box">
                <div class="row">
                    <div class="<?= $single ?>">
                        <label class="<?= $label ?>"><?= __('Observações') ?></label>
                        <?= $this->Form->textarea('obs', ['label' => false, 'id' => 'text', 'maxlength' => '300', 'type' => 'textarea', 'class' => 'form-control form-group']) ?>
                        <span class="pull-right" style="margin-top:-12px;font-size:10px;"><span id="count_message"></span> <?= __('restantes') ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- This tag finishes the modal body and starts the modal's footer here -->

<div class="col-xs-12 box text-left">
    <?= $this->Html->link(__('Visualizar Lançamento'), ['controller' => 'Pages', 'action' => 'modal2'], ['class' => 'btn_modal2 box-shadow scroll-modal btn btn-warning btn-shortcut fa fa-eye ', 'role' => 'button', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Dados do Cadastro'), 'data-toggle' => 'modal', 'data-target' => '#myModal2', 'data-size' => 'lg', 'title' => __('Visualizar'), 'escape' => false]) ?>
    <?= $this->Html->link(__('Saldos de Bancos/Caixas'), ['controller' => 'Pages', 'action' => 'modal2'], ['class' => 'btn_modal2 box-shadow btn btn-warning btn-shortcut fa fa-usd ', 'role' => 'button', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Saldos de Bancos e Caixas'), 'data-toggle' => 'modal', 'data-target' => '#myModal2', 'data-size' => 'lg', 'title' => __('Visualizar'), 'escape' => false]) ?>
</div>

<div class="modal-footer">
    <?= $this->Form->button(__('Gravar'), ['type' => 'cancel', 'class' => 'btn btn-primary scroll-modal', 'data-dismiss' => 'modal', 'div' => false]) ?>
    <?= $this->Form->button(__('Cancelar'), ['type' => 'cancel', 'class' => 'btn btn-default', 'data-dismiss' => 'modal', 'div' => false]) ?>
    <?= $this->Form->end() ?>
</div>