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
                "SELECT idAdotantes, email, senha 
                 FROM adotantes 
                 WHERE  email = '$username' 
                 AND senha = '$senha'";
            $result = mysqli_query($conn, $script_recupera_adotante);
            if(mysqli_num_rows($result) == 0){
                throw new Exception("Email e/ou Senha incorreto!");
            } else {
                $row = mysqli_fetch_assoc($result);
                $idAdotantes = $row['idAdotantes'];
                echo "<script>console.log('[SUCESSO] usuário encontrado: $idAdotantes')</script>";
                echo "<script>localStorage.setItem('id_adotante', $idAdotantes);</script>";
                echo "<script> window.location.href = '../home.html';</script>";
            }
        } else {
            // CNPJ
            $script_recupera_ong = 
            "SELECT idong, cnpj, senha 
             FROM ongs 
             WHERE cnpj = '$username' 
             AND senha = '$senha'";
            $result = mysqli_query($conn, $script_recupera_ong);
            if(mysqli_num_rows($result) == 0){
                throw new Exception("Email e/ou Senha incorreto!");
            } else {
                $row = mysqli_fetch_assoc($result);
                $idOng = $row['idong'];
                echo "<script>console.log('[SUCESSO] usuário encontrado: $idOng')</script>";
                echo "<script>localStorage.setItem('id_ong', $idOng);</script>";
                echo "<script> window.location.href = '../home.html';</script>";
            }
        }
    } catch (Exception $e) {
        header("Location: login.html?error=1");
        exit();
    }
}
?>
