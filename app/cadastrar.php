<?php

// --- Configurações do Banco de Dados ---
$servername = "db"; // Se estiver usando XAMPP/WAMP ou MySQL localmente
// Se estiver usando Docker Compose, o hostname será o nome do seu serviço de banco de dados
// Por exemplo, se seu serviço MySQL no docker-compose.yml é 'db', use:
// $servername = "db";
$username = "thiago"; // O usuário que você definiu no MySQL ou Docker Compose
$password = "Adm1n@RN"; // A senha do usuário
$dbname = "meu_banco_de_dados"; // O nome do banco de dados que você criou

// --- Conexão com o Banco de Dados ---
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// --- Processamento do Formulário ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pega os dados do formulário e sanitiza (muito importante para segurança!)
    $primeiro_nome = $conn->real_escape_string($_POST['primeiro_nome']);
    $segundo_nome = $conn->real_escape_string($_POST['segundo_nome']);
    $telefone = $conn->real_escape_string($_POST['telefone']); // Telefone é opcional, pode vir vazio

    // Prepara a query SQL para inserção
    $sql = "INSERT INTO usuarios (primeiro_nome, segundo_nome, telefone) VALUES ('$primeiro_nome', '$segundo_nome', '$telefone')";

    // Executa a query
    if ($conn->query($sql) === TRUE) {
        // Redireciona de volta para o formulário com uma mensagem de sucesso
        header("Location: cadastro.html?status=success");
        exit();
    } else {
        // Redireciona de volta para o formulário com uma mensagem de erro
        header("Location: cadastro.html?status=error&msg=" . urlencode($conn->error));
        exit();
    }
}

// Fecha a conexão
$conn->close();

?>