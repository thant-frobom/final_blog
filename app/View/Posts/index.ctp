
<h1>
	Blog Posts
</h1>
<?php
	echo $this->Html->link(
			'Add Post',
			array('controller' => 'posts', 'action' => 'add')
		);
?>
</br>
<?php	
	//debug($userid);
	if($userid==null)
	{
		echo $this->Html->link('Login',
				array('controller'=>'users', 'action'=>'login')
			);
	}
	else
	{
		echo $this->Html->link('Logout', 
				array('controller'=>'users', 'action'=>'logout')
			);
	}	
?>
</br>
<?php
	echo $this->Html->link('Manage Your Posts',
			array('controller'=>'posts', 'action' => 'showbyid')
		);
?>
<table>
	<tr>
		<th>Id</th>
		<th>Title</th>
		<th>Image</th>
	</tr>
	<?php
		foreach ($posts as $post):
	?>
	<tr>
		<td>
			<?php echo $post['Post']['id'];?>
		</td>
		<td>
			<?php echo  $this->Html->link($post['Post']['title'], array('controller' => 'posts', 'action' => 'view', $post['Post']['id']));?>
		</td>
		<td><?php echo $this->Html->image('./posts/'.$post['Post']['imagePath'], array('alt' => 'Image', 'style' => 'width:100px; height:100px;'))?></td>
	</tr>
			<?php endforeach;?>
			<?php unset($post);?>
</table>