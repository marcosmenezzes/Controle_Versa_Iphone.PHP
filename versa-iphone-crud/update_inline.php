<?php
include 'conexao.php';

if (isset($_POST['id']) && isset($_POST['situacao'])) {
    $id = $_POST['id'];
    $situacao = $_POST['situacao'];

    $sql = "UPDATE aparelhos SET situacao = ? WHERE id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param('si', $situacao, $id);

    if ($stmt->execute()) {
        header('Location: index.php');
        exit();
    } else {
        echo "Erro ao atualizar situação.";
    }
}
?>
