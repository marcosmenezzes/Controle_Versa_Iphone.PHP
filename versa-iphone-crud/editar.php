<?php
include('conexao.php');

$id = $_GET['id'];

$sql = "SELECT * FROM aparelhos WHERE id = $id";
$result = mysqli_query($conexao, $sql);
$row = mysqli_fetch_assoc($result);

if ($_POST) {
    $id_aparelho = $_POST['id_aparelho'];
    $modelo = $_POST['modelo'];
    $descricao = $_POST['descricao'];
    $local = $_POST['local'];
    $situacao = $_POST['situacao'];

    $sql = "UPDATE aparelhos SET 
            id_aparelho = '$id_aparelho',
            modelo = '$modelo',
            descricao = '$descricao',
            local = '$local',
            situacao = '$situacao'
            WHERE id = $id";
    mysqli_query($conexao, $sql);

    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Aparelho</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h1>Editar Aparelho</h1>
    <form method="POST">
        <div class="mb-3">
            <label>ID do Aparelho</label>
            <input type="text" name="id_aparelho" class="form-control" value="<?php echo $row['id_aparelho']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Modelo do iPhone</label>
            <input type="text" name="modelo" class="form-control" value="<?php echo $row['modelo']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Descrição do Problema</label>
            <textarea name="descricao" class="form-control" required><?php echo $row['descricao']; ?></textarea>
        </div>
        <div class="mb-3">
            <label>Local</label>
            <select name="local" class="form-select" required>
                <option <?php if($row['local']=='Versa') echo 'selected'; ?>>Versa</option>
                <option <?php if($row['local']=='Alex') echo 'selected'; ?>>Alex</option>
                <option <?php if($row['local']=='Bin') echo 'selected'; ?>>Bin</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Situação</label>
            <select name="situacao" class="form-select" required>
                <option <?php if($row['situacao']=='Pendente') echo 'selected'; ?>>Pendente</option>
                <option <?php if($row['situacao']=='Concluído') echo 'selected'; ?>>Concluído</option>
            </select>
        </div>
        <button class="btn btn-primary">Salvar Alterações</button>
        <a href="index.php" class="btn btn-secondary">Voltar</a>
    </form>
</div>

</body>
</html>
<?php
mysqli_close($conexao);