<?php
include('conexao.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    
    if (isset($_POST['action']) && $_POST['action'] === 'update_situacao') {
        $situacao = mysqli_real_escape_string($conexao, $_POST['situacao']);
        $sql = "UPDATE aparelhos SET situacao = '$situacao' WHERE id = $id";
        $success = mysqli_query($conexao, $sql);
        echo json_encode(['success' => $success]);
        exit;
    }
    
    if (isset($_POST['action']) && $_POST['action'] === 'update_local') {
        $local = mysqli_real_escape_string($conexao, $_POST['local']);
        $sql = "UPDATE aparelhos SET local = '$local' WHERE id = $id";
        $success = mysqli_query($conexao, $sql);
        echo json_encode(['success' => $success]);
        exit;
    }
}

echo json_encode(['success' => false]);