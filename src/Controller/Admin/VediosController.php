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


class VediosController extends AppController
{
    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->loadModel('Cats');
    }

    public function summary($cat_id=null)
    {
       $this->set('section','Videos');
       $this->set('sub_section','Summary');
       $con=array();
       if(!empty($cat_id)){
        $con +=['category_id'=>$cat_id];
       }
       $this->paginate = ['conditions'=>$con,'limit'=>10,'contain'=>['Cats']];
       $clinics = $this->paginate($this->Vedios);
        $this->set(compact('clinics'));
    
    }
   
    public function add($id=null){        
       $this->set('section','Video');
       $this->set('sub_section','Manager');
        $cat=$this->Cats->find('list',['conditions'=>['status'=>1],'keyField'=>'id','valueField'=>'name'])->all()->toArray();
          $img='';
       	if(!empty($id)){
    		$clinics=$this->Vedios->get($id);
             $img=$clinics->thumb;
            $this->set('edit','edit');
    	}
    	else{
    		$clinics=$this->Vedios->newEntity();
    	}
    	if($this->request->is(['post','put'])){
    		$data=$this->request->getData();
               $types = array('image/jpeg', 'image/gif', 'image/png');
                if(!empty($data['thumb']['name']))
                {
                    if (in_array($data['thumb']['type'], $types)) {
                    $file_name=str_replace(" ","",$data['thumb']['name']);
                    str_replace("world","Peter","Hello world!");
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
    		$clinics=$this->Vedios->patchEntity($clinics,$data);
    		if($this->Vedios->save($clinics)){
    			$this->Flash->success(__('Video saved successfully.'));
                return $this->redirect(['action'=>'summary']);
            }
            else{
                $this->Flash->error(__('Video could not be saved.'));
            }
    	}
        $this->set(compact('clinics','img','cat'));
    }
   
    public function delete($id=null){
    	if(!empty($id)){
    		$drivers=$this->Vedios->get($id);
    		if($this->Vedios->delete($drivers)){
    			$this->Flash->success(__('Video deleted successfully.'));
                return $this->redirect(['action'=>'summary']);
            }
            else{
                $this->Flash->error(__('Video could not be deleted.'));
            }
    	}
    	$this->Flash->error(__('Video could not be deleted.'));
    }
    public function changestatus($id=null){
    	if(!empty($id)){
    		$clinics=$this->Vedios->findById($id)->first();
            $c_data=$this->Vedios->get($id);
            if($clinics->status == 1)
            {
              $data['status']=0;  
            }else{
              $data['status']=1;  
            }
            $c_data=$this->Vedios->patchEntity($c_data,$data);
    		if($this->Vedios->save($c_data)){
    			$this->Flash->success(__('Video status successfully change'));
                return $this->redirect(['action'=>'summary']);
            }
            else{
                $this->Flash->error(__('Video could not be change.'));
            }
    	}
    	$this->Flash->error(__('Video could not be change.'));
    }
}

