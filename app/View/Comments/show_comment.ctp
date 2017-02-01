<?php
	//debug($comments);
	foreach($comments as $comment)
	{
?>
		<strong><?php echo $comment['User']['username'];?></strong>
		&nbsp; &nbsp;
		<i><?php echo $comment['Comment']['comment'];?></i>
		&nbsp; &nbsp;
<?php		
		echo $this->Form->postLink(
					'Delete',
					array(
							'action' => '',$comment['Comment']['id'],
							'type'=>'button'
							
						),
					array(
							'confirm'=>'Your data will be deleted.'
						)
					);
?>		
		<br/><br/>
<?php
	}
?>