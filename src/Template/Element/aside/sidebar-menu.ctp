<?php
/**
 * Developed by:
 *     Renée Maksoud
 * 
 * All rights reserved - 2015-2019
 */

/* File: src/Template/Element/aside/sidebar-menu.ctp */

use Cake\Core\Configure;

?>
<ul class="sidebar-menu tree" data-widget="tree">

    <li class="header text-center text-bold">

        <?php 
        $logomarca = $this->request->Session()->read('logomarca');

        if (!empty($logomarca) && file_exists($logomarca)) {

            echo $this->Html->image($logomarca, ['alt'    => 'logomarca',
                                                 'height' => '38px',
                                                 'style'  => 'background-color:#ecf0f5;'
                                                ]);

        } else {

            echo $this->request->Session()->read('brand');

        }//else if (!empty($logomarca) && file_exists($logomarca))
        ?>
        
    </li>

    <li>
        <?= $this->Html->link($this->Html->tag('i', '',['class' => 'fa fa-dashboard']).
                              $this->Html->tag('span', __(' Início')), 
                              ['controller' => 'Pages', 'action' => 'home'], 
                              ['escape' => false]
                             ) ?>
    </li>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-list-ul"></i> <span><?= __(' Lançamentos Financeiros') ?></span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu menu">
            <li><?= $this->Html->link('<i class="fa fa-folder-open-o"></i> '.__('Contas a Pagar/Receber'), ['controller' => 'Controller', 'action' => 'index'], ['class' => 'link_active', 'escape' => false]) ?></li>
            <li><?= $this->Html->link('<i class="fa fa-money"></i> '.__('Movimentos de Caixa'), ['controller' => 'Controller', 'action' => 'index'], ['class' => 'link_active', 'escape' => false]) ?></li>
            <li><?= $this->Html->link('<i class="fa fa-university"></i> '.__('Movimentos de Banco'), ['controller' => 'Controller', 'action' => 'index'], ['class' => 'link_active', 'escape' => false]) ?></li>
            <li><?= $this->Html->link('<i class="fa fa-cc"></i> '.__('Movimentos de Cheque'), ['controller' => 'Controller', 'action' => 'index'], ['class' => 'link_active', 'escape' => false]) ?></li>
            <li><?= $this->Html->link('<i class="fa fa-credit-card-alt"></i> '.__('Lançamentos de Cartão'), ['controller' => 'Controller', 'action' => 'index'], ['class' => 'link_active', 'escape' => false]) ?></li>
            <li><?= $this->Html->link('<i class="fa fa-exchange"></i> '.__('Transferências'), ['controller' => 'Controller', 'action' => 'index'], ['class' => 'link_active', 'escape' => false]) ?></li>
            <li><?= $this->Html->link('<i class="fa fa-trophy"></i> '.__('Planejamentos & Metas'), ['controller' => 'Controller', 'action' => 'index'], ['class' => 'link_active', 'escape' => false]) ?></li>
        </ul>
    </li>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-cubes"></i><span><?= __(' Lançamentos de Estoque') ?></span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu menu">
            <li><?= $this->Html->link('<i class="fa fa-briefcase"></i> '.__('Pedidos de Vendas'), ['controller' => 'Controller', 'action' => 'index'], ['class' => 'link_active', 'escape' => false]) ?></li>
            <li><?= $this->Html->link('<i class="fa fa-shopping-cart"></i> '.__('Pedidos de Compras'), ['controller' => 'Controller', 'action' => 'index'], ['class' => 'link_active', 'escape' => false]) ?></li>
            <li><?= $this->Html->link('<i class="fa fa-paw"></i> '.__('Faturamentos'), ['controller' => 'Controller', 'action' => 'index'], ['class' => 'link_active', 'escape' => false]) ?></li>
            <li><?= $this->Html->link('<i class="fa fa-bullhorn"></i> '.__('Ordens de Fabricação'), ['controller' => 'Controller', 'action' => 'index'], ['class' => 'link_active', 'escape' => false]) ?></li>
            <li><?= $this->Html->link('<i class="fa fa-check-square-o"></i> '.__('Solicitações de Compra'), ['controller' => 'Controller', 'action' => 'index'], ['class' => 'link_active', 'escape' => false]) ?></li>
            <li><?= $this->Html->link('<i class="fa fa-shopping-basket"></i> '.__('Requisições'), ['controller' => 'Controller', 'action' => 'index'], ['class' => 'link_active', 'escape' => false]) ?></li>
            <li><?= $this->Html->link('<i class="fa fa-file-text-o"></i> '.__('Inventários'), ['controller' => 'Controller', 'action' => 'index'], ['class' => 'link_active', 'escape' => false]) ?></li>
        </ul>
    </li>
    
    <li class="treeview">
        <a href="#">
            <i class="fa fa-pencil-square-o"></i><span><?= __(' Cadastros') ?></span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu menu">
            <li><?= $this->Html->link('<i class="fa fa-briefcase"></i> '.__('Clientes'), ['controller' => 'Controller', 'action' => 'index'], ['class' => 'link_active', 'escape' => false]) ?></li>
            <li><?= $this->Html->link('<i class="fa fa-shopping-cart"></i> '.__('Fornecedores'), ['controller' => 'Controller', 'action' => 'index'], ['class' => 'link_active', 'escape' => false]) ?></li>
            <li><?= $this->Html->link('<i class="fa fa-money"></i> '.__('Caixas'), ['controller' => 'Controller', 'action' => 'index'], ['class' => 'link_active', 'escape' => false]) ?></li>
            <li><?= $this->Html->link('<i class="fa fa-university"></i> '.__('Bancos'), ['controller' => 'Controller', 'action' => 'index'], ['class' => 'link_active', 'escape' => false]) ?></li>
            <li><?= $this->Html->link('<i class="fa fa-credit-card-alt"></i> '.__('Cartões'), ['controller' => 'Controller', 'action' => 'index'], ['class' => 'link_active', 'escape' => false]) ?></li>
            <li><?= $this->Html->link('<i class="fa fa-sort-amount-asc"></i> '.__('Planos de Contas'), ['controller' => 'Controller', 'action' => 'index'], ['class' => 'link_active', 'escape' => false]) ?></li>
            <li><?= $this->Html->link('<i class="fa fa-arrows-alt"></i> '.__('Centros de Custos'), ['controller' => 'Controller', 'action' => 'index'], ['class' => 'link_active', 'escape' => false]) ?></li>
            <li><?= $this->Html->link('<i class="fa fa-files-o"></i> '.__('Tipos de Documentos'), ['controller' => 'Controller', 'action' => 'index'], ['class' => 'link_active', 'escape' => false]) ?></li>
            <li><?= $this->Html->link('<i class="fa fa-random"></i> '.__('Tipos de Eventos'), ['controller' => 'Controller', 'action' => 'index'], ['class' => 'link_active', 'escape' => false]) ?></li>
        </ul>
    </li>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-file-text-o"></i><span><?= __(' Relatórios') ?></span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu menu">
            <li><?= $this->Html->link('<i class="fa fa-bar-chart"></i> '.__('Relatório Geral'), ['controller' => 'Controller', 'action' => 'report'], ['class' => 'btn_modal', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Relatório Geral'), 'escape' => false]) ?></li>
            <li><?= $this->Html->link('<i class="fa fa-folder-open-o"></i> '.__('Contas a Pagar/Receber'), ['controller' => 'Controller', 'action' => 'report'], ['class' => 'btn_modal', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Relatório - Movimentos Financeiros'), 'escape' => false]) ?></li>
            <li><?= $this->Html->link('<i class="fa fa-money"></i> '.__('Movimentos de Caixa'), ['controller' => 'Controller', 'action' => 'report'], ['class' => 'btn_modal', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Relatório - Movimentos de Caixa'), 'escape' => false]) ?></li>
            <li><?= $this->Html->link('<i class="fa fa-university"></i> '.__('Movimentos de Banco'), ['controller' => 'Controller', 'action' => 'report'], ['class' => 'btn_modal', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Relatório - Movimentos de Banco'), 'escape' => false]) ?></li>
            <li><?= $this->Html->link('<i class="fa fa-cc"></i> '.__('Movimentos de Cheque'), ['controller' => 'Controller', 'action' => 'report'], ['class' => 'btn_modal', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Relatório - Movimentos de Cheques'), 'escape' => false]) ?></li>
            <li><?= $this->Html->link('<i class="fa fa-credit-card-alt"></i> '.__('Lançamentos de Cartão'), ['controller' => 'Controller', 'action' => 'report'], ['class' => 'btn_modal', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Relatório - Movimentos de Cartões'), 'escape' => false]) ?></li>
            <li><?= $this->Html->link('<i class="fa fa-exchange"></i> '.__('Transferências'), ['controller' => 'Controller', 'action' => 'report'], ['class' => 'btn_modal', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Relatório - Movimentos de Transferência'), 'escape' => false]) ?></li>
            <li><?= $this->Html->link('<i class="fa fa-list-ul"></i> '.__('Relação de Pagamentos'), ['controller' => 'Controller', 'action' => 'report'], ['class' => 'btn_modal', 'data-loading-text' => __('Carregando...'), 'data-title' => __('Relatório - Relação de Pagamentos'), 'escape' => false]) ?></li>
        </ul>
    </li>

    <!-- 
    <li><a href="<php echo $this->Url->build('/pages/debug'); ?>"><i class="fa fa-bug"></i> Debug</a></li>
    -->

    <li>
        <?= $this->Html->link($this->Html->tag('i', '',['class' => 'fa fa-comments-o']).
                              $this->Html->tag('span', __(' Chamados de Suporte')), 
                              ['controller' => 'Controller', 'action' => 'index'], 
                              ['escape' => false]
                             ) ?>
    </li>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-question-circle-o"></i><span><?= __(' Sistema') ?></span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu menu">
            <li class="text-nowrap"><a href="#"><i class="fa fa-calendar"></i> <?= __('Validade: ').$this->request->Session()->read('validade') ?></a></li>
            <li class="text-nowrap"><a href="#"><i class="fa fa-briefcase"></i> <?= __('Plano: ').$this->request->Session()->read('plan') ?></a></li>
            <li class="text-nowrap"><a href="#"><i class="fa fa-code"></i> <?= __('Versão: ').$this->request->Session()->read('version') ?></a></li>
            <li class="text-nowrap"><a href="#"><i class="fa fa-picture-o"></i> <?= __('Res. Janela: ') ?><span class="window-size"></span></a></li>
            <li class="text-nowrap"><a href="#"><i class="fa fa-television" class="fa fa-television"></i> <?= __('Res. Monitor: ') ?><span class="screen-size"></span></a></li>
        </ul>
    </li>
</ul>