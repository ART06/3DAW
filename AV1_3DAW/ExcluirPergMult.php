<?php
$msg = "";
if(isset($_POST['id_excluir'])){
    $id = $_POST['id_excluir'];
    $linhas = file("PergMult.txt");
    $novoArquivo = "";
    $achou = false;

    foreach($linhas as $linha){
        $dados = explode(";", $linha);
        if($dados[0] == $id && $id != "ID"){
            $achou = true;
            continue;
        }
        $novoArquivo .= $linha;
    }

    file_put_contents("PergMult.txt", $novoArquivo);
    $msg = $achou ? "Excluído com sucesso!" : "ID não encontrado.";
}
?>
<!DOCTYPE html>
<html>
<body>
    <h1>Excluir Pergunta de Múltipla Escolha</h1>
    <form method="POST">
        Digite o ID para excluir: <input type="text" name="id_excluir" required>
        <input type="submit" value="Excluir">
    </form>
    <p><?php echo $msg; ?></p>
    <a href="CadastrarPergMult.php">Voltar</a>
</body>
</html>