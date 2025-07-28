<?php
include 'conexao.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $sql = "UPDATE users SET name='$nome', email='$email' WHERE id=$id";
    mysqli_query($conexao, $sql);
    header('Location: painel.php'); 
} else {
    $sql = "SELECT * FROM users WHERE id=$id";
    $resultado = mysqli_query($conexao, $sql);
    $usuario = mysqli_fetch_assoc($resultado);
}

?>