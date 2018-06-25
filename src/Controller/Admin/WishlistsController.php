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


class WishlistsController extends AppController
{
    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->loadModel('Wishlists');
         $this->loadModel('Requests');
         $this->loadModel('Feedbacks');
    }

    public function summary()
    {
       $this->set('section','Wishlists');
       $this->set('sub_section','Summary');
       $this->paginate = ['limit'=>10];
       $clinics = $this->paginate($this->Wishlists);
        $this->set(compact('clinics'));
    
    }
    public function request()
    {
       $this->set('section','User Wishlists');
       $this->set('sub_section','Summary');
       $this->paginate = ['limit'=>10,'contain'=>['Users','Wishlists']];
       $clinics = $this->paginate($this->Requests);
       //echo"<pre>";print_r($clinics);exit;
        $this->set(compact('clinics'));
    
    }
    public function add($id=null){        
       $this->set('section','Video');
       $this->set('sub_section','Manager');
       // $cat=$this->Cats->find('list',['conditions'=>['status'=>1],'keyField'=>'id','valueField'=>'name'])->all()->toArray();
          $img='';
       	if(!empty($id)){
    		$clinics=$this->Wishlists->get($id);
             $img=$clinics->thumb;
            $this->set('edit','edit');
    	}
    	else{
    		$clinics=$this->Wishlists->newEntity();
    	}

    	if($this->request->is(['post','put'])){
    		$data=$this->request->getData();
               $types = array('image/jpeg', 'image/gif', 'image/png', 'image/pdf', 'image/doc', 'image/docx');
             // echo"<pre>";print_r($data);exit;
                if(!empty($data['thumb']['name']))
                {
                    if (in_array($data['thumb']['type'], $types)) {
                    $file_name=str_replace(" ","",$data['thumb']['name']);
                    move_uploaded_file($data['thumb']['tmp_name'],WWW_ROOT.'img/data/'.$file_name);
                    $data['thumb']=$file_name;
                    }else{
                    $this->Flash->set('Unable To Upload image.Please check Extension');	
                    }
                }else{
                    unset($data['thumb']);
                }
    		if(!isset($id)){
                $data['date']=date('Y-m-d h:i:s');
            }
          // echo"<pre>";print_r($data);exit;
    		$clinics=$this->Wishlists->patchEntity($clinics,$data);
    		if($this->Wishlists->save($clinics)){
    			$this->Flash->success(__('Wishlists saved successfully.'));
                return $this->redirect(['action'=>'summary']);
            }
            else{
                $this->Flash->error(__('Wishlists could not be saved.'));
            }
    	}
        $this->set(compact('clinics','img'));
    }
   
    public function delete($id=null){
    	if(!empty($id)){
    		$drivers=$this->Wishlists->get($id);
    		if($this->Wishlists->delete($drivers)){
    			$this->Flash->success(__('Wishlists deleted successfully.'));
                return $this->redirect(['action'=>'summary']);
            }
            else{
                $this->Flash->error(__('Wishlists could not be deleted.'));
            }
    	}
    	$this->Flash->error(__('Wishlists could not be deleted.'));
    }
    public function changestatus($id=null){
    	if(!empty($id)){
    		$clinics=$this->Wishlists->findById($id)->first();
            $c_data=$this->Wishlists->get($id);
            if($clinics->status == 1)
            {
              $data['status']=0;  
            }else{
              $data['status']=1;  
            }
            $c_data=$this->Wishlists->patchEntity($c_data,$data);
    		if($this->Wishlists->save($c_data)){
    			$this->Flash->success(__('Wishlists status successfully change'));
                return $this->redirect(['action'=>'summary']);
            }
            else{
                $this->Flash->error(__('Wishlists could not be change.'));
            }
    	}
    	$this->Flash->error(__('Wishlists could not be change.'));
    }
    public function feedbacksummary()
    {
         $this->set('section','Feedbacks');
       $this->set('sub_section','Summary');
       $this->paginate = ['limit'=>10,'contain'=>['Users']];
       $admin = $this->paginate($this->Feedbacks);
       //echo"<pre>";print_r($clinics);exit;
        $this->set(compact('admin'));
    }
}

