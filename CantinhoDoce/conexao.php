<?php
$server = "127.0.0.1:3312";
$user = "root";
$password ="";
$database = "cantinhoDoce";

$conexao = mysqli_connect($server, $user, $password, $database);

if (!$conexao) {
    die("A conexão falhou" . mysqli_connect_error());
}
echo "";
?>