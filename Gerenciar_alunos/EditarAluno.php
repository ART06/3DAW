<?php
$matricula = '';
$nome = '';
$email = '';
$msg = '';

if (isset($_GET['matricula'])) {
    $matricula = $_GET['matricula'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['matricula'])) {
    $matricula = $_POST['matricula'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];

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

            if ($colunaDados[0] === $matricula) {
                $linhas[] = $matricula . ';' . $nome . ';' . $email . "\n";
            } else {
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
        $msg = 'Aluno atualizado com sucesso.';
    }
}

if ($matricula !== '' && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    if (file_exists("alunos.txt")) {
        $arqAluno = fopen("alunos.txt", 'r') or die('erro ao abrir arquivo');
        if (!feof($arqAluno)) {
            fgets($arqAluno);
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

            if ($colunaDados[0] === $matricula) {
                $nome = $colunaDados[1];
                $email = $colunaDados[2];
                break;
            }
        }

        fclose($arqAluno);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Aluno</title>
</head>
<body>
    <h1>Editar Aluno</h1>

    <form method="POST" action="">
        <input type="hidden" name="matricula" value="<?php echo $matricula; ?>">
        Matrícula: <?php echo $matricula; ?><br><br>
        Nome: <input type="text" name="nome" value="<?php echo $nome; ?>" required><br><br>
        Email: <input type="email" name="email" value="<?php echo $email; ?>" required><br><br>
        <input type="submit" value="Salvar">
    </form>

    <p><a href="InserirAlunos.php">Voltar para cadastro</a></p>
</body>
</html>
