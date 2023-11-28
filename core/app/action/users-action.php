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

		Core::addToastr('success','Usuario agregado con Exito .!');
		Core::redir("./?view=users&opt=all");

	}else{

		echo "NO";
	}


}else if(isset($_GET["opt"]) && $_GET["opt"] == "update" ){


		$u = UserData::getByID($_POST['user_id']);

		$u->nombre = $_POST['nombre'];
		$u->apellido = $_POST['apellido'];
		$u->email = $_POST['email'];
		$u->username = $_POST['username'];
		//$u->password = sha1(md5($_POST['password']));
		//$u->kind = 1;
		//$u->status = 1;

		$u->update();

		if(isset($_POST['password']) and $_POST['password']!=''  ){

			$u->password = sha1(md5($_POST['password']));

			$u->updatePass();
		}

		Core::addToastr('success','Usuario actualizado con Exito .!');
		Core::redir("./?view=users&opt=all");


}else if(isset($_GET["opt"]) && $_GET["opt"] == "delete" && 
	isset($_GET["id"]) ){

	$user = UserData::getByID($_GET['id']);

	$user->updateOne("status",0);

	Core::addToastr('warning','Usuario eliminado con Exito .!');
	Core::redir("./?view=users&opt=all");


}



?>