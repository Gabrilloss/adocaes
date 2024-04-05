<?php
session_start();
include_once("Conexao.php");
include_once("cpf.php");

try {
    $nome = $_POST['nome_usuario'];
    $cpf = $_POST['cpf_usuario'];
    if(!validaCPF($cpf)){
        throw new Exception("CPF inválido");
    }
    $email = $_POST['email_usuario'];
    $senha = $_POST['senha_usuario'];
    $telefone = $_POST['num_telefone'];
    $bairro = $_POST['bairro_usuario'];
    $numero = $_POST['num_adotante'];
    $cidade = $_POST['cidade_adotante'];
    $rua = $_POST['rua_usuario'];
    $estado = $_POST['estado_usuario'];
    $cep = $_POST['cep_usuario'];

    mysqli_begin_transaction($conn);
    $sql_adotante = "INSERT INTO adotantes(nomeAdotante, cpf, email, senha) VALUES('$nome', '$cpf','$email','$senha')";
    $resposta_adotante = mysqli_query($conn, $sql_adotante);

    if($resposta_adotante){
        $id_novo = mysqli_insert_id($conn);

        $sql_endereco = "INSERT INTO endereco(bairro, numero, rua, cidade, estado, cep, idAdotantes, idONG) VALUES ('$bairro', '$numero','$rua', '$cidade', '$estado', '$cep', '$id_novo', null)";
        $resposta_endereco = mysqli_query($conn, $sql_endereco);

        if($resposta_endereco){
            $sql_telefone = "INSERT INTO telefone(numero, idAdotantes, idONG) VALUES ('$telefone', '$id_novo', null)";
            $resposta_telefone = mysqli_query($conn, $sql_telefone);

            if($resposta_telefone){
                mysqli_commit($conn);
                echo "Transação concluída com sucesso!";
            } else {
                mysqli_rollback($conn);
                echo "Erro ao inserir animal: " . mysqli_error($conn);
            }
        }else {
            mysqli_rollback($conn);
            echo "Erro ao cadastrar adotante: " . mysqli_error($conn);
        }
    }else {
        mysqli_rollback($conn);
        echo "Erro ao cadastrar adotante: " . mysqli_error($conn);
    }
} catch (Exception $e) {
    mysqli_rollback($conn);
    $_SESSION['error_message'] = $e->getMessage(); // Defina a mensagem de erro na sessão
    header("Location: cadastro_usuario.php"); // Redirecione de volta para a página de cadastro
    exit();
}
mysqli_close($conn);
?>