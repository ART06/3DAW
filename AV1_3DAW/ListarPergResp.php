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
    <?PHP
    if(file_exists("PergMult.txt")){
        $arqMult=fopen("PergMult.txt","r") or die("erro ao abrir arquivo");
        fgets($arqMult);
        
        while(!feof($arqMult)) {
            $linha = fgets($arqMult);
            $colunaDados = explode(";", $linha);
 
            echo "<tr>
                    <td>".$colunaDados[0]." </td>" .
                    "<td>".$colunaDados[1]." </td>" .
                    "<td>".$colunaDados[2]." </td>" .
                    "<td>".$colunaDados[3]." </td>" .
                    "<td>".$colunaDados[4]." </td>" .
                    "<td>".$colunaDados[5]." </td>" .
                    "<td>".$colunaDados[6]." </td>
                </tr>";
        }
        fclose($arqMult);
    }
    ?>
        <h2>Perguntas de Texto</h2>
        <?PHP
    if(file_exists("PergTxt.txt")){
        $arqTxt=fopen("PergTxt.txt","r") or die("erro ao abrir arquivo");
        fgets($arqTxt);
        
        while(!feof($arqTxt)) {
            $linha = fgets($arqTxt);
            $colunaDados = explode(";", $linha);
 
            echo "<tr>
                    <td>".$colunaDados[0]." </td>" .
                    "<td>".$colunaDados[1]." </td>" .
                    "<td>".$colunaDados[2]." </td>
                </tr>";
        }
        fclose($arqTxt);
    }
    ?>
</body>
</html>