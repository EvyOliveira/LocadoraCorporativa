<?php
	include ($_SERVER['DOCUMENT_ROOT'] . 'login_DAO/DAO/usuariosDAO.php');
	include ($_SERVER['DOCUMENT_ROOT'] . 'login_DAO/DAO/perfisDAO.php');
?>
<html>
	<head>
		<title>Cadastro de Usuários</title>
	</head>
	<body>
		<b>
		<h1>Cadastro de Usuários</h1>
<?php

	//Instancio um objeto do tipo usuarios()
	$myuser = new usuarios();
	
	//Se chegam os dados incluindo o id, mostro o form preenchido e faço a alteração
	if(isset($_POST['f_nome']) and isset($_POST['f_mail']) and isset($_POST['f_senha']) and isset($_POST['f_id']) and isset($_POST['f_perfil'])){
		echo "<form method=POST action=alterar.php>";
		echo "<H3>Nome: <input class='form-control' type=text name=f_nome value=".$_POST['f_nome']."></H3>";
		echo "<br/>";
		echo "<H3>Email: <input class='form-control' type=text name=f_mail value=".$_POST['f_mail']."></H3>";
		echo "<br/>";
		echo "<H3>Senha: <input class='form-control' type=password name=f_senha value=".$_POST['f_senha']." readonly=“true”></H3>";
		echo "<br/>";
		echo "<select class='form-control' name='f_perfil' id='f_perfil'>";
		$perfDAO = new perfisDAO();
		$arr = $perfDAO->load();
		foreach($arr as $perfis):
		    if($perfis->getId() == $_POST['f_perfil']){
		        echo("<option value =".$perfis->getId()." selected>".$perfis->getNome()."</option>");
		    }else{
		        echo("<option value =".$perfis->getId().">".$perfis->getNome()."</option>"); 
		    }
		endforeach;
		echo "</select>";
		echo "<br/>";
		echo "<input type=hidden name=f_id value=".$_POST['f_id'].">";
		echo "<input class='btn btn-info' type=submit value=Enviar>";
		echo "</form>";	
	}				
	//Se nada chega via POST simplesmente mostro o formulário de cadastro
	else{
		echo "<form method=POST action=inserir.php>";
		echo "<H3>Nome: <input class='form-control' type=text name=f_nome></H3>";
		//echo "<br/>";
		echo "<H3>Email: <input class='form-control' type=text name=f_mail></H3>";
		//echo "<br/>";
		echo "<H3>Senha: <input  class='form-control' type=password name=f_senha></H3>";
		//echo "<br/>";
		echo "<H3>Perfil: <select class='form-control' name='f_perfil' id='f_perfil'></H3>";
		$perfDAO = new perfisDAO();
		$arr = $perfDAO->load();
		foreach($arr as $perfis):
		    echo("<option value =".$perfis->getId().">".$perfis->getNome()."</option>");
		endforeach;
		echo "</select>";
		echo "<br/>";
		echo "<br/>";
		echo "<input class='btn btn-info' type=submit value=Enviar>";
		echo "<br/>";
		echo "<br/>";
		echo "</form>";		
	}
?>
	<!-- ***** GERAR RELATORIO ***** -->
	<form method="POST" action="relatorio.php">
		<input type="submit" class="btn btn-outline-warning " value="Emitir Relatório">
	</form>

	<p></p>
	<div>
		<table border=1>
		  <tr>
			<th width="20%">Nome</th>
			<th width="20%">Email</th>
			<th width="20%">Perfil</th>
			<th width="20%">Ações... </th>
		  </tr>
			<?php foreach($myuser->findAll() as $key=>$value):?>
				<tr>
					<td><?php echo "$value->nome";?></td>
					<td><?php echo "$value->email";?></td>
					<td><?php echo "$value->id_perfil";?></td>
					<td>
						<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">	
							<input type="hidden" name="f_nome" value=<?php echo "$value->nome";?>>
							<input type="hidden" name="f_mail" value=<?php echo "$value->email";?>>
							<input type="hidden" name="f_senha" value=<?php echo "$value->senha";?>>
							<input type="hidden" name="f_perfil" value=<?php echo "$value->id_perfil";?>>
							<input type="hidden" name="f_id" value=<?php echo "$value->id";?>>
							<input type="submit" value="Alterar">
						</form> 
						<form method="POST" action='excluir.php'>
							<input type="hidden" name="f_id" value=<?php echo "$value->id";?>>
							<input type="submit" value="Excluir">
						</form>						
						<form method="POST" action='reset.php'>
						<input type="hidden" name="f_id" value=<?php echo "$value->id";?>>						
						<button type="submit" class="btn btn-outline-info btn-sm" name="btncomando" id="btncomando" value="resetar">Resetar senha</button>
					</form>					
					</td>
				</tr>
			<?php endforeach;?>	
		</table>
	</div>
		</b>
	</body>
</html>