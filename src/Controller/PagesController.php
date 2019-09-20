<?php

/**
 * Developed by:
 *     Renée Maksoud
 * 
 * All rights reserved - 2015-2019
 */

/* File: src/Controller/PagesController.php */

namespace App\Controller;

use Cake\ORM\TableRegistry;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Datasource\ConnectionManager;
use Cake\I18n\I18n;
use Cake\Log\Log;

class PagesController extends AppController
{
    public function initialize()
    {
        parent::initialize();

        //Autoriza a exibição das páginas
        $this->Auth->allow(['login', 'logout', 'home']);

        //Carrega janela com informações sobre a validade do sistema
        $this->validade();

    }
    
    public function home()
    {
        //Variáveis:
        $this->set('id', 0);
        
        /********/

        /* SAÚDE FINANCEIRA - GRÁFICO */
        $dtinicial = date('Y-01-01');
        $dtfinal   = date('Y-12-31');
        
        /********/
        
        $m = $variable = 1;
        while ($m <= 12) {

            $variable            = $variable + (rand(-15, $m));

            $receitas[$m]        = $variable + (rand(-5, 35)); //Receitas Orçadas
            $receitas_r[$m]      = $variable + (rand(-5, 35) / 2); //Receitas Realizadas

            $despesas[$m]        = $variable - (rand(-5, 15)); //Despesas Orçadas
            $despesas_r[$m]      = $variable - (rand(-5, 15) / 2); //Despesas Realizadas

            $orcado[$m]          = $receitas[$m] - $despesas[$m]; //Resumo Orçado
            $realizado[$m]       = $receitas_r[$m] - $despesas_r[$m]; //Resumo Realizado

            $saude_media_ano[$m] = $receitas_r[$m] - $despesas_r[$m]; //Orçado quando não realizado
            $m++;

        }//while ($m <= 12)
        
        /********/

        $saude_media_ano = array_filter($saude_media_ano);
        $saude_media_ano = array_sum($saude_media_ano) / count($saude_media_ano);

        // debug($receitas);
        // debug($receitas_r);
        // debug($despesas);
        // debug($despesas_r);
        // debug($orcado);
        // debug($realizado);
        // debug($saude_media_ano);
        
        /********/

        $m = 1;
        while ($m <= 12) {
            
            //$m = str_pad($m, 2, "0", STR_PAD_LEFT);
            
            if ($receitas[$m] > 0 && $despesas[$m] > 0) { //orçado
                $orcado[$m] = number_format((100 - ($despesas[$m] * 100) / $receitas[$m]), 0, '.', '');
            } else {
                if ($receitas[$m] > 0) {$orcado[$m] = 100;}
                if ($despesas[$m] > 0) {$orcado[$m] = -100;}
            }
            
            if ($receitas_r[$m] > 0 && $despesas_r[$m] > 0) { //realizado
                $realizado[$m] = number_format((100 - ($despesas_r[$m] * 100) / $receitas_r[$m]), 0, '.', '');
            } else {
                if ($receitas_r[$m] > 0) {$realizado[$m] = 100;}
                if ($despesas_r[$m] > 0) {$realizado[$m] = 0;}
            }

            $m++;

        }//while ($m <= 12)
        
        /********/

        // debug($orcado);
        // debug($realizado);
        
        $this->set('saude_orcado', $orcado); //orçado
        $this->set('saude_realizado', $realizado); //realizado
        $this->set('saude_media_ano', round($saude_media_ano, 0)); //orçado quando não realizado
        
        /**********************************************************************/
        
        /* SAÚDE FINANCEIRA NO MÊS ATUAL */
        
        $receitas               = round(3500, 8500);
        $despesas               = round(1500, 3750);
        
        //Orçado
        $receitas_mes_orcado    = $receitas + ($receitas * 0.6);
        $despesas_mes_orcado    = $despesas + ($despesas * 0.4);
        
        //Realizado
        $receitas_mes_realizado = $receitas_mes_orcado - ($receitas_mes_orcado * 0.7);
        $despesas_mes_realizado = $despesas_mes_orcado - ($despesas_mes_orcado * 0.4);
        
        //Em aberto
        $receitas_mes_aberto    = $receitas_mes_orcado - $receitas_mes_realizado;
        $despesas_mes_aberto    = $despesas_mes_orcado - $despesas_mes_realizado;
        
        /********/

        //Inicializa as variáveis
        $per_orcado    = null;
        $per_realizado = null;
        $per_aberto    = null;
        $percent       = null;
        
        /********/
        
        //CÁLCULO DO PERCENTUAL DA SAÚDE FINANCEIRA DO MÊS
        if ($receitas > 0 && $despesas > 0) {
            $percent = 100 - (($despesas * 100) / $receitas);
        } else {
            if ($receitas > 0) {$percent = 100;}
            if ($despesas > 0) {$percent = 0;}
            if ($receitas == 0 && $despesas == 0) {$percent = 0;}
        }
        
        /********/
        
        //CÁLCULO DO PERCENTUAL ORÇADO
        if ($receitas_mes_orcado > 0 && $despesas_mes_orcado > 0) {
            $per_orcado = 100 - (($despesas_mes_orcado * 100) / $receitas_mes_orcado);
        } else {
            if ($receitas_mes_orcado > 0) {$per_orcado = 100;}
            if ($despesas_mes_orcado > 0) {$per_orcado = 0;}
            if ($receitas_mes_orcado == 0 && $despesas_mes_orcado == 0) {$per_orcado = 0;}
        }
        
        /********/
        
        //CÁLCULO DO PERCENTUAL REALIZADO
        if ($receitas_mes_realizado > 0 && $despesas_mes_realizado > 0) {
            $per_realizado = 100 - (($despesas_mes_realizado * 100) / $receitas_mes_realizado);
        } else {
            if ($receitas_mes_realizado > 0) {$per_realizado = 100;}
            if ($despesas_mes_realizado > 0) {$per_realizado = 0;}
            if ($receitas_mes_realizado == 0 && $despesas_mes_realizado == 0) {$per_realizado = 0;}
        }
        
        /********/
        
        //CÁLCULO DO PERCENTUAL EM ABERTO
        if ($receitas_mes_aberto > 0 && $despesas_mes_aberto > 0) {
            $per_aberto = 100 - (($despesas_mes_aberto * 100) / $receitas_mes_aberto);
        } else {
            if ($receitas_mes_aberto > 0) {$per_aberto = 100;}
            if ($despesas_mes_aberto > 0) {$per_aberto = 0;}
            if ($receitas_mes_aberto == 0 && $despesas_mes_aberto == 0) {$per_aberto = 0;}
        }
        
        /********/

        $this->set('percent', number_format($percent, 0));
        $this->set('per_orcado', number_format($per_orcado, 0));
        $this->set('per_realizado', number_format($per_realizado, 0));
        $this->set('per_aberto', number_format($per_aberto, 0));

        $this->set('receitas', $receitas);
        $this->set('despesas', $despesas);

        $this->set('receitas_mes_orcado', $receitas_mes_orcado);
        $this->set('despesas_mes_orcado', $despesas_mes_orcado);

        $this->set('receitas_mes_realizado', $receitas_mes_realizado);
        $this->set('despesas_mes_realizado', $despesas_mes_realizado);

        $this->set('receitas_mes_aberto', $receitas_mes_aberto);
        $this->set('despesas_mes_aberto', $despesas_mes_aberto);
        
        /**********************************************************************/
        
    }
    
    public function login() 
    {
        if ($this->request->is('post')) {
            
            $user = $this->Auth->identify();
            
            if ($user) {
                
                $this->Auth->setUser($user);
                
                //REDIRECIONA PARA PÁGINA INICIAL
                return $this->redirect($this->Auth->redirectUrl());

            }//else if ($user)
            
            $this->Flash->error(__('Usuário/senha incorreto, tente novamente'));
            return $this->redirect($this->Auth->logout());
        }
    }
    
    public function logout() 
    {
        $this->request->Session()->destroy();
        
        $this->Flash->success(__('Sessão Finalizada'));
        return $this->redirect($this->Auth->logout());
    }
    
    public function debugMode()
    {
        $debug = Configure::read('debug');
        
        if ($debug) {
            
            Configure::write('debug', false);
            $this->Flash->warning(__('Modo DEBUG desativado!'));
            
        } else {
            
            Configure::write('debug', true);
            $this->Flash->warning(__('Modo DEBUG ativo!'));
            
        }//else if ($debug)
        
        $this->request->Session()->write('debug', $debug);
        
        return $this->redirect($this->referer());
    }
    
    public function display(...$path)
    {
        $count = count($path);
        if (!$count) {
            return $this->redirect('/');
        }
        if (in_array('..', $path, true) || in_array('.', $path, true)) {
            throw new ForbiddenException();
        }
        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        $this->set(compact('page', 'subpage'));

        try {
            $this->render(implode('/', $path));
        } catch (MissingTemplateException $e) {
            if (Configure::read('debug')) {
                throw $e;
            }
            throw new NotFoundException();
        }
    }
}
