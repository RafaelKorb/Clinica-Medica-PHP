<?php

include_once("conexaoo.php");

session_start();
$nome = $_SESSION["nome"]; //coloco em $a os dados da sessao..
$id = $_SESSION['id'];

$result_events = "SELECT id, title, color, start, end FROM events  WHERE id LIKE $id";
$resultado_events = mysqli_query($conn, $result_events);

?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
	<link rel="stylesheet" type="text/css" href="css/pagina_medico.css"/>
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

	
	<div class="header">
<h1 align="center">BEM VINDO  <?php echo $nome; ?>!</h1>
</div>


<div class="aside">
<a href="login.html">Sair/Logout</a>
<br><br><br><br><br><br><br>
<form method="post" action="actions/actions_medico.php">
<h2>Gerenciamento</h2>
<br><br><br><br>
<p>historico do Paciente</p>
<input type="text" class="input_text" name="paciente" />
<button type="submit" name="historico_paciente">Consultar</button>
<br>
<br>
<br>


<button type="submit" name="consulta_cadastro">Consultar Cadastro</button>
<br>
<br>
<br>
<br>
<p>Deseja alterar seu cadastro?</p>
<br>
	<p>Senha</p>
	 <input type="password" class="input_text" name="senha" />

	 <p>Nome Completo</p>
				<input type="text" class="input_text" name="nome" />


	<p>Email</p>
				<input type="email" class="input_text" name="email">
			
			 </label>


	<p>Plano De Saude</p>
	<input type="text" class="input_text" name="planodesaude" onKeyPress = "planodesaude"/>
  	<br>
	<br>
	<button type="submit" name="altera_cadastro">Alterar Cadastro</button>
</form>

</div>

<div class="footer">
<p>Hesfaller,	Rafael	 e	Luis Fernando</p>
</div>
<br>
<br>
</font>


<div class="article">


		<div id='calendar'></div>

</div>
	</body>
</html>
