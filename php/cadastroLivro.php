<?php
session_start();
/*
// VERIFICA SE USUÁRIO ESTÁ LOGADO
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.html?erro=acesso_negado');
    exit();
}*/

$host = "localhost";
$usuario = "root";
$pass = "admin25";
$banco = "clube_livro";

$conn = new mysqli($host, $usuario, $pass, $banco);

// CHECA CONEXÃO
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// recebendo os dados do formulário
$nome = $_POST['nome'] ?? '';
$resenha = $_POST['resenha'] ?? '';

// VERIFICA CAMPOS OBRIGATÓRIOS
if (empty($nome) || empty($resenha)) {
    die("Preencha todos os campos");
}

// prepara a query -> evita sql injection e erros de construção
$stmt = $conn->prepare("INSERT INTO resenha_livro(nome, resenha) VALUES (?, ?)"); 
$stmt->bind_param("ss", $nome, $resenha); // monta a query
$stmt->execute(); // executa a query

// redirect para a exibir livros
header('Location: /Clube_Livro1/components/exibirLivros.html');


?>