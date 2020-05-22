<?php
	include "./scripts/usuarios.php";
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Rent a Car</title>
        <link href="./css/reset.css" type="text/css" rel="stylesheet">
        <link href="./css/style-home.css" type="text/css" rel="stylesheet">
    </head>
    <body>
        <div class="formLogin">
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <h3>Acesse sua conta:</h3>
                    <input type="text" placeholder="E-mail" name="f_mail"><br/>               
                    <input type="password" placeholder="Senha" name="f_senha"><br/>            
                    <button type="submit" id="btn_entrar">Entrar</button>                    
                    <br/>                    
                    <a href="./views/resetSenha.php">Esqueceu a senha?</a>
                    <br/><br/><br/>
                    <span>Não tem cadastro?</span>
                    <a href="./views/novoUsuario.php">Clique aqui.</a>
            </form>
        </div>
        <?php
			$myuser = new usuarios();
			if(!empty($_POST['f_mail']) and !empty($_POST['f_senha'])){
				$myuser->setEmail($_POST['f_mail']);
                $myuser->setSenha($_POST['f_senha']);
                $retorno = $myuser->autenticacao();
                //print_r($retorno);                   
                //print_r(count($retorno));
                if(count($retorno) > 0){
                    if($_POST['f_senha'] == "123456"){                       
                        Header("Location:./views/trocaSenhaTemp.php");
                    }else{                        
                        Header("Location:./views/cadastro.php");
                    }
                }else{
                    echo "<script language=javascript>alert( 'Usuário/Senha Incorreto!' );</script>";
                }
			}
		?>        
    </body>    	
</html>