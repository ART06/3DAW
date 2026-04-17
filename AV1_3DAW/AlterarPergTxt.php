<?php
$msg = "";
$id = $perg = $correto = "";

if (isset($_POST['buscar'])) {
    $id_busca = $_POST['id'];
    if (file_exists("PergTxt.txt")) {
        $linhas = file("PergTxt.txt", FILE_IGNORE_NEW_LINES);
        foreach ($linhas as $linha) {
            $dados = explode(";", $linha);
            if ($dados[0] == $id_busca) {
                $id = $dados[0];
                $perg = $dados[1];
                $correto = $dados[2];
                break;
            }
        }
    }
}

if (isset($_POST['alterar'])) {
    $id = $_POST['id'];
    $novaLinha = $id . ";" . $_POST['perg'] . ";" . $_POST['correto'] . "\n";
    $linhas = file("PergTxt.txt");
    foreach ($linhas as $i => $linha) {
        $dados = explode(";", $linha);
        if ($dados[0] == $id) {
            $linhas[$i] = $novaLinha;
            break;
        }
    }
    file_put_contents("PergTxt.txt", implode("", $linhas));
    $msg = "Pergunta de texto atualizada.";
}
?>

<!DOCTYPE html>
<html>
<body>
    <h1>Alterar Pergunta de Texto</h1>
    <form method="POST">
        ID: <input type="text" name="id" value="<?php echo $id; ?>">
        <input type="submit" name="buscar" value="Buscar">
        <br>
        Pergunta: <input type="text" name="perg" value="<?php echo $perg; ?>"><br>
        Resposta modelo: <input type="text" name="correto" value="<?php echo $correto; ?>"><br>
        <input type="submit" name="alterar" value="Alterar">
    </form>
    <p><?php echo $msg; ?></p>
    <a href="CadastrarPergTxt.php">Voltar</a>
</body>
</html>