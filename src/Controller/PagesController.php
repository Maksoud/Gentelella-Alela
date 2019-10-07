<?php

/**
 * Developed by:
 *     Renée Maksoud
 * 
 * All rights reserved - 2015-2019
 */

/* File: src/Controller/PagesController.php */

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

class PagesController extends AppController
{
    public function initialize()
    {
        parent::initialize();

        //Autoriza a exibição das páginas
        $this->Auth->allow(['login', 'logout', 'home', 'content', 'modalContent', 'modal2', 'update', 'changeLocale']);

    }
    
    public function home()
    {
        //Carrega janela com informações sobre a validade do sistema
        $this->expireDate();

        /**********************************************************************/

        //Variáveis:
        $this->set('id', 0);

        /**********************************************************************/

        /* SAÚDE FINANCEIRA NO MÊS ATUAL */
        
        //Progressive variable values for presentation in the graphs
        $recipes                     = round(3500, 8500);
        $expenses                    = round(1500, 3750);
        
        //Budgeted
        $recipes_month_budgeted      = $recipes + ($recipes * 0.6);
        $expenses_month_budgeted     = $expenses + ($expenses * 0.4);
        
        //Accomplished
        $recipes_month_accomplished  = $recipes_month_budgeted - ($recipes_month_budgeted * 0.7);
        $expenses_month_accomplished = $expenses_month_budgeted - ($expenses_month_budgeted * 0.4);
        
        //Em aberto
        $recipes_month_opened        = $recipes_month_budgeted - $recipes_month_accomplished;
        $expenses_month_opened       = $expenses_month_budgeted - $expenses_month_accomplished;
        
        /********/
        
        //CÁLCULO DO PERCENTUAL DA SAÚDE FINANCEIRA DO MÊS
        if ($recipes > 0 && $expenses > 0) {
            
            $percent = 100 - (($expenses * 100) / $recipes);

        } else {
            
            if ($recipes > 0) {$percent = 100;}
            if ($expenses > 0) {$percent = 0;}
            if ($recipes == 0 && $expenses == 0) {$percent = 0;}
            if ($recipes < 0 && $expenses < 0) {$percent = 0;} //In case of failure

        }//else if ($recipes > 0 && $expenses > 0)
        
        /********/
        
        //CÁLCULO DO PERCENTUAL ORÇADO
        if ($recipes_month_budgeted > 0 && $expenses_month_budgeted > 0) {
            
            $per_budgeted = 100 - (($expenses_month_budgeted * 100) / $recipes_month_budgeted);

        } else {
            
            if ($recipes_month_budgeted > 0) {$per_budgeted = 100;}
            if ($expenses_month_budgeted > 0) {$per_budgeted = 0;}
            if ($recipes_month_budgeted == 0 && $expenses_month_budgeted == 0) {$per_budgeted = 0;}
            if ($recipes_month_budgeted < 0 && $expenses_month_budgeted < 0) {$per_budgeted = 0;} //In case of failure

        }//else if ($recipes_month_budgeted > 0 && $expenses_month_budgeted > 0)
        
        /********/
        
        //CÁLCULO DO PERCENTUAL REALIZADO
        if ($recipes_month_accomplished > 0 && $expenses_month_accomplished > 0) {
            
            $per_accomplished = 100 - (($expenses_month_accomplished * 100) / $recipes_month_accomplished);

        } else {
            
            if ($recipes_month_accomplished > 0) {$per_accomplished = 100;}
            if ($expenses_month_accomplished > 0) {$per_accomplished = 0;}
            if ($recipes_month_accomplished == 0 && $expenses_month_accomplished == 0) {$per_accomplished = 0;}
            if ($recipes_month_accomplished < 0 && $expenses_month_accomplished < 0) {$per_accomplished = 0;} //In case of failure

        }//else if ($recipes_month_accomplished > 0 && $expenses_month_accomplished > 0)
        
        /********/
        
        //CÁLCULO DO PERCENTUAL EM ABERTO
        if ($recipes_month_opened > 0 && $expenses_month_opened > 0) {

            $per_opened = 100 - (($expenses_month_opened * 100) / $recipes_month_opened);

        } else {

            if ($recipes_month_opened > 0) {$per_opened = 100;}
            if ($expenses_month_opened > 0) {$per_opened = 0;}
            if ($recipes_month_opened == 0 && $expenses_month_opened == 0) {$per_opened = 0;}
            if ($recipes_month_opened < 0 && $expenses_month_opened < 0) {$per_opened = 0;} //In case of failure

        }//else if ($recipes_month_opened > 0 && $expenses_month_opened > 0)
        
        /********/

        // echo 'Progressive Variable:<br>';
        // echo $recipes.'<br>';
        // echo $expenses.'<br>';
        
        // echo 'Orçado:<br>';
        // echo $recipes_month_budgeted.'<br>';
        // echo $expenses_month_budgeted.'<br>';
        
        // echo 'Realizado:<br>';
        // echo $recipes_month_accomplished.'<br>';
        // echo $expenses_month_accomplished.'<br>';
        
        // echo 'Em Aberto:<br>';
        // echo $recipes_month_opened.'<br>';
        // echo $expenses_month_opened.'<br>';

        /********/

        $this->set('percent', number_format($percent, 0));
        $this->set('per_budgeted', number_format($per_budgeted, 0));
        $this->set('per_accomplished', number_format($per_accomplished, 0));
        $this->set('per_opened', number_format($per_opened, 0));

        $this->set('recipes', $recipes);
        $this->set('expenses', $expenses);

        $this->set('recipes_month_budgeted', $recipes_month_budgeted);
        $this->set('expenses_month_budgeted', $expenses_month_budgeted);

        $this->set('recipes_month_accomplished', $recipes_month_accomplished);
        $this->set('expenses_month_accomplished', $expenses_month_accomplished);

        $this->set('recipes_month_opened', $recipes_month_opened);
        $this->set('expenses_month_opened', $expenses_month_opened);

        /**********************************************************************/

        /* FINANCIAL HEALTH - GRAPH */
        
        $variable = 1;
        for ($m = 1; $m <= 12; $m++) {

            //Progressive variable value for presentation in the graphs
            $variable = $variable + (rand(0, $m));

            //Current Month
            if ($m == date('m')) {

                //Recipes
                $recipes_budgeted[$m]    = $recipes_month_budgeted;
                $recipes_accomplished[$m] = $recipes_month_accomplished;

                //Expenses
                $expenses_budgeted[$m]    = $expenses_month_budgeted;
                $expenses_accomplished[$m] = $expenses_month_accomplished;

            } else {

                //Recipes
                $recipes_budgeted[$m]    = $variable + (rand(0, 35));
                $recipes_accomplished[$m] = $variable + (rand(0, 35) / 2);

                //Expenses
                $expenses_budgeted[$m]    = $variable + (rand(0, 15));
                $expenses_accomplished[$m] = $variable + (rand(0, 15) / 2);

            }//else if ($m == date('m'))
        
            /********/

            //Result
            $health_budgeted[$m]    = $recipes_budgeted[$m] - $expenses[$m];
            $health_accomplished[$m] = $recipes_accomplished[$m] - $expenses_accomplished[$m];

            //Annual Average Accomplished
            $health_average_year[$m] = $recipes_accomplished[$m] - $expenses_accomplished[$m];
        
            /********/

            //Budgeted
            if ($recipes_budgeted[$m] > 0 && $expenses_budgeted[$m] > 0) {
                
                $health_budgeted[$m] = number_format((100 - ($expenses_budgeted[$m] * 100) / $recipes_budgeted[$m]), 0, '.', '');

            } else {
                
                //Better presentation on graph
                if ($recipes_budgeted[$m] > 0) {$health_budgeted[$m] = 100;}
                if ($expenses_budgeted[$m] > 0) {$health_budgeted[$m] = -100;}

            }//else if ($recipes_budgeted[$m] > 0 && $expenses_budgeted[$m] > 0)
        
            /********/
            
            //Accomplished
            if ($recipes_accomplished[$m] > 0 && $expenses_accomplished[$m] > 0) {
                
                $health_accomplished[$m] = number_format((100 - ($expenses_accomplished[$m] * 100) / $recipes_accomplished[$m]), 0, '.', '');

            } else {
                
                //Better presentation on graph
                if ($recipes_accomplished[$m] > 0) {$health_accomplished[$m] = 100;}
                if ($expenses_accomplished[$m] > 0) {$health_accomplished[$m] = 0;}

            }//else if ($recipes_accomplished[$m] > 0 && $expenses_accomplished[$m] > 0)

        }//for ($m = 0; $m <= 12; $m++)
        
        /********/

        //Annual Average Accomplished
        $health_average_year = array_filter($health_average_year);
        $health_average_year = array_sum($health_average_year) / count($health_average_year);
        
        /********/

        // echo 'Receitas Orçadas: <br>';
        // print_r($recipes_budgeted);
        // echo '<br>';

        // echo 'Receitas Realizadas: <br>';
        // print_r($recipes_accomplished);
        // echo '<br>';

        // echo 'Despesas Orçadas: <br>';
        // print_r($expenses_budgeted);
        // echo '<br>';

        // echo 'Despesas Realizadas: <br>';
        // print_r($expenses_accomplished);
        // echo '<br>';

        // echo 'Resultado Orçado: <br>';
        // print_r($health_budgeted);
        // echo '<br>';

        // echo 'Resultado Realizado: <br>';
        // print_r($health_accomplished);
        // echo '<br>';

        // echo 'Saúde Média anual realizada: <br>';
        // echo $health_average_year;
        // echo '<br>';

        /********/
        
        $this->set('health_budgeted', $health_budgeted);
        $this->set('health_accomplished', $health_accomplished);
        $this->set('health_average_year', round($health_average_year, 0));
        
    }

    public function content()
    {
        //Páginas internas
    }

    public function modalContent()
    {
        //Modais
    }

    public function modal2()
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
            
            //$this->Flash->error(__('Usuário/senha incorreto, tente novamente'));
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
    
    public function update()
    {
        if ($this->request->is(['get'])) {
            
            //CRIA DIRETÓRIO SE NÃO EXISTIR
            if (!file_exists('log.log')) {
                @fopen('log.log', 'x+');
            }//if (!file_exists('log.log'))
            
            //O USO DESSA OPÇÃO É PREJUDICIAL AOS ARQUIVOS DE LOG QUE SERÃO SOBRESCRITOS
            $shell = shell_exec("git reset --hard FETCH_HEAD 2>&1");
            $shell .= shell_exec("git clean -df 2>&1");
            
            $shell .= shell_exec("git pull origin master 2>&1");
            
            $textoLog  = PHP_EOL . '================================================ <br />';
            $textoLog .= PHP_EOL . "Data: " . date('d'."/".'m'."/".'Y'." - ".'H'.":".'i'.":".'s') . '<br>';
            $textoLog .= PHP_EOL . $shell . '<br>';
            $textoLog .= PHP_EOL . '================================================ <br />';
            
            if ($arquivoLog = @fopen('log.log', 'r+')) {
                fwrite($arquivoLog, $textoLog);
                fclose($arquivoLog);
            }//if ($arquivoLog = @fopen('log.log', 'r+'))
            
            $this->Flash->success(__('Atualização realizada com sucesso'));
            return $this->redirect($this->referer());
            
        }//if ($this->request->is(['get']))
        
        $this->Flash->error(__('Sistema NÃO atualizado'));
        return $this->redirect($this->referer());
    }
    
    public function changeLocale()
    {
        $locale = $this->request->Session()->read('locale');
            
        /**********************************************************************/

        if ($locale == 'pt_BR') {

            $this->request->Session()->write('locale', 'en_US');

        } else {
            
            $this->request->Session()->write('locale', 'pt_BR');

        }//else if ($locale == 'pt_BR')
            
        /**********************************************************************/
        
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
