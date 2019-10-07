<?php
/**
 * Developed by:
 *     Renée Maksoud
 * 
 * All rights reserved - 2015-2019
 */

/* File: src/Template/Element/navbar-up.ctp */
?>

<nav class="navbar navbar-static-top">
  <!-- Sidebar toggle button -->
  <a href="#" class="sidebar-toggle btn" data-toggle="offcanvas" role="button">
    <span class="sr-only"><?= __('Menu'); ?></span>
  </a>

  <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">

      <li class="notifications-menu hidden-xs">
        <span style="float:left;margin:16px 4px;font-weight:bold;white-space:nowrap;color:#FFF;">
          <?= $this->request->Session()->read('debug') ? '<i class="fa fa-bug"></i>&nbsp;' : ''; ?>
          <?= date('d/m/Y') ?> &nbsp;|&nbsp; <span id="timer"><?= date('H:i:s') ?></span>&nbsp;|&nbsp;
        </span>
      </li>

      <li class="notifications-menu">
        <span style="float:left;margin-top:16px;white-space:nowrap;color:#FFF;">
          <span class="hidden-xs"><?= __('Sua sessão expira em: ') ?></span><span class="text-bold" id="countdown"></span>
          <span id="server_datetime" style="visibility: hidden; position: absolute;"><?= date('M d Y H:i:s') ?></span>
          <script>
            setInterval(function() {
              var current_date = new Date(document.getElementById("server_datetime").innerHTML);
              document.getElementById("server_datetime").innerHTML = new Date(current_date.setSeconds(current_date.getSeconds() + 1));
            }, 1000);

            window.onload = function() {

              var session_timeout, current_date, target_date, hours, minutes, seconds;
              var countdown = document.getElementById("countdown");

              //Timeout do sistema
              session_timeout = <?= $this->request->Session()->read('Session.timeout'); ?>;

              current_date = new Date(document.getElementById("server_datetime").innerHTML);
              target_date = new Date(current_date.setMinutes(current_date.getMinutes() + parseInt(session_timeout)));

              setInterval(function() {

                //var current_date = new Date();
                current_date = new Date(document.getElementById("server_datetime").innerHTML);
                var seconds_left = (target_date - current_date) / 1000;

                //console.log("Target Date: " + target_date);
                //console.log("Current Date: " + current_date);

                minutes = parseInt(seconds_left / 60);
                seconds = parseInt(seconds_left % 60);

                if (minutes >= 0 && minutes < 10) {
                  minutes = "0" + minutes;
                }
                if (seconds >= 0 && seconds < 10) {
                  seconds = "0" + seconds;
                }

                if (minutes < 0 || seconds < 0) {
                  //location.reload(); 
                } else {
                  if (minutes < 1 && seconds < 1) {
                    //location.reload(); 
                    location.href = "<?= $this->Url->build('/logout', true); ?>";
                  } else {
                    countdown.innerHTML = minutes + ":" + seconds;
                  }
                }
              }, 1000);

            } //window.onload = function()
          </script>
        </span>
      </li>

      <!-- User Account: style can be found in dropdown.less -->
      <li class="dropdown user user-menu">
        <span style="color:#f6f6f6;font-size:14px;margin:16px 12px;position:relative;display:block;">
          <?= __('Olá, ') ?>
          <?= $this->request->Session()->read('username') ?>
        </span>
      </li>

      <?php
      if ($this->request->Session()->read('locale') == 'en_US') {

        $locale = 'brz.png';
        $text_idioma = ' Mudar Idioma';

      } elseif ($this->request->Session()->read('locale') == 'pt_BR') {

        $locale = 'usa.png';
        $text_idioma = ' Change Idiom';

      }//elseif ($this->request->Session()->read('locale') == 'pt_BR')
      ?>

      <!-- Control Sidebar Toggle Button -->
      <li class="dropdown notifications-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-gears"></i>
        </a>
        <ul class="dropdown-menu">
          <li>
            <ul class="control-sidebar-menu menu list-group" style="max-height:unset;">
              <li><?= $this->Html->link($this->Html->image($locale, ['width' => '15px']) . $text_idioma, ['controller' => 'Pages', 'action' => 'changeLocale'], ['escape' => false]) ?></li>
              <li><?= $this->Html->link('<i class="fa fa-database"></i> ' . __('Meus Dados'), ['controller' => 'Pages', 'action' => 'content'], ['escape' => false]) ?></li>
              <li><?= $this->Html->link('<i class="fa fa-user-plus"></i> ' . __('Usuários'), ['controller' => 'Pages', 'action' => 'content'], ['escape' => false]) ?></li>
              <li><?= $this->Html->link('<i class="fa fa-usd"></i> ' . __('Pagamentos do Sistema'), ['controller' => 'Pages', 'action' => 'content'], ['escape' => false]) ?></li>
              <li><?= $this->Html->link('<i class="fa fa-download"></i> ' . __('Backup do Sistema'), ['controller' => 'Pages', 'action' => 'content'], ['escape' => false]) ?></li>
              <li><?= $this->Html->link('<i class="fa fa-cloud-download"></i> ' . __('Atualizar Sistema'), ['controller' => 'Pages', 'action' => 'update'], ['escape' => false]) ?></li>
              <li><?= $this->Html->link('<i class="fa fa-comments-o"></i> ' . __('Chamados de Suporte'), ['controller' => 'Pages', 'action' => 'content'], ['escape' => false]) ?></li>
            </ul>
          </li>
        </ul>
      </li>
      <li><?= $this->Html->link('<i class="fa fa-sign-out"></i>', ['controller' => 'Pages', 'action' => 'logout'], ['title' => __('Sair'), 'escape' => false]) ?></li>
    </ul>
  </div>
</nav>