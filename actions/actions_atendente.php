<?php

include_once("conexao.php");
$conn=conectar();

session_start(); // Inicia a sessão
$clinica= $_POST["clinica"];
$_SESSION["clinica"] = $clinica; 


/////////HISTORICO PACIENTE/////////////
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



////////////////////////////////////////////////////////




/////////HISTORICO MEDICO//////////////////////////////
if(isset($_POST["historico_medico"])){
$medico=$_POST["nome_medico"];

	if (empty($_POST["nome_medico"])){
	echo "preecha o nome!";
	}
	else{
		


		try{

		$sql = 'SELECT * FROM events WHERE medico LIKE :medico';
				$stm = $conn->prepare($sql);
				$stm->bindValue(':medico', $medico.'%');
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


////////////////////////////////////////////////////////////////////





//////////////////////AGENDAMENTO//////////////////////////////////

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



		$sql = "INSERT INTO events(title, start, medico, paciente) VALUES(:title, :start, :nome_medico, :nome_paciente)";

		$stmt = $conn->prepare($sql);

		$stmt->bindParam( ':title', $title );
		$stmt->bindParam( ':nome_medico', $nome_medico );
		$stmt->bindParam( ':nome_paciente', $nome_paciente );
		$stmt->bindParam( ':start', $horario );

		$stmt->execute();
 
	}

		catch(PDOException $e)
			{
				echo $sql . "<br>" . $e->getMessage();
			}

		$conn = null;
		unset($_POST);

}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////


///////////////////REMOVER DATA AGENDADA////////////////////////////////////////////////////////////////////////
if(isset($_POST["Desmarcar"])){
	$nomee_do_paciente=$_POST["nomee_paciente"];
	$nomee_do_medico=$_POST["nomee_medico"];
	$horas=$_POST["horas"];
	$data=$_POST["data"];
	$horario= "$data". " " . "$horas".":00"; 


	$sql= 'DELETE FROM events WHERE paciente LIKE :nome AND medico LIKE :medico AND start LIKE :horario';
	$stm = $conn->prepare($sql);
	$stm->bindValue( ':nome', $nomee_do_paciente);
	$stm->bindValue( ':medico', $nomee_do_medico);
	$stm->bindValue( ':horario', $horario);
	$stm->execute();
	
	echo("Horario Removido!");
	echo("$horario");

}
/////////////////////////////////////








////////////////////////AGENDAMENTOS ONLINE/////////////////////////////////////////////////////////////////////


//conferir requisicoes////
if(isset($_POST["agenda_online"])){

	$sql = 'SELECT medico, paciente, data FROM agendamento_online';
			$stm = $conn->prepare($sql);
			$stm->execute();
			$consulta = $stm->fetchAll(PDO::FETCH_OBJ);

			if (!empty($consulta)){

			var_dump($consulta);
		
			}
			else{
			
				echo "Nao há reservas!";
			//echo '<meta http-equiv="refresh" content="0;url=Atendente.php">';
			
			}

}
/////////////////////////////////

//deletar requisicao//
if(isset($_POST["deletar"])){
	$nome_do_paciente=$_POST["nome_do_paciente"];

	$sql= 'DELETE FROM agendamento_online WHERE paciente LIKE :nome';
	$stm = $conn->prepare($sql);
	$stm->bindValue( ':nome', $nome_do_paciente);
	$stm->execute();
	

}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////







///////////////////////////////BARRA DE PESQUISA/////////////////////////////////////////////////////////////////
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
			
			


			while ($rows = $stm->fetch( PDO::FETCH_ASSOC ))  {
			echo "<table border='1' width=200 height=50>";
			echo "<tr>"
			   ."<td>{$rows['nome']}</td></tr>"
			   ."</table>"; 

			}
	}




	if (empty($_POST["nome_medico"]) && empty($_POST["esp"]) && !empty($_POST["planodesaude"])) {  //caso pesquise planodesaude

	$sql = 'SELECT nome FROM medicos WHERE planodesaude LIKE :pds';
			$stm = $conn->prepare($sql);
			$stm->bindValue(':pds', $planodesaude.'%');
			
			$stm->execute();

			while ($rows = $stm->fetch( PDO::FETCH_ASSOC ))  {
			echo "<table border='1' width=200 height=50>";
			echo "<tr>"
			   ."<td>{$rows['nome']}</td></tr>"
			   ."</table>"; 

		
			}
	}

	if (empty($_POST["nome_medico"]) && !empty($_POST["esp"]) && empty($_POST["planodesaude"])) {  //caso pesquise especialidade

	$sql = 'SELECT nome FROM medicos WHERE especialidade LIKE :esp';
			$stm = $conn->prepare($sql);
			$stm->bindValue(':esp', $especialidade.'%');
			
			$stm->execute();
			while ($rows = $stm->fetch( PDO::FETCH_ASSOC ))  {
			echo "<table border='1' width=200 height=50>";
			echo "<tr>"
			   ."<td>{$rows['nome']}</td></tr>"
			   ."</table>"; 

			
			}

	}

	if (!empty($_POST["nome_medico"]) && empty($_POST["esp"]) && empty($_POST["planodesaude"])) {  //caso pesquise por nome

	$sql = 'SELECT especialidade FROM medicos WHERE nome LIKE :nome';
			$stm = $conn->prepare($sql);
			$stm->bindValue(':nome', $nome_medico.'%');
			
			$stm->execute();
			while ($rows = $stm->fetch( PDO::FETCH_ASSOC ))  {
			echo "<table border='1' width=200 height=50>";
			echo "<tr>"
			   ."<td>{$rows['especialidade']}</td></tr>"
			   ."</table>"; 

	}

}
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




















?>