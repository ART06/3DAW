<!DOCTYPE html>
<html>
<body>
    <h1>Buscar Pergunta por ID</h1>
    <form method="GET">
        ID: <input type="text" name="id_busca">
        <input type="submit" value="Buscar">
    </form>

    <?php
    if(isset($_GET['id_busca'])){
        $id = $_GET['id_busca'];
        $arquivos = ["PergMult.txt", "PergTxt.txt"];
        foreach($arquivos as $arq){
            if(file_exists($arq)){
                $linhas = file($arq);
                foreach($linhas as $linha){
                    $dados = explode(";", $linha);
                    if($dados[0] == $id){
                        echo "<h3>Encontrado no arquivo: $arq</h3>";
                        echo "Detalhes: " . str_replace(";", " | ", $linha);
                    }
                }
            }
        }
    }
    ?>
    <br><a href="CadastrarPergMult.php">Voltar</a>
</body>
</html>