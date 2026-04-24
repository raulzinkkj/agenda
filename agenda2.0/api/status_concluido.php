<?php
include '../conexao/conexao.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "UPDATE agenda SET status_agenda = 'concluido' WHERE id_agenda = :id";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("Location: ../index.php?sucesso=status_atualizado");
        exit;
    } else {
        header("Location: ../index.php?erro=falha_ao_atualizar");
        exit;
    }
} else {
    header("Location: ../index.php?erro=id_nao_fornecido");
    exit;
}
?>
