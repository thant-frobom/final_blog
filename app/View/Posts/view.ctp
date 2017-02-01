<h1>
	<?php
			echo h($posts['Post']['title']);
	?>
</h1>
<p><small>Created: <?php echo $posts['Post']['created'];?></small></p>
<p><small>Photo: </small></p>
<?php echo $this->Html->image('./posts/'.$posts['Post']['imagePath'], array('alt' => 'Image', 'style' => 'width:300px;'))?>

<p><?php echo h($posts['Post']['description']);?></p>

<h3>COMMENTS</h3>
<?php 
	//debug($userid);
	foreach($comments as $comment)
	{
?>		
		<text><?php echo "Name: " . $comment['User']['username'] . "<br/>";?></text>
		
		<text><?php echo "Comment: " . $comment['Comment']['comment'];?></text>
		&nbsp; &nbsp; &nbsp;
<?php	
		if($userid==$comment['Comment']['user_id'])
		{
			echo $this->Form->postLink(
						'Delete',
						array(
								'controller'=>'Comments',
								'action' => 'delete',$comment['Comment']['id'],$comment['Comment']['post_id'],
								'type'=>'button'
								
							),
						array(
								'confirm'=>'Your data will be deleted.'
							)
						);

			echo "<br/>";
		}

		
?>
		<br/><br/><hr/>
<?php				
	}	

		echo $this->Form->create('Comment', array('url'=> array('controller'=>'Comments','action'=>'saveComment', $posts['Post']['id'])));
		echo $this->Form->input('comment',
				array('type'=>'text')
			);

		echo $this->Form->button('Save Comment');
?>
