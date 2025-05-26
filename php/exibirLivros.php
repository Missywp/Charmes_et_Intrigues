<?php
$host = "localhost";
$user = "root";
$password = "admin25";
$db = "clube_livro";

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

$sql = "SELECT nome, resenha FROM resenha_livro";
$result = $conn->query($sql);

$livros = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $livros[] = $row;
    }
}

echo json_encode($livros);

$conn->close();
?>
