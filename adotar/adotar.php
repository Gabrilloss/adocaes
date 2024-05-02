<?php
include_once("../util_php/animais.php");
header('Content-Type: text/html; charset=UTF-8');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <link rel="stylesheet" href="adotar.css">

    <title>Adotar</title>
</head>
<body>
    <header id="siteHeader">
        <nav id="mainMenu">
            <a href="../home.php"><img src="../imagens\logo.png" class="logo"></a>
            <a href="../home.php">Página Inicial</a>
            <a href="adotar.php">Adotar</a>
            <a href="../home.php#como-adotar">Como Adotar</a>
            <a href="../home.php#porque-adotar">Porque Adotar</a>
            <a href="../ong/view/ongs.php">ONGs Parceiras</a>
            <nav class="profile-nav">
                <a href="#" onclick="toggleProfile()"><span id ='person' class="material-symbols-outlined"> person</span> Perfil</a>
            </nav>
        </nav>
    </header>

    <div class="overlay" id="overlay" onclick="closeProfile()" style="display:none;"></div>

    <div class="profile-sidebar" id="profileSidebar" style="right: -100%;">
        <div class="close-button" onclick="closeProfile()">X</div>
        <div class="profile-content-top">
            <div class="profile-picture-container">
                <input type="file" id="uploadFile" style="display: none;" accept="image/*" onchange="mostrarImagemSelecionada()">
                <img src="#" id="profilePicture" alt="Foto do Perfil">
            </div>
            <div class ="perfil-text">
            <h2>Nome Completo</h2>
            <h3>Adotante</h3>
            <label for="uploadFile" class="alterar-foto">Alterar Foto</label>
            </div>
        </div>
        <div class="topicos-perfil">
            
            <label for="sobre-mim">Sobre Mim</label>
            <div class="input-botao">
            <textarea maxlength="120" placeholder="Fale sobre você..." readonly></textarea>
            <span id = 'stylus' class="material-symbols-outlined">stylus</span>
            </div>

            
            <label for="email">E-mail</label>
            <div class="input-botao">
            <input type="email" id="email" name="email" readonly>
            <span id = 'stylus' class="material-symbols-outlined">stylus</span>
            </div>

            
            <label for="telefone">Telefone</label>
            <div class="input-botao">
            <input type="telefone" id="telefone" name="telefone" readonly>
            <span id = 'stylus' class="material-symbols-outlined">stylus</span>
            </div>

            
            <label for="cpf">CPF</label>
            <div class="input-botao">
            <input type="cpf" id="cpf" name="cpf" readonly>
            </div>

            <div class="botoes-perfil">
            <button onclick="openPopup()" class="botao-alterar-senha">Alterar Senha</button>
            <a ><button class="botao-sair" onclick="logout()">Sair</button></a>
            </div>

            <!--POPUP-->
            <div id="popup" class="popup">
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
    </div>

    <main>

    <section id="animais-section">

        <div class="animais-top">

            <h1>Conheça Nossos Animais <span class="material-symbols-outlined">pets</span></h1>
            
            <div class="filtro-container">

            <input type="text" id="barra-pesquisa" placeholder="Pesquisar por gênero, raça, cor, cidade..." class="barra-pesquisa" onkeydown="handleEnterKey(event)">


                <div class="filtro-lista" onmouseover="mostrarFiltro()" onmouseout="esconderFiltro()">
                    <p><span class="material-symbols-outlined" id="filtrinho">filter_alt</span>Filtrar</p>
                    <ul class="filtro-opcoes">
                        <li>
                            <input type="checkbox" id="filtro-gato" name="filtro-gato" onchange="aplicarFiltro()">
                            <label for="filtro-gato">Gato</label>
                        </li>
                        <li>
                            <input type="checkbox" id="filtro-cachorro" name="filtro-cachorro" onchange="aplicarFiltro()">
                            <label for="filtro-cachorro">Cachorro</label>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
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
                echo '<img src="'.(($animal['url'] !== "") ? $animal['url'] : (($animal['tipo'] === 'C') ? '../Imagens/cachorro2.jpeg' : '../Imagens/gato6.jpeg')).
                '" alt="'.(($animal['tipo'] === 'C') ? 'Cachorro' : 'Gato').'">';
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

</main>

    <footer>
        <p>&copy; 2024 Adocães - Todos os direitos reservados</p>
    </footer>
    <script src="scriptadotar.js"></script>
</body>
</html>
