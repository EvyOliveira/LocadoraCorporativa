<?php
    require_once 'DAO/perfisDAO.php';

    $meuPerfil = new perfisDAO();
    $meuArray = $meuPerfil->load();
    
    ///print_r($meuArray);
    var_dump($meuArray);
    //echo "<h1>" . $meuArray . "</h1>";
    foreach($meuArray as $value) {
        echo '<pre>'; 
        print_r($value->nome);
        echo '<br>';
    }
?>