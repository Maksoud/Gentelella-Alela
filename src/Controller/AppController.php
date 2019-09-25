<?php

/**
 * Developed by:
 *     Renée Maksoud
 * 
 * All rights reserved - 2015-2019
 */

/* File: src/Controller/AppController.php */

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\I18n\I18n;

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
                                     ]
                            );
        
        I18n::locale($this->request->Session()->read('locale'));
        
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
        
        $this->request->Session()->write(['username'        => 'Renée Maksoud',
                                          'brand'           => 'Reiniciando Sistemas',
                                          'debug'           => Configure::read('debug'),
                                          'version'         => '90.20-2019',
                                          'validade'        => date('Y-m-d', strtotime('+ 5 days')),
                                          'plan'            => __('Completo'),
                                          'Session.timeout' => 30,
                                          'debug'           => true
                                         ]);
        
        /**********************************************************************/

        //Define o locale
        if (!$this->request->Session()->read('locale')) {
            $this->request->Session()->write('locale', 'pt_BR');
        }//if (!$this->request->Session()->read('locale'))

    }
    
    public function validade()
    {   
        $validade = date('d/m/Y', strtotime($this->request->Session()->read('validade')));
        $inverse  = implode("-", array_reverse(explode("/", $validade)));
        $dtalerta = date('Y-m-d', strtotime(date('Y-m-d')) + 604800);// ALERTA EM 7 DIAS
        $dtaviso  = date('Y-m-d', strtotime(date('Y-m-d')) + 259200);// AVISO EM 3 DIAS
        
        /******************************************************************/
        
        //MENSAGEM DE ALERTA DE VENCIMENTO DA APLICAÇÃO
        if (($inverse <= $dtalerta) && ($inverse > $dtaviso) && ($inverse >= date('Y-m-d'))) {
            
            //Sistema próximo de expirar
            $this->Flash->warning(__('O sistema irá expirar em ') . $validade . __(', entre em contato com o suporte'));
            
        } elseif (($inverse <= $dtalerta) && ($inverse <= $dtaviso) && ($inverse >= date('Y-m-d'))) {
            
            //Sistema muito próximo de expirar
            $this->Flash->error(__('O sistema irá expirar em ') . $validade . __(', entre em contato com o suporte urgente'));
            
        } elseif ($inverse < date('Y-m-d')) {

            //Sistema fora de validade
            $this->Flash->error(__('O sistema expirou em ') . $validade . __(', entre em contato pelo e-mail suporte@reiniciando.com.br'));

            //Finaliza a execução da função
            return false;

        }//elseif (($inverse < date('Y-m-d')))
        
        /******************************************************************/
        
        //Finaliza a execução da função
        return $validade;
    }
}