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
        $this->Auth->allow(['login', 'logout', 'home', 'content', 'modalContent']);

        //Carrega janela com informações sobre a validade do sistema
        $this->validade();

    }
    
    public function home()
    {
        //Variáveis:
        $this->set('id', 0);

        /**********************************************************************/

        /* SAÚDE FINANCEIRA NO MÊS ATUAL */
        
        //Valor variável
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
        
        //CÁLCULO DO PERCENTUAL DA SAÚDE FINANCEIRA DO MÊS
        if ($receitas > 0 && $despesas > 0) {
            
            $percent = 100 - (($despesas * 100) / $receitas);

        } else {
            
            if ($receitas > 0) {$percent = 100;}
            if ($despesas > 0) {$percent = 0;}
            if ($receitas == 0 && $despesas == 0) {$percent = 0;}
            if ($receitas < 0 && $despesas < 0) {$percent = 0;} //Falha

        }//else if ($receitas > 0 && $despesas > 0)
        
        /********/
        
        //CÁLCULO DO PERCENTUAL ORÇADO
        if ($receitas_mes_orcado > 0 && $despesas_mes_orcado > 0) {
            
            $per_orcado = 100 - (($despesas_mes_orcado * 100) / $receitas_mes_orcado);

        } else {
            
            if ($receitas_mes_orcado > 0) {$per_orcado = 100;}
            if ($despesas_mes_orcado > 0) {$per_orcado = 0;}
            if ($receitas_mes_orcado == 0 && $despesas_mes_orcado == 0) {$per_orcado = 0;}
            if ($receitas_mes_orcado < 0 && $despesas_mes_orcado < 0) {$per_orcado = 0;} //Falha

        }//else if ($receitas_mes_orcado > 0 && $despesas_mes_orcado > 0)
        
        /********/
        
        //CÁLCULO DO PERCENTUAL REALIZADO
        if ($receitas_mes_realizado > 0 && $despesas_mes_realizado > 0) {
            
            $per_realizado = 100 - (($despesas_mes_realizado * 100) / $receitas_mes_realizado);

        } else {
            
            if ($receitas_mes_realizado > 0) {$per_realizado = 100;}
            if ($despesas_mes_realizado > 0) {$per_realizado = 0;}
            if ($receitas_mes_realizado == 0 && $despesas_mes_realizado == 0) {$per_realizado = 0;}
            if ($receitas_mes_realizado < 0 && $despesas_mes_realizado < 0) {$per_realizado = 0;} //Falha

        }//else if ($receitas_mes_realizado > 0 && $despesas_mes_realizado > 0)
        
        /********/
        
        //CÁLCULO DO PERCENTUAL EM ABERTO
        if ($receitas_mes_aberto > 0 && $despesas_mes_aberto > 0) {

            $per_aberto = 100 - (($despesas_mes_aberto * 100) / $receitas_mes_aberto);

        } else {

            if ($receitas_mes_aberto > 0) {$per_aberto = 100;}
            if ($despesas_mes_aberto > 0) {$per_aberto = 0;}
            if ($receitas_mes_aberto == 0 && $despesas_mes_aberto == 0) {$per_aberto = 0;}
            if ($receitas_mes_aberto < 0 && $despesas_mes_aberto < 0) {$per_aberto = 0;} //Falha

        }//else if ($receitas_mes_aberto > 0 && $despesas_mes_aberto > 0)
        
        /********/

        // echo 'Valor variável:<br>';
        // echo $receitas.'<br>';
        // echo $despesas.'<br>';
        
        // echo 'Orçado:<br>';
        // echo $receitas_mes_orcado.'<br>';
        // echo $despesas_mes_orcado.'<br>';
        
        // echo 'Realizado:<br>';
        // echo $receitas_mes_realizado.'<br>';
        // echo $despesas_mes_realizado.'<br>';
        
        // echo 'Em aberto:<br>';
        // echo $receitas_mes_aberto.'<br>';
        // echo $despesas_mes_aberto.'<br>';

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

        /* SAÚDE FINANCEIRA - GRÁFICO */
        
        $variable = 1;
        for ($m = 1; $m <= 12; $m++) {

            //Valor aleatório
            $variable = $variable + (rand(0, $m));

            //Mês atual
            if ($m == date('m')) {

                //Receitas
                $receitas_orcado[$m]    = $receitas_mes_orcado;
                $receitas_realizado[$m] = $receitas_mes_realizado;

                //Despesas
                $despesas_orcado[$m]    = $despesas_mes_orcado;
                $despesas_realizado[$m] = $despesas_mes_realizado;

            } else {

                //Receitas
                $receitas_orcado[$m]    = $variable + (rand(0, 35));
                $receitas_realizado[$m] = $variable + (rand(0, 35) / 2);

                //Despesas
                $despesas_orcado[$m]    = $variable + (rand(0, 15));
                $despesas_realizado[$m] = $variable + (rand(0, 15) / 2);

            }//else if ($m == date('m'))
        
            /********/

            //Resultado
            $saude_orcado[$m]    = $receitas_orcado[$m] - $despesas[$m];
            $saude_realizado[$m] = $receitas_realizado[$m] - $despesas_realizado[$m];

            //Saúde Média anual realizada
            $saude_media_ano[$m] = $receitas_realizado[$m] - $despesas_realizado[$m];
        
            /********/

            //Orçado
            if ($receitas_orcado[$m] > 0 && $despesas_orcado[$m] > 0) {
                
                $saude_orcado[$m] = number_format((100 - ($despesas_orcado[$m] * 100) / $receitas_orcado[$m]), 0, '.', '');

            } else {
                
                //Ajusta do gráfico
                if ($receitas_orcado[$m] > 0) {$saude_orcado[$m] = 100;}
                if ($despesas_orcado[$m] > 0) {$saude_orcado[$m] = -100;}

            }//else if ($receitas_orcado[$m] > 0 && $despesas_orcado[$m] > 0)
        
            /********/
            
            //Realizado
            if ($receitas_realizado[$m] > 0 && $despesas_realizado[$m] > 0) {
                
                $saude_realizado[$m] = number_format((100 - ($despesas_realizado[$m] * 100) / $receitas_realizado[$m]), 0, '.', '');

            } else {
                
                //Ajusta do gráfico
                if ($receitas_realizado[$m] > 0) {$saude_realizado[$m] = 100;}
                if ($despesas_realizado[$m] > 0) {$saude_realizado[$m] = 0;}

            }//else if ($receitas_realizado[$m] > 0 && $despesas_realizado[$m] > 0)

        }//for ($m = 0; $m <= 12; $m++)
        
        /********/

        //Saúde média anual realizada
        $saude_media_ano = array_filter($saude_media_ano);
        $saude_media_ano = array_sum($saude_media_ano) / count($saude_media_ano);
        
        /********/

        // echo 'Receitas Orçadas: <br>';
        // print_r($receitas_orcado);
        // echo '<br>';

        // echo 'Receitas Realizadas: <br>';
        // print_r($receitas_realizado);
        // echo '<br>';

        // echo 'Despesas Orçadas: <br>';
        // print_r($despesas_orcado);
        // echo '<br>';

        // echo 'Despesas Realizadas: <br>';
        // print_r($despesas_realizado);
        // echo '<br>';

        // echo 'Resultado Orçado: <br>';
        // print_r($saude_orcado);
        // echo '<br>';

        // echo 'Resultado Realizado: <br>';
        // print_r($saude_realizado);
        // echo '<br>';

        // echo 'Saúde Média anual realizada: <br>';
        // echo $saude_media_ano;
        // echo '<br>';

        /********/
        
        $this->set('saude_orcado', $saude_orcado);
        $this->set('saude_realizado', $saude_realizado);
        $this->set('saude_media_ano', round($saude_media_ano, 0));
        
    }

    public function content()
    {
        //Páginas internas
    }

    public function modalContent()
    {
        //Modais
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
        //$this->request->Session()->destroy();
        
        $this->Flash->success(__('Sessão Finalizada'));
        return $this->redirect('/');
        //return $this->redirect($this->Auth->logout());
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
