<?php
include_once("../util_php/Conexao.php");
header('Content-Type: text/html; charset=UTF-8');
$nome = $_POST['nomeAnimal'];
$raca = $_POST['raca'];
$dataNascimento = $_POST['dataNascimento'];
$genero = $_POST['genero'];
$porte = $_POST['porte'];
$cor = $_POST['cor'];
$castrado = $_POST['castrado'];
$vacinas = $_POST['vacinas'];
$observacao = $_POST['observacao'];
$tipo = $_POST['tipo'];
$ONGs_idONG = $_POST['id_ong'];
$url = $_POST['URLs_idURL'];

mysqli_begin_transaction($conn);

$sql_animal = "INSERT INTO animais (nomeAnimal, raca, dataNascimento, genero, porte, cor, castrado, vacinas, observacao, tipo, ONGs_idONG) VALUES ('$nome', '$raca', '$dataNascimento', '$genero', '$porte', '$cor', '$castrado', '$vacinas', '$observacao', '$tipo','$ONGs_idONG')";
$resposta_animal = mysqli_query($conn, $sql_animal);

if ($resposta_animal) {
    $novo_id = mysqli_insert_id($conn);
    $sql_url = "INSERT INTO urls(url, idAnimais) VALUES ('$url', '$novo_id')";
    $resposta_url = mysqli_query($conn, $sql_url);
    if ($resposta_url) {
        mysqli_commit($conn);
        echo "Transação concluída com sucesso!";
        echo "<script> window.location.href = '../administracao/administracao.html';</script>";
    } else {
        mysqli_rollback($conn);
        echo "Erro ao inserir animal: " . mysqli_error($conn);
    }
} else {
    mysqli_rollback($conn);
    echo "Erro ao inserir URL: " . mysqli_error($conn);
}

mysqli_close($conn);
?>