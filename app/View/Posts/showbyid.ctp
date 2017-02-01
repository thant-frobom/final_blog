<table>
	<tr>
		<th>Id</th>
		<th>Title</th>
		<th>Image</th>
		<th>Edit</th>
		<th>Delete</th>
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
		<td>
			<?php
				echo $this->Html->link('Edit', 
						array('action'=>'edit', $post['Post']['id'])
					);
			?>
		</td>
		<td>
			<?php
				echo $this->Form->postLink(
					'Delete',
					array(
							'action' => 'delete',$post['Post']['id'],
							'type'=>'button'
							
						),
					array(
							'confirm'=>'Your data will be deleted.'
						)
					);
			?>
		</td>
	</tr>
			<?php endforeach;?>
			<?php unset($post);?>
</table>