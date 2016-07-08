<?php
	require_once('boot.php');

	if (isset($_GET['id'])) {
		$mode = 'update';
		$user = User::findById($_GET['id']);
		var_dump($user);
	} else {
		$mode = 'insert';
		//crée un user vide dans le cas d'une
		// creé un user vide pour éviter "notice: undefind variable/property " (atttribute value des value des input du formulaire)
		$user = new User();
	}

	if (isset($_POST['submit'])) {
		$mode = 'update';

		//formulaire enviyeé
		//utiliser la class User
		//pour insert en DB les donnée postées
		//echo $_POST['lasttName'];

		//instractio d'un object vide
		$user = new User();
		// hydration de l'object
		$user->firstName = $_POST['firstName'];
		//$user->lastName = $_POST['lastName'];
		$user->email = $_POST['email'];

		//$user->insert();
		//$user->update()

		// déterminer au submit si on est en mode update ou en mode insert
		/*
		if (isset($_POST['id'])) {
			//echo 'mode update'
			$user->id = $_POST['id'];
			$user->update();
			redirect('index.php');
		} else {
			//echo 'mode insert';
			$user->insert();
			redirect('index.php');
		}
		*/
		if(isset($_POST['id'])) {
			$user->id = $_POST['id'];
		};
		
		$user->save();
		redirect('index.php');
	}
?>
	<h2>Add User form</h2>
	<form action="" method="post">
	<label for="firstName">Frist Name</label>
	<input type="text" name="firstName" value="<?= $user->firstName ?>">
	<br/>

	<label for="lasttName">Last Name</label>
	<input type="text" name="lasttName" value="">
	<br/>

	<label for="email">Email</label>
	<input type="text" name="email" value="<?= $user->email ?>">
	<br/>

	<?php
		if ($mode == 'update') {
			echo '<input type"hidden" name="id" value="'. $user->id .'">';
		}
	?>
	<input type="submit" name="submit">
	
</form>