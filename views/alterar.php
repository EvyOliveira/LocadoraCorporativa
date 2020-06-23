<?php
    include "../scripts/usuarios.php";
    require_once("DAO/usuariosDAO.php");

    $myuser = new usuarios();
    $myuser-> setNome($_POST['f_nome']);
    $myuser-> setEmail($_POST['f_email']);
    $myuser-> setId($_POST['f_id']);
    $myuser-> setPerfil($_POST['f_perfil']);
    $myuser-> setPerfil($_POST['f_perfil']);
    $myuserDAO-> new usuariosDAO($myuser);
    $myuserDAO-> update();
    Header( "Location: cadastro.php" );

    print_r($_SESSION["altera"]);
    print_r($_SESSION["altera"]["f_id"]);
    print_r($_SESSION["altera"]["f_nome"]);
    print_r($_SESSION["altera"]["f_mail"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/style-home.css">
    <title>Alterar Dados</title>
</head>
<body>
    <div class="formResetSenha">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h3>Atualizar dados</h3>
            <input type="text" name="f_nome" id="txtSenha" placeholder="nome" value=<?php echo $_SESSION["altera"]["f_nome"]; ?> />
            <br/>
            <input type="text" name="f_email" id="txtSenha" placeholder="e-mail" value=<?php echo $_SESSION["altera"]["f_mail"]; ?> />
            <br/>
            <button>Salvar</button>
            <br/>
            <span>Retornar:</span>
            <a href="../views/cadastro.php" id="criarConta">aqui*</a>
            <br/><br/>
        </form>
    </div>
    <?php
        $myuser = new usuarios();
        if(isset($_POST['f_nome']) and isset($_POST['f_email'])){           
		    $myuser->setId($_SESSION["altera"]["f_id"]);
		    $myuser->setNome($_POST['f_nome']);
		    $myuser->setEmail($_POST['f_email']);
            $myuser->alteraDados($myuser->getId());
            Header("Location:../views/cadastro.php");
        }
	?>        
</body>
</html>