<?php
/**
 * Developed by:
 *     Renée Maksoud
 * 
 * All rights reserved - 2015-2019
 */

/* File: src/Template/Element/aside-main-sidebar.ctp */

use Cake\Core\Configure;

?>

<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="background-color:#222D32;">

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <?= $this->element('aside/sidebar-menu'); ?>

    </section>
    <!-- /.sidebar -->
</aside>