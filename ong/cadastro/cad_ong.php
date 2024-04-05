<?php
    session_start();
    include_once("../../util_php/Conexao.php");
    include_once("../../util_php/cnpj.php");
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
        $telefone = $_POST['num_telefone'];
        $bairro = $_POST['bairro_ong'];
        $numero = $_POST['num_ong'];
        $cidade = $_POST['cidade_ong'];
        $rua = $_POST['rua_ong'];
        $estado = $_POST['estado_ong'];
        $cep = $_POST['cep_ong'];

        mysqli_begin_transaction($conn);
        $sql_ong = "INSERT INTO ongs(nomeOng, cnpj, senha, site) VALUES('$nome', '$cnpj','$senha','$site')";
        $resposta_ong = mysqli_query($conn, $sql_ong);

        if($resposta_ong){
            $id_novo = mysqli_insert_id($conn);
            $sql_url = "INSERT INTO urls(url, idOng) VALUES ('$url', '$id_novo')";
            $resposta_url = mysqli_query($conn, $sql_url);
            if($resposta_url){
                $sql_telefone = "INSERT INTO telefone(numero, idAdotantes, idONG) VALUES ('$telefone', null,  '$id_novo')";
                $resposta_telefone = mysqli_query($conn, $sql_telefone);
                if($resposta_telefone){
                    $sql_endereco = "INSERT INTO endereco(bairro, numero, rua, cidade, estado, cep, idAdotantes, idONG) VALUES ('$bairro', '$numero','$rua', '$cidade', '$estado', '$cep' , null, '$id_novo')";
                    $resposta_endereco = mysqli_query($conn, $sql_endereco);
                    if($resposta_endereco){
                        mysqli_commit($conn);
                        echo "Ong cadastrada com sucesso!";
                    }else{
                        mysqli_rollback($conn);
                        echo "Erro ao cadastrar ong: " . mysqli_error($conn);
                    }
                }else {
                    mysqli_rollback($conn);
                    echo "Erro ao cadastrar ong: " . mysqli_error($conn);
                    }
            }else {
                mysqli_rollback($conn);
                echo "Erro ao cadastrar ong: " . mysqli_error($conn);
                }

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