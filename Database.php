<?php
// include 'config.php';
// 	define('DB_HOST', 'localhost');
// 	define('DB_NAME', 'student');
// 	define('DB_USER', 'root');
// 	define('DB_PASS', '');
class Database{

	public $host  	= "localhost";
	public $dbname	= "student";
	public $user	= "root";
	public $pass	= "";
	public $link;
	public $error;
	public function __construct(){
		$this->connectDb();
	}

	private function connectDb(){
		$this->link=new mysqli($this->host,$this->user,$this->pass,$this->dbname);
		if(!$this->link){
			$this->error="Connection failed. ".$this->link->connect_error;
			return false;
		}
	}
	public function select($q){
		$res=$this->link->query($q) or die ($this->link->error.__LINE__);
		if($res->num_rows>0){
			return $res;
		}
		else{
			return false;
		}

	}
	public function query($q){
		$res=$this->link->query($q) or die ($this->link->error.__LINE__);
		if(!$res){
			return false;
		}
		else return $res;
	}
}

?>