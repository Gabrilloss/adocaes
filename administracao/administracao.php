<?php
include_once("../util_php/animais.php");
header('Content-Type: text/html; charset=UTF-8');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="administracao.css">
    <title>Administração</title>
</head>

<body>
    <header id="siteHeader">
        <nav id="mainMenu">
            <a href="../home.php">
            <img src="../imagens\logo.png" class="logo">
            </a>
            <a href="../home.php">Página Inicial</a>
            <a href="../adotar/adotar.php">Adotar</a>
            <a href="../home.html#como-adotar">Como Adotar</a>
            <a href="../home.html#porque-adotar">Porque Adotar</a>
            <a href="../ong/view/ongs.html">ONGs Parceiras</a>
            <nav class="profile-nav">
                <a href="administracao.php"><span id ='person' class="material-symbols-outlined">assignment</span> Administrar</a>
            </nav>
        </nav>
    </header>

    <section class="tela-adm">

    <div class="container-perfil">

        <div class="perfil-top">
        <h1><span class="material-symbols-outlined"> person</span> Perfil da ONG</h1>
        <span class="nome" id="nome-ong">Nome da Ong</span>
        </div>
        <br>
        <label for="cnpj">CNPJ</label>
        <div class="input-botao">
        <input type="cnpj" id="cnpj" name="cnpj" class="centra">
        <span class="material-symbols-outlined">stylus</span>
        </div>

            
        <label for="telefone">Telefone</label>
        <div class="input-botao">
        <input type="telefone" id="telefone" name="telefone" class="centra">
        <span class="material-symbols-outlined">stylus</span>
        </div>

            
        <!--<label for="responsavel">Responsável</label>
        <div class="input-botao">
        <input type="responsavel" id="responsavel" name="responsavel">
        </div> -->

        <label for="sobre-nos">Sobre nós</label>
        <div class="input-botao">
        <textarea maxlength="80" placeholder="Fale brevemente sobre a sua instituição..."></textarea>
        <span class="material-symbols-outlined">stylus</span>
        <!--<span class="material-symbols-outlined">save</span> utilizar esse quando estiver habilitado para edição-->
        </div>

        <label for="site">Meu site</label>
        <div class="input-botao">
        <input type="site" id="site" name="site" class="centra">
        </div>

        <div class="botoes-perfil">
        <button onclick="openPopup()" class="botao-alterar-senha">Alterar Senha</button>
        <a href="../home.html"><button class="botao-sair" onclick="logout()">Sair</button></a>
        </div>

        <!--POPUP-->
        <div id="popup" class="popup">
            <div class="popup-content">
                <form class="formulario">
                    <span onclick="closePopup()" style="float:right;cursor:pointer;">&times;</span>
                    <h1>Redefinir Senha</h1>
                    <div class="input-group">
                        <label for="username">Senha Atual:</label>
                        <input type="text" id="username" name="username" required>
                        <label for="password">Nova Senha:</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <button type="submit">Salvar</button>
                </form>
            </div>
        </div>

    </div>

    <div class="container-animais">
    <div class ="todos-animais">
            <?php
            foreach ($animais as $animal) {
                echo '<div class="animal-card corresponde-pesquisa">';
                echo '<img src="'.(($animal['url'] !== "") ? $animal['url'] : (($animal['tipo'] === 'C') ? '../Imagens/cachorro2.jpeg' : '../Imagens/gato6.jpeg')).
                '" alt="'.(($animal['tipo'] === 'C') ? 'Cachorro' : 'Gato').'">';
                echo '<p class="nome-animal">'. $animal['nome'] .'</p>';
                echo '<p>Gênero: '. (($animal['genero'] === 'F') ? 'Fêmea' : 'Macho') .'</p>';
                echo '<p>Cidade: '. $animal['cidade'] .' - '. $animal['estado'] .'</p>';
                echo '<div class="botao-mais-detalhes">';
                echo '<button onclick="mostrarDetalhes(\'popup'. $animal["id_Animal"] . '\')">Mais Detalhes</button>';
                echo '</div>';
                echo '</div>';
            ?>
            <?php
                echo '<div id="popup'.$animal["id_Animal"] .'" class="popup">';
                echo '<div class="popup-content">';
                echo '<span class="fechar" onclick="fecharDetalhes('.'\'popup'. $animal["id_Animal"] . '\')">&times;</span>';
                echo '<div class="imagem-animal">';
                echo '<img src="'.$animal['url'].'" alt="Imagem do Animal">';
                echo '</div>';
                echo '<p>Nome: '. $animal['nome'] .'</p>';
                echo '<p>Raça: '. $animal['raca'] .'</p>';
                echo '<p>Data de nascimento: '. $animal['nascimento'] .'</p>';
                echo '<p>Genero: '.(($animal['genero'] === 'F') ? 'Femea' : 'Macho').'</p>';
                echo '<p>Porte: '.(($animal['porte'] === 'P') ? 'Pequeno' : (($animal['porte'] === 'M') ? 'Médio' : 'Grande')).'</p>';
                echo '<p>Cor: '. $animal['cor'] .'</p>';
                echo '<p>Castrado: '.(($animal['castrado'] === '1') ? 'Sim' : 'Não').'</p>';
                echo '<p>Vacinas: '. $animal['vacinas'] .'</p>';
                echo '<p>Observação: '. $animal['obs'] .'</p>';
                echo '<p>ONG: '. $animal['ong'] .'</p>';
                echo '<p>Cidade: '. $animal['cidade'] .'</p>';
                echo '<p>Estado: '. $animal['estado'] .'</p>';
                echo '<p>Telefone: '. $animal['telefone'] .'</p>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </section>
    <script src="scriptadm.js"></script>
    <script src="../local_storage.js"></script>
</body>