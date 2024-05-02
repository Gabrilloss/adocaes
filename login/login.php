<?php 
session_start();
include_once("../util_php/Conexao.php");
header('Content-Type: text/html; charset=UTF-8');

$username = $_POST['username'];
$senha = $_POST['password'];

login($conn, $username, $senha);

function isEmail($username){
    $regex = '/^\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Z|a-z]{2,}\b$/';
    if (preg_match($regex, $username)) {
        return true;
    } else {
        return false;
    }
}

function login($conn, $username, $senha){
    try {
if(isEmail($username)){
            // EMAIL
            $script_recupera_adotante = 
                "SELECT idAdotantes, email, senha, nomeAdotante, CPF
                 FROM adotantes 
                 WHERE  email = '$username' 
                 AND senha = '$senha'";
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
                    'nome' => $nome,
                    'email' => $email,
                    'cpf' => $cpf,
                    'imagem' => $imagem,
                    'telefone' => $telefone
                );
                
                $info_usuario_json = json_encode($info_usuario);

                echo "<script>console.log('[SUCESSO] usuário encontrado: $idAdotantes')</script>";
                echo "<script>localStorage.setItem('id_adotante', $idAdotantes);</script>";
                echo "<script>localStorage.setItem('info_usuario', '$info_usuario_json');</script>";
                echo "<script> window.location.href = '../home.php';</script>";
            }
        } else {
            // CNPJ
            $script_recupera_ong = 
            "SELECT idong, cnpj, senha, nomeOng, site
             FROM ongs 
             WHERE cnpj = '$username' 
             AND senha = '$senha'";
            $result = mysqli_query($conn, $script_recupera_ong);
            if(mysqli_num_rows($result) == 0){
                throw new Exception("Email e/ou Senha incorreto!");
            } else {
                $row = mysqli_fetch_assoc($result);
                $idOng = $row['idong'];
                $nome = $row['nomeOng'];
                $site = $row['site'];
                $cnpj = $row['cnpj'];
                $telefone = retornaTelefoneOng($conn, $idOng);
                $info_Ong = array(
                    'nome' => $nome,
                    'site' => $site,
                    'cnpj' => $cnpj,
                    'telefone' => $telefone
                );
                $info_ong_json = json_encode($info_Ong);
                echo "<script>console.log('[SUCESSO] usuário encontrado: $idOng')</script>";
                echo "<script>localStorage.setItem('id_ong', $idOng);</script>";
                echo "<script>localStorage.setItem('info_ong', '$info_ong_json');</script>";
                echo "<script> window.location.href = '../home.php';</script>";
            }
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
function retornaTelefoneOng($conn, $idOng){
    $script_urls = 
    "SELECT idTelefone, numero
    FROM telefone 
    WHERE  idOng = '$idOng'";

    $result = mysqli_query($conn, $script_urls);
    
    if(mysqli_num_rows($result) == 0){ return null; }
    $row = mysqli_fetch_assoc($result);
    return $row['numero'];
}
?>
