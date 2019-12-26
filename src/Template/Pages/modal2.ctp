<?php
/**
 * Developed by:
 *     Renée Maksoud
 * 
 * All rights reserved - 2015-2019
 */

/* File: src/Template/Pages/modal2.ctp */
?>

<?php $this->layout = 'ajax'; ?>
<?= $this->Form->create('form', ['type' => 'file']) ?>

<?= $this->Html->script([//Extras
                         'maksoud-radiooptions.min',
                         'maksoud-text.min'
                        ]) ?>

<?php 
    $single = 'col-xs-12 bottom-10';
    $double = 'col-xs-12 col-sm-6 bottom-10';
    $quad   = 'col-xs-12 col-sm-3 bottom-10';
    $label  = 'control-label text-nowrap';
    $input  = 'form-control';
?>

    <div class="container-fluid">
        <div class="row">
            <div class="<?= $double ?> box" style="min-height:262px;">
                
                <div class="row">
                    <div class="<?= $double ?>">
                        <label class="<?= $label ?>">
                            <?= __('Data do Pagamento') ?>
                            <i class="fa fa-info-circle" data-toggle="tooltip" title="<?= __('Informe a data do pagamento desse lançamento.') ?>"></i>
                        </label>
                        <?= $this->Form->control('dtbaixa', ['label' => false, 'autocomplete' => 'off', 'type' => 'text', 'value' => date('d/m/Y'), 'class' => $input.' focus datepicker datemask controldate', 'placeholder' => __('Ex. 31/12/2020'), 'required' => true]) ?>
                    </div>
                    
                    <div class="<?= $double ?>">
                        <label class="<?= $label ?>" style="font-weight: normal">
                            <?= __('Vencimento') ?>
                            <i class="fa fa-info-circle" data-toggle="tooltip" title="<?= __('Em caso de não informar o vencimento, este será preenchido considerando a periodicidade e a data do documento.') ?>"></i>
                        </label>
                        <?= $this->Form->control('vencimento', ['label' => false, 'autocomplete' => 'off', 'type' => 'text', 'class' => $input.' datepicker datemask', 'placeholder' => __('Ex. 31/12/2020'), 'required' => true]) ?>
                    </div>
                </div>
                
                <div class="row">
                    <div class="<?= $double ?>">
                        <label class="<?= $label ?>">
                            <?= __('Valor do Pagamento') ?>
                            <i class="fa fa-info-circle" data-toggle="tooltip" title="<?= __('Informe o valor pago, considerando juros ou descontos.') ?>"></i>
                        </label>
                        <div class="input-group">
                            <span class="input-group-addon input-border-left"><?= __('R$') ?></span>
                            <?= $this->Form->control('valorbaixa', ['label' => false, 'type' => 'text', 'class' => $input.' input-border-right valuemask', 'value' => $this->MyForm->decimal(1234.56), 'placeholder' => __('0,00'), 'id' => 'valorbaixa', 'required' => true]) ?>
                            <div class="dataLoading"></div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="<?= $single ?>">
                        <label class="<?= $label ?>">
                            <?= __('Histórico') ?>
                            <i class="fa fa-info-circle" data-toggle="tooltip" title="<?= __('Não é obrigatório a alteração da descrição do lançamento.') ?>"></i>
                        </label>
                        <?= $this->Form->control('historico', ['label' => false, 'type' => 'text', 'class' => $input, 'required' => true]) ?>
                    </div>
                </div>
            </div>
            
            <div class="<?= $double ?> well" style="min-height:262px;">
                <div class="row">
                    <div class="<?= $single ?>">

                        <div class="pull-right">
                            <span class="label label-primary"><?= __('Contábil'); ?></span>
                        </div>

                        <div class="text-center bottom-10 font-16"><label><?= __('RESUMO')?></label></div>
                        
                        <label><?= __('Total da Fatura: ')?></label>
                        <div class="pull-right" id="valor">
                            <?= $this->Number->precision(2469.12, 2) ?>
                        </div>
                        
                        <br/>
                        
                        <label><span id="vlrparcial"><?= __('Total dos Pagamentos Anteriores: ')?></span></label>
                        <div class="pull-right" id="vlrparcial">
                            <?= $this->Number->precision(1234.56, 2) ?>
                        </div>
                        
                        <br/>
                        
                        <label><span id="text-vlrdesc"><?= __('Desconto/Juros Aplicado: ')?></span></label>
                        <div class="pull-right" id="vlrdesc">
                            <?= $this->Number->precision(0.00, 2) ?>
                        </div>
                        
                        <br/>
                        
                        <label><?= __('Total dos Títulos Vinculados: ')?></label>
                        <div class="pull-right" id="vinculapgto">
                            <?= $this->Number->precision(1234.56, 2) ?>
                        </div>
                        <br/>
                            
                        <label><span id="text-diferenca"></span></label>
                        <div class="pull-right" id="vlrdiferenca"></div>
                    </div>
                </div>
            </div>
            
            <div class="<?= $single ?>"></div>
            
            <div class="<?= $double ?> well" style="min-height:220px;">
                <div class="row box text-center" style="padding:0 0 0 15px; display:block; margin:auto; width:250px; margin-top:15px; margin-bottom:4px;">
                    <div class="btn btn-link">
                        <?= $this->Form->radio('radio_bc', ['banco'   => __('Banco'), 'caixa' => __('Caixa')], 
                                                           ['legend'      => false, 
                                                            'default'     => 'banco', 
                                                            'hiddenField' => false,
                                                            'label'       => ['class' => 'radio-inline btn']
                                                           ]) ?>
                    </div>
                </div>
                
                <div class="row">
                        
                    <div class="<?= $single ?> banco">
                        <label class="<?= $label ?>">
                            <?= __('Banco') ?>
                            <i class="fa fa-info-circle" data-toggle="tooltip" title="<?= __('Esse campo é obrigatório, caso o pagamento tenha sido realizado através de um dos bancos cadastrados.') ?>"></i>
                        </label>
                        <div class="input-group">
                            <div class="input-group-addon input-border-left">
                                <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'content'], ['class' => 'btn btn-primary btn-custom fa fa-plus', 'data-loading-text' => '', 'data-title' => __('Novo Banco'), 'title' => __('Adicionar Banco'), 'escape' => false]) ?>
                            </div>
                            <input id="banks_title" class="form-control input-border-right" type="text" autocomplete="off" placeholder="<?= __('Digite o nome do banco ou adicione') ?>"><div class="loadingBanks"></div>
                        </div>
                        <input name="banks_id" id="banks_id" type="hidden">
                    </div>
                    
                    <div class="<?= $single ?> caixa hidden">
                        <label class="<?= $label ?>">
                            <?= __('Caixa') ?>
                            <i class="fa fa-info-circle" data-toggle="tooltip" title="<?= __('Esse campo é obrigatório, caso o pagamento tenha sido realizado através de um das carteiras cadastradas.') ?>"></i>
                        </label>
                        <div class="input-group">
                            <div class="input-group-addon input-border-left">
                                <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'content'], ['class' => 'btn btn-primary btn-custom fa fa-plus', 'data-loading-text' => '', 'data-title' => __('Novo Caixa'), 'title' => __('Adicionar Caixa'), 'escape' => false]) ?>
                            </div>
                            <input id="boxes_title" class="form-control input-border-right" type="text" autocomplete="off" placeholder="<?= __('Digite o nome da carteira ou adicione') ?>"><div class="loadingBoxes"></div>
                        </div>
                        <input name="boxes_id" id="boxes_id" type="hidden">
                    </div>
                    
                </div>
            </div>
            
            <div class="<?= $double ?> box" style="height:220px;">
                <div class="row">
                    <div class="<?= $single ?>">
                        <label class="<?= $label ?>"><?= __('Observações') ?></label>
                        <?= $this->Form->control('obs', ['label'     => false,
                                                         'type'      => 'textarea',
                                                         'id'        => 'text',
                                                         'maxlength' => '300',
                                                         'class'     => 'form-control form-group'
                                                        ]) ?>
                        <h6 class="pull-right" id="count_message" style="margin-top: -12px;"></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- É para encerrar o corpo do modal e poder iniciar o rodape do modal aqui -->

<div class="modal-footer">
    <?= $this->Form->button(__('Gravar'), ['type' => 'cancel', 'class' => 'btn btn-primary scroll-modal', 'data-dismiss' => 'modal', 'div' => false]) ?>
    <?= $this->Form->button(__('Cancelar'), ['type' => 'cancel', 'class' => 'btn btn-default', 'data-dismiss' => 'modal', 'div' => false]) ?>
    <?= $this->Form->end() ?>
</div>