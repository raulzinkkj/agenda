<?php
include 'conexao/conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        header {
            height: 50px;
            padding: 10px;
            display: flex;
            justify-content: space-around;
            align-items: center;    
        }
        body {
            display: flex;
            justify-content: center;
            flex-direction: column; 
            align-items: center;
        }
        #formulario{
            display: flex;
            justify-content: center;
            
        }
        form {
            width: 400px;   
            display: flex;
            flex-direction: column;
            padding: 20px;
        }
        input, textarea{
            width: 300px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }
        span {
            width: 100%;
        }
        button{
            width: 300px;
            height: 40px;
            font-size: 1.4rem;
        }
        #card {
            display: grid;
            grid-template-columns: repeat(3,1fr);
            height: 500px;
            gap: 20px;  

            width: 1000px;
        }
        .card{
            background: #589cc9ff;
           
        }
        .status{
            width: 90px;
            height: 30px;
            font-size: 1rem;
        }
    </style>
</head>

<body>
    <header>

    </header>
    <section id="formulario">
        <form action="api/gravar_tarefa.php" method="post">
            <span><label for="tarefa">Tarefa</label></span>
            <input type="text" name="tarefa" id="">

            <span><label for="descricao">Descrição da Tarefa</label></span>
            <textarea name="descricao" id=""></textarea>

            <span><label for="data_inicial">Data Inicial</label></span>
            <input type="date" name="data_inicial" id="">

            <span><label for="data_final">Data Final</label></span>
            <input type="date" name="data_final" id="">

            <button type="submit">Salvar</button>
        </form>
    </section>
    <section id="card">
        <div class="card">
            <?php
                $sql = "SELECT * FROM agenda WHERE status_agenda= 'pendente'";
                $stmt = $conexao->prepare($sql);
                $stmt->execute ();

                while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {

                    echo "<div class='linha'>";
                        echo "<div class='cel_cabecalho'>{$linha['tarefa_agenda']}</div>";
                        echo "<div class='cel_cabecalho'>{$linha['descricao_agenda']}</div>";
                        echo "<div class='cel_cabecalho'> de {$linha['data_inicial_agenda']}"." a ". "{$linha['data_final_agenda']}</div>";
                    echo "</div>";

                    echo "<form action='api/status_concluido.php' method='get'>";
                    echo "<input type='hidden' name='id' value='{$linha['id_agenda']}'>";
                    echo "<button type='submit' class='status'>Concluído</button>";
                    echo "</form>";

                    echo "<form action='api/status_cancelado.php' method='get'>";
                    echo "<input type='hidden' name='id' value='{$linha['id_agenda']}'>";
                    echo "<button type='submit' class='status'>❌</button>";
                    echo "</form>";

                }
            ?>
        </div>
        <div class="card">
            <?php
                $sql = "SELECT * FROM agenda WHERE status_agenda= 'concluido'";
                $stmt = $conexao->prepare($sql);
                $stmt->execute ();

                while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {

                    echo "<div class='linha'>";
                        echo "<div class='cel_cabecalho'>{$linha['tarefa_agenda']}</div>";
                        echo "<div class='cel_cabecalho'>{$linha['descricao_agenda']}</div>";
                        echo "<div class='cel_cabecalho'> de {$linha['data_inicial_agenda']}"." a ". "{$linha['data_final_agenda']}</div>";
                    echo "</div>";

                    echo "<form action='api/status_pendente.php' method='get'>";
                    echo "<input type='hidden' name='id' value='{$linha['id_agenda']}'>";
                    echo "<button type='submit' class='status'>Pendente</button>";
                    echo "</form>";
                    
                    echo "<form action='api/status_cancelado.php' method='get'>";
                    echo "<input type='hidden' name='id' value='{$linha['id_agenda']}'>";
                    echo "<button type='submit' class='status'>❌</button>";
                    echo "</form>";
                }
            ?>
        </div>
        <div class="card">
            <?php
                $sql = "SELECT * FROM agenda WHERE status_agenda= 'cancelado'";
                $stmt = $conexao->prepare($sql);
                $stmt->execute ();

                while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {

                    echo "<div class='linha'>";
                        echo "<div class='cel_cabecalho'>{$linha['tarefa_agenda']}</div>";
                        echo "<div class='cel_cabecalho'>{$linha['descricao_agenda']}</div>";
                        echo "<div class='cel_cabecalho'> de {$linha['data_inicial_agenda']}"." a ". "{$linha['data_final_agenda']}</div>";
                    echo "</div>";
                }
            ?>
        </div>
    </section>

</body>
</html>