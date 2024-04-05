<?php
include_once("Conexao.php");

$nome = $_POST['nomeAnimal'];
$raca = $_POST['raca'];
$dataNascimento = $_POST['dataNascimento'];
$genero = $_POST['genero'];
$porte = $_POST['porte'];
$cor = $_POST['cor'];
$castrado = $_POST['castrado'];
$vacinas = $_POST['vacinas'];
$observacao = $_POST['observacao'];
$ONGs_idONG = $_POST['ONGs_idONG'];
$url = $_POST['URLs_idURL'];

mysqli_begin_transaction($conn);

$sql_url = "INSERT INTO urls(url) VALUES ('$url')";
$resposta_url = mysqli_query($conn, $sql_url);

if ($resposta_url) {
    $novo_id = mysqli_insert_id($conn);

    $sql_animal = "INSERT INTO animais (nomeAnimal, raca, dataNascimento, genero, porte, cor, castrado, vacinas, observacao, ONGs_idONG, URLs_idURL) VALUES ('$nome', '$raca', '$dataNascimento', '$genero', '$porte', '$cor', '$castrado', '$vacinas', '$observacao', '$ONGs_idONG', '$novo_id')";
    $resposta_animal = mysqli_query($conn, $sql_animal);

    if ($resposta_animal) {
        mysqli_commit($conn);
        echo "Transação concluída com sucesso!";
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