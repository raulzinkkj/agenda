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
            font-family: 'Segoe Ui';
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
            background: #dbdbdbc7;
            border-radius: 12px;
            display: flex;
            flex-direction: column;
            padding: 10px;
        }
        .status{
            width: 90px;
            height: 25px;
            font-size: 0.8rem;
            background: white;
            border-radius: 5px;
            border: solid 1px gray; 
            display: flex;  
            align-items: center;
        }
        .status img {
            width: 25px; 
        }
        .tarefa {
            background: white;
            border-radius: 12px;
            height: 175px;
            display: flex;
            flex-direction: column;
            margin-bottom: 10px;
        }
        .tarefa p {
            padding: 5px;
            margin-bottom: 5px;
        }
        .tarefa h3 {
            padding: 5px;
            margin-bottom: 5px;
        }
        #button_form{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .button_form {
            width: 80px;
            padding: 0;
            margin-left: 20px;
        }
        .cel_tarefa {
            width: 100%;
        }
        .bolinha_azul {
            height: 7px;
            width: 7px;
            border-radius: 50%;
            background: #5030e5;
            margin-right: 10px;
        }
        .bolinha_vermelho{
            height: 7px;
            width: 7px;
            border-radius: 50%;
            background: #c53d3dff;
            margin-right: 10px;
        }
        .bolinha_verde {
            height: 7px;
            width: 7px;
            border-radius: 50%;
            background: #59c568ff;
            margin-right: 10px;
        }
        .titulo {
            display: flex;
            align-items: center;
            border-bottom: solid 3px #5030e5;
            margin-bottom: 20px; 
            padding: 10px 0 10px 0px;
        }
        .titulo2 {
            display: flex;
            align-items: center;
            border-bottom: solid 3px #59c568ff;
            margin-bottom: 20px; 
            padding: 10px 0 10px 0px;
        }
        .titulo3 {
            display: flex;
            align-items: center;
            border-bottom: solid 3px #c53d3dff;
            margin-bottom: 20px; 
            padding: 10px 0 10px 0px;
        }
        .save  {
            background: white;
            border-radius: 5px;
            border: solid 1px gray; 
            display: flex;  
            align-items: center;
            justify-content: center;
        }
        .save img {
            width: 35px;
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

            <button type="submit" class="save"><img src="img/save.svg" alt="">Salvar</button>
        </form>
    </section>
    <section id="card">
        <div class="card">            
            <div class="titulo">
                <div class="bolinha_azul"></div>
                <h3>A fazer</h3>
            </div>
            <?php
                $sql = "SELECT * FROM agenda WHERE status_agenda= 'pendente'";
                $stmt = $conexao->prepare($sql);
                $stmt->execute ();

                while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {

                    $data1 = date("d/m/Y", strtotime($linha['data_inicial_agenda']));
                    $data2 = date("d/m/Y", strtotime($linha['data_final_agenda']));

                    echo "<div class='tarefa'>";
                        echo "<div class='cel_tarefa'><h3>{$linha['tarefa_agenda']}</h3></div>";
                        echo "<div class='cel_tarefa'><p>{$linha['descricao_agenda']}</p></div>";
                        echo "<div class='cel_tarefa'><p> de $data1"." a ". "$data2</p></div>";

                        echo "<div id= 'button_form'>"; 
                            echo "<form action='api/status_concluido.php' method='get' class='button_form'>";
                            echo "<input type='hidden' name='id' value='{$linha['id_agenda']}'>";
                            echo "<button type='submit' class='status'><img src='img/check-solid-full.svg' alt=''>Concluído</button>";
                            echo "</form>";

                            echo "<form action='api/status_cancelado.php' method='get' class='button_form'>";
                            echo "<input type='hidden' name='id' value='{$linha['id_agenda']}'>";
                            echo "<button type='submit' class='status'><img src='img/x-solid-full.svg' alt=''> Cancelar</button>";
                            echo "</form>";
                        echo "</div>";
                    echo "</div>";  
                }
            ?>
        </div>
        <div class="card">
             <div class="titulo2">
                <div class="bolinha_verde"></div>
                <h3>Concluído</h3>
            </div>
            <?php
                $sql = "SELECT * FROM agenda WHERE status_agenda= 'concluido'";
                $stmt = $conexao->prepare($sql);
                $stmt->execute ();

                while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {

                    $data1 = date("d/m/Y", strtotime($linha['data_inicial_agenda']));
                    $data2 = date("d/m/Y", strtotime($linha['data_final_agenda']));

                    echo "<div class='tarefa'>";
                        echo "<div class='cel_tarefa'><h3>{$linha['tarefa_agenda']}</h3></div>";
                        echo "<div class='cel_tarefa'><p>{$linha['descricao_agenda']}</p></div>";
                        echo "<div class='cel_tarefa'><p> de $data1"." a ". "$data2</p></div>";

                        echo "<div id= 'button_form'>"; 
                            echo "<form action='api/status_pendente.php' method='get' class='button_form'>";
                            echo "<input type='hidden' name='id' value='{$linha['id_agenda']}'>";
                            echo "<button type='submit' class='status'><img src='img/check-solid-full.svg' alt=''>Pendente</button>";
                            echo "</form>";

                            echo "<form action='api/status_cancelado.php' method='get' class='button_form'>";
                            echo "<input type='hidden' name='id' value='{$linha['id_agenda']}'>";
                            echo "<button type='submit' class='status'><img src='img/x-solid-full.svg' alt=''> Cancelar</button>";
                            echo "</form>";
                        echo "</div>";
                    echo "</div>";  
                }
            ?>
        </div>
        <div class="card">
             <div class="titulo3">
                <div class="bolinha_vermelho"></div>
                <h3>Cancelado</h3>
            </div>
            <?php
                $sql = "SELECT * FROM agenda WHERE status_agenda= 'cancelado'";
                $stmt = $conexao->prepare($sql);
                $stmt->execute ();

                while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {

                    $data1 = date("d/m/Y", strtotime($linha['data_inicial_agenda']));
                    $data2 = date("d/m/Y", strtotime($linha['data_final_agenda']));

                    echo "<div class='tarefa'>";
                        echo "<div class='cel_tarefa'><h3>{$linha['tarefa_agenda']}</h3></div>";
                        echo "<div class='cel_tarefa'><p>{$linha['descricao_agenda']}</p></div>";
                        echo "<div class='cel_tarefa'><p> de $data1"." a ". "$data2</p></div>";

                        echo "<div id= 'button_form'>"; 
                            echo "<form action='api/status_pendente.php' method='get' class='button_form'>";
                            echo "<input type='hidden' name='id' value='{$linha['id_agenda']}'>";
                            echo "<button type='submit' class='status'><img src='img/check-solid-full.svg' alt=''>Pendente</button>";
                            echo "</form>";

                        echo "</div>";
                    echo "</div>";  
                }
            ?>
        </div>
        
    </section>
</body>
</html>