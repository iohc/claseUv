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
		$this->apellido = "";
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
		$sql = "select * from user where status=1 and kind=".$k;
		$query = Executor::doit($sql);
		return Model::many($query[0],new UserData()); 
	}

	public function add(){
		$sql = "insert into user (nombre,apellido,username,password,email,kind,status) value
		 (\"$this->nombre\",\"$this->apellido\",\"$this->username\",\"$this->password\",
		 \"$this->email\",$this->kind,$this->status)";

		return Executor::doit($sql);

	}

	public function	update(){
		$sql  = "update user set nombre= \"$this->nombre\",apellido= \"$this->apellido\",email= \"$this->email\",username= \"$this->username\" where id=".$this->id;

		return Executor::doit($sql);

	}

	public function	updatePass(){
		$sql  = "update user set password= \"$this->password\" where id=".$this->id;
		return Executor::doit($sql);
	}

	public function	updateOne($key,$val){
		$sql  = "update user set $key= \"$val\" where id=".$this->id;
		return Executor::doit($sql);
	}
}

?>