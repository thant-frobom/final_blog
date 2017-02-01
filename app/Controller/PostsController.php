<?php
class PostsController extends AppController
{
    public $helpers = array('Html', 'Form');

    public function index() 
    {
      $userid=$this->Auth->user('id');
      $this->set('userid',$userid);
      $this->set('posts', $this->Post->find('all'));
    }
    

    /////////////////////////////////////////////////////////////////////////////


    public function view($id = null)
    {
        $this->loadModel('Comment');
        if(!$id)
        {
           throw new NotFoundException(__('Invalid Post'));
        }

        $userid=$this->Auth->user('id');
        $this->set('userid', $userid);

        $post = $this->Post->findById($id);
        $this->set('comments',$this->Comment->find('all',
          array(
              'fields'=> array('Comment.comment', 'Comment.id','User.username', 'Comment.user_id', 'Comment.post_id'),
              'joins'=>array(array(
                    'table'=>'users',
                    'alias'=>'User',
                    'type'=>'INNER',
                    'conditions'=>array('Comment.user_id=User.id','Comment.post_id='.$post['Post']['id'])
                    ))
              
            )
        ));

      if(!$post)
      {
             throw new NotFoundException(__('Invalid Post'));
      }
     
      $this->set('posts',$post);
     }
            
      ///////////////Show Post By Specific UserID////////////////
      public function showbyid()
      {
          $this->set('posts',$this->Post->find('all',
                array('conditions'=>array('Post.user_id'=>$this->Auth->user('id')))
            ));
      }

            /////////////////Add Post///////////////
      public function add()
      {
             if($this->request->is('post'))
             {
                    $this->Post->create();

                    $filePath="./img/posts/".$this->request->data['Post']['image']['name'];
                    $filename=$this->request->data['Post']['image']['tmp_name'];

                    if(move_uploaded_file($filename, $filePath))
                    {
                          echo "File Uploaded Successfully";

                          $this->request->data['Post']['imagePath']=$this->request->data['Post']['image']['name'];
                          $this->request->data['Post']['user_id']=$this->Auth->user('id');
                          if($this->Post->save($this->request->data))
                           {
                                 $this->Flash->success(__('Your post has been saved.'));
                                 return $this->redirect(array('action'=>'index'));
                           }
                           $this->Flash->error(__('Unable to add your post.'));
                    }
             }
      }

              /////////////////Delete////////////////////////
      public function delete($id=null)
      {
       // debug($id);
         $user_id=$this->Auth->user('id');
         $post_uid=$this->Post->findById($id);

        if($user_id==$post_uid['Post']['user_id']) 
        {
           $result=$this->Post->delete($id);
           if($result)
            {
             $this->Flash->success(__('Your post has been deleted.'));
             return $this->redirect(array('action'=>'showbyid'));
            }
            else
            {
              $this->Flash->error(__('Your delete operation has failed.'));
              return $this->redirect(array('action'=>'showbyid'));
            }
        }
        else
        {
          $this->Flash->error(__('Nice Try! You can only delete these.'));
          return $this->redirect(array('action'=>'showbyid'));
        }
   
      }

              //////////////Edit Method///////////////////////
      public function edit($id=null)
      {
         $user_id=$this->Auth->user('id');
         $post_uid=$this->Post->findById($id);
         if($user_id==$post_uid['Post']['user_id'])
         {
                if(!$id)
                {
                    throw new NotFoundException(__('Invalid Post'));
                }
                $post=$this->Post->findById($id);
              
               if(!$post)
                {
                  throw new NotFoundException(__('Invalid Post'));
                }

               if($this->request->is(array('post','put')))
               {
                    debug($this->Post->id);
                     
                    $this->Post->id=$id;
                    
                    $result=$this->Post->save($this->request->data);
                  
                    if($result)
                    {
                      $this->Flash->success(__("Your post has been updated."));
                      return $this->redirect(array('action'=>'showbyid'));
                    }

                    $this->Flash->error(__('Unable to update your post.'));
               }
               if(!$this->request->data)
               {
                  $this->request->data=$post;
               }
         }
         else
         {
           $this->Flash->error(__('Nice try! You can only edit these.'));
           $this->redirect(array('action'=>'showbyid'));
           return false;
         }

        
      }
}       

?>       