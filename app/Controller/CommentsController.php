<?php
	include 'PostsController.php';
		
	class CommentsController extends AppController
    {
    	public function saveComment($id = null)
    	{
    		$obj_post = new PostsController;

    		$user_id=$this->Auth->user('id');
    		$comments=$this->Comment->create();
    		
 			$post_fields=$obj_post->Post->findById($id);
    		$post_id=$post_fields['Post']['id'];

    		$this->request->data['Comment']['user_id']=$user_id;
    		$this->request->data['Comment']['post_id']=$post_id;
    		
    		$result=$this->Comment->save($this->request->data);
    		if($result)
    		{
    			
    			$this->Flash->success(__('Your comment has been saved.'));
    			return $this->redirect(array('action'=>'../Posts/view/'.$post_id));
    		}
    		else
    		{
    			return $this->Flash->error(__('Add Comment Failed'));
    		}
			   		
    	}

    	public function delete($id=null,$pid)
    	 {
    	 	$uid=$this->Auth->user('id');
    	 	$obj_post = new PostsController;
            $post_fields=$obj_post->Post->findById($pid);

            $com_field=$this->Comment->findById($id);
    	 	if($uid==$com_field['Comment']['user_id'])
    	 	{
	    	   	$result=$this->Comment->delete($id);
	    	 	if($result)
	    	 	{

	    	 		$this->Flash->success(__('Your comment has been deleted.'));
	    	 		$this->redirect(array('action'=>'../Posts/view/'.$post_fields['Post']['id']));
	            }
	    	}	
	    	else
	    	{
	    		$this->Flash->error(__('You do not own the comment.'));
	    		$this->redirect(array('action'=>'../Posts/view/'.$post_fields['Post']['id']));
               
	    	}
    	 }

    
    }       
         
?>