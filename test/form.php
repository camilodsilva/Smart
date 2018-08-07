<?php

require('../app/libs/Form.php');
require('../app/libs/Form/Val.php');

if(isset($_REQUEST['run'])){
	try{
		$form = new Form();

		$form->post('name')->val('minlength', 5)->post('age')->val('digit')->post('gender'); 
		$form->submit();

		echo "The form passed!";
		$data = $form->fetch();

		echo "<pre>";
			print_r($data);
		echo "</pre>";
	}catch(Exception $e){
		echo $e->getMessage();
	}
}

?>

<form method="post" action="?run">
	Name <input type="text" name="name" />
	Age <input type="text" name="age" />
	Gender <select name="gender">
		<option value="m">Male</option>
		<option value="f">Female</option>
	</select>
	<input type="submit" />
</form>