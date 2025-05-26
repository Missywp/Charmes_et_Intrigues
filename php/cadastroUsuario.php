<?php
// conectando com o banco
$host = "localhost";
$usuario = "root";
$senha = "admin25";
$banco = "clube_livro";

$conn = new mysqli($host, $usuario, $senha, $banco);

// CHECA CONEXÃO
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// recebendo os dados do formulário
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$data_nascimento = $_POST['data_nascimento'];
$senha = $_POST['senha'];
$confirma_senha = $_POST['confirma_senha'];

// VERIFICA CAMPOS OBRIGATÓRIOS
if (empty($nome) || empty($sobrenome) || empty($data_nascimento) || empty($senha)) {
    die("Preencha todos os campos");
}

if ($senha !== $confirma_senha) {
    die("As senhas não coincidem");
}

// fazendo um salt da senha 
$senha_salt = password_hash($senha, PASSWORD_BCRYPT);

// inserindo no banco de dados
//$sql = "INSERT INTO usuarios (nome, sobrenome, data_nascimento, senha) VALUES ($nome, $sobrenome, $data_nascimento, $senha_salt)";

// prepara a query -> evita sql injection e erros de construção
$stmt = $conn->prepare("INSERT INTO usuario (nome, sobrenome, data_nascimento, senha) VALUES (?, ?, ?, ?)"); 
$stmt->bind_param("ssss", $nome, $sobrenome, $data_nascimento, $senha_salt); // monta a query
$stmt->execute(); // executa a query

// redirect para a index
header('Location: /Clube_Livro1/home.html');
?>
