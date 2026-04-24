<?php
include '../conexao/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tarefa = $_POST['tarefa'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $data_inicial = $_POST['data_inicial'] ?? '';
    $data_final = $_POST['data_final'] ?? '';

    // Validação básica
    if (empty($tarefa) || empty($descricao) || empty($data_inicial) || empty($data_final)) {
        header("Location: ../index.php?erro=campos_obrigatorios");
        exit;
    }

    $sql = "INSERT INTO agenda (tarefa_agenda, descricao_agenda, data_inicial_agenda, data_final_agenda)
            VALUES (:tarefa_agenda, :descricao_agenda, :data_inicial_agenda, :data_final_agenda)";

    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':tarefa_agenda', $tarefa);
    $stmt->bindParam(':descricao_agenda', $descricao);
    $stmt->bindParam(':data_inicial_agenda', $data_inicial);
    $stmt->bindParam(':data_final_agenda', $data_final);

    if ($stmt->execute()) {
        header("Location: ../index.php?sucesso=tarefa_criada");
        exit;
    } else {
        header("Location: ../index.php?erro=falha_ao_criar");
        exit;
    }
}
?>
