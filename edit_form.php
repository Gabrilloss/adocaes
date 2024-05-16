<?php
include_once("util_php/Conexao.php");
include "util_php/info_usuario.php";

// Receber dados do formulário
$idAdotantes = $_POST['idAdotante'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$cpf = $_POST['cpf'];

// Preparar SQL para atualização

echo "<script>console.log('[UPDATE]: $email, $telefone, $cpf')</script>";

$sql = "UPDATE adotantes SET email = '$email', cpf = '$cpf' WHERE idAdotantes = $idAdotantes";
$sql_telefone = "UPDATE telefone SET numero = '$telefone' WHERE idAdotantes = $idAdotantes";

// Verificar se a execução foi bem-sucedida
if ($conn->query($sql) === TRUE) {
    if ($conn->query($sql_telefone) === TRUE) { 
        buildInfo($conn, $email);
        echo "<script> window.location.href = 'home.php';</script>";
        echo "<script>console.log('[UPDATE-SUCESSO]')</script>";
    };
} else {
    echo "Erro ao atualizar o registro: " . $conn->error;
}

// Fechar a conexão
$conn->close();
?>
