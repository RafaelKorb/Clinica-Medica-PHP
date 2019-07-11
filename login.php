<?php
	include ("conexao.php");
	$conn=conectar();

	session_start(); // Inicia a sessão
	$clinica= $_POST["clinica"];
	$_SESSION["clinica"] = $clinica; 
	// = $_POST["login"]; 

try{
	
	if(!empty($_POST["login"]) && !empty($_POST["senha"])){

	$senha=addslashes(trim($_POST["senha"]));
	$email=addslashes(trim($_POST["login"]));

	

	}
	else{
		echo "preecha os campos!";
		exit();
	}

	$sql = 'SELECT email, senha, nome, id FROM medicos WHERE email LIKE :email AND senha LIKE :senha';
		$stm = $conn->prepare($sql);
		$stm->bindValue(':email', $email.'%');
		$stm->bindValue(':senha', $senha.'%');
		$stm->execute();
		$medicos = $stm->fetchAll(PDO::FETCH_OBJ);
				
		if (!empty($medicos)){
		$stm->execute();
		$rows = $stm->fetch( PDO::FETCH_ASSOC );
		//var_dump($rows);
		$_SESSION['nome'] = $rows['nome'];
		$_SESSION['id'] = $rows['id'];
		echo '<meta http-equiv="refresh" content="0;url=medico.php">';
		exit();
		}

		$sql = 'SELECT nome, senha, clinica FROM atendentes WHERE nome LIKE :nome AND senha LIKE :senha AND clinica LIKE :clinica';
		$stm = $conn->prepare($sql);
		$stm->bindValue(':nome', $email.'%');
		$stm->bindValue(':senha', $senha.'%');
		$stm->bindValue(':clinica', $clinica.'%');

		$stm->execute();
		$atendentes = $stm->fetchAll(PDO::FETCH_OBJ);

			if (!empty($atendentes)){
			$stm->execute();
			$rows = $stm->fetch( PDO::FETCH_ASSOC );
			$_SESSION['nome'] = $rows['nome'];
			echo '<meta http-equiv="refresh" content="0;url=atendente.php">';
			exit();
			}


		
		else{
			$sql = 'SELECT email, senha, nome, id FROM pacientes WHERE email LIKE :email AND senha LIKE :senha';
		$stm = $conn->prepare($sql);
		$stm->bindValue(':email', $email.'%');
		$stm->bindValue(':senha', $senha.'%');
		
		$stm->execute();
		$pacientes = $stm->fetchAll(PDO::FETCH_OBJ);
			if (!empty($pacientes)){
			$stm->execute();
			$rows = $stm->fetch( PDO::FETCH_ASSOC );
			$_SESSION['nome'] = $rows['nome'];
			$_SESSION['id'] = $rows['id'];
			echo '<meta http-equiv="refresh" content="0;url=paciente.php">';
			exit();
			}
			else{
				echo "DADOS INVÁLIDOS";
			}
	}


		
}catch(PDOException $e)
	{
		echo $e->getMessage();
	}

	

$conn = null;




?>