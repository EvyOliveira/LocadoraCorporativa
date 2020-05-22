<?php
    include "../scripts/usuarios.php";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/style-home.css">   
    <title>Cadastro</title>
</head>
<body>
    <div class="formCadastro">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h3>Cadastre-se</h3>
            <input type="text" name="f_nome" placeholder="Nome"/>
            <br/>
            <input type="text" name="f_mail" placeholder="Email"/>
            <br/>                    
            <input type="password" name="f_senha" id="txtPassword" placeholder="Senha"/>
            <br/>
            <button onclick="validar_cadastro()">Criar Conta</button>
            <br/><br/><br/>
            <a href="../index.php" id="navegacao">Retornar à página inicial</a>
        </form>
    </div>
    <?php
			$myuser = new usuarios();
			if(!empty($_POST['f_nome']) and !empty($_POST['f_mail']) and !empty($_POST['f_senha'])){
                $myuser->setNome($_POST['f_nome']);
				$myuser->setEmail($_POST['f_mail']);
				$myuser->setSenha($_POST['f_senha']);
				$myuser->insert();				
			}
			else {
				echo "Todos os campos são obrigatórios!";
			}
		?>
		<div>
			<table border=1>
				<tr>
					<th>Nome</th>
					<th>Email</th>
				</tr>
				
				
				<?php foreach($myuser->findAll() as $key=>$value): ?>
				<tr>
					<td><?php echo "$value->nome"; ?></td>
					<td><?php echo "$value->email"; ?></td>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>		
		</b>
</body>
</html>