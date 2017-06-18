<?php

namespace App\Models;

use PDO;

abstract class Model
{
	protected $db;
	protected $table;

	public function __construct()
	{
		$configDB = require_once dirname(__DIR__) . "/config/db.php";

		try {

			$this->db = new PDO(
				"mysql:host=" . $configDB["DB_HOST"] . ";dbname=" . $configDB["DB_NAME"] . ";charset=utf8", 
				$configDB["DB_USER"], 
				$configDB["DB_PASSWORD"]
			);

		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function findAll()
	{
		$sql = "SELECT * FROM $this->table ORDER BY id desc";
		$query = $this->db->query($sql);

		return $query->fetchAll(PDO::FETCH_OBJ); 
	}

	public function find($id)
	{
		$sql = "SELECT * FROM $this->table WHERE id = :id";
		$query = $this->db->prepare($sql);
		$query->bindParam(':id', $id, PDO::PARAM_INT);
		$query->execute();

		return $query->fetch(PDO::FETCH_OBJ);
	}

	public function findBy($field, $value)
	{
		$sql = "SELECT * FROM $this->table WHERE $field = :$value";
		$query = $this->db->prepare($sql);
		$query->bindParam(':$value', $value, PDO::PARAM_STR);
		$query->execute();

		return $query->fetch(PDO::FETCH_OBJ);
	}

	public function query($sql)
	{
		$query = $this->db->query($sql);

		if($query->rowCount() > 1) return $query->fetchAll(PDO::FETCH_OBJ);
		elseif($query->rowCount() == 1) return $query->fetch(PDO::FETCH_OBJ);

		return false;
	}

	public function delete($id)
	{
		$query = $this->db->prepare("DELETE FROM $this->table WHERE id = :id");

		return $query->execute(["id" => $id]);
	}


}
