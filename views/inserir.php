<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . '/login_DAO/DAO/usuariosDAO.php');
	
	$myuser = new usuarios();
	$myuser->setNome($_POST['f_nome']);
	$myuser->setEmail($_POST['f_mail']);
	$myuser->setSenha(md5($_POST['f_senha']));
	$myuser->setPerfil($_POST['f_perfil']);
	$myUser = new usuariosDAO($myuser);
	$myUser->insert();
	//Header("Location:../views/cadastro.php");
	$URL = "./cadastro.php";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
?>