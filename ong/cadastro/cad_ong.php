<?php
    session_start();
    include_once("php_util/Conexao.php");
    include_once("php_util/cnpj.php");
    try{
        $nome = $_POST['nome_ong'];
        $cnpj = $_POST['cnpj_ong'];
        if(!validaCNPJ($cnpj)){
           echo "<script>alert('CNPJ inválidos');</script>";
           throw new Exception("CNPJ inválido");
        }
        $senha = $_POST['senha_ong'];
        $site = $_POST['site_ong'];
        $url = $_POST['url_ong'];

        mysqli_begin_transaction($conn);
        $sql_ong = "INSERT INTO ongs(nomeOng, cnpj, senha, site) VALUES('$nome', '$cnpj','$senha','$site')";
        $resposta_ong = mysqli_query($conn, $sql_ong);

        if($resposta_ong){
            $id_novo = mysqli_insert_id($conn);
            $sql_url = "INSERT INTO urls(url, idOng) VALUES ('$url', '$id_novo')";
            $resposta_url = mysqli_query($conn, $sql_url);
            mysqli_commit($conn);
            echo "Transação concluída com sucesso!";
        } else {
            mysqli_rollback($conn);
            echo "Erro ao cadastrar ong: " . mysqli_error($conn);
        }
    } catch (Exception $e){
        mysqli_rollback($conn);
        echo "<script>alert('CNPJ inválido " . $e->getMessage() . "');</script>";
        header("Location: cadastro_ong.html"); // Redirecione de volta para a página de cadastro
        exit();
    }
    mysqli_close($conn);
?>