<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id=$_POST["id"];
    $perg=$_POST["perg"];
    $A=$_POST["A"];
    $B=$_POST["B"];
    $C=$_POST["C"];
    $D=$_POST["D"];
    $correto=$_POST["correto"];
    $msg="";

    if(!file_exists($arqMult)){
        $arqMult=fopen("PergMult.txt","w") or die("Erro ao criar arquivo.");
        $cabecalho="ID;Pergunta;Alternativas;Alternativa Correta\n";
        fwrite($arqMult,$cabecalho);
        fclose($arqMult);
    }

    $arqMult=fopen("PergMult.txt","a") or die("Erro ao abrir arquivo.");
    $linha=$id.";".$perg.";A)".$A." | B)".$B." | C)".$C." | D)".$D.";".$correto."\n";

    if(fwrite($arqMult,$linha)){
        $msg="Pergunta de múltipla escolha salva com sucesso.";
    }
    else{
        $msg="Falha ao salvar pergunta.";
    }
    fclose($arqMult);
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastar Pergunta Múltipla Escolha</title>
</head>
<body>
    <h1>Cadastrar Pergunta de Múltipla Escolha</h1>
    <form action="" method="POST">
        Insira ID da pergunta: <input type="text" name="id" required><br><br>
        Insira a pergunta: <input type="text" name="perg" required><br><br>
        Alternativa A: <input type="text" name="A" required><br><br>
        Alternativa B: <input type="text" name="B" required><br><br>
        Alternativa C: <input type="text" name="C" required><br><br>
        Alternativa D: <input type="text" name="D" required><br><br>
        Qual é a alternativa correta? (Insira somente a letra da alternativa)<br><input type="text" name="correto"><br><br>
        <input type="submit" value="Enviar">
    </form>
    <p><?PHP echo $msg; ?></p>
    <a href="ListarPergResp.php">Ver Todas as Perguntas</a>
    <hr>
    <a href="CadastrarPergTxt.php">Cadastrar Pergunta de Texto</a><br><br>
    <a href="ExcluirPergMult.php">Excluir Pergunta de Múltipla Escolha</a>
</body>
</html>