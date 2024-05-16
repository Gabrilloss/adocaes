<?php
function buildInfo($conn, $username){
    try {
        $script_recupera_adotante = 
            "SELECT idAdotantes, email, senha, nomeAdotante, CPF
                FROM adotantes 
                WHERE  email = '$username'";
        $result = mysqli_query($conn, $script_recupera_adotante);
        if(mysqli_num_rows($result) == 0){
            throw new Exception("Email e/ou Senha incorreto!");
        } else {
            $row = mysqli_fetch_assoc($result);
            $idAdotantes = $row['idAdotantes'];
            $imagem = retornaUrl($conn, $idAdotantes);
            $nome = $row['nomeAdotante'];
            $email = $row['email'];
            $telefone = retornaTelefone($conn, $idAdotantes);
            $cpf = $row['CPF'];

            $info_usuario = array(
                'id' => $idAdotantes,
                'nome' => $nome,
                'email' => $email,
                'cpf' => $cpf,
                'imagem' => $imagem,
                'telefone' => $telefone
            );
            
            $info_usuario_json = json_encode($info_usuario);

            echo "<script>console.log('[SUCESSO] usuário encontrado: $idAdotantes')</script>";
            echo "<script>localStorage.clear();</script>";
            echo "<script>localStorage.setItem('id_adotante', $idAdotantes);</script>";
            echo "<script>localStorage.setItem('info_usuario', '$info_usuario_json');</script>";
        }
    } catch (Exception $e) {
        header("Location: login.html?error=1");
        exit();
    }
}


function retornaUrl($conn, $idAdotante){
    $script_urls = 
    "SELECT idUrl, url
    FROM urls 
    WHERE  idAdotantes = '$idAdotante'";

    $result = mysqli_query($conn, $script_urls);
    
    if(mysqli_num_rows($result) == 0){ return null; }
    $row = mysqli_fetch_assoc($result);
    return $row['url'];
}


function retornaTelefone($conn, $idAdotante){
    $script_urls = 
    "SELECT idTelefone, numero
    FROM telefone 
    WHERE  idAdotantes = '$idAdotante'";

    $result = mysqli_query($conn, $script_urls);
    
    if(mysqli_num_rows($result) == 0){ return null; }
    $row = mysqli_fetch_assoc($result);
    return $row['numero'];
}

?>