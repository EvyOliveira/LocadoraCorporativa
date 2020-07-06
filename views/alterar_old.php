<?php    
    require_once ($_SERVER['DOCUMENT_ROOT'] . 'login_DAO/DAO/usuariosDAO.php');
    print_r($_SESSION["altera"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Alterar Dados</title>
</head>
<body>
    <div class="formResetSenha">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h3>Atualizar dados</h3>
            <label>Nome</label> 
            <input type="text" name="f_nome" id="txtSenha" placeholder="nome" value=<?php echo $_SESSION["altera"]["f_nome"]; ?> />
            <br/>
            <label>E-mail</label> 
            <input type="text" name="f_email" id="txtSenha" placeholder="e-mail" value=<?php echo $_SESSION["altera"]["f_mail"]; ?> />
            <br/>    
            <label>Senha</label> 
            <input type="password" name="f_senha" id="txtSenha" placeholder="senha" value=<?php echo $_SESSION["altera"]["f_senha"]; ?> />
            <br/>
            <label>Perfil</label>
            <select></select>
            <button>Salvar</button>
            <br/>
            <span>Retornar:</span>
            <a href="../views/cadastro.php" id="criarConta">aqui*</a>
            <input type="hidden" name="f_id" id="txtSenha" value=<?php echo $_SESSION["altera"]["f_id"]; ?> />
            <br/>
            <input type="hidden" name="f_perfil" id="txtSenha" value=<?php echo $_SESSION["altera"]["f_perfil"]; ?> />
            <br/>
        </form>
    </div>
    <?php
        require_once ($_SERVER['DOCUMENT_ROOT'] . 'login_DAO/DAO/usuariosDAO.php');
        $myuser = new usuarios();
        if(isset($_POST['f_nome']) and isset($_POST['f_email'])){           
            $myuser->setId($_POST["f_id"]);
            $myuser->setPerfil($_POST["f_perfil"]);            
		    $myuser->setNome($_POST['f_nome']);
            $myuser->setEmail($_POST['f_email']);            
            $myuserDAO = new usuariosDAO($myuser);
            $myuserDAO->update();
            Header("Location:../views/cadastro.php");
        }
	?>        
</body>
</html>