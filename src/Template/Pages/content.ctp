<?php
/**
 * Developed by:
 *     Renée Maksoud
 * 
 * All rights reserved - 2015-2019
 */

/* File: src/Template/Pages/content.ctp */
?>

<div class="col-xs-12 col-md-12 col-sm-12 container top-20">

    <div class="col-xs-12 panel" style="float: none;">
        <div class="pull-right"><?= $this->Html->link(__('Incluir'), ['controller' => 'Pages', 'action' => 'modalContent'], ['class' => 'btn btn-primary fa fa-plus-circle top-20 right-10 btn_modal', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Novo Cadastro'), 'escape' => false]) ?></div>
        <h3 class="page-header top-20"><?= __('Página Interna') ?></h3>
    </div>

    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed box-shadow btn bottom-10" style="color:#fff;background-color:#337ab7;border-color:#2e6da4;" data-toggle="collapse" data-target="#search-collapse">
            <i class="fa fa-search"></i> <?= __('Filtros de Busca') ?>
        </button>
    </div>

    <div class="collapse navbar-collapse" id="search-collapse">
        <div class="row form-busca bottom-10">
            <div class="col-xs-12 box box-body">
                <?= $this->Form->create(null, ['type' => 'get', 'class' => 'form-inline']); ?>
                    <?= $this->Form->control('code_search', ['type' => 'text', 'templates' => ['inputContainer' => '{{content}}'], 'class' => 'form-control top-5', 'label' => false, 'placeholder' => __('Código do Registro'), 'value' => @$this->request->query['code_search']]); ?>
                    <?= $this->Form->control('customers_search', ['type' => 'text', 'templates' => ['inputContainer' => '{{content}}'], 'class' => 'form-control top-5', 'label' => false, 'placeholder' => __('Cliente'), 'value' => @$this->request->query['customers_search']]); ?>
                    <?= $this->Form->control('status_search', ['type' => 'select', 'templates' => ['inputContainer' => '{{content}}'], 'class' => 'form-control top-5', 'label' => false, 'empty' => __('- status -'), 'options' => ['P' => __('Pendente'),
                                                                                                                                                                                                                                     'D' => __('Em Entrega'),
                                                                                                                                                                                                                                     'E' => __('Entrega Parcial'),
                                                                                                                                                                                                                                     'C' => __('Cancelado'),
                                                                                                                                                                                                                                     'F' => __('Finalizado')
                                                                                                                                                                                                                                    ], // P - pending, D - in delivery, E - partial delivery, C - cancelled, F - finalized
                                                               'value' => @$this->request->query['status_search']]); ?>
                    <?= $this->Form->button(__('Buscar'), ['type' => 'submit', 'class' => 'btn btn-primary fa fa-search top-5', 'data-loading-text' => __('Buscando...'), 'div' => false]) ?>
                    <input type="hidden" name="iniciar_busca" value="true">
                    <?= $this->Html->link(__('Listar Todos'), ['controller' => 'Pages', 'action' => 'content'], ['class'=>'btn btn-default fa fa-list top-5', 'id' => 'btn-resetar-form', 'style' => 'display:none;', 'escape' => false]); ?>
                <?= $this->Form->end(); ?>
            </div>
        </div>
    </div>

    <!-- 
        Implementado para corrigir falha de conflito do postLink
        com o Form->button que permite a exclusão de mais de um
        registro ao mesmo tempo. Falha: O primeiro postLink após
        a declaração do Form->create não exibe o <form> no HTML.
        Necessário estar localizado após o Form->button e antes
        da listagem. 07/2017
    -->

    <?= $this->Form->postLink('') ?>
	
        <div class="col-xs-12 panel" style="float: none;">
            <div class="bottom-20"><?= $this->Form->button(__('Excluir Selecionados'), ['type' => 'submit', 'class' => 'btn btn-primary top-20 right-10 fa fa-trash-o', 'div' => false]) ?></div>
        </div>

        <div class="table-responsive">
            <table class="table no-margin table-striped dataTable no-footer">
                <thead>
                    <tr>
                        <th class="text-center hidden-print" style="width: 20px">
                            <?= $this->Form->control('select_all', ['type'        => 'checkbox', 
                                                                    'id'          => 'select_all',
                                                                    'label'       => false, 
                                                                    'templates'   => ['inputContainer' => '{{content}}'],
                                                                    'hiddenField' => false,
                                                                    'class'       => 'btn btn-actions',
                                                                   ]) ?>
                        </th>
                        <th class="text-left col-xs-1"><?= __('Código') ?></th>
                        <th class="text-nowrap col-xs-1"><?= __('Data do Lançamento') ?></th>
                        <th class="text-nowrap col-xs-1"><?= __('Prazo de Entrega') ?></th>
                        <th class="text-left"><?= __('Cliente') ?></th>
                        <th class="text-nowrap col-xs-1"><?= __('Total Geral') ?></th>
                        <th class="text-center col-xs-1"><?= __('Status') ?></th>
                        <th class="text-center col-xs-1"><?= __('Ações') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="initialism">
                        <td class="text-center hidden-print">
                            <?= $this->Form->control('record[1234]', ['type'        => 'checkbox', 
                                                                      'multiple'    => true,
                                                                      'label'       => false, 
                                                                      'templates'   => ['inputContainer' => '{{content}}'],
                                                                      'hiddenField' => false,
                                                                      'class'       => 'btn btn-actions',
                                                                      'style'       => 'margin-top:0;',
                                                                      'value'       => 'file',
                                                                     ]) ?>
                            <?= $this->Form->control('source[1234]', ['type' => 'hidden', 'value' => 'source']) ?>
                        </td>
                        <td class="text-left"><?= str_pad(1234, 6, '0', STR_PAD_LEFT) ?></td>
                        <td class="text-left"><?= $this->MyHtml->date(date('Y-m-d')) ?></td>
                        <td class="text-left"><?= $this->MyHtml->date(date('Y-m-d', strtotime('+1 day'))) ?></td>
                        <td class="text-left"><?= __('Nome do Cliente').' 1' ?></td>
                        <td class="text-left"><?= $this->Number->precision(1234.56, 2); ?></td>
                        <td class="text-center"><?= __('Finalizado') ?></td>
                        <td class="btn-actions-group">
                            <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'modalContent'], ['class' => 'btn btn-actions btn_modal fa fa-eye', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Dados do Cadastro'), 'title' => __('Visualizar'), 'escape' => false]) ?>                         
                            <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'modalContent'], ['class' => 'btn btn-actions btn_modal fa fa-pencil', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Editar Cadastro'), 'title' => __('Editar'), 'escape' => false]) ?>
                            <?= $this->Form->postLink('', ['controller' => 'Pages', 'action' => 'content'], ['confirm' => __('Você tem certeza que deseja FINALIZAR o registro?'), 'class' => 'btn btn-actions fa fa-check', 'data-loading-text' => __('Carregando...'), 'title' => __('Finalizar Compra'), 'escape' => false]) ?>
                            <?= $this->Form->postLink('', ['controller' => 'Pages', 'action' => 'content'], ['confirm' => __('Você tem certeza que deseja EXCLUIR o registro?'), 'class' => 'btn btn-actions fa fa-trash-o', 'title' => __('Excluir'), 'escape' => false]) ?>
                        </td>
                    </tr>
                    <tr class="initialism">
                        <td class="text-center hidden-print">
                            <?= $this->Form->control('record[1235]', ['type'        => 'checkbox', 
                                                                      'multiple'    => true,
                                                                      'label'       => false, 
                                                                      'templates'   => ['inputContainer' => '{{content}}'],
                                                                      'hiddenField' => false,
                                                                      'class'       => 'btn btn-actions',
                                                                      'value'       => 'file',
                                                                     ]) ?>
                            <?= $this->Form->control('source[1235]', ['type' => 'hidden', 'value' => 'source']) ?>
                        </td>
                        <td class="text-left"><?= str_pad(1235, 6, '0', STR_PAD_LEFT) ?></td>
                        <td class="text-left"><?= $this->MyHtml->date(date('Y-m-d')) ?></td>
                        <td class="text-left"><?= $this->MyHtml->date(date('Y-m-d', strtotime('+2 days'))) ?></td>
                        <td class="text-left"><?= __('Nome do Cliente').' 2' ?></td>
                        <td class="text-left"><?= $this->Number->precision(2469.12, 2); ?></td>
                        <td class="text-center"><?= __('Finalizado') ?></td>
                        <td class="btn-actions-group">
                            <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'modalContent'], ['class' => 'btn btn-actions btn_modal fa fa-eye', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Dados do Cadastro'), 'title' => __('Visualizar'), 'escape' => false]) ?>                         
                            <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'modalContent'], ['class' => 'btn btn-actions btn_modal fa fa-pencil', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Editar Cadastro'), 'title' => __('Editar'), 'escape' => false]) ?>
                            <?= $this->Form->postLink('', ['controller' => 'Pages', 'action' => 'content'], ['confirm' => __('Você tem certeza que deseja FINALIZAR o registro?'), 'class' => 'btn btn-actions fa fa-check', 'data-loading-text' => __('Carregando...'), 'title' => __('Finalizar Compra'), 'escape' => false]) ?>
                            <?= $this->Form->postLink('', ['controller' => 'Pages', 'action' => 'content'], ['confirm' => __('Você tem certeza que deseja EXCLUIR o registro?'), 'class' => 'btn btn-actions fa fa-trash-o', 'title' => __('Excluir'), 'escape' => false]) ?>
                        </td>
                    </tr>
                    <tr class="initialism">
                        <td class="text-center hidden-print">
                            <?= $this->Form->control('record[1236]', ['type'        => 'checkbox', 
                                                                      'multiple'    => true,
                                                                      'label'       => false, 
                                                                      'templates'   => ['inputContainer' => '{{content}}'],
                                                                      'hiddenField' => false,
                                                                      'class'       => 'btn btn-actions',
                                                                      'value'       => 'file',
                                                                     ]) ?>
                            <?= $this->Form->control('source[1236]', ['type' => 'hidden', 'value' => 'source']) ?>
                        </td>
                        <td class="text-left"><?= str_pad(1236, 6, '0', STR_PAD_LEFT) ?></td>
                        <td class="text-left"><?= $this->MyHtml->date(date('Y-m-d')) ?></td>
                        <td class="text-left"><?= $this->MyHtml->date(date('Y-m-d', strtotime('+3 days'))) ?></td>
                        <td class="text-left"><?= __('Nome do Cliente').' 3' ?></td>
                        <td class="text-left"><?= $this->Number->precision(3703.68, 2); ?></td>
                        <td class="text-center"><?= __('Finalizado') ?></td>
                        <td class="btn-actions-group">
                            <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'modalContent'], ['class' => 'btn btn-actions btn_modal fa fa-eye', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Dados do Cadastro'), 'title' => __('Visualizar'), 'escape' => false]) ?>                         
                            <?= $this->Html->link('', ['controller' => 'Pages', 'action' => 'modalContent'], ['class' => 'btn btn-actions btn_modal fa fa-pencil', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Editar Cadastro'), 'title' => __('Editar'), 'escape' => false]) ?>
                            <?= $this->Form->postLink('', ['controller' => 'Pages', 'action' => 'content'], ['confirm' => __('Você tem certeza que deseja FINALIZAR o registro?'), 'class' => 'btn btn-actions fa fa-check', 'data-loading-text' => __('Carregando...'), 'title' => __('Finalizar Compra'), 'escape' => false]) ?>
                            <?= $this->Form->postLink('', ['controller' => 'Pages', 'action' => 'content'], ['confirm' => __('Você tem certeza que deseja EXCLUIR o registro?'), 'class' => 'btn btn-actions fa fa-trash-o', 'title' => __('Excluir'), 'escape' => false]) ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-xs-12 panel" style="float: none;">
            <div class="bottom-20"><?= $this->Form->button(__('Excluir Selecionados'), ['type' => 'submit', 'class' => 'btn btn-primary top-20 right-10 fa fa-trash-o', 'div' => false]) ?></div>
        </div>

    <?= $this->Form->end() ?>
    
    <?= $this->element('pagination') ?>
    
</div>