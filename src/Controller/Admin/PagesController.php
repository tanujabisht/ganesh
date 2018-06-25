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


class PagesController extends AppController
{
    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->loadModel('Pages');
         $this->loadModel('Users');
    }

    public function summary()
    {
       $this->set('section','Pages');
       $this->set('sub_section','Summary');
       $this->paginate = ['limit'=>10];
       $clinics = $this->paginate($this->Pages);
        $this->set(compact('clinics'));
    
    }
   
    public function add($id=null){        
       $this->set('section','Pages');
       $this->set('sub_section','Manager');
          $img='';
       	if(!empty($id)){
    		$clinics=$this->Pages->get($id);
            $this->set('edit','edit');
    	}
    	else{
    		$clinics=$this->Pages->newEntity();
    	}

    	if($this->request->is(['post','put'])){
    		$data=$this->request->getData();            
    		if(!isset($id)){
                $data['added']=date('Y-m-d');
            }
    		$clinics=$this->Pages->patchEntity($clinics,$data);
    		if($this->Pages->save($clinics)){
                $type_new=$clinics->type;
                $message_new="Ganesh Films ".$clinics->type." content updated.";
               //====FCM ANDROID=====
                 $url = 'https://fcm.googleapis.com/fcm/send';
                    $msg = array
                    (
                      'message'  =>$message_new,
                      'status'=>'1',
                      'type'=>$type_new,
                      'body' 		=> 'great match!',
                      'title' 	=> 'Notification',
                      'icon' 		=> 'ic_launcher'
                    );
                    $fields = array(
                     'to' => "/topics/GaneshFilms",
                     'data' => $msg,
                    );
                
                     $headers = array(
                     'Authorization: key='.ANROID_KEY,
                     'Content-Type: application/json'
                     );
                     $ch = curl_init();
                     curl_setopt($ch, CURLOPT_URL, $url);								
                     curl_setopt($ch, CURLOPT_POST, true);
                     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);								
                     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
                     $result = curl_exec($ch);								  
                     if ($result === FALSE) {
                      die('Curl failed: ' . curl_error($ch));
                     }
                     curl_close($ch);
                     //====FCM ANDROID=====
                     //=======APN IOS=======
                            $user_list=$this->Users->find('all',['conditions'=>['token !='=>'','active'=>'1']])->all()->toArray();
                            if(!empty($user_list)){
                                foreach($user_list as $user_list1){
                                    $deviceToken=$user_list1->token;
                                    //echo"<pre>";print_r($deviceToken);exit;
                                    $payload = [];
                                    $payload['aps'] = array('alert' => $message_new, 'badge' => 1, 'sound' => 'default','type'=>$type_new);
                                    $payload['data']= $msg;
                                    $payload = json_encode($payload);						
                                    $apnsHost = 'gateway.sandbox.push.apple.com';
                                    $apnsPort = 2195;							
                                    $apnsCert = WWW_ROOT.'Ganesh.pem';
                                    $error='';
                                    $errorString='';
                                   // echo"<pre>";print_r($payload);exit;
                                    $streamContext = stream_context_create();
                                    stream_context_set_option($streamContext, 'ssl', 'local_cert', $apnsCert);							
                                    $apns = stream_socket_client('ssl://' . $apnsHost . ':' . $apnsPort, $error, $errorString, 2, STREAM_CLIENT_CONNECT, $streamContext);
                                    $apnsMessage = chr(0) . chr(0) . chr(32) . pack('H*', str_replace(' ', '', $deviceToken)) . chr(0) . chr(strlen($payload)) . $payload;
                                    if(fwrite($apns, $apnsMessage)){
                                        //echo"<pre>";print_r($apns);exit;
                                    }
                                    fclose($apns);
                                }
                            }					
							
                     //=======APN IOS=======
    			$this->Flash->success(__('Page saved successfully.'));
                return $this->redirect(['action'=>'summary']);
            }
            else{
                $this->Flash->error(__('Page could not be saved.'));
            }
    	}
        $this->set(compact('clinics','img'));
    }
   
    public function delete($id=null){
    	if(!empty($id)){
    		$drivers=$this->Pages->get($id);
    		if($this->Pages->delete($drivers)){
    			$this->Flash->success(__('Page deleted successfully.'));
                return $this->redirect(['action'=>'summary']);
            }
            else{
                $this->Flash->error(__('Page could not be deleted.'));
            }
    	}
    	$this->Flash->error(__('Page could not be deleted.'));
    }
    public function changestatus($id=null){
    	if(!empty($id)){
    		$clinics=$this->Pages->findById($id)->first();
            $c_data=$this->Pages->get($id);
            if($clinics->status == 1)
            {
              $data['status']=0;  
            }else{
              $data['status']=1;  
            }
            $c_data=$this->Pages->patchEntity($c_data,$data);
    		if($this->Pages->save($c_data)){
    			$this->Flash->success(__('Page status successfully change'));
                return $this->redirect(['action'=>'summary']);
            }
            else{
                $this->Flash->error(__('Page could not be change.'));
            }
    	}
    	$this->Flash->error(__('Page could not be change.'));
    }
}

