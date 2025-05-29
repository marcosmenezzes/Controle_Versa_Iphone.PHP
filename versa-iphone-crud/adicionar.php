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
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Responsividade -->
    <title>Adicionar Aparelho</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            padding: 2rem 1rem;
            max-width: 480px;
            margin: 0 auto;
        }
        @media (max-width: 576px) {
            .form-container {
                padding: 1rem 0.5rem;
            }
            h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>

<div class="container mt-4 mb-4">
    <div class="form-container">
        <h1 class="mb-4 text-center">Adicionar Aparelho</h1>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">ID do Aparelho</label>
                <input type="text" name="id_aparelho" class="form-control" required autocomplete="off">
            </div>
            <div class="mb-3">
                <label class="form-label">Modelo do iPhone</label>
                <input type="text" name="modelo" class="form-control" required autocomplete="off">
            </div>
            <div class="mb-3">
                <label class="form-label">Descrição do Problema</label>
                <textarea name="descricao" class="form-control" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Local</label>
                <select name="local" class="form-select" required>
                    <option>Versa</option>
                    <option>Alex</option>
                    <option>Bin</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Situação</label>
                <select name="situacao" class="form-select" required>
                    <option>Pendente</option>
                    <option>Concluído</option>
                </select>
            </div>
            <div class="d-grid gap-2">
                <button class="btn btn-success" type="submit">Salvar</button>
                <a href="index.php" class="btn btn-secondary">Voltar</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
<?php
mysqli_close($conexao);
