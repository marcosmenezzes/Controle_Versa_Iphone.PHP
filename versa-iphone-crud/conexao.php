<?php
$host = 'localhost';
$user = 'root';
$password = ''; // coloque sua senha do banco aqui
$dbname = 'versa_iphone'; // nome do banco

$conexao = mysqli_connect($host, $user, $password, $dbname);

if (!$conexao) {
    die("Erro na conexão com banco: " . mysqli_connect_error());
}
mysqli_set_charset($conexao, 'utf8mb4'); // Define o charset para UTF-8
if (!mysqli_select_db($conexao, $dbname)) {
    die("Erro ao selecionar o banco de dados: " . mysqli_error($conexao));
}