<?php
include_once("conexaoo.php");

session_start(); // Inicia a sessão
$_SESSION["clinica"];

////////////retorna busca da tabela events para foramatar o calendario///////////


$result_events = "SELECT id, title, color, start, medico, paciente end FROM events";
$resultado_events = mysqli_query($conn, $result_events);



///////////////////////////////////////////////////////////////////////////////////

?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
	

	<link rel="stylesheet" type="text/css" href="css/estilos.css"/>
		<meta charset='utf-8' />
			<link href='css/fullcalendar.min.css' rel='stylesheet' />
			<link href='css/fullcalendar.print.min.css' rel='stylesheet' media='print' />
			<link href='css/personalizado.css' rel='stylesheet' />
			<script src='js/moment.min.js'></script>
			<script src='js/jquery.min.js'></script>
			<script src='js/fullcalendar.min.js'></script>
			<script src='locale/pt-br.js'></script>
		<script>
			$(document).ready(function() {
				$('#calendar').fullCalendar({
					header: {
						left: 'prev,next today',
						center: 'title',
						right: 'month,agendaWeek,agendaDay'
					},
					defaultDate: Date(),
					navLinks: true, // can click day/week names to navigate views
					editable: true,
					eventLimit: true, // allow "more" link when too many events
					events: [
						<?php
							while($row_events = mysqli_fetch_array($resultado_events)){
								?>
								{
								id: '<?php echo $row_events['id']; ?>',
								title: '<?php echo $row_events['title']; ?>',
								start: '<?php echo $row_events['start']; ?>',
								end: '<?php echo $row_events['end']; ?>',
								color: '<?php echo $row_events['color']; ?>',
								},<?php
							}
						?>
					]
				});
			});
		</script>
	</head>
	<body>

<?php

	

				
?>



	
	<div class="header">
<a href="logout.php">Sair/Logout</a>
<h1 align="center">BEM VINDO ATENDENTE!</h1>
</div>


<br>
<form method="POST" action="form_cadastro_paciente.php">
		
		<button type="submit">Cadastrar Paciente</button></a></p>

		<button type="submit">Cadastrar Medico</button></a></p>
</form>	


<br>
<br>







<form method="post" action="actions/actions_atendente.php">

<p>Nome Completo</p>
			<input type="text" class="input_text" name="nome_paciente" />

<button type="submit" name="historico_paciente">Historico do Paciente</button>



<br>
<p>Nome Completo</p>
			<input type="text" class="input_text" name="nome_medico" />

<button type="submit" name="historico_medico">Historico do Medico</button>

<br>
<br>
<br>


			
<button type="submit" name="agenda_online">Agendamentos Online</button>

<button type="submit" name="deletar">remover da lista</button>
<input type="text" class="input_text" name="nome_do_paciente" />

<br>
<br>
<br>

</form>


<br>
<br>

<br>










<form method="post" action="actions/actions_atendente.php">
<h3>Agendar Consulta</h3>

<p>Nome do paciente</p>
			<input type="text" class="input_text" name="nome_paciente" />

<p>Nome Medico</p>
			<input type="text" class="input_text" name="nome_medico" />


<p>Data
		<input type="date"  name="data"> <input type="time" min="08:00" max="18:00" name="hora">
		
</p>
<br>
		
<button type="submit" name="agendar">Agendar Consulta</button>

<br>
<br>



<h3>Desmarcar Consulta</h3>

<p>Nome do paciente</p>
			<input type="text" class="input_text" name="nomee_paciente" />

<p>Nome Medico</p>
			<input type="text" class="input_text" name="nomee_medico" />


<p>Data
		<input type="date"  name="data"> <input type="time" min="08:00" max="18:00" name="horas">
		
</p>
<br>
		
<button type="submit" name="Desmarcar">Desmarcar Consulta</button>


</form>



<br>
<br>
<br>



<form method="post" action="actions/actions_atendente.php">
<h3>Pesquisar</h3>

<p>Especialidade</p>
			 <select  class="input_text" name="esp"/>
	<option value=""></option>	
	<option value="NENHUMA">Nenhuma</option>
    <option value="ORTOPEDIA">Ortopedia</option>
    <option value="CARDIOLOGIA">Cardiologia</option>
	<option value="DERMATOLOGIA">Dermatologia</option>
	<option value=" RADIOLOGIA">Radiologia</option>
	<option value="CIRURGIA PLÁSTICA">Cirurgia Plástica</option>
	<option value="HEMATOLOGIA">Hematologia</option>
	<option value="ONCOLOGIA">Oncologia</option>
    
  </select>

<p>Plano de Saude</p>
			<select  class="input_text" name="planodesaude" id="planodesaude"/>
	<option value=""></option>
	<option value="Unimed">Unimed</option>
	<option value="Amil">Amil</option>
	<option value="Bradesco Saúde">Bradesco Saúde</option>
	<option value="SulAmérica">SulAmérica</option>
	<option value="Outro">Outro</option>
    
	</select>

	<h4>Pesquisar pelo Nome<h4>

<p>Nome do Medico</p>
		<input type="text" name="nome_medico">

<br>
		<br>
<button type="submit" name="pesquisar">Pesquisar</button>




</form>







<div class="footer">
<p>Hesfaller,	Rafael	 e	Luis Fernando</p>
</div>
<br>
<br>
</font>





		<div id='calendar'></div>

	</body>
</html>