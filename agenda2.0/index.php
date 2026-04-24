<?php
include 'conexao/conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda Moderna - Gestão de Tarefas</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container-main">
        <!-- HEADER -->
        <header>
            <div class="header-left">
                <div class="logo">📋 Agenda</div>
                <input type="search" class="search-box" placeholder="Buscar tarefas...">
            </div>

            <div class="header-right">
                <div class="icons-group">
                    <button class="icon-btn" title="Calendário">📅</button>
                    <button class="icon-btn" title="Mensagens">💬</button>
                    <button class="icon-btn" title="Notificações">🔔</button>
                </div>

                <div class="user-info">
                    <div class="user-text">
                        <strong>Raul Karvat</strong>
                        <span>União da Vitória-PR</span>
                    </div>
                    <img src="img/R.jpg" alt="Usuário" class="user-avatar">
                </div>
            </div>
        </header>

        <!-- MENU LATERAL -->
        <nav class="sidebar">
            <ul>
                <li><a href="#" class="active">🏠 Início</a></li>
                <li><a href="#">💬 Fórum</a></li>
                <li><a href="#">📎 Tarefas</a></li>
                <li><a href="#">👥 Comunidade</a></li>
                <li><a href="#">📚 Apoio</a></li>
                <li><a href="#">❓ Ajuda</a></li>
            </ul>
        </nav>

        <!-- CONTEÚDO PRINCIPAL -->
        <main>
            <!-- SEÇÃO DE FORMULÁRIO -->
            <section class="form-section">
                <h2 class="form-title">Criar Nova Tarefa</h2>
                <form action="api/gravar_tarefa.php" method="post">
                    <div class="form-group">
                        <label for="tarefa">Título da Tarefa</label>
                        <input type="text" id="tarefa" name="tarefa" placeholder="Ex: Programar" required>
                    </div>

                    <div class="form-group">
                        <label for="descricao">Descrição da Tarefa</label>
                        <textarea id="descricao" name="descricao" placeholder="Descreva os detalhes da tarefa..." required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="data_inicial">Data Inicial</label>
                        <input type="date" id="data_inicial" name="data_inicial" required>
                    </div>

                    <div class="form-group">
                        <label for="data_final">Data Final</label>
                        <input type="date" id="data_final" name="data_final" required>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">💾 Salvar Tarefa</button>
                    </div>
                </form>
            </section>

            <!-- SEÇÃO DE CARDS (KANBAN) -->
            <section class="cards-section">
                <h2 class="cards-title">Minhas Tarefas</h2>

                <div class="cards-container">
                    <!-- COLUNA: A FAZER -->
                    <div class="card-column">
                        <div class="column-header pending">
                            <div class="status-dot pending"></div>
                            <h3>A Fazer</h3>
                            <span class="column-count">
                                <?php
                                $sql = "SELECT COUNT(*) as count FROM agenda WHERE status_agenda = 'pendente'";
                                $stmt = $conexao->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                                echo $result['count'];
                                ?>
                            </span>
                        </div>

                        <div class="tasks-list">
                            <?php
                            $sql = "SELECT * FROM agenda WHERE status_agenda = 'pendente' ORDER BY id_agenda DESC LIMIT 10";
                            $stmt = $conexao->prepare($sql);
                            $stmt->execute();
                            $temTarefas = false;

                            while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                $temTarefas = true;
                                $data1 = date("d/m/Y", strtotime($linha['data_inicial_agenda']));
                                $data2 = date("d/m/Y", strtotime($linha['data_final_agenda']));

                                echo "
                                <div class='task-card'>
                                    <h4 class='task-title'>{$linha['tarefa_agenda']}</h4>
                                    <p class='task-description'>{$linha['descricao_agenda']}</p>
                                    <div class='task-dates'>
                                        📅 $data1 a $data2
                                    </div>
                                    <div class='task-actions'>
                                        <form action='api/status_concluido.php' method='get' style='display: inline;'>
                                            <input type='hidden' name='id' value='{$linha['id_agenda']}'>
                                            <button type='submit' class='task-btn'>✓ Concluir</button>
                                        </form>
                                        <form action='api/status_cancelado.php' method='get' style='display: inline;'>
                                            <input type='hidden' name='id' value='{$linha['id_agenda']}'>
                                            <button type='submit' class='task-btn danger'>✕ Cancelar</button>
                                        </form>
                                    </div>
                                </div>
                                ";
                            }

                            if (!$temTarefas) {
                                echo "<div class='empty-state'>Nenhuma tarefa pendente</div>";
                            }
                            ?>
                        </div>
                    </div>

                    <!-- COLUNA: CONCLUÍDO -->
                    <div class="card-column">
                        <div class="column-header completed">
                            <div class="status-dot completed"></div>
                            <h3>Concluído</h3>
                            <span class="column-count">
                                <?php
                                $sql = "SELECT COUNT(*) as count FROM agenda WHERE status_agenda = 'concluido'";
                                $stmt = $conexao->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                                echo $result['count'];
                                ?>
                            </span>
                        </div>

                        <div class="tasks-list">
                            <?php
                            $sql = "SELECT * FROM agenda WHERE status_agenda = 'concluido' ORDER BY id_agenda DESC LIMIT 10";
                            $stmt = $conexao->prepare($sql);
                            $stmt->execute();
                            $temTarefas = false;

                            while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                $temTarefas = true;
                                $data1 = date("d/m/Y", strtotime($linha['data_inicial_agenda']));
                                $data2 = date("d/m/Y", strtotime($linha['data_final_agenda']));

                                echo "
                                <div class='task-card'>
                                    <h4 class='task-title'>{$linha['tarefa_agenda']}</h4>
                                    <p class='task-description'>{$linha['descricao_agenda']}</p>
                                    <div class='task-dates'>
                                        📅 $data1 a $data2
                                    </div>
                                    <div class='task-actions'>
                                        <form action='api/status_pendente.php' method='get' style='display: inline;'>
                                            <input type='hidden' name='id' value='{$linha['id_agenda']}'>
                                            <button type='submit' class='task-btn'>⟲ Pendente</button>
                                        </form>
                                        <form action='api/status_cancelado.php' method='get' style='display: inline;'>
                                            <input type='hidden' name='id' value='{$linha['id_agenda']}'>
                                            <button type='submit' class='task-btn danger'>✕ Cancelar</button>
                                        </form>
                                    </div>
                                </div>
                                ";
                            }

                            if (!$temTarefas) {
                                echo "<div class='empty-state'>Nenhuma tarefa concluída</div>";
                            }
                            ?>
                        </div>
                    </div>

                    <!-- COLUNA: CANCELADO -->
                    <div class="card-column">
                        <div class="column-header canceled">
                            <div class="status-dot canceled"></div>
                            <h3>Cancelado</h3>
                            <span class="column-count">
                                <?php
                                $sql = "SELECT COUNT(*) as count FROM agenda WHERE status_agenda = 'cancelado'";
                                $stmt = $conexao->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                                echo $result['count'];
                                ?>
                            </span>
                        </div>

                        <div class="tasks-list">
                            <?php
                            $sql = "SELECT * FROM agenda WHERE status_agenda = 'cancelado' ORDER BY id_agenda DESC LIMIT 10";
                            $stmt = $conexao->prepare($sql);
                            $stmt->execute();
                            $temTarefas = false;

                            while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                $temTarefas = true;
                                $data1 = date("d/m/Y", strtotime($linha['data_inicial_agenda']));
                                $data2 = date("d/m/Y", strtotime($linha['data_final_agenda']));

                                echo "
                                <div class='task-card'>
                                    <h4 class='task-title'>{$linha['tarefa_agenda']}</h4>
                                    <p class='task-description'>{$linha['descricao_agenda']}</p>
                                    <div class='task-dates'>
                                        📅 $data1 a $data2
                                    </div>
                                    <div class='task-actions'>
                                        <form action='api/status_pendente.php' method='get' style='display: inline;'>
                                            <input type='hidden' name='id' value='{$linha['id_agenda']}'>
                                            <button type='submit' class='task-btn'>⟲ Pendente</button>
                                        </form>
                                    </div>
                                </div>
                                ";
                            }

                            if (!$temTarefas) {
                                echo "<div class='empty-state'>Nenhuma tarefa cancelada</div>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>

</html>
