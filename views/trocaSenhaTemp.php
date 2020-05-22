<?php
    include "../scripts/usuarios.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/style-home.css">
    <title>Recuperação de senha</title>
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
            <a href="../views/novoUsuario.php" id="criarConta">Cadastrar</a>
            <br/><br/>
            <!--<a href="../index.php">Retornar ao Login</a> -->
        </form>
    </div>
    <?php
        $myuser = new usuarios();
        if(isset($_POST['f_senha'])){
            $myuser->setSenha($_POST['f_senha']);            
		    $myuser->setId($_SESSION["dados"][0]->id);
		    $myuser->setNome($_SESSION["dados"][0]->nome);
		    $myuser->setEmail($_SESSION["dados"][0]->email);
            $myuser->update($myuser->getId());
            Header("Location:../index.php");                      
        }
	?>        
</body>
</html>