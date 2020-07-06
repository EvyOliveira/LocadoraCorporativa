<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . 'login_DAO/DAO/usuariosDAO.php');
    print_r($_SESSION['altera']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Recuperar</title>
</head>
<body>
    <div class="formResetSenha">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h3>Nova Senha</h3>
            <input type="password" name="f_senha" id="txtSenha" placeholder="cadastrar nova senha"/>
            <br/>
            <button>Salvar</button>
            <br/>
            <span>Criar uma nova conta:</span>
            <a href="../views/novoUsuario.php" id="criarConta">Cadastrar*</a>
            <br/><br/>
            <!--<a href="../index.php">Retornar ao Login</a> -->
        </form>
    </div>
    <?php
    print_r($_POST);
        $myuser = new usuarios();
        if(isset($_POST['f_senha'])){
            $myuser->setSenha($_POST['f_senha']);            
		    $myuser->setId($_SESSION["altera"]['f_id']);
		    $myuser->setNome($_SESSION["altera"]['f_nome']);
            $myuser->setEmail($_SESSION["altera"]['f_mail']);
            $myuser->setPerfil($_SESSION["altera"]['f_perfil']);
            $myuserDAO = new usuariosDAO($myuser);
            $myuserDAO->update();
            Header("Location:../index.php");                      
        }
	?>        
</body>
</html>