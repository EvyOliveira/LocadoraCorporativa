<?php
    session_start();
    print_r($_SESSION['dados']);
    $my_val = $_SESSION['dados'];   
    include ($_SERVER['DOCUMENT_ROOT'] . '/login_DAO/DAO/usuariosDAO.php');
    $myuser = new usuarios();
    if(isset($_POST['f_id']) and isset($_POST['f_senha'])){
        $myuser->setId($_POST['f_id']);
        $myuser->setSenha($_POST['f_senha']);
        $myuserDAO = new usuariosDAO();
        $myuserDAO->reset();
        Header( 'Location: index.php' );
    }
    else{
        carregaTelaResetSenha($my_val);
    }
    
function carregaTelaResetSenha($my_val){
    echo "<html>";
    echo "<head>";
    echo "    <meta charset='UTF-8'>";
    echo "    <link rel='stylesheet' href='../css/reset.css'>";
    echo "    <link rel='stylesheet' href=''../css/style.css'>";
    echo "    <title>Recuperar</title>";
    echo "</head>";
    echo "<body>";
    echo "    <div class='formResetSenha'>";
    echo "        <h3>Recuperar</h3>";
    echo "        <input type='text' name='txtEmail' id='txtEmail' placeholder='Informe seu email'/>";
    echo "        <br/>";
    echo "        <button onclick='validar_recuperacao()'>Enviar</button>";
    echo "        <br/>";
    echo "        <span>Criar uma nova conta:</span>";
    echo "        <a href='../views/novoUsuario.php' id='criarConta'>Cadastrar*</a>";
    echo "        <br/><br/>";
    echo "        <a href='../index.php'>Retornar ao Login</a>";
    echo "    </div>";
    echo "</body>";
    echo "</html>";
}

?>



