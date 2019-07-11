<?php

session_start();

	include ("conexao.php");
	$conn=conectar();





$CPF = $_POST["CPF"];
$senha = $_POST["senha"];
$nome= $_POST["nome"];
$email = $_POST["email"];
$idade = $_POST["idade"];
$planodesaude = $_POST["planodesaude"];
$genero = $_POST["genero"];
$nome_clinica = $_SESSION["clinica"];


	$sql = 'SELECT CPF FROM pacientes WHERE CPF LIKE :CPF';
			$stmt = $conn->prepare($sql);
			$stmt->bindValue(':CPF', $CPF.'%');

			$stmt->execute();

			$rows = $stmt->fetch( PDO::FETCH_ASSOC);

			if(($rows['CPF'])==($CPF)){
					
			
			
			$sql="UPDATE pacientes SET $nome_clinica=:clinica WHERE CPF LIKE :cpf";
			
			$stmt = $conn->prepare($sql);
			$stmt->bindParam( ':clinica', $nome_clinica);
			$stmt->bindParam( ':cpf', $CPF);

			$stmt->execute();
			
	
			}
			
			 
			else{

			$sql = "INSERT INTO pacientes(CPF, nome, email, idade, PlanoDeSaude, senha, genero, clinica) VALUES(:CPF, :nome, :email, :idade, :planodesaude, :senha, :genero, :clinica)";

				$stmt = $conn->prepare($sql);

				$stmt->bindParam( ':CPF', $CPF );
				$stmt->bindParam( ':nome', $nome );
				$stmt->bindParam( ':email', $email );
				$stmt->bindParam( ':idade', $idade );
				$stmt->bindParam( ':planodesaude', $planodesaude );
				$stmt->bindParam( ':senha', $senha );
 				$stmt->bindParam( ':genero', $genero );
				$stmt->bindParam( ':clinica', $nome_clinica );
	
	
				$stmt->execute();
 
			}
	






?>


