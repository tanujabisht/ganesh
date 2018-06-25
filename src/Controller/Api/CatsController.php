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


class CatsController extends AppController
{
    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->loadModel('Vedios');
         $this->loadModel('Favs');
    }
    public function categoryList(){        
        $res=array();
        $status='false';
        $responsecode='404';
        $message="failed";
        $this->viewBuilder()->setLayout(false);
         $zone=$this->Cats->find('all',['conditions'=>['status'=>1],'order'=>['id'=>'asc']])->all()->toArray();
         if(!empty($zone)){
            $i=0;
            $status='true';
            $responsecode='200';
            $message="success";
          foreach($zone as $news1){
            $res[$i]['category_id']=$news1->id;
            $res[$i]['name']=$news1->name;          
            $i++;
          }
        }
          $this->response= $this->response->withType('application/json')
                              ->withStringBody(json_encode(['status'=>$status,'responsecode'=>$responsecode,'message'=>$message,'response'=>$res]));
         return $this->response;
    }
     public function featureVideo(){        
        $res=array();
        $status='false';
        $responsecode='404';
        $message="failed";
        $this->viewBuilder()->setLayout(false);
         //$zone=$this->Vedios->find('all',['conditions'=>['status'=>1],'order'=>['feature'=>'DESC']])->all()->toArray();
          if($this->request->is(['post'])){
            $data=$this->request->getData();
            $cat_id=$data['category_id'];
             $user_id=$data['user_id'];
            if(empty($cat_id)){
                 $zone=$this->Vedios->find('all',['conditions'=>['status'=>1],'order'=>['feature'=>'DESC']])->all()->toArray();
            }else{
                 $zone=$this->Vedios->find('all',['conditions'=>['status'=>1,'category_id'=>$cat_id],'order'=>['id'=>'DESC']])->all()->toArray();
            }   
         if(!empty($zone)){
            $i=0;
            $status='true';
            $responsecode='200';
            $message="success";
          foreach($zone as $news1){
          if(isset($data['video_id'])){
            if(!empty($data['video_id'])){
                if($news1->id == $data['video_id']){
                    continue;
                }
            }
          }
          $getdata=$this->Favs->find('all',['conditions'=>['user_id'=>$user_id,'video_id'=>$news1->id]])->first();
                   if(!empty($getdata)){
                    $fav=1;
                   }else{
                    $fav=0;
                   }
            $res[$i]['video_id']=$news1->id;
            $res[$i]['name']=$news1->name;
            $res[$i]['description']=$news1->description;
            $res[$i]['url']=$news1->url;
            $res[$i]['date']=$news1->date;
            $res[$i]['category_id']=$news1->category_id;
            $res[$i]['fav']=$fav;
            $elapsed=$this->time_elapsed_string($news1->date);
            $res[$i]['posted']=$elapsed;
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
    public function searchVideo(){        
        $res=array();
        $status='false';
        $responsecode='404';
        $message="failed";
        $this->viewBuilder()->setLayout(false);
         if($this->request->is(['post'])){
            $data=$this->request->getData();
            $word=$data['word'];
            $user_id=$data['user_id'];
                $zone=$this->Vedios->find('all',['conditions'=>['Vedios.status'=>1,'OR'=>['Vedios.name LIKE' =>'%'.$word.'%','Vedios.description LIKE' =>'%'.$word.'%','Cats.name LIKE' =>'%'.$word.'%']],'contain'=>['Cats'],'order'=>['Vedios.id'=>'asc']])->all()->toArray();
               // echo"<pre>";print_r($zone);exit;
                if(!empty($zone)){
                   $i=0;
                   $status='true';
                   $responsecode='200';
                   $message="success";
                 foreach($zone as $news1){
                   $getdata=$this->Favs->find('all',['conditions'=>['user_id'=>$user_id,'video_id'=>$news1->id]])->first();
                   if(!empty($getdata)){
                    $fav=1;
                   }else{
                    $fav=0;
                   }
                   $res[$i]['video_id']=$news1->id;
                   $res[$i]['name']=$news1->name;
                   $res[$i]['description']=$news1->description;
                   $res[$i]['url']=$news1->url;
                   $res[$i]['date']=$news1->date;
                   $res[$i]['category_id']=$news1->category_id;
                   $elapsed=$this->time_elapsed_string($news1->date);
                   $res[$i]['fav']=$fav;
                   $res[$i]['posted']=$elapsed;
                    $url_img=Router::url('/', true);
                        $url_img=str_replace("index.php/","",$url_img);
                        $url_img .= "webroot/img/data/";
                     if(!empty($news1->thumb)){                       
                        $res[$i]['thumb'] = $url_img.$news1->thumb;
                    }  else{
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
            function time_elapsed_string($datetime, $full = false) {
            $now = new \DateTime;
            $ago = new \DateTime($datetime);
            $diff = $now->diff($ago);
        
            $diff->w = floor($diff->d / 7);
            $diff->d -= $diff->w * 7;
        
            $string = array(
                'y' => 'year',
                'm' => 'month',
                'w' => 'week',
                'd' => 'day',
                'h' => 'hour',
                'i' => 'minute',
                's' => 'second',
            );
            foreach ($string as $k => &$v) {
                if ($diff->$k) {
                    $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
                } else {
                    unset($string[$k]);
                }
            }
        
            if (!$full) $string = array_slice($string, 0, 1);
            return $string ? implode(', ', $string) . ' ago' : 'just now';
        }
       public function addFav(){        
        $res=array();
        $status='false';
        $responsecode='404';
        $message="failed";
        $this->viewBuilder()->setLayout(false);
         if($this->request->is(['post'])){
            $data=$this->request->getData();
            $user_id=$data['user_id'];
            $video_id=$data['video_id'];
            $getdata=$this->Favs->find('all',['conditions'=>['user_id'=>$user_id,'video_id'=>$video_id]])->first();
            if(empty($getdata)){
                $users=$this->Favs->newEntity();
                $users=$this->Favs->patchEntity($users,$data);
                if($this->Favs->save($users)){
                        $status='true';
                        $responsecode='200';
                        $message="Successfully added to your favourite list";
                         $res['msg']="Successfully added to your favourite list";	
                }
            }else{
                $users=$this->Favs->get($getdata->id);
                if($this->Favs->delete($users)){
                        $status='true';
                        $responsecode='200';
                        $message="Successfully remove to your favourite list";
                          $res['msg']="Successfully remove to your favourite list";	
                }
            }
           
        }
         $this->response= $this->response->withType('application/json')
                              ->withStringBody(json_encode(['status'=>$status,'responsecode'=>$responsecode,'message'=>$message,'response'=>$res]));
         return $this->response;
    }
    public function favList(){        
        $res=array();
        $status='false';
        $responsecode='404';
        $message="failed";
        $this->viewBuilder()->setLayout(false);
         if($this->request->is(['post'])){
            $data=$this->request->getData();
            $user_id=$data['user_id'];
            $favdata=$this->Favs->find('all',['conditions'=>['user_id'=>$user_id],'contain'=>['Vedios']])->all()->toArray();
            if(!empty($favdata)){
                 $i=0;
                foreach($favdata as $favdata1){                   
                   $status='true';
                   $responsecode='200';
                   $message="success";
                   
                   $res[$i]['video_id']=$favdata1->vedio->id;
                   $res[$i]['name']=$favdata1->vedio->name;
                   $res[$i]['description']=$favdata1->vedio->description;
                   $res[$i]['url']=$favdata1->vedio->url;
                   $res[$i]['date']=$favdata1->vedio->date;
                   $res[$i]['category_id']=$favdata1->vedio->category_id;
                   $elapsed=$this->time_elapsed_string($favdata1->vedio->date);
                   $res[$i]['posted']=$elapsed;
                         $url_img=Router::url('/', true);
                        $url_img=str_replace("index.php/","",$url_img);
                        $url_img .= "webroot/img/data/";
                     if(!empty($favdata1->vedio->thumb)){                        
                        $res[$i]['thumb'] = $url_img.$favdata1->vedio->thumb;
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

