<?php

/**
 * Developed by:
 *     Renée Maksoud
 * 
 * All rights reserved - 2019
 */

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\I18n\I18n;
use Cake\Log\Log;

class AppController extends Controller
{
    public function isAuthorized($user)
    {
        // All logged users can access every action
        if (isset($user)) {
            return true;
        }
        
        return false;
    }
    
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', ['authenticate' => ['Form' => ['fields' => ['username' => 'username',
                                                                                 //'password' => 'password'
                                                                                 'passwordHasher' => 'Blowfish'
                                                                                ]
                                                                   ]
                                                        ],
                                      'authError'            => 'Informe o usuário/senha para acessar ao sistema',
                                      'loginAction'          => ['controller' => 'Pages', 'action' => 'home'],
                                      'loginRedirect'        => ['controller' => 'Pages', 'action' => 'home'],
                                      'logoutRedirect'       => ['controller' => 'Pages', 'action' => 'home'],
                                      'unauthorizedRedirect' => ['controller' => 'Pages', 'action' => 'home'],
                                      'storage'              => 'Session'
                                      //'authorize'    => ['Controller']
                                     ]
                            );
        
        I18n::locale($this->request->Session()->read('locale'));
        
        // Allow the display action so our pages controller
        //$this->Auth->allow(['display']);

        /*
         * Enable the following components for recommended CakePHP security settings.
         * see http://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');
        
    }
    
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
        
        $this->loadComponent('Auth');
    }
    
    public function beforeFilter(Event $event) 
    {
        parent::beforeFilter($event);
        
        /**********************************************************************/
        
        //Controle de Permissões - Validação do nível de permissão do usuário
        if ($this->Auth->user('id') && $this->request->Session()->read('sessionParameterControl')) {
            
            if (!$this->SystemFunctions->validaAcesso($this->request->params['action'], $this->Auth->user('id'), $this->request->Session()->read('sessionParameterControl'))) {
                $this->Flash->warning(__('Sem permissão para realizar a operação solicitada'));   
                return $this->redirect($this->referer());
            }//if (!$this->SystemFunctions->validaAcesso($this->request->params['action'], $this->Auth->user('id'), $this->request->Session()->read('sessionParameterControl')))
            
        }//if ($this->Auth->user('id') && $this->request->Session()->read('sessionParameterControl'))
    }
    
    public function session($parameters_id = null, $request_data = null)
    {
        //Define variáveis de autenticação na sessão
        $this->request->Session()->write(['userid'      => $this->Auth->user('id'),
                                          'username'    => $this->Auth->user('username'),
                                          'user_name'   => $this->Auth->user('name')
                                         ]);
        
        /**********************************************************************/
        
        if ($parameters_id == null) {
            
            //LISTA AS EMPRESAS QUE O USUÁRIO ESTÁ VINCULADO
            $perfis = $this->SystemFunctions->listaPerfis($this->request->Session()->read('userid'));
            
            //IDENTIFICA O ÚLTIMO PERFIL UTILIZADO
            $last_parameter = $this->SystemFunctions->GETlastParameter($this->request->Session()->read('userid'));
            
            /******************************************************************/
            
            if ($last_parameter) {

                //Valida se o perfil último perfil continua na lista de permissão de acesso
                foreach ($perfis as $perfil):
                    if ($perfil == $last_parameter) {
                        $this->SETsessionParameterControl($last_parameter);
                        $was_seted = true;
                    }//if ($perfil == $last_parameter)
                endforeach;

                if (!$was_seted) {
                    //DEFINE A EMPRESA DO VETOR '0' COMO INICIAL, CASO NÃO TENHA MAIS A PERMISSÃO DE ACESSO
                    $this->SETsessionParameterControl($perfis[0]);
                }//if (!$was_seted)

            } else {

                //DEFINE A EMPRESA DO VETOR '0' COMO INICIAL 
                $this->SETsessionParameterControl($perfis[0]);

            }//else if ($last_parameter)
            
            /******************************************************************/
            
            //IDENTIFICA A VERSÃO DO SISTEMA
            $systemver = $this->Parameters->find('all')
            							  ->select(['Parameters.id', 'Parameters.systemver'])
            							  ->where(['Parameters.id' => $perfis[0]])
            							  ->first();
            
        } else {
            
            //VALIDA SE O USUÁRIO ATUAL ESTÁ NA LISTA DA EMPRESA INFORMADA
            if ($this->SystemFunctions->validaUsuariosPerfis($this->Auth->user('id'), $parameters_id)) {
                
                //DEFINE O PERFIL NA SESSÃO
                $this->SETsessionParameterControl($parameters_id);
                
            } else {

                //ENVIA ALERTA COM DADOS DE ACESSO
                $sendMail = ['subject'  => 'SISTEMA R2: Tentativa de logon no sistema nível 2',
                             'template' => 'tentativa_logon',
                             'vars'     => ['request_data' => $request_data],
                             'toEmail'  => null
                            ];

                $this->EmailFunctions->sendMail($sendMail);
        
                /**************************************************************/

                //Finaliza a execução da função
                $this->Flash->error(__('Desculpe, ocorreu um erro. Por favor, tente novamente'));
                return $this->redirect($this->Auth->logout());
                
            }//else if ($this->SystemFunctions->validaUsuariosPerfis($this->Auth->user('id'), $parameters_id))
            
            /******************************************************************/
            
            //IDENTIFICA A VERSÃO DO SISTEMA
            $systemver = $this->Parameters->find('all')
            							  ->select(['Parameters.id', 'Parameters.systemver'])
            							  ->where(['Parameters.id' => $parameters_id])
            							  ->first();
            
        }//if ($parameters_id == null)
        
        /**********************************************************************/
        
        //Verifica versão do sistema
        if ($systemver->systemver < 2) {
            
            $this->Flash->error(__('Desculpe, ocorreu um erro. Por favor, tente novamente'));
            return $this->redirect($this->Auth->logout());
            
        }//if ($systemver->systemver < 2)
        
        /**********************************************************************/
        
        //Define a permissão do usuário após definição da empresa
        $rule_name = $this->SystemFunctions->GETuserRules($this->Auth->user('id'), $this->request->Session()->read('sessionParameterControl'));
        $rule_id   = $this->SystemFunctions->GETuserRulesId($rule_name);
        
        $this->request->Session()->write(['sessionRule'   => $rule_name]);
        $this->request->Session()->write(['sessionRuleId' => $rule_id]);
        
        /**********************************************************************/
        
        //ALIMENTA O BRAND NA SESSÃO (NAVBAR-UP)
        $this->brand();
        
        /**********************************************************************/
        
        //ATUALIZA A TABELA DE SALDOS DO DIA
        $this->GeneralBalance->updateBalance($this->request->Session()->read('sessionParameterControl'));
        
        /**********************************************************************/
        
        //GERA DOCUMENTOS RECORRENTES
        $Cron = new CronController;
        $Cron->recurrent();
        //ClassRegistry::init('Cron')->recurrent();
        //$this->requestAction('/Cron/recurrent?token=Y5eEHC208Q2kcbfRhiNC0pxAAPtk3CB6');
        
        /**********************************************************************/
        
        //VERIFICA A VALIDADE DO SISTEMA
        if ($this->validade(null, $request_data)) {

            //Definindo o Debug
            $this->request->Session()->write('debug', Configure::read('debug'));
            
            /******************************************************************/
            
            //Limite da Sessão
            $this->request->Session()->write('Session.timeout', Configure::read('Session.timeout'));
            
            /******************************************************************/
            
            //Definindo o Locale default
            $this->locale($this->Auth->user('id'));
            
            /******************************************************************/

            //GRAVA LOG
            $this->Log->gravaLog($this->Auth->user(), 'login');
            
        } else {

            return $this->redirect($this->Auth->logout());

        }//else if ($this->validade(null, $request_data))
        
    }
    
    public function brand($getRazao = null)
    {
        $this->Versions = TableRegistry::get('Versions');
        $this->Users    = TableRegistry::get('Users');
        
        /**********************************************************************/
        
        //Consulta dados do perfil
        $parameters = $this->Parameters->findById($this->request->Session()->read('sessionParameterControl'))
                                       ->select(['Parameters.razao', 
                                                 'Parameters.logomarca', 
                                                 'Parameters.plans_id'
                                                ]);
        
        foreach($parameters as $parameter):
            $razao     = $parameter->razao;
            $logomarca = $parameter->logomarca;
            $plans_id  = $parameter->plans_id;
        endforeach;
        
        /**********************************************************************/
        
        if (!empty($getRazao)) {
            //RETORNA A RAZÃO SOCIAL DA EMPRESA EM LETRAS MAIÚSCULAS
            //return mb_strtoupper($razao);
            return ucfirst($razao);
        }
        
        $razao  = explode(" ", $razao);
        $size_r = sizeof($razao);
        $i      = 0;

        while ($i < $size_r) {
            $brand[] = $razao[$i];
            $i++;
            if ($i == 2) break;
        }
        
        /**********************************************************************/
        
        //Versão do sistema
        $version = $this->Versions->find('all')
                                  ->first();
        
        /**********************************************************************/
        
        if (empty($plans_id)) {
            
            $plano = 'Não Selecionado';
            
        } else {

            switch($plans_id) {
                case '1':
                    $plano = __('Pessoal');
                    break;
                case '2':
                    $plano = __('Simples');
                    break;
                case '3':
                    $plano = __('Completo');
                    break;
                case '4':
                    $plano = __('Limitado');
                    break;
            }//switch($plans_id)

        }//if (empty($plans_id))
        
        /**********************************************************************/

        $user = $this->Users->findById($this->Auth->user('id'))
                            ->select(['Users.module'])
                            ->first();
        
        /**********************************************************************/

        //Define variáveis de sessão
        $this->request->Session()->write(['brand'       => mb_strtoupper(implode(' ', $brand)),
                                          'logomarca'   => $logomarca,
                                          'sessionPlan' => $plans_id,
                                          'plano'       => $plano,
                                          'version'     => $version->financeiro,
                                          'module'      => $user->module
                                         ]);
    }
    
    public function validade($dtvalidade = null, $request_data = null)
    {   
        $parameter = $this->Parameters->findById($this->request->Session()->read('sessionParameterControl'))
                                       ->select(['Parameters.dtvalidade'])
                                       ->first();
        
        /**********************************************************************/
        
        if (!empty($dtvalidade)) {
            
            //Atualiza a data de validade do sistema
            $parameter->dtvalidade = $dtvalidade;
            
            //Finaliza a execução da função com a data de validade definida
            if ($this->Parameters->save($parameter)) {
                return $dtvalidade;
            }//if ($this->Parameters->save($parameter))
            
            //Finaliza a execução da função
            return false;
            
        } else {
            
            //GRAVA NA SESSÃO A DATA DE VALIDADE DO SISTEMA
            $this->request->Session()->write('validade', date('d/m/Y', strtotime($parameter->dtvalidade)));
            
            /******************************************************************/
            
            $dtvalidade = implode("-", array_reverse(explode("/", $this->request->Session()->read('validade'))));
            $dtplano    = date('Y-m-d', strtotime(date('Y-m-d')) + 864000);// ALERTA EM 10 DIAS
            $dtalerta   = date('Y-m-d', strtotime(date('Y-m-d')) + 604800);// ALERTA EM 7 DIAS
            $dtaviso    = date('Y-m-d', strtotime(date('Y-m-d')) + 259200);// AVISO EM 3 DIAS
            
            /******************************************************************/
            
            //MENSAGEM DE ALERTA DE VENCIMENTO DA APLICAÇÃO
            if (($dtvalidade <= $dtalerta) && ($dtvalidade > $dtaviso) && ($dtvalidade >= date('Y-m-d'))) {
                
                //Sistema próximo de expirar
                $this->Flash->warning(__('O sistema irá expirar em ') . $this->request->Session()->read('validade') . __(', entre em contato com o suporte'));
                
            } elseif (($dtvalidade <= $dtalerta) && ($dtvalidade <= $dtaviso) && ($dtvalidade >= date('Y-m-d'))) {
                
                //Sistema muito próximo de expirar
                $this->Flash->error(__('O sistema irá expirar em ') . $this->request->Session()->read('validade') . __(', entre em contato com o suporte urgente'));
                
            } elseif ($dtvalidade < date('Y-m-d')) {

                //Sistema fora de validade
                $this->Flash->error(__('O sistema expirou em ') . $this->request->Session()->read('validade') . __(', entre em contato pelo e-mail suporte@reiniciando.com.br'));

                /**************************************************************/

                //ENVIA ALERTA COM DADOS DE ACESSO
                $sendMail = ['subject'  => 'SISTEMA R2: Sistema fora de validade',
                             'template' => 'fora_validade',
                             'vars'     => ['request_data' => $request_data],
                             'toEmail'  => null
                            ];

                $this->EmailFunctions->sendMail($sendMail);

                /**************************************************************/

                //Finaliza a execução da função
                return false;

            }//elseif (($dtvalidade < date('Y-m-d')))
            
            /******************************************************************/

            //MENSAGEM DE ALERTA PARA ESCOLHA DE UM PLANO
            if ($message = $this->SystemFunctions->validaCadastros("plano", $this->request->Session()->read('sessionParameterControl'))) {
                $this->Flash->warning(__($message), ['escape' => false]);
            }
            
            /******************************************************************/
            
            //Finaliza a execução da função
            return $dtvalidade;
            
        }//if (!empty($dtvalidade))
    }
    
    public function locale($user_id)
    {
        $this->Users = TableRegistry::get('Users');
        
        /**********************************************************************/
        
        $user = $this->Users->findById($user_id)
                            ->select(['Users.id', 'Users.language'])
                            ->first();
        
        /**********************************************************************/
        
        if (empty($user->language)) {

            $user->language = 'pt_BR';
            
            if (!$this->Users->save($user)) {

                //Alerta de erro
                $message = 'AppController->locale';
                $this->Error->registerError($user, $message, true);

            }//if (!$this->Users->save($user))
            
        }//if (!empty($user->language))
        
        /**********************************************************************/
        
        $this->request->Session()->write('locale', $user->language);
        
    }
}