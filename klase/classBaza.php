<?php
class Baza{
	private $server;
	private $userName;
	private $password;
	private $database;
	private $db;
	public function __construct()
	{
		$this->server="localhost";
		$this->userName="root";
		$this->password="";
		$this->database="sajt";
	}
	public function connect()
	{
		return $this->db=@mysqli_connect($this->server, $this->userName, $this->password, $this->database);
	}
	public function connect_error(){
		if(mysqli_connect_error($this->db))
			return "Doslo je do greske!!!<br>".mysqli_connect_error($this->db);
		else
			return false;
	}
	public function query($sql){
		return mysqli_query($this->db, $sql);
	}
	public function error()
	{
		return mysqli_error($this->db);
	}
	public function num_rows($rez){
		return mysqli_num_rows($rez);
	}
	public function affected_rows(){
		return mysqli_affected_rows($this->db);
	}
	public function fetch_assoc($rez){
		return mysqli_fetch_assoc($rez);
	}
	public function fetch_object($rez){
		return mysqli_fetch_object($rez);
	}
	public function __destruct(){
		mysqli_close($this->db);
	}
		public function insert_id(){
		return mysqli_insert_id($this->db);
	}
}
?>