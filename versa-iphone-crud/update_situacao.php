<?php
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $situacao = $_POST['situacao'] ?? null;

    if ($id && $situacao) {
        $id = intval($id);
        $situacao = mysqli_real_escape_string($conexao, $situacao);

        $sql = "UPDATE aparelhos SET situacao = '$situacao' WHERE id = $id";
        mysqli_query($conexao, $sql);
    }
}

header('Location: index.php');
exit;
?>
