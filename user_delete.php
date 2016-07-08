<?php

require_once("classes/Database.php");
require_once("classes/User.php");
//require_once("boot.php");
require_once("function.php");

if (isset($_GET['id'])) {

	$user = User::findByid($_GET['id']);

	if (!$user) {
		echo 'User introuvable';
	} else {
		//+var_dump($user);
		$user->delete();
		//echo '<div class="succes">utilisateur suprime</div>';
		redirect('index.php');
	}

} else {
	echo 'Il manque l\'id';
}

?>
