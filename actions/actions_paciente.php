<?php

include_once("conexao.php");
$conn=conectar();

session_start();
//$a = $_SESSION["login"]; //coloco em $a os dados da sessao..
$a = "1";





/////////HISTORICO PACIENTE////////////////////////
if(isset($_POST["historico_paciente"])){
$paciente=$_POST["nome_paciente"];

	if (empty($_POST["nome_paciente"])){
	echo "preecha o nome!";
	}
	else{
		


		try{

		$sql = 'SELECT * FROM events WHERE paciente LIKE :paciente';
				$stm = $conn->prepare($sql);
				$stm->bindValue(':paciente', $paciente.'%');
				$stm->execute();
				$resultado = $stm->fetchAll(PDO::FETCH_OBJ);

				var_dump( $resultado );
		}
		catch(PDOException $e)
			{
				echo $sql . "<br>" . $e->getMessage();
			}

		$conn = null;
	}
}
/////////////////////////////////////////////////











/////////CONSULTA CADASTRO/////////////
if(isset($_POST["consulta_cadastro"])){

	try{

	$sql = "SELECT * FROM pacientes WHERE id LIKE $a";
	$result = $conn->query($sql);
	$rows = $result->fetchAll( PDO::FETCH_ASSOC );

	var_dump( $rows );

	}
	catch(PDOException $e)
		{
			echo $sql . "<br>" . $e->getMessage();
		}

	$conn = null;
	unset($_POST);

}











/////////ALTERA CADASTRO///////////////////////////////////////////////////////
if(isset($_POST["altera_cadastro"])){



try{

$id=1;

if(!empty($_POST["nome"]) && !empty($_POST["senha"]) && !empty($_POST["email"]) && !empty($_POST["planodesaude"])):

$senha=$_POST["senha"];
$email=$_POST["email"];
$nome=$_POST["nome"];
$planodesaude=$_POST["planodesaude"];
//$horario=addslashes(trim($_POST["horario"]));




$atualizausuario = 'UPDATE pacientes SET senha=:senha, email=:email, nome=:nome, planodesaude=:planodesaude WHERE id LIKE :id';

	$stmt=$conn->prepare($atualizausuario);

	$stmt->bindValue( ':senha', $senha );
	$stmt->bindValue( ':email', $email );
	$stmt->bindValue( ':nome', $nome );
	$stmt->bindValue( ':planodesaude', $planodesaude );
	//$atualizausuario->bindValue( ':horario', $horario );
	$stmt->bindValue( ':id', $id );

	
	
	
	$stmt->execute();
	echo "DADOS ALTERADOS COM SUCESSO!";

else:
	echo "<H2>NENHUM USUARIO ENCONTRADO, FAVOR INFORMAR OS DADOS!";

endif;

}
catch(PDOException $e)
	{
		echo $atualizausuario . "<br>" . $e->getMessage();
	}

$conn = null;

}

///////////////////////////////////////////////////////////////////////////////////////////







/////////////////////////////AGENDAMENTO/////////////////////////////////////////////////////

if(isset($_POST["agendar"])){

$nome_medico = $_POST["nome_medico"];
$nome_paciente = $_POST["nome_paciente"];
$data = $_POST["data"];
$hora = $_POST["hora"];
$horario= "$data". " " . "$hora"; 
$title="Medico:"."$nome_medico". " ". "Paciente:" . "$nome_paciente";





//condicoes para agendamento//


//medico deve estar cadastrado//
	$sql = 'SELECT nome FROM medicos WHERE nome LIKE :nome';
		$stm = $conn->prepare($sql);
		$stm->bindValue(':nome', $nome_medico.'%');
		$stm->execute();
		$medicos = $stm->fetchAll(PDO::FETCH_OBJ);

		if (empty($medicos)){
		echo "este medico nao existe!";
		break;
		}

//paciente deve estar cadastrado//
	$sql = 'SELECT nome FROM pacientes WHERE nome LIKE :nome';
		$stm = $conn->prepare($sql);
		$stm->bindValue(':nome', $nome_paciente.'%');
		$stm->execute();
		$pacientes = $stm->fetchAll(PDO::FETCH_OBJ);

		if (empty($pacientes)){
		echo "este paciente nao existe!";
		break;
		}


//horario do medico deve estar disponivel
	$sql = 'SELECT start FROM events WHERE start LIKE :data AND medico LIKE :medico';
		$stm = $conn->prepare($sql);
		$stm->bindValue(':data', $horario.'%');
		$stm->bindValue(':medico', $nome_medico.'%');

		$stm->execute();
		$pacientes = $stm->fetchAll(PDO::FETCH_OBJ);

		if (!empty($pacientes)){
		
		echo "este horario ja esta preenchido!";
		//echo '<meta http-equiv="refresh" content="0;url=Atendente.php">';
		break;
		}


try{



		$sql = "INSERT INTO agendamento_online(paciente, medico, data) VALUES(:nome_paciente, :nome_medico, :start)";

		$stmt = $conn->prepare($sql);
		$stmt->bindParam( ':nome_paciente', $nome_paciente );
		$stmt->bindParam( ':nome_medico', $nome_medico );
		$stmt->bindParam( ':start', $horario );

		$stmt->execute();
 
	}

		catch(PDOException $e)
			{
				echo $sql . "<br>" . $e->getMessage();
			}

		$conn = null;
		
}


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////









///////////////////////////////Barra de Pesquisa/////////////////////////////////////////////////////////////////
if(isset($_POST["pesquisar"])){

$nome_medico = $_POST["nome_medico"];
$especialidade = $_POST["esp"];
$planodesaude= $_POST["planodesaude"];



	if (empty($_POST["nome_medico"]) && empty($_POST["esp"]) && empty($_POST["planodesaude"])) {        //caso nao tenha preenchido nenhum campo

	echo "preecha algum campo!";
	}


	if (empty($_POST["nome_medico"]) && !empty($_POST["esp"]) && !empty($_POST["planodesaude"])) {			//caso pesquise especialidade e plano de saude

	$sql = 'SELECT nome FROM medicos WHERE especialidade LIKE :esp AND planodesaude LIKE :pds';
			$stm = $conn->prepare($sql);
			$stm->bindValue(':esp', $especialidade.'%');
			$stm->bindValue(':pds', $planodesaude.'%');

			$stm->execute();
			$consulta = $stm->fetchAll(PDO::FETCH_OBJ);

			if (!empty($consulta)){

			var_dump($consulta);
		
			}

			else{
			
				echo "Nenhum medico encontrado!";
			//echo '<meta http-equiv="refresh" content="0;url=Atendente.php">';
			
			}
	}



	if (empty($_POST["nome_medico"]) && empty($_POST["esp"]) && !empty($_POST["planodesaude"])) {  //caso pesquise planodesaude

	$sql = 'SELECT nome FROM medicos WHERE planodesaude LIKE :pds';
			$stm = $conn->prepare($sql);
			$stm->bindValue(':pds', $planodesaude.'%');
			
			$stm->execute();
			$consulta = $stm->fetchAll(PDO::FETCH_OBJ);

			if (!empty($consulta)){

			var_dump($consulta);
		
			}
			else{
			
				echo "Nenhum medico encontrado!";
			//echo '<meta http-equiv="refresh" content="0;url=Atendente.php">';
			
			}
	}

	if (empty($_POST["nome_medico"]) && !empty($_POST["esp"]) && empty($_POST["planodesaude"])) {  //caso pesquise especialidade

	$sql = 'SELECT nome FROM medicos WHERE especialidade LIKE :esp';
			$stm = $conn->prepare($sql);
			$stm->bindValue(':esp', $especialidade.'%');
			
			$stm->execute();
			$consulta = $stm->fetchAll(PDO::FETCH_OBJ);

			if (!empty($consulta)){

			var_dump($consulta);
		
			}
			else{
			
				echo "Nenhum medico encontrado!";
			//echo '<meta http-equiv="refresh" content="0;url=Atendente.php">';
			
			}

	}

	if (!empty($_POST["nome_medico"]) && empty($_POST["esp"]) && empty($_POST["planodesaude"])) {  //caso pesquise por nome

	$sql = 'SELECT nome FROM medicos WHERE nome LIKE :nome';
			$stm = $conn->prepare($sql);
			$stm->bindValue(':nome', $nome_medico.'%');
			
			$stm->execute();
			$consulta = $stm->fetchAll(PDO::FETCH_OBJ);

			if (!empty($consulta)){

			var_dump($consulta);
		
			}
			else{
			
				echo "Nenhum medico encontrado!";
			//echo '<meta http-equiv="refresh" content="0;url=Atendente.php">';
			
			}

	}
	unset($_POST);
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



?>