<?php
include('conexao.php');

$id = $_GET['id'];

$sql = "DELETE FROM aparelhos WHERE id = $id";
mysqli_query($conexao, $sql);

header('Location: index.php');
?>
