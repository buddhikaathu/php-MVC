<?php
include('../controler/todocontroler.php');

if (isset($_POST)) {
	$con = new Todocontoler();
	$ins = $con->inserttodo($_POST);
	if ($ins==1) {
		echo 'success';
	}
}

?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Todo List</title>
</head>
<body>
	<h1>Add new todo</h1>
	<form method="post" >
		<div>
			<input type="text" style="width:50%" placeholder="todo here" name="todo" />
		</div>
		<div>
			<button>Add Todo</button>
		</div>

		
	</form>
</body>
</html>