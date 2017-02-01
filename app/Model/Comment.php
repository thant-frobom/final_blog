<?php
class Comment extends AppModel
	{
		public $validate=array(
				'comment'=>array(
					'rule'=>'notBlank'
					)
			);
	}
?>	