<?php

session_start(); // Inicia a sessão
$clinica= $_POST["clinica"];
$_SESSION["clinica"] = $clinica; 
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="css/estilo_formulario.css"/>

</head>

<style>
body  {
    background-image: url("fundo.jpg");
    background-attachment:fixed;
	background-size:100%;
	background-repeat:no-repeat;
	
}
</style>	

<body> 
<form action="cadastro_paciente.php" name="CADASTRO_PACIENTE" method="POST" id="CADASTRO_PACIENTE">
    <div class="box"> 
        <h1>Cadastro Paciente</h1>
  
        <label> 
            <span>Nome Completo</span>
            <input type="text" class="input_text" name="nome" id="nome"/>
  
        </label>
  
        <label>
            <span>Email</span>
            <input type="email" class="input_text" name="email" id="email"/>
         </label>


		  <label> 
            <span>CPF</span>
            <input type="text" class="input_text" name="CPF" id="CPF"  maxlength="11"size="11"/>
  
        </label>

  
         <label> 
            <span>Idade</span>
            <input type="text" class="input_text" name="idade" id="idade">
  
        </label>

       

		<label> 
            <span>Plano de Saúde</span>
            <select  class="input_text" name="planodesaude" id="subject"/>
	<option value="Unimed">Unimed</option>
	<option value="Amil">Amil</option>
	<option value="Bradesco Saúde">Bradesco Saúde</option>
    <option value="SulAmérica">SulAmérica</option>
	<option value="Outro">Outro</option>
    
	</select>
    </label>

	<label> 
            <span>Gênero</span>
			<input type="radio" name="genero" value="homem" checked> Homem &nbsp;
			<input type="radio" name="genero" value="mulher" checked> Mulher &nbsp;
			<input type="radio" name="genero" value="outro" checked> Outro
	</label>

	<label for="senha"> 
            <span>Senha</span>
            <input type="password" class="input_text" name="senha" />
	</label>
            
           <button type="submit" class="button" name="button_paciente"  placeholder="Senha"> Enviar </button>
   

    </div>
</form> 
</body>
</html>