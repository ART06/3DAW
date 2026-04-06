<?php
$msg = '';
$resultados = array();
$idAlvo = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idAlvo = $_POST['idAlvo'];

    if ($idAlvo === '') {
        $msg = 'Digite matrícula para pesquisar.';
    } elseif (!file_exists("alunos.txt")) {
        $msg = 'Arquivo de alunos não existe. Cadastre alunos primeiro.';
    } else {
        $arqAlunos = fopen("alunos.txt", "r") or die("Erro ao ler arquivo!");
        if ($arqAlunos) {
            if (!feof($arqAlunos)) {
                fgets($arqAlunos);
            }
            while (!feof($arqAlunos)) {
                $linha = fgets($arqAlunos);

                $colunaDados = explode(';', $linha);

                $matricula = $colunaDados[0];
                $nome = $colunaDados[1];
                $email = $colunaDados[2];

                if ($matricula == $idAlvo) {
                    $email = rtrim($email, "\r\n");
                    $resultados[] = array('matricula' => $matricula, 'nome' => $nome, 'email' => $email);
                }
            }
            fclose($arqAlunos);

            if (count($resultados) == 0) {
                $msg = 'Nenhum aluno encontrado com a matrícula informada.';
            } else {
                header("Location: EditarAluno.php?matricula=" . $resultados[0]['matricula']);
                exit;
            }
        } else {
            $msg = 'Não foi possível abrir o arquivo de alunos.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Aluno</title>
</head>
<body>
    <h1>Editar Aluno</h1>

    <form method="POST" action="EncontrarAlunoEditar.php">
        <label>Digite matrícula: </label>
        <input type="text" name="idAlvo" value="<?php echo $idAlvo; ?>" required>
        <button type="submit">Buscar</button>
    </form>

    <?php if ($msg): ?>
        <p><?php echo $msg; ?></p>
    <?php endif; ?>

    <a href="InserirAlunos.php">Voltar para cadastro</a>
</body>
</html>
