
<?php

require_once("classes/Database.php");
require_once("classes/User.php");

require_once("boot.php");

$connection = new Database();
$db = $connection->connection();


//$db = new Database();
//$db->connection();
//$db->query('SELECT')

$sth = $db->query("SELECT * FROM user");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC); 
//$result = $sth->fetch(PDO::FETCH_ASSOC);


print_r($result);
//echo $result->firstName;

//$db->query('SELECT * FROM user');

echo '<h1>List des utilisateurs</h1>';
echo '<p>Nomber d\utilisateur: ' .User::countAll() . '</p>';
echo '<a href="user_form.php">Ajouter  un utilisateur</a>';
// afficher le nomber d'utilisateur
//User::countAll();

// Afficher la liste

$user = new User();
$users = $user->findAll();


echo '<table>';
foreach ($users as $u) {
	//echo '<P>' . $u->firstName . '' .
	//$u->lastName . '</p>';

	//$u->getFullName();
	//$u->up

	echo '<tr>';
	echo '<td>' . $u->getFullName() . '</td>';
	echo '<td><a href="user_form.php?id='.$u->id.'&mode=edit">Update</td>';
	echo '<td><a href="user_delete.php?id='.$u->id.'">Delete</a></td>';
	echo '</th>';

	//echo'<p>' .$u->getFullName() . '</p>';
}
echo '</table>';


?>





