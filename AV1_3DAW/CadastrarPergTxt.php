<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id=$_POST["id"];
    $perg=$_POST["perg"];
    $correto=$_POST["correto"];
    $msg="";

    if(!file_exists($arqMult)){
        $arqTxt=fopen("PergTxt.txt","w") or die("Erro ao criar arquivo.");
        $cabecalho="ID;Pergunta;Resposta-Modelo\n";
        fwrite($arqTxt,$cabecalho);
        fclose($arqTxt);
    }

    $arqTxt=fopen("PergTxt.txt","a") or die("Erro ao abrir arquivo.");
    $linha=$id.";".$perg.";".$correto."\n";

    if(fwrite($arqTxt,$linha)){
        $msg="Pergunta de texto salva com sucesso.";
    }
    else{
        $msg="Falha ao salvar pergunta.";
    }
    fclose($arqTxt);
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastar Pergunta Texto</title>
</head>
<body>
    <h1>Cadastrar Pergunta de Texto</h1>
    <form action="" method="POST">
        Insira ID da pergunta: <input type="text" name="id" required>
        Insira a pergunta: <input type="text" name="perg" required><br><br>
        Qual é a resposta-modelo?<br><input type="text" name="correto"><br><br>
        <input type="submit" value="Enviar">
    </form>
    <p><?PHP echo $msg; ?></p>
    <a href="ListarPergResp.php">Ver Todas as Perguntas</a>
    <hr>
    <a href="CadastrarPergMult.php">Cadastrar Pergunta de Múltipla Escolha</a><br><br>
    <a href="ExcluirPergTxt.php">Excluir Pergunta de Texto</a>
</body>
</html>