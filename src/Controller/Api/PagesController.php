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
namespace App\Controller\Api;
use App\Controller\AppController;
use Cake\Routing\Router;

use Cake\Auth\DefaultPasswordHasher;


class PagesController extends AppController
{
    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
          $this->loadModel("Pages");
    }

         public function about(){
            $this->viewBuilder()->setLayout(false);
            $pagedata=$this->Pages->find('all',['conditions'=>['type'=>'about','status'=>1]])->first();
           
            $this->set(compact('pagedata'));
                      
        }
         public function term(){
             $this->viewBuilder()->setLayout(false);
            $pagedata=$this->Pages->find('all',['conditions'=>['type'=>'term','status'=>1]])->first();
           
            $this->set(compact('pagedata'));
                    
        }
        public function privacy(){
           $this->viewBuilder()->setLayout(false);
            $pagedata=$this->Pages->find('all',['conditions'=>['type'=>'term','status'=>1]])->first();
           
            $this->set(compact('pagedata'));      
        }
        public function help(){
           $this->viewBuilder()->setLayout(false);
            $pagedata=$this->Pages->find('all',['conditions'=>['type'=>'help','status'=>1]])->first();
           
            $this->set(compact('pagedata'));      
        }
}

