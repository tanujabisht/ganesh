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


class AdminsController extends AppController
{
    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->loadModel('Clinics');
        $this->loadModel('Users');
        $this->loadModel('Requests');
        $this->loadModel('Wishlists');
        $this->loadModel('Cats');
        $this->loadModel('Vedios');
    }
    public function login(){        
        $this->viewBuilder()->setLayout(LOGIN_LAYOUT);
       
        if (!empty($this->Auth->user("id"))) {
            if($this->Auth->user("type") == APP_USER_ADMIN){
                return $this->redirect($this->Auth->redirectUrl());
            }else{
             return $this->redirect(['prefix' => 'admin', 'controller' => 'Admins', 'action' => 'login']);
            }
        }

        if($this->request->is(['post'])){
             // echo"<pre>"; print_r($this->Auth);exit;
            $user = $this->Auth->identify();
  
            if ($user) {
                $this->Auth->setUser($user);
                if($user["type"] == APP_USER_ADMIN){
                     return $this->redirect($this->Auth->redirectUrl());
                    }    
            }
            $this->Flash->error(__('Invalid contact number or password, try again'));
        }
    }
     public function logout(){        
        $this->Flash->error(__('Logout successfully.'));
        return $this->redirect($this->Auth->logout());
    }
    public function dashboard(){
       $this->set('section','Admin');
       $this->set('sub_section','Dashboard');
       $no='';
       $user=$this->Users->find('all',['conditions'=>['status'=>1]])->count();
       $wish=$this->Requests->find('all')->count();
       $wishlist=$this->Wishlists->find('all',['conditions'=>['status'=>1]])->count();
       $cat=$this->Cats->find('all',['conditions'=>['status'=>1]])->count();
       $cat_details=$this->Cats->find('all',['conditions'=>['status'=>1]])->all()->toArray();
       $res=array();
       if(!empty($cat_details)){
        $i=0;
           foreach($cat_details as $video1){
             $vedio=$this->Vedios->find('all',['conditions'=>['status'=>1,'category_id'=>$video1->id]])->count();
             $res[$i]['cat_name']=$video1->name;
             $res[$i]['cat_id']=$video1->id;
             $res[$i]['count']=$vedio;
             $i++;
           }
       }
       $this->set(compact('no','clinic_data','user','wish','wishlist','cat','res'));
    }
   
    public function adminsummary()
    {
       $this->set('section','Admin');
       $this->set('sub_section','Summary');
       $this->paginate = ['conditions'=>['type'=>'A'],'limit'=>10];
       $clinics = $this->paginate($this->Clinics);
        $this->set(compact('clinics'));
    
    }
   
    public function adminadd($id=null){        
       $this->set('section','Admin');
       $this->set('sub_section','Manager');
       	if(!empty($id)){
    		$clinics=$this->Clinics->get($id);
            $this->set('edit','edit');
    	}
    	else{
    		$clinics=$this->Clinics->newEntity();
    	}

    	if($this->request->is(['post','put'])){
    		$data=$this->request->getData();
           
    		if(!empty($data['password'])){
                $data['password2'] = base64_encode($data['password']);
            }
            $data['type']='A';
          // echo"<pre>";print_r($data);exit;
    		$clinics=$this->Clinics->patchEntity($clinics,$data);
    		if($this->Clinics->save($clinics)){
    			$this->Flash->success(__('Admin saved successfully.'));
                return $this->redirect(['action'=>'adminsummary']);
            }
            else{
                $this->Flash->error(__('Admin could not be saved.'));
            }
    	}
        $this->set(compact('clinics'));
    }
   
    public function admindelete($id=null){
    	if(!empty($id)){
    		$drivers=$this->Clinics->get($id);
    		if($this->Clinics->delete($drivers)){
    			$this->Flash->success(__('Admin deleted successfully.'));
                return $this->redirect(['action'=>'adminsummary']);
            }
            else{
                $this->Flash->error(__('Admin could not be deleted.'));
            }
    	}
    	$this->Flash->error(__('Admin could not be deleted.'));
    }
    public function changestatus($id=null){
    	if(!empty($id)){
    		$clinics=$this->Clinics->findById($id)->first();
            $c_data=$this->Clinics->get($id);
            if($clinics->status == 1)
            {
              $data['status']=0;  
            }else{
              $data['status']=1;  
            }
            $c_data=$this->Clinics->patchEntity($c_data,$data);
    		if($this->Clinics->save($c_data)){
    			$this->Flash->success(__('Admin status successfully change'));
                return $this->redirect(['action'=>'adminsummary']);
            }
            else{
                $this->Flash->error(__('Admin could not be change.'));
            }
    	}
    	$this->Flash->error(__('Admin could not be change.'));
    }
}

