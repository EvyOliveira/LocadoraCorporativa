<?php
    error_reporting(0);
    require_once($_SERVER['DOCUMENT_ROOT'] . '/login_DAO/DAO/usuariosDAO.php');       
?>
<?php
			$myuser = new usuarios();
			if(!empty($_POST['f_mail']) and !empty($_POST['f_senha'])){                
                $myuser->setEmail($_POST['f_mail']);
                $myuser->setSenha($_POST['f_senha']);
                              
                $myuserDAO = new usuariosDAO($myuser);                
                $retorno = $myuserDAO->autenticacao();                
                if(count($retorno) > 0){
                    if($_POST['f_senha'] == "123456"){
                        $resultado = $myuserDAO->busca($_POST['f_mail'], md5($_POST['f_senha']));
                        foreach($resultado as $key=>$value):
                            //print_r($value);
                            $id = $value->id;
                            $nome = $value->nome;
                            $email = $value->email;
                            $perfil = $value->id_perfil;
                        endforeach;                        
                        session_start();
                        $_SESSION["altera"]['f_id'] = $id;
                        $_SESSION["altera"]['f_nome'] = $nome;
                        $_SESSION["altera"]['f_mail'] = $email;
                        $_SESSION["altera"]['f_perfil'] = $perfil;                    
                        //Header("Location:./views/trocaSenhaTemp.php");
                        $URL = "./views/trocaSenhaTemp.php";
                        echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
                    }else{                        
                        //Header("Location:./views/cadastro.php");
                        $URL = "./views/cadastro.php";
                        echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
                    }
                }else{
                    echo "<script language=javascript>alert( 'Usuário/Senha Incorreto!' );</script>";
                }
			}
		?>        
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link href="./css/reset.css" type="text/css" rel="stylesheet">
        <link href="./css/style.css" type="text/css" rel="stylesheet">
    </head>
    <body>
        <div class="formLogin">
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <h3>Login</h3>
                    <input type="text" placeholder="E-mail" name="f_mail"><br/>               
                    <input type="password" placeholder="Senha" name="f_senha"><br/>            
                    <button type="submit">Entrar</button>                    
                    <br/>                    
                    <a href="./views/resetSenha.php">Esqueceu a senha?</a>
                    <br/><br/><br/>
                    <span>Não tem cadastro?</span>
                    <a href="./views/novoUsuario.php">Clique aqui.</a>
            </form>
        </div>
        
    </body>    	
</html>