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


class UsersController extends AppController
{
    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
       
    }
     public function login(){
        $res=array();
        $status='false';
        $responsecode='404';
        $message="failed";
        $this->viewBuilder()->setLayout(false);
         if($this->request->is(['post'])){
            $data=$this->request->getData();
            if(!empty($data['phone'])){
                $userexist=$this->Users->find('all',['conditions'=>['phone'=>$data['phone']]])->first();
                        if(!empty($userexist)){
                            if($userexist->active ==0){                                
                                    $status='false';
                                    $responsecode='404';
                                    $message="You are blocked.Please contact to administator";
                                     $this->response= $this->response->withType('application/json')
                                      ->withStringBody(json_encode(['status'=>$status,'responsecode'=>$responsecode,'message'=>$message,'response'=>$res]));
                                     return $this->response;
                                    exit;
                            }
                        }                        
                        $r_num=rand('0000','9999');
                        $r= strlen($r_num);
                        if($r < 4){
                            if($r==1){$n1=000;}
                            if($r==2){$n1=00;}
                            if($r==3){$n1=0;}
                            $r_num1=$r_num.$n1;
                        }else{
                            $r_num1=$r_num;
                        }
                         if(!empty($userexist)){
                            $users=$this->Users->get($userexist->id);
                            if(empty($userexist->name)){
                                $res['user_type']='New User';
                                $res['name'] = '';
                                $res['email'] = '';
                                $res['image'] = '';                               
                            }else{
                                $res['user_type']='Old User';
                                $res['name'] = $userexist->name;
                                $res['email'] = $userexist->email;
                                $url_img=Router::url('/', true);
                                $url_img=str_replace("index.php/","",$url_img);
                                $url_img .= "webroot/img/user/";
                                $res['image'] = $url_img.$userexist->image;
                            }                            
                         }else{
                            $users=$this->Users->newEntity();
                            $res['user_type']='New User';
                            $res['name'] = '';
                            $res['email'] = '';
                            $res['image'] = '';
                           
                         }
                        $datanew['phone']=$data['phone'];
                        $datanew['active']=1;
                        $datanew['otp']=$r_num1;
                        $users=$this->Users->patchEntity($users,$datanew); 
                        if($this->Users->save($users,$datanew)){
                            $status='true';
                            $responsecode='200';
                            $message="success";
                            $res['user_id']=(string)$users->id;
                            // $res['otp']=$r_num1;
                            $res['otp']="1234";							
                                //$mobilenumber = $data['phone'];   
                                //$mess = urlencode("The unique verificaton code for Ganesh films is ". $r_num1);
                                //$ch = curl_init();
                                //curl_setopt($ch,CURLOPT_URL,  "http://sms4power.com/api/swsend.asp");
                                //curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                //curl_setopt($ch, CURLOPT_POST, 1);
                                //curl_setopt($ch,CURLOPT_POSTFIELDS,"username=t1UKSTECHNO&password=21594789&sender=KOALAK&sendto=$mobilenumber&message=$mess");
                                //$buffer = curl_exec($ch);
                                //if(empty ($buffer))
                                // {
                                // }
                                // else
                                // { 
                                // }
                                // curl_close($ch);
                        }
            }
         }
          $this->response= $this->response->withType('application/json')
                              ->withStringBody(json_encode(['status'=>$status,'responsecode'=>$responsecode,'message'=>$message,'response'=>$res]));
         return $this->response;
    }
    public function register(){        
        $res=array();
         $status='false';
        $responsecode='404';
        $message="failed";
        $this->viewBuilder()->setLayout(false);
       // 
        if($this->request->is(['post'])){
             $data=$this->request->getData();
             
             if(isset($data['user_id'])){
                 if(!empty($data['user_id'])){
                    $data['user_id'] = $data['user_id'];
                    $users=$this->Users->get($data['user_id']);
                }
             }else{
                $users=$this->Users->newEntity();
             }
             
            if(isset($data['name'])){
                if(!empty($data['name'])){
                    $data['name'] = $data['name'];
                }
            }
            
            if(isset($data['email'])){
                if(!empty($data['email'])){
                    $data['email'] = $data['email'];
                }
            }
            if(isset($data['loaction'])){
                if(!empty($data['loaction'])){
                    $data['loaction'] = $data['loaction'];
                }
            }
             if(isset($data['gender'])){
                if(!empty($data['gender'])){
                    $data['gender'] = $data['gender'];
                }
            }
           
             if(isset($data['dob'])){
                if(!empty($data['dob'])){
                    $date=$data['dob'];
                    $date = str_replace('/', '-', $date);
                    $data['dob'] = date('Y-m-d',strtotime($date));
                }
             }
           
             if(!empty($data['image'])){
                    $img=trim($data['image']);
                    $img = str_replace(' ', '+', $img);
                    $image = base64_decode($img);
                    $file = uniqid() . '.png';
                    $file1= WWW_ROOT."img/user/" .$file;
                    $success = file_put_contents($file1, $image);                                       
                    if($success){
                        $data['image']=$file;
                    }
                    else{
                        $data['image']="user.png";
                    }
            }else{
                $data['image']="user.png";
            }
            $data['created'] = date('Y-m-d');
            $data['active'] = 1;  
            $data['status'] = 1;
            $users=$this->Users->patchEntity($users,$data);
             //print_r($users);exit;
            if(!empty($users->errors())){
                //echo "in"; exit;                
                $errors = $users->errors();               
                foreach ($errors as $key => $error) {
                    foreach ($error as $keyInner => $val) {
                        $message = $val;
                        break 2;
                    }
                }
               
            }else{              
                if($this->Users->save($users)){
                    $status='true';
                    $responsecode='200';
                    $message="Registration completed.";
                    $res['user_id']=$users->id;
                    $res['name'] = $users->name;
                    $res['email'] = $users->email;
                    $res['phone'] = $users->phone;
                      $res['gender'] = $users->gender;
                    $url_img=Router::url('/', true);
                    $url_img=str_replace("index.php/","",$url_img);
                    $url_img .= "webroot/img/user/";
                    $res['image'] = $url_img.$users->image;
                }                       
            }            
        }
        $this->response= $this->response->withType('application/json')
                              ->withStringBody(json_encode(['status'=>$status,'responsecode'=>$responsecode,'message'=>$message,'response'=>$res]));
         return $this->response;
    }
     public function getprofile(){
          $res=array();
         $status='false';
        $responsecode='404';
        $message="failed";
        if($this->request->is(['post'])){
            $data=$this->request->getData();
            $userdata=$this->Users->find('all',['conditions'=>['id'=>$data['user_id']]])->first();
            if(!empty($userdata)){
                 $status='true';
                    $responsecode='200';
                    $message="success";
                $res['name']= $userdata->name;
                $res['email']= $userdata->email;
                $res['phone']= $userdata->phone;
                //$res['city']= $userdata->city;
                $res['dob']= date('d/m/Y',strtotime($userdata->dob));
                //$res['location']= $userdata->location;
                $res['gender']= $userdata->gender;
                $url_img=Router::url('/', true);
                $url_img=str_replace("index.php/","",$url_img);
                $url_img .= "webroot/img/user/";
                $res['image'] = $url_img.$userdata->image;
            }
        }
       $this->response= $this->response->withType('application/json')
                              ->withStringBody(json_encode(['status'=>$status,'responsecode'=>$responsecode,'message'=>$message,'response'=>$res]));
         return $this->response;
     }
      public function token(){        
        $res=array();
        $status='false';
        $responsecode='404';
        $message="failed";
        $this->viewBuilder()->setLayout(false);
        if($this->request->is(['post'])){
            $data=$this->request->getData();             
            $users=$this->Users->get($data['user_id']);
            $users=$this->Users->patchEntity($users,$data);
            $users=$this->Users->save($users);
             if($this->Users->save($users)){
                    $status='true';
                    $responsecode='200';
                    $message="Token Saved";
             }
        }
        $this->response= $this->response->withType('application/json')
                              ->withStringBody(json_encode(['status'=>$status,'responsecode'=>$responsecode,'message'=>$message]));
         return $this->response;
      }
    public function token_android(){        
        $res=array();
        $status='false';
        $responsecode='404';
        $message="failed";
        $this->viewBuilder()->setLayout(false);
        if($this->request->is(['post'])){
            $data=$this->request->getData();             
            $users=$this->Users->get($data['user_id']);
            $users=$this->Users->patchEntity($users,$data);
            $users=$this->Users->save($users);
             if($this->Users->save($users)){
                    $status='true';
                    $responsecode='200';
                    $message="Token Saved";
             }
        }
        $this->response= $this->response->withType('application/json')
                              ->withStringBody(json_encode(['status'=>$status,'responsecode'=>$responsecode,'message'=>$message]));
         return $this->response;
      }
      
}

