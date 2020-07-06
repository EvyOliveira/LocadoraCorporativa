<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . 'login_DAO/DAO/usuariosDAO.php');
	
	$myUser = new usuariosDAO();
	$myUser->delete($_POST['f_id']);
	Header("Location:../views/cadastro.php");
?>