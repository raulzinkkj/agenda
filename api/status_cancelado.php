<?php
    include '../conexao/conexao.php';


    if ($_SERVER['REQUEST_METHOD'] === 'GET'){
       $id = $_GET['id'];

       if(!empty($id)){
        $sql = "UPDATE `agenda` SET `status_agenda` = 'cancelado' WHERE `agenda`.`id_agenda` = :id;";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()){
             header("Location:../index.php");
        }else{
            echo "não deu boa!";
        }
       }else{
        echo "Id não encontrada";
       }
    }
?>