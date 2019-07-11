<?php

include_once("conexao.php");
$conn=conectar();


$nome_atendente=$_POST["nome_atendente"];
$senha=$_POST["senha_atendente"];
$nome_clinica=$_POST["nome_clinica"];


if(isset($_POST["criar_clinica"])){


	$sql = "ALTER TABLE  medicos ADD $nome_clinica VARCHAR(50)";
		$stmt = $conn->prepare($sql);
		$stmt->execute();

	$sql = "ALTER TABLE  pacientes ADD $nome_clinica VARCHAR(50)";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		
echo "Clinica criada com sucesso!";	
	
}

if(isset($_POST["cadastrar_atendente"])){


$sql = "INSERT INTO atendentes(nome, senha, clinica) VALUES(:nome, :senha, :clinica)";

				$stmt = $conn->prepare($sql);

				$stmt->bindParam( ':nome', $nome_atendente);
				$stmt->bindParam( ':senha', $senha );
 				$stmt->bindParam( ':clinica', $nome_clinica );
 					
				$stmt->execute();
 }