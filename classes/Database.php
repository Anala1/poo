<?php

class Database
{
	//public $connection;

	public function connection()
	{
		$db = new PDO('mysql:host=localhost;dbname=poo', 'root', 'paris');

		return $db;
	}
}