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
namespace App\Controller\Admin;
use App\Controller\AppController;
use Cake\Routing\Router;

use Cake\Auth\DefaultPasswordHasher;


class CatsController extends AppController
{
    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->loadModel('Cats');
    }

    public function summary()
    {
       $this->set('section','Category');
       $this->set('sub_section','Summary');
       $this->paginate = ['limit'=>10];
       $clinics = $this->paginate($this->Cats);
        $this->set(compact('clinics'));
    
    }
   
    public function add($id=null){        
       $this->set('section','Category');
       $this->set('sub_section','Manager');
          $img='';
       	if(!empty($id)){
    		$clinics=$this->Cats->get($id);
            $this->set('edit','edit');
    	}
    	else{
    		$clinics=$this->Cats->newEntity();
    	}

    	if($this->request->is(['post','put'])){
    		$data=$this->request->getData();            
    		if(!isset($id)){
                $data['added']=date('Y-m-d');
            }
          // echo"<pre>";print_r($data);exit;
    		$clinics=$this->Cats->patchEntity($clinics,$data);
    		if($this->Cats->save($clinics)){
    			$this->Flash->success(__('Category saved successfully.'));
                return $this->redirect(['action'=>'summary']);
            }
            else{
                $this->Flash->error(__('Category could not be saved.'));
            }
    	}
        $this->set(compact('clinics','img'));
    }
   
    public function delete($id=null){
    	if(!empty($id)){
    		$drivers=$this->Cats->get($id);
    		if($this->Cats->delete($drivers)){
    			$this->Flash->success(__('Category deleted successfully.'));
                return $this->redirect(['action'=>'summary']);
            }
            else{
                $this->Flash->error(__('Category could not be deleted.'));
            }
    	}
    	$this->Flash->error(__('Category could not be deleted.'));
    }
    public function changestatus($id=null){
    	if(!empty($id)){
    		$clinics=$this->Cats->findById($id)->first();
            $c_data=$this->Cats->get($id);
            if($clinics->status == 1)
            {
              $data['status']=0;  
            }else{
              $data['status']=1;  
            }
            $c_data=$this->Cats->patchEntity($c_data,$data);
    		if($this->Cats->save($c_data)){
    			$this->Flash->success(__('Category status successfully change'));
                return $this->redirect(['action'=>'summary']);
            }
            else{
                $this->Flash->error(__('Category could not be change.'));
            }
    	}
    	$this->Flash->error(__('Category could not be change.'));
    }
}

