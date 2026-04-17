<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perguntas de Múltipla Escolha</title>
</head>
<body>
    <h1>Perguntas e Respostas</h1>
        <h2>Perguntas de Múltipla Escolha</h2>
    <table>
        <tr><th>ID</th><th>Pergunta</th><th>Alternativas</th><th>Correta</th></tr>
        <?php
        if(file_exists("PergMult.txt")){
            $linhas = file("PergMult.txt", FILE_IGNORE_NEW_LINES);
            unset($linhas[0]);
            foreach($linhas as $linha){
                $dados = explode(";", $linha);
                if(count($dados) < 4) continue;
                echo "<tr>
                    <td>{$dados[0]}</td>
                    <td>{$dados[1]}</td>
                    <td>{$dados[2]}</td>
                    <td>{$dados[3]}</td>
                </tr>";
            }
        }
        ?>
    </table>

    <h2>Perguntas de Texto</h2>
    <table>
        <tr><th>ID</th><th>Pergunta</th><th>Resposta-Modelo</th></tr>
        <?php
        if(file_exists("PergTxt.txt")){
            $linhas = file("PergTxt.txt", FILE_IGNORE_NEW_LINES);
            unset($linhas[0]);
            foreach($linhas as $linha){
                $dados = explode(";", $linha);
                if(count($dados) < 3) continue;
                echo "<tr>
                    <td>{$dados[0]}</td>
                    <td>{$dados[1]}</td>
                    <td>{$dados[2]}</td>
                </tr>";
            }
        }
        ?>
    </table>
    <br><a href="CadastrarPergMult.php">Voltar</a>
</body>
</html>