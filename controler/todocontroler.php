<?php 

include('../config/config.php');
include('../model/DBBase.php');
include('../model/todo_list.php');

class Todocontoler{

	function inserttodo($array)
	{
		$obj = new Todo_list();
		$obj->name = $array['todo'];
		$obj->date = date('Y-m-d');
		$obj->time = date('H:i:s');
		$save = $obj->savetodo_list();
		if ($save) {
			return 1;
		}else{
			return 0;
		}
		
	}
}


 ?>