<!DOCTYPE html>
<html lang="pt-br">
	<head>
	<link rel="stylesheet" type="text/css" href="css/estilos.css"/>
		
	</head>
	<body>

	
	<div class="header">
<a href="logout.php">Sair/Logout</a>
<h1 align="center">BEM VINDO PACIENTE!</h1>
</div>

<br>
<br>

<form method="post" action="actions/actions_paciente.php">

	<p>Nome Completo</p>
			<input type="text" class="input_text" name="nome_paciente" />

<button type="submit" name="historico_paciente">Historico</button>

<br>
<br>
<br>
<br>
<button type="submit" name="consulta_cadastro">Consultar Cadastro</button>
<br>
<br><br><br><br>
<button type="submit" name="altera_cadastro">Alterar Cadastro</button>
	<p>Senha</p>
	 <input type="password" class="input_text" name="senha" />

	 <p>Nome Completo</p>
				<input type="text" class="input_text" name="nome" />


	<p>Email</p>
				<input type="email" class="input_text" name="email">
			
			 </label>


	<p>Plano De Saude</p>
	<input type="text" class="input_text" name="planodesaude" onKeyPress = "planodesaude"/>

 	

</form>



<br><br><br><br>



<form method="post" action="actions/actions_paciente.php">
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


<p>Nome do Medico</p>
		<input type="text" name="nome_medico">

<br>
		<br>
<button type="submit" name="pesquisar">Pesquisar</button>



</form>



<br>
<br>



<form method="post" action="actions/actions_paciente.php">
<h3>Agendar Consulta</h3>

<p>Nome do paciente</p>
			<input type="text" class="input_text" name="nome_paciente" />

<p>Nome Medico</p>
			<input type="text" class="input_text" name="nome_medico" />


<p>Data
		<input type="date" name="data"> <input type="time" name="hora">
</p>
<br>
		
<button type="submit" name="agendar">Agendar Consulta</button>



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
