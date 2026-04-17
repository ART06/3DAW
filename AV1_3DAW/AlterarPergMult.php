<?php
$msg = "";
$id = $perg = $A = $B = $C = $D = $correto = "";

if (isset($_POST['buscar'])) {
    $id_busca = $_POST['id'];
    if (file_exists("PergMult.txt")) {
        $linhas = file("PergMult.txt", FILE_IGNORE_NEW_LINES);
        foreach ($linhas as $linha) {
            $dados = explode(";", $linha);
            if ($dados[0] == $id_busca) {
                $id = $dados[0];
                $perg = $dados[1];
                $msg = "Pergunta encontrada.";
                break;
            }
        }
    }
}

if (isset($_POST['alterar'])) {
    $id = $_POST['id'];
    $novaLinha = $id . ";" . $_POST['perg'] . ";A)" . $_POST['A'] . " | B)" . $_POST['B'] . " | C)" . $_POST['C'] . " | D)" . $_POST['D'] . ";" . $_POST['correto'] . "\n";
    
    $linhas = file("PergMult.txt");
    foreach ($linhas as $i => $linha) {
        $dados = explode(";", $linha);
        if ($dados[0] == $id) {
            $linhas[$i] = $novaLinha;
            break;
        }
    }
    file_put_contents("PergMult.txt", implode("", $linhas));
    $msg = "Pergunta atualizada.";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head><meta charset="UTF-8"><title>Alterar Pergunta Mult</title></head>
<body>
    <h1>Alterar Pergunta de Múltipla Escolha</h1>
    <form method="POST">
        ID da Pergunta para buscar: <input type="text" name="id" value="<?php echo $id; ?>" required>
        <input type="submit" name="buscar" value="Buscar Dados">
        <hr>
        Pergunta: <input type="text" name="perg" value="<?php echo $perg; ?>"><br><br>
        A: <input type="text" name="A"><br><br>
        B: <input type="text" name="B"><br><br>
        C: <input type="text" name="C"><br>
        D: <input type="text" name="D"><br><br>
        Correta: <input type="text" name="correto"><br><br>
        <input type="submit" name="alterar" value="Salvar Alterações">
    </form>
    <p><?php echo $msg; ?></p>
    <a href="CadastrarPergMult.php">Voltar</a>
</body>
</html>