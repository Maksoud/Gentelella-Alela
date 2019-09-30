<?php

/**
 * Developed by:
 *     Renée Maksoud
 * 
 * All rights reserved - 2015-2019
 */

/* File: src/Template/Element/pagination.ctp */
?>

<div class="col-xs-12 text-center">
    <nav class="pagination justify-content-center top-0 bottom-30">
        <ul class="pagination">

            <li class="page-item"></li>

            <li class="active"><a href="">1</a></li>
            <li><a href="#?page=2">2</a></li>
            <li><a href="#?page=3">3</a></li>
            <li><a href="#?page=4">4</a></li>
            <li><a href="#?page=5">5</a></li>

            <li class="page-item"></li>

            <li class="last"><a href="#?page=999"><?= __('Último') ?></a></li>

            <!-- <li class="page-item disabled">
                <= $this->Paginator->first(__('Primeiro'), ['class' => 'paginate_button', 'tag' => 'li', 'escape' => false]); ?>
            </li>
            <li class="page-item">
                <= $this->Paginator->numbers(['class' => 'paginate_button', 'separator' => '', 'tag' => 'li', 'currentLink' => true, 'currentClass' => 'active', 'currentTag' => 'a', 'modulus' => 4]); ?>
            </li>
            <li class="page-item">
                <= $this->Paginator->last(__('Último'), ['class' => 'paginate_button', 'escape' => false]); ?>
            </li> -->

        </ul>
    </nav>
</div>