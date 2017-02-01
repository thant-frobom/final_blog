<?php
	class Post extends AppModel
	{
		public $validate=array(
			'title'=>array(
					'rule'=>'notBlank'
				),
			'body'=>array(
					'rule'=>'notBlank'
				),
			'image'=>array(
				'rule'=>array('extension',array('jpeg','jpg','png','gif')),
				'required'=> false,
				'allowEmpty'=>true,
				'message'=>'Invalid File'
				)
			);	

	}
?>