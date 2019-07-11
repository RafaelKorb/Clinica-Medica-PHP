<?php
include "../medico.php";
include_once("conexao.php");
$conn=conectar();



/////////CONSULTA CADASTRO/////////////
if(isset($_POST["consulta_cadastro"])){



	$sql = "SELECT * FROM medicos WHERE id LIKE $id";
	$result = $conn->query($sql);
	//$rows = $result->fetchAll( PDO::FETCH_ASSOC );

		while ($rows = $result->fetch( PDO::FETCH_ASSOC ))  {
		    echo "<div class='footer'>";
			echo "<table border='1'>";
			echo "<tr>"
			  ."<th>CRM</th>"
			  ."<th>Nome</th>"
			  ."<th>Email</th>"
			  ."<th>Especialidade</th>"
			  ."<th>Planodesaude</th>"
			  ."<th>Senha</th></tr>"
			  ."<td>{$rows['CRM']}</td>"
              ."<td>{$rows['nome']}</td>"
              ."<td>{$rows['email']}</td>"
              ."<td>{$rows['especialidade']}</td>"
              ."<td>{$rows['planodesaude']}</td>"
              ."<td>{$rows['senha']}</td>"
			  ."</table>"; 
			  echo"</div>";
			 
		}   
}
//////////////////////////////////////////


/////////////Historico Paciente/////////////
if(isset($_POST["historico_paciente"])){
$paciente=$_POST["paciente"];


	$sql = 'SELECT title, start FROM events WHERE medico LIKE :nome AND paciente LIKE :paciente';
			$stm = $conn->prepare($sql);
			$stm->bindValue(':nome', $nome.'%');
			$stm->bindValue(':paciente', $paciente.'%');
			$stm->execute();
		
		echo '<div class="section">';
		
		while ($rows = $stm->fetch( PDO::FETCH_ASSOC ))  {
			echo "<table border='1'>";
			echo "<tr>"
			  ."<th>descricao</th>"
			  ."<th>Data</th></tr>"
			  ."<td>{$rows['title']}</td>"
              ."<td>{$rows['start']}</td>"
			  ."</table>";
			 
		}
		 echo '</div>';
}

/////////ALTERA CADASTRO/////////////
if(isset($_POST["altera_cadastro"])){



try{


if(!empty($_POST["nome"]) && !empty($_POST["senha"]) && !empty($_POST["email"]) && !empty($_POST["planodesaude"])):

$senha=$_POST["senha"];
$email=$_POST["email"];
$nome=$_POST["nome"];
$planodesaude=$_POST["planodesaude"];
//$horario=addslashes(trim($_POST["horario"]));




$atualizausuario = 'UPDATE medicos SET senha=:senha, email=:email, nome=:nome, planodesaude=:planodesaude WHERE id LIKE :id';

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



?>