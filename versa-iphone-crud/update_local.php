<?php
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $local = $_POST['local'] ?? null;

    if ($id && $local) {
        $id = intval($id);
        $local = mysqli_real_escape_string($conexao, $local);

        $sql = "UPDATE aparelhos SET local = '$local' WHERE id = $id";
        mysqli_query($conexao, $sql);
    }
}

header('Location: index.php');
exit;
?>