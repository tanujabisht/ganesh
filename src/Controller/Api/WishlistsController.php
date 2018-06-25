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


class WishlistsController extends AppController
{
    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->loadModel('Requests');
        $this->loadModel('Users');
        $this->loadModel('Feedbacks');
    }
    public function wishList(){        
        $res=array();
        $status='false';
        $responsecode='404';
        $message="failed";
        $this->viewBuilder()->setLayout(false);
        if($this->request->is(['post'])){
                $data=$this->request->getData();
                $user_id=$data['user_id'];
                $con=['status'=>1];
                $request_list=$this->Requests->find('list',['conditions'=>['user_id'=>$user_id],'keyField'=>'wish_id','valueField'=>'wish_id'])->all()->toArray();
                if(!empty($request_list)){
                    $con +=['id NOT IN'=>$request_list];
                }
                $zone=$this->Wishlists->find('all',['conditions'=>$con,'order'=>['id'=>'asc']])->all()->toArray();
                 //print_r($zone);exit;
                 if(!empty($zone)){
                    $i=0;
                    $status='true';
                    $responsecode='200';
                    $message="success";
                  foreach($zone as $news1){
                    $res[$i]['wishlist_id']=$news1->id;
                    $res[$i]['name']=$news1->name;
                    $res[$i]['description']=$news1->description;
                    $url_img=Router::url('/', true);
                                $url_img=str_replace("index.php/","",$url_img);
                                $url_img .= "webroot/img/data/";
                    if(!empty($news1->thumb)){                                
                                $res[$i]['thumb'] = $url_img.$news1->thumb;
                            }else{
                                $res[$i]['thumb'] = $url_img."noimage.png";
                            }
                    $i++;
                  }
                }
        }
          $this->response= $this->response->withType('application/json')
                              ->withStringBody(json_encode(['status'=>$status,'responsecode'=>$responsecode,'message'=>$message,'response'=>$res]));
         return $this->response;
    }
     
    public function addWishList(){        
        $res=array();
        $status='false';
        $responsecode='404';
        $message="failed";
        $this->viewBuilder()->setLayout(false);
        if($this->request->is(['post'])){
            $data=$this->request->getData();
            $data['date']=date('Y-m-d');
            $request=$this->Requests->newEntity();
            $request=$this->Requests->patchEntity($request,$data);
            if($this->Requests->save($request)){
                $status='true';
                $responsecode='200';
                $message="success";
                $res['msg']="Successfully saved as wishlist";
            }
        }
          $this->response= $this->response->withType('application/json')
                              ->withStringBody(json_encode(['status'=>$status,'responsecode'=>$responsecode,'message'=>$message,'response'=>$res]));
         return $this->response;
    }
     public function removeWishList(){        
        $res=array();
        $status='false';
        $responsecode='404';
        $message="failed";
        $this->viewBuilder()->setLayout(false);
        if($this->request->is(['post'])){
            $data=$this->request->getData();
            $id=$data['wishlist_id'];
            $drivers=$this->Requests->get($id);
    		if($this->Requests->delete($drivers)){
                $status='true';
                $responsecode='200';
                $message="success";
                $res['msg']="Successfully remove from wishlist";
            }
        }
          $this->response= $this->response->withType('application/json')
                              ->withStringBody(json_encode(['status'=>$status,'responsecode'=>$responsecode,'message'=>$message,'response'=>$res]));
         return $this->response;
    }
    public function newsletter(){        
        $res=array();
        $status='false';
        $responsecode='404';
        $message="failed";
        $this->viewBuilder()->setLayout(false);
        if($this->request->is(['post'])){
            $data=$this->request->getData();
            $user_id=$data['user_id'];
            $user_detail=$this->Users->find('all',['conditions'=>['id'=>$user_id]])->first();
            if($user_detail->newsletter == 0){
                $datanew['newsletter']=1;
                $datanew['email']=$data['email_id'];
                $request=$this->Users->get($user_id);
                $request=$this->Users->patchEntity($request,$datanew);
                if($this->Users->save($request)){
                    $status='true';
                    $responsecode='200';
                    $message="success";
                    $res['msg']="You have sucessfully subscribe the newsletter";
                } 
            }else{
                $res['msg']="You already subscribe the newsletter";
            }            
        }
          $this->response= $this->response->withType('application/json')
                              ->withStringBody(json_encode(['status'=>$status,'responsecode'=>$responsecode,'message'=>$message,'response'=>$res]));
         return $this->response;
    }
     public function addFeedback(){
            $res=array();
            $status='false';
            $responsecode='404';
            $message="failed";
            $this->viewBuilder()->setLayout(false);
            if($this->request->is(['post'])){
                $data=$this->request->getData();
                $data['user_id']=$data['user_id'];
                $data['comment']=$data['comment'];
                $data['date']=date('Y-m-d');
                $data['rating']=$data['rating'];                
                $pack=$this->Feedbacks->newEntity();
                $pack=$this->Feedbacks->patchEntity($pack,$data);
                if($this->Feedbacks->save($pack)){
                    $status='true';
                    $responsecode='200';
                    $message="success";
                    $res['msg']="You have successfully submit feedback";
                }
            }
            $this->response= $this->response->withType('application/json')
                              ->withStringBody(json_encode(['status'=>$status,'responsecode'=>$responsecode,'message'=>$message,'response'=>$res]));
         return $this->response;
        }
    public function userWishList(){        
        $res=array();
        $status='false';
        $responsecode='404';
        $message="failed";
        $this->viewBuilder()->setLayout(false);
         if($this->request->is(['post'])){
            $data=$this->request->getData();
            $user_id=$data['user_id'];
            $favdata=$this->Requests->find('all',['conditions'=>['Requests.user_id'=>$user_id],'contain'=>['Wishlists']])->all()->toArray();
            if(!empty($favdata)){
                 $i=0;
                foreach($favdata as $news1){                   
                   $status='true';
                   $responsecode='200';
                   $message="success";                   
                   $res[$i]['wishlist_id']=$news1->id;
                    $res[$i]['name']=$news1->wishlist->name;
                    $res[$i]['description']=$news1->wishlist->description;
                     $url_img=Router::url('/', true);
                        $url_img=str_replace("index.php/","",$url_img);
                        $url_img .= "webroot/img/data/";
                    if(!empty($news1->wishlist->thumb)){                       
                        $res[$i]['thumb'] = $url_img.$news1->wishlist->thumb;
                    } else{
                        $res[$i]['thumb'] = $url_img."noimage.png";
                    }
                   $i++;
                 
                }
            }               
                
           }
          $this->response= $this->response->withType('application/json')
                              ->withStringBody(json_encode(['status'=>$status,'responsecode'=>$responsecode,'message'=>$message,'response'=>$res]));
         return $this->response;
    }
}

