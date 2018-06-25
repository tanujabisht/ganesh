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


class UsersController extends AppController
{
    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->loadModel('Useraddresses');
    }
    
    public function summary()
    {
       $this->set('section','User');
       $this->set('sub_section','Summary');
       $this->paginate = ['conditions'=>['status'=>1],'limit'=>10];
       $clinics = $this->paginate($this->Users);
        $this->set(compact('clinics'));
    
    }
     public function view($id)
    {
       $this->set('section','User');
       $this->set('sub_section','View Detail');
       if(!empty($id)){
        $userdata=$this->Users->find('all',['conditions'=>['id'=>$id]])->first();
        //$url_img=Router::url('/', true);
        //$url_img=str_replace("index.php/","",$url_img);
        //$url_img .= "webroot/img/data/";
        //$userdata->image=$url_img.$userdata->image;
       }
        $this->set(compact('userdata'));
    }
    public function changestatus($id=null){
    	if(!empty($id)){
    		$clinics=$this->Users->findById($id)->first();
            $c_data=$this->Users->get($id);
            if($clinics->active == 1)
            {
             // echo"<pre>";print_r($c_data);exit;
               $message_new="Ganesh Films Block you account";
             
                    $msg = array
                    (
                      'message'  =>$message_new,
                      'status'=>'1',
                      'type'=>'block',
                      'body' 		=> 'great match!',
                      'title' 	=> 'Notification',
                      'icon' 		=> 'ic_launcher'
                    );
                    $type_new="block";
                      //====Apn Ios=====
                    if(!empty($c_data->token)){
                        $deviceToken=$c_data->token;
                        $payload = [];
                        $payload['aps'] = array('alert' => $message_new, 'badge' => 1, 'sound' => 'default','type'=>$type_new);
                        $payload['data']= $msg;
                        $payload = json_encode($payload);						
                        $apnsHost = 'gateway.sandbox.push.apple.com';
                        $apnsPort = 2195;							
                        $apnsCert = WWW_ROOT.'Ganesh.pem';
                        $error='';
                        $errorString='';        
                        $streamContext = stream_context_create();
                        print_r($payload);exit;
                        stream_context_set_option($streamContext, 'ssl', 'local_cert', $apnsCert);							
                        $apns = stream_socket_client('ssl://' . $apnsHost . ':' . $apnsPort, $error, $errorString, 2, STREAM_CLIENT_CONNECT, $streamContext);
                        $apnsMessage = chr(0) . chr(0) . chr(32) . pack('H*', str_replace(' ', '', $deviceToken)) . chr(0) . chr(strlen($payload)) . $payload;
                        
                        if(fwrite($apns, $apnsMessage)){
                          
                        }
                        fclose($apns);
                    }
                
                 //====Apn Ios=====
                    //====Android FCM=====
                    print_r($c_data->token_a);exit;
                    if(!empty($c_data->token_a)){
                        $deviceToken=$c_data->token_a;
                         $url = 'https://fcm.googleapis.com/fcm/send';								
								$fields = array(
								 'to' => $deviceToken,
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
                                        // Disabling SSL Certificate support temporarly
                                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);                                    
                                        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));                                    
                                        // Execute post
                                        $result = curl_exec($ch);                                      
                                        if ($result === FALSE) {
                                         die('Curl failed: ' . curl_error($ch));
                                        }
                                    curl_close($ch);
                    }
                
                 //====Android FCM=====
              $data['active']=0;
              $this->Flash->success(__('Users successfully Blocked'));
            }else{
              $data['active']=1;
              $this->Flash->success(__('Users successfully Unblocked'));
            }
            $c_data=$this->Users->patchEntity($c_data,$data);
    		if($this->Users->save($c_data)){
    			
                return $this->redirect(['action'=>'summary']);
            }
            else{
                $this->Flash->error(__('Users could not be change.'));
            }
    	}
    	$this->Flash->error(__('Users could not be change.'));
    }
   
}

