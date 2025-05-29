<?php include('conexao.php');

if ($_POST) {
    $id_aparelho = $_POST['id_aparelho'];
    $modelo = $_POST['modelo'];
    $descricao = $_POST['descricao'];
    $local = $_POST['local'];
    $situacao = $_POST['situacao'];

    $sql = "INSERT INTO aparelhos (id_aparelho, modelo, descricao, local, situacao) 
            VALUES ('$id_aparelho', '$modelo', '$descricao', '$local', '$situacao')";
    mysqli_query($conexao, $sql);

    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Aparelho</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h1 class="mb-4">Adicionar Aparelho</h1>
    <form method="POST">
        <div class="mb-3">
            <label>ID do Aparelho</label>
            <input type="text" name="id_aparelho" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Modelo do iPhone</label>
            <input type="text" name="modelo" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Descrição do Problema</label>
            <textarea name="descricao" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Local</label>
            <select name="local" class="form-select" required>
                <option>Versa</option>
                <option>Alex</option>
                <option>Bin</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Situação</label>
            <select name="situacao" class="form-select" required>
                <option>Pendente</option>
                <option>Concluído</option>
            </select>
        </div>
        <button class="btn btn-success">Salvar</button>
        <a href="index.php" class="btn btn-secondary">Voltar</a>
    </form>
</div>

</body>
</html>
<?php
mysqli_close($conexao);