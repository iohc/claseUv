
<br>
<?php


if(isset($_GET["opt"]) && $_GET["opt"] == "login"){


	if(!isset($_SESSION['user_id'])){
		$val_user = htmlentities($_POST['username']);
		$val_pass = htmlentities($_POST['password']);
		$val_pass = sha1(md5($val_pass));

		//sha1(md5($val_pass));


		$base = new Database();
		$con = $base->connect();

		$sentencia = "select * from user where (email=\"".$val_user."\" or username=\"".$val_user."\") and username=\"".$val_user."\"";

		$query = $con->query($sentencia);

		$encontre = false;

		$username ="";
		while($r = $query->fetch_array()){
			$encontre = true;
			$userid  = $r['id'];
			$username = $r['username'];
		}


		if($encontre== true){
			$_SESSION['user_id'] = $userid;

			print "Cargando ... $username";

			
			Core::addToastr("info","Bienvenido $username");
			Core::redir("./?view=home");
		}else{
			//Core::redir("./");
		}


	}else{
		Core::redir("./?view=home");

	}


		
}else if(isset($_GET["opt"]) && $_GET["opt"] == "logout"){
	unset($_SESSION);
	session_destroy();

	Core::redir("./");
}

	



?>