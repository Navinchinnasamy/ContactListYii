<?php
class myBehavior extends CActiveRecordBehavior {
	public function beforeSave($event){
		echo "Before Save..!";
		echo "<pre>";
		print_r($event);
		exit;
	}
	
	public function afterSave($event){
		echo "After Save..!";
		echo "<pre>";
		print_r($event);
		exit;
	}
}
?>