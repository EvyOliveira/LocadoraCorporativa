<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . '/login_DAO/DAO/usuariosDAO.php');
	
	$myUser = new usuarios();
	$myUserDAO = new usuariosDAO($myUser);
	$myUserDAO->delete($_POST['f_id']);
	//Header("Location:../views/cadastro.php");
	$URL = "./cadastro.php";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
?>