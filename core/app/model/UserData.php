<?php

class UserData extends Extra{


	public static $tablename = "user";
	public $extra_fields_strings;
	public $extra_fields;

	public function __construct(){
		$this->extra_fields = array();
		$this->extra_fields_strings = array();
		$this->nombre = "";
		$this->username = "";
		$this->password = "";
		$this->status = "";
		$this->lastname = "";
		$this->kind = 1;

	}


	public static function getByID($id)
	{
		$sql = "select * from user where id=".$id;
		$query = Executor::doit($sql);
		return Model::one($query[0],new UserData()); 
	}

	public static function getUsersbyKind($k=1)
	{
		$sql = "select * from user where kind=".$k;
		$query = Executor::doit($sql);
		return Model::many($query[0],new UserData()); 
	}

	public function add(){
		$sql = "insert into user (nombre,apellido,username,password,email,kind,status) value
		 (\"$this->nombre\",\"$this->lastname\",\"$this->username\",\"$this->password\",
		 \"$this->email\",$this->kind,$this->status)";

		return Executor::doit($sql);

	}
}

?>