<?php
class User
{
	private $db;
	public $id;
	public $firstName;
	public $lasttName;
	public $email;
	public $age;

	private static $database; // variante si contexte statique

	public function __construct()
	{
		$connection = new Database();
		$this->db = $connection->connection();
		echo 'ok';
	}

	public static function countAll()
	{
		$connection = new Database();
		self::$database = $connection->connection();
		$sth = self::$database->query("SELECT COUNT(*) FROM user");
		$sth->execute();
		$result = $sth->fetch(PDO::FETCH_NUM); // FETCH_NUM renvoi un tablo (et non pas object);


		return $result[0];

		//variante
		//return arry_shift($result);

	}


	//METHORD STATIC MÉTHORD CLASS INVOQUÉE PAR LE ::
	 public static function findById($id)
	{
		// variante si contexte static
		$connection = new Database();
		self::$database = $connection->connection();
		$sth = self::$database->query("SELECT * FROM user WHERE id =".$id);
		$sth->execute();
		$result = $sth->fetch(PDO::FETCH_OBJ);


		//instanction d'object +hydration

		if (!$result) {
			return false;
		}else {
			//instraction d'object + hydration
			$user = new User();
			$user->id = $result->id;
			$user->firstName = $result->firstName;
			$user->lastName = $result->lastName;
			$user->email = $result->email;

			return $user;
		}

		/*
		$connection = new Database();
		$this->db = $connection->connection();
		$sth = $db->query("SELECT * FROM user");
		*/
	}

	public function findAll()
	{

		$sth = $this->db->query("SELECT * FROM user");
		$sth->execute();
		//$result = $sth->fetch(PDO::FETCH_ASSOC);
		$results = $sth->fetchAll(PDO::FETCH_OBJ); 
		echo '<pre>';
		//var_dump($results);

		$users = [];

		foreach ($results as $result) {
			//echo $result->firstName;
			$user = new User();

			//hydration de l'object: on alimente
			$user->id = $result->id;
			$user->firstName = $result->firstName;
			$user->lastName = $result->lastName;
			$user->email = $result->email;

			$users[] = $user;
		}

		//var_dump($users);

		//return $results;
		return $users;
	}

	public function insert()
	{
		$sth = $this->db->prepare("INSERT INTO user (firstName, lastName, email) VALUES (:firstName, :lastName, :email)");

		$sth->bindValue(':firstName', $this->firstName);
		$sth->bindValue(':lastName', $this->lastName);
		$sth->bindValue(':email', $this->email);

		$sth->execute();
	}

	public function save()
	{
		/*
		if (isset($this-<id)) {
			$this->update();

		} else {
	$this->insert();
		}
	
	*/

	// notation ternaire
	// expression  ? true : faise
	isset($this->id) ? $this->update() : $this->insert();
	}
	public function update()
	{

		$sth = $this->db->prepare("UPDATE user SET firstName=:firstName, lastName=:lastName, email=:email) VALUES (:firstName, :lastName, :email WHERE id=:id");

		$sth->bindValue(':firstName', $this->firstName);
		$sth->bindValue(':lastName', $this->lastName);
		$sth->bindValue(':email', $this->email);
		$sth->bindValue(':id', $this->id);


		$sth->execute();
	}

	public function delete()
	{
		$sth = $this->db->query("DELETE FROM user WHERE id=".$this->id);
	 	$sth->execute();
	}

	public function getFullName()
	{
		return $this->firstName .''. $this->lastName;
	}

	
	
}

?>
