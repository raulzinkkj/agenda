<?php
$local = 'localhost';
$banco = 'agenda';
$usuario = 'root';
$senha = '';

try {
    $conexao = new PDO("mysql:host=$local;dbname=$banco", $usuario, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOexecption $e){
    echo "não deu boa" . $e->getMessage();
}
?>