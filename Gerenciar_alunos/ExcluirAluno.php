<?php
$matricula = '';
$msg = '';

if (isset($_GET['matricula'])) {
    $matricula = $_GET['matricula'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['matricula'])) {
    $matricula = $_POST['matricula'];

    if (!file_exists("alunos.txt")) {
        $msg = 'Arquivo alunos.txt não encontrado.';
    } else {
        $linhas = array();
        $arqAluno = fopen("alunos.txt", 'r') or die('erro ao abrir arquivo');
        if (!feof($arqAluno)) {
            $cabecalho = fgets($arqAluno);
        }

        while (!feof($arqAluno)) {
            $linha = fgets($arqAluno);
            if ($linha === false || $linha === "" || $linha === "\n" || $linha === "\r\n") {
                continue;
            }

            $colunaDados = explode(';', $linha);
            if (count($colunaDados) < 3) {
                continue;
            }

            if ($colunaDados[0] !== $matricula) {
                $linhas[] = $colunaDados[0] . ';' . $colunaDados[1] . ';' . $colunaDados[2];
            }
        }

        fclose($arqAluno);

        $arqAluno = fopen("alunos.txt", 'w') or die('erro ao abrir arquivo');
        if (isset($cabecalho)) {
            fputs($arqAluno, $cabecalho);
        }

        foreach ($linhas as $l) {
            fputs($arqAluno, $l);
        }

        fclose($arqAluno);
        $msg = 'Aluno excluído com sucesso.';
        header("Location: InserirAlunos.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Excluir Aluno</title>
</head>
<body>
    <h1>Excluir Aluno</h1>
    <p>Tem certeza que deseja excluir o aluno da matrícula <?php echo $matricula; ?>?</p>
    <form method="POST" action="">
        <input type="hidden" name="matricula" value="<?php echo $matricula; ?>">
        <input type="submit" value="Confirmar">
    </form>

    <p><a href="InserirAlunos.php">Voltar para cadastro</a></p>
</body>
</html>
