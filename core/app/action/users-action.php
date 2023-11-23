<?php
var_dump($_POST);
if(!isset($_SESSION['user_id'])) Core::redir("./");


if(isset($_GET["opt"]) && $_GET["opt"] == "add"){



	if(isset($_POST["nombre"]) and isset($_POST["email"]) and isset($_POST["username"])
	 and isset($_POST["password"])){

		$u = new UserData();

		$u->nombre = $_POST['nombre'];
		$u->email = $_POST['email'];
		$u->username = $_POST['username'];
		$u->password = sha1(md5($_POST['password']));
		$u->kind = 1;
		$u->status = 1;

		$u->add();

	}else{

		echo "NO";
	}


}



?>