<?php
session_start();

    header('Content-Type: application/json');

    // Pega os dados da URL
    $nome = $_POST["nome"] ?? "";
    $senha = $_POST["senha"] ?? "";

    // conectando com o bd
    $host = "localhost";
    $usuario = "root";
    $pass = "admin25";
    $banco = "clube_livro";

$conn = new mysqli($host, $usuario, $pass, $banco);

// CHECA CONEXÃO
if ($conn->connect_error) {
    echo json_encode(['resp' => 'erro_conexao']);
    exit();
}

    // Consulta usuário existente no banco de dados
    // prepara a query
    $stmt = $conn->prepare("SELECT senha FROM usuario WHERE nome = ?"); 
    // substitui o parâmetro ? pelo o que foi digitado no formulário
    $stmt->bind_param("s", $nome);
    $stmt->execute(); // executa a query
    $result = $stmt->get_result(); // recupera os dados da consulta

    // Verifica se o usuário existe
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verifica a senha
        if (password_verify($senha, $row["senha"])) {
            // Cria sessão
            $_SESSION['usuario_nome'] = $nome;
            
            echo json_encode(['resp' => "sucesso"]);
            exit();
        } else {
            echo json_encode(['resp' => "Senha incorreta"]);
            exit();
        }
    } else {
        echo json_encode(['resp' => "Usuário não encontrado"]);
        exit();
    }

/*
// FECHA STATEMENT E CONEXÃO
$stmt->close();
$conn->close();
*/
?>
