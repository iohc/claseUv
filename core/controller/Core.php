<?php


// 14 de Abril del 2014
// Core.php
// @brief obtiene las configuraciones, muestra y carga los contenidos necesarios.

class Core {

	public static $debug_sql = false;

	public static function includeCSS(){
		$path = "res/css/";
		$handle=opendir($path);
		if($handle){
			while (false !== ($entry = readdir($handle)))  {
				if($entry!="." && $entry!=".."){
					$fullpath = $path.$entry;
				if(!is_dir($fullpath)){
						echo "<link rel='stylesheet' type='text/css' href='".$fullpath."' />";

					}
				}
			}
		closedir($handle);
		}

	}

	public static function getFlashes(){

		//var_dump($_SESSION["flashes"]);

		if(isset($_SESSION["flashes"])){
			$flashes = $_SESSION["flashes"];
			foreach($flashes as $f){
				echo $f;
			}
			unset($_SESSION["flashes"]);
		}

	}

	public static function addFlash($type,$message){

		$flash = "<p class='alert alert-".$type."'>".$message."<p>";
		if(!isset($_SESSION["flashes"])){ $_SESSION["flashes"]=  array(); }

		$flashes = $_SESSION["flashes"];
		$flashes[] = $flash;
		$_SESSION["flashes"] = $flashes;

	}


	public static function addToastr($type,$message){

		$toas = "toastr.$type('$message');";
		//echo $toastr."     -      ";

		if(!isset($_SESSION["toastr"])){ $_SESSION["toastr"]=  array(); }

		$toastr = $_SESSION["toastr"];
		$toastr[] = $toas;
		$_SESSION["toastr"] = $toastr;

		//var_dump($toastr);
	}
	public static function getToastr(){	
		if(isset($_SESSION["toastr"])){
			$toastr = $_SESSION["toastr"];
			foreach($toastr as $f){
				echo $f;
				//var_dump($f);
			}
			unset($_SESSION["toastr"]);
		}
	}
	public static function redir($url){
		echo "<script>window.location='".$url."';</script>";
	}

	public static function alert($txt){
		echo "<script>alert('".$txt."');</script>";
	}

	public static function includeJS(){
		$path = "res/js/";
		$handle=opendir($path);
		if($handle){
			while (false !== ($entry = readdir($handle)))  {
				if($entry!="." && $entry!=".."){
					$fullpath = $path.$entry;
				if(!is_dir($fullpath)){
						echo "<script type='text/javascript' src='".$fullpath."'></script>";

					}
				}
			}
		closedir($handle);
		}

	}

}



?>