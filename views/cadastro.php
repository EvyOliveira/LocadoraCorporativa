<?php
    include "../scripts/usuarios.php";
?>

<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="">
        <title>Cadastro de Usuários</title>
        <link rel="stylesheet" type="text/css" href="../lib/perfect-scrollbar/css/perfect-scrollbar.css"/>
        <link rel="stylesheet" type="text/css" href="../lib/material-design-icons/css/material-design-iconic-font.min.css"/>
        <link rel="stylesheet" type="text/css" href="../lib/jquery.vectormap/jquery-jvectormap-1.2.2.css"/>
        <link rel="stylesheet" type="text/css" href="../lib/jqvmap/jqvmap.min.css"/>
        <link rel="stylesheet" type="text/css" href="../lib/datetimepicker/css/bootstrap-datetimepicker.min.css"/>
        <link rel="stylesheet" type="text/css" href="../css/app.css"/>
	</head>
	<body>
    <div class="be-wrapper be-fixed-sidebar">
        <nav class="navbar navbar-expand fixed-top be-top-header">
            <div class="container-fluid">
            <div class="be-navbar-header"><a class="navbar-brand" href="../index.php"></a>
            </div>
            <div class="page-title"><span>Cadastro de Usuários</span></div>
            <div class="be-right-navbar">
                <ul class="nav navbar-nav float-right be-user-nav">
                <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="false"><img src="../images/avatar01.png" alt="Avatar"><span class="user-name">Túpac Amaru</span></a>
                    <div class="dropdown-menu" role="menu">     
                    <div class="user-info">
                        <div class="user-name">Túpac Amaru</div>
                        <div class="user-position online">Available</div>
                    </div><a class="dropdown-item" href=""><span class="icon mdi mdi-face"></span>Account</a><a class="dropdown-item" href="#"><span class="icon mdi mdi-settings"></span>Settings</a><a class="dropdown-item" href=""><span class="icon mdi mdi-power"></span>Logout</a>
                    </div>
                </li>
                </ul>
            </div>
            </div>
        </nav>
    </div>
<?php

	//Instancio um objeto do tipo usuarios()
	$myuser = new usuarios();
	
	//Se chegam os dados incluindo o id, mostro o form preenchido e faço a alteração
	if(isset($_POST['f_nome']) and isset($_POST['f_mail']) and isset($_POST['f_senha']) and isset($_POST['f_id'])){
		$_SESSION["altera"]['f_nome'] = $_POST['f_nome'];
		$_SESSION["altera"]['f_mail'] = $_POST['f_mail'];
		$_SESSION["altera"]['f_id'] = $_POST['f_id'];
		echo "<form method=POST action=./alterar.php>";
		echo "<H2>Nome: <input type=text name=f_nome value=".$_POST['f_nome']."></H2>";
		echo "<br/>";
		echo "<H2>Email: <input type=text name=f_mail value=".$_POST['f_mail']."></H2>";
		echo "<br/>";		
		echo "<input type=hidden name=f_id value=".$_POST['f_id'].">";
		echo "<input type=submit value=Enviar>";
		echo "</form>";	
	}
	//Se chegam os dados exceto o id, faço a inserção do usuário
	elseif(isset($_POST['f_nome']) and isset($_POST['f_mail']) and isset($_POST['f_senha'])){
		$myuser->setNome($_POST['f_nome']);
		$myuser->setEmail($_POST['f_mail']);
		$myuser->setSenha(md5($_POST['f_senha']));
		$myuser->insert();
		echo "<form method=POST action=".$_SERVER['PHP_SELF'].">";
		echo "<H2>Nome: <input type=text name=f_nome></H2>";
		echo "<br/>";
		echo "<H2>Email: <input type=text name=f_mail></H2>";
		echo "<br/>";
		echo "<H2>Senha: <input type=password name=f_senha></H2>";
		echo "<br/>";
		echo "<input type=submit value=Enviar>";
		echo "</form>";		
	}
	//Se chega id e temp_senha... Faço o reset da Senha.
	elseif(isset($_POST['f_temp_senha']) and isset($_POST['f_id'])){
		$myuser->setSenha($_POST['f_temp_senha']);
		$myuser->setId($_POST['f_id']);
		$myuser->setNome($_POST['f_nome']);
		$myuser->setEmail($_POST['f_mail']);
		$myuser->update($myuser->getId());
		echo "<form method=POST action=".$_SERVER['PHP_SELF'].">";
		echo "<H2>Nome: <input type=text name=f_nome></H2>";
		echo "<br/>";
		echo "<H2>Email: <input type=text name=f_mail></H2>";
		echo "<br/>";
		echo "<H2>Senha: <input type=password name=f_senha></H2>";
		echo "<br/>";
		echo "<input type=submit value=Enviar>";
		echo "</form>";		
	}

	//Se chega somente o id faço a exclusão e mostro o formulário para cadastro
	elseif(isset($_POST['f_id'])){
		$myuser->setId($_POST['f_id']);
		$myuser->delete($_POST['f_id']);
		echo "<form method=POST action=".$_SERVER['PHP_SELF'].">";
		echo "<H2>Nome: <input type=text name=f_nome></H2>";
		echo "<br/>";
		echo "<H2>Email: <input type=text name=f_mail></H2>";
		echo "<br/>";
		echo "<H2>Senha: <input type=password name=f_senha></H2>";
		echo "<br/>";
		echo "<input type=submit value=Enviar>";
		echo "</form>";	
	}
	
	//Se nada chega via POST simplesmente mostro o formulário de cadastro
	else{
		echo "<form method=POST action=".$_SERVER['PHP_SELF'].">";
		echo "<H2>Nome: <input type=text name=f_nome></H2>";
		echo "<br/>";
		echo "<H2>Email: <input type=text name=f_mail></H2>";
		echo "<br/>";
		echo "<H2>Senha: <input type=password name=f_senha></H2>";
		echo "<br/>";
		echo "<input type=submit value=Enviar>";
		echo "</form>";				
	}
?>



	<p></p>
	<div>
		<table border=1>
		  <tr>
			<th width="20%">Nome</th>
			<th width="30%">Email</th>
			<th width="20%">Ações... </th>
		  </tr>
			<?php foreach($myuser->findAll() as $key=>$value):?>
				<tr>
					<td><?php echo "$value->nome";?></td>
					<td><?php echo "$value->email";?></td>
					<td>
						<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">	
							<input type="hidden" name="f_nome" value=<?php echo "$value->nome";?>>
							<input type="hidden" name="f_mail" value=<?php echo "$value->email";?>>
							<input type="hidden" name="f_senha" value=<?php echo "$value->senha";?>>
							<input type="hidden" name="f_id" value=<?php echo "$value->id";?>>
							<input type="submit" value="Alterar">
						</form> 
						<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
							<input type="hidden" name="f_id" value=<?php echo "$value->id";?>>
							<input type="submit" value="Excluir">
						</form>			
						<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
							<input type="hidden" name="f_id" value=<?php echo "$value->id";?>>						
							<input type="hidden" name="f_nome" value=<?php echo "$value->nome";?>>
							<input type="hidden" name="f_mail" value=<?php echo "$value->email";?>>
							<input type="hidden" name="f_temp_senha" value="123456">
							<input type="submit" value="Reset Senha">
						</form>				
					</td>
				</tr>
			<?php endforeach;?>	
		</table>
	</div>
        <script src="../lib/jquery/jquery.min.js" type="text/javascript"></script>
        <script src="../lib/perfect-scrollbar/js/perfect-scrollbar.min.js" type="text/javascript"></script>
        <script src="../lib/bootstrap/dist/js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <script src="../js/app.js" type="text/javascript"></script>
        <script src="../lib/jquery-flot/jquery.flot.js" type="text/javascript"></script>
        <script src="../lib/jquery-flot/jquery.flot.pie.js" type="text/javascript"></script>
        <script src="../lib/jquery-flot/jquery.flot.time.js" type="text/javascript"></script>
        <script src="../lib/jquery-flot/jquery.flot.resize.js" type="text/javascript"></script>
        <script src="../lib/jquery-flot/plugins/jquery.flot.orderBars.js" type="text/javascript"></script>
        <script src="../lib/jquery-flot/plugins/curvedLines.js" type="text/javascript"></script>
        <script src="../lib/jquery-flot/plugins/jquery.flot.tooltip.js" type="text/javascript"></script>
        <script src="../lib/jquery.sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <script src="../lib/countup/countUp.min.js" type="text/javascript"></script>
        <script src="../lib/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
        <script src="../lib/jqvmap/jquery.vmap.min.js" type="text/javascript"></script>
        <script src="../lib/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
        <script src="../js/app-dashboard.js" type="text/javascript"></script>
        <script type="text/javascript">
        $(document).ready(function(){
            //-initialize the javascript
            App.init();
            App.dashboard();
        
        });
        </script>
	</body>
</html>