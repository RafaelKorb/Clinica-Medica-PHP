<?php




function conectar() {

$server = "localhost";
$user = "rafael";
$pass = "rafael";
$db = "clinica";

	try{
		$conn = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		
	}catch(PDOException $e)
		{
			echo $sql . "<br>" . $e->getMessage();
		}
		return $conn;
}




?>
