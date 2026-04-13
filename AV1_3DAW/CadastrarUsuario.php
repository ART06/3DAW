<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id=$_POST["id"];
    $nome=$_POST["nome"];
    $email=$_POST["email"];
    $msg="";

    if(!file_exists($arqUser)){
        $arqUser=fopen("Usuarios.txt","w") or die("Erro ao criar arquivo.");
        $cabecalho="ID;Nome;Email\n";
        fwrite($arqUser,$cabecalho);
        fclose($arqUser);
    }

    $arqUser=fopen("Usuarios.txt","a") or die("Erro ao abrir arquivo.");
    $linha=$id.";".$nome.";".$email."\n";

    if(fwrite($arqUser,$linha)){
        $msg="Usuário cadastrado com sucesso.";
    }
    else{
        $msg="Falha ao cadastrar uruário.";
    }
    fclose($arqUser);
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastar Usuário</title>
</head>
<body>
    <h1>Cadastro de Usuário</h1>
    <form action="" method="POST">
        ID: <input type="text" name="id" required><br><br>
        Nome: <input type="text" name="nome" required><br><br>
        Email: <input type="text" name="email" required><br><br>
        <input type="submit" value="Enviar">
    </form>
    <p><?PHP echo $msg; ?></p>
    <a href="Usuarios.txt">Ver Arquivo de Usuários</a>
    <br><br>
    <a href="CadastrarPergMult.php">Iniciar Cadastro de Perguntas</a>
</body>
</html>