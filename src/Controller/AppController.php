<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{


    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        
        $prefix = isset($this->request->params["prefix"]) ? $this->request->params["prefix"] : "";
        switch ($prefix) {
            case "admin":
                
                $this->loadComponent('Auth', [
                    'loginAction' => [
                        'controller' => 'Admins',
                        'action' => 'login',
                        'prefix' => "admin"
                    ],
                    'loginRedirect' => [
                        'controller' => 'Admins',
                        'action' => 'dashboard',
                        'prefix' => "admin"
                    ],
                    'logoutRedirect' => [
                        'controller' => 'Admins',
                        'action' => 'login',
                        'prefix' => "admin"
                    ],
                    'authenticate' => [
                        'Form' => [
                            'userModel' => 'Clinics', //your Model Name
                            'fields' => [
                                'username' => 'phone',
                                'password' => 'password'
                            ],
                            'scope'=>['status'=>1]
                        ]
                    ]
                ]);
                $this->set('user', $this->Auth->user());
                break;
                case "api":
                
                break;
            default:
                $this->loadComponent('Auth', [
                    'loginAction' => [
                        'controller' => 'Clinics',
                        'action' => 'login',
                        'prefix' => false
                    ],
                    'loginRedirect' => [
                        'controller' => 'Clinics',
                        'action' => 'index',
                        'prefix' => false
                    ],
                    'logoutRedirect' => [
                        'controller' => 'Clinics',
                        'action' => 'login',
                        'prefix' => false
                    ],
                    'authenticate' => [
                        'Form' => [
                            'userModel' => 'Clinics', //your Model Name
                            'fields' => [
                                'username' => 'phone',
                                'password' => 'password'
                            ],
                            'scope'=>['status'=>1]
                        ]
                    ]
                ]);
                $this->set('user', $this->Auth->user());
        }
    }
    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);

        $permissionFreeActs=['login','adminadd','currenttoken','currenttokennew'];
        $prefix = isset($this->request->params["prefix"]) ? $this->request->params["prefix"] : "";
        switch ($prefix) {
            case "admin":
                $this->Auth->allow($permissionFreeActs);
               // $this->Auth->allow();
                $this->viewBuilder()->setLayout(ADMIN_LAYOUT);
                break;
            case "api":                
                $this->viewBuilder()->setLayout(false);
                 break;
            default:
                //$this->Auth->allow($permissionFreeActs);
                $this->viewBuilder()->setLayout(ADMIN_LAYOUT);
        }
        
        
        
    }

}
