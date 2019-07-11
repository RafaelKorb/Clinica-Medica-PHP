<?php

	include ("conexao.php");
	$conn=conectar();



	
try{

$CRM = $_POST["CRM"];
$senha = $_POST["senha"];
$nome_medico = $_POST["nome_medico"];
$email = $_POST["email"];
$especialidade = $_POST["especialidade"];
$planodesaude = $_POST["plano_de_saude"];
$horario = $_POST["horario"];





$sql = "INSERT INTO medicos(CRM, nome, email, especialidade, planodesaude, senha, clinica) VALUES(:CRM, :nome, :email, :especialidade, :planodesaude, :senha, :clinica)";

	$stmt = $conn->prepare($sql);

	$stmt->bindParam( ':CRM', $CRM );
	$stmt->bindParam( ':nome', $nome_medico );
	$stmt->bindParam( ':email', $email );
	$stmt->bindParam( ':especialidade', $especialidade );
	$stmt->bindParam( ':planodesaude', $planodesaude );
	$stmt->bindParam( ':senha', $senha );
 	$stmt->bindParam( ':clinica', $clinica );
 
	$stmt->execute();


 
	}

	catch(PDOException $e)
		{
			echo $sql . "<br>" . $e->getMessage();
		}

	$conn = null;
	
	
?>