<?php

use \Elementor\Group_Control_Background;

class test_bg extends Group_Control_Background{
	public function init_fields() {
		$fields =  parent::init_fields();

		var_dump($fields);
		die();
	}
}

new test_bg();