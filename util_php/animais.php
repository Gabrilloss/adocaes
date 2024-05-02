<?php
include_once("Conexao.php");
header('Content-Type: text/html; charset=UTF-8');

$chamar_animais = "SELECT * FROM animais";
$result_animais = mysqli_query($conn, $chamar_animais);

$chamar_ongs = "SELECT * FROM ongs";
$result_ongs = mysqli_query($conn, $chamar_ongs);

$chamar_urls = "SELECT * FROM urls";
$result_urls = mysqli_query($conn, $chamar_urls);

$chamar_endereco = "SELECT * FROM endereco";
$result_endereco = mysqli_query($conn, $chamar_endereco);

$chamar_telefone = "SELECT * FROM telefone";
$result_telefone = mysqli_query($conn, $chamar_telefone);
 

// Arrays
$ongs = [];
$endereco = [];
$telefone = [];
$animais = [];
$urls = [];

// ONGS
while($row_ongs = mysqli_fetch_assoc($result_ongs)) {
     $ongs[] = [
        'idONG' => (String) $row_ongs['idONG'],
        'nome' => (String) $row_ongs['nomeOng'],
        'cnpj' => (String) $row_ongs['CNPJ'],
        'site' => (String) $row_ongs['site'],
        'senha' => (String) $row_ongs['senha']
     ];
 }

// ENDERECO
while($row_endereco = mysqli_fetch_assoc($result_endereco)) {
     $endereco[] = [
        'idEndereco' => (String) $row_endereco['idEndereco'],
        'bairro' => (String) $row_endereco['bairro'],
        'numero' => (String) $row_endereco['numero'],
        'rua' => (String) $row_endereco['rua'],
        'cidade' => (String) $row_endereco['cidade'],
        'estado' => (String) $row_endereco['estado'],
        'cep' => (String) $row_endereco['cep'],
        'adotante' => (String) $row_endereco['idAdotantes'],
        'ong' => (String) $row_endereco['idONG']
     ];
 }

// TELEFONE
while($row_telefone = mysqli_fetch_assoc($result_telefone)) {
    $telefone[] = [
        'idTelefone' => (String) $row_telefone['idTelefone'],
        'numero' => (String) $row_telefone['numero'],
        'adotante' => (String) $row_telefone['idAdotantes'],
        'ong' => (String) $row_telefone['idONG']
    ];
}

// URLS - Para os animais
while($row_url = mysqli_fetch_assoc($result_urls)) {
    $urls[] = [
        'idURL' => (String) $row_url['idURL'],
        'url' => (String) $row_url['url'],
        'animal' => (String) $row_url['idAnimais']
    ];
}

// ANIMAIS - (com ONG, endereco da ong, site da ong, telefone da ong)
$contador = 0;
while($row_animais = mysqli_fetch_assoc($result_animais)) {
    $nomeONG = "";
    $enderecoONG = "";
    $telefoneONG = "";

    $urlAnimal = "";

    // Todas as infos que preciso para completar dependem do ID da ONG
    if ($row_animais['ONGs_idONG'] !== NULL) {
        foreach ($ongs as $auxN => $subarray_ongs) {
            if (in_array($row_animais['ONGs_idONG'], $subarray_ongs)) {
                $indiceN = $auxN; // Saber o indice encontrado
                break;
            }
        }
        $nomeONG = (String) $ongs[$auxN]['nome'];

        foreach($endereco as $auxE => $subarray_endereco) {
            if ($row_animais['ONGs_idONG'] === $subarray_endereco['ong']) {
                $indiceE = $auxE; // Saber o indice encontado
                break;
            }
        }
        $cidadeONG = (String) $endereco[$auxE]['cidade'];
        $estadoONG = (String) $endereco[$auxE]['estado'];

        foreach($telefone as $auxT => $subarray_telefone) {
            if ($row_animais['ONGs_idONG'] === $subarray_telefone['ong']) {
                $indiceT = $auxT; // Saber o indice encontrado
                break;
            }
        }
        $telefoneONG = (String) $telefone[$auxT]['numero'];
    } else {
        //$nomeONG = (String) $row_animais['ONGs_idONG'];
        $nomeONG = "-";
        $cidadeONG = "*";
        $estadoONG = "*";
        $telefoneONG = "-";
    }

    // Achar a imagem que pertence ao animal
    foreach($urls as $auxU => $subarray_url) {
        if ($subarray_url['animal'] !== NULL) {
            if ($row_animais['idAnimais'] === $subarray_url['animal']) {
                $urlAnimal = (String) $urls[$auxU]['url'];
            }
        } else {
            $urlAnimal = "";
        }
    }
    $animais[] = [
        'id_Animal' => (String) $row_animais['idAnimais'],
        'nome' => (String) $row_animais['nomeAnimal'],
        'raca' => (String) $row_animais['raca'],
        'nascimento' => (String) $row_animais['dataNascimento'],
        'genero' => (String) $row_animais['genero'],
        'porte' => (String) $row_animais['porte'],
        'cor' => (String) $row_animais['cor'],
        'castrado' => (String) $row_animais['castrado'],
        'vacinas' => (String) $row_animais['vacinas'],
        'obs' => (String) $row_animais['observacao'],
        'tipo' => (String) $row_animais['tipo'],
        'ong' => (String) $nomeONG,
        'cidade' => (String) $cidadeONG,
        'estado' => (String) $estadoONG,
        'telefone' => (String) $telefoneONG,
        'url' => (String) $urlAnimal
    ];
}
?>