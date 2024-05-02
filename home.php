<?php
include_once("util_php/animais.php");
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
    <link rel="stylesheet" href="home.css">
    <title>Home</title>
</head>

<body>
    <header id="siteHeader">
        <nav id="mainMenu">
            <a href="home.php">
                <img src="imagens\logo.png" class="logo">
            </a>
            <a href="home.html">Página Inicial</a>
            <a href="adotar/adotar.php">Adotar</a>
            <a href="#como-adotar">Como Adotar</a>
            <a href="#porque-adotar">Porque Adotar</a>
            <a href="ong/view/ongs.html">ONGs Parceiras</a>
            <div class="profile-nav">
                <div class="navbar-cadastro">
                    <a href="/adocaes/adotante/cadastro_usuario.html">Cadastre-se</a>
                </div>
                <div class="navbar-adm">
                    <a href="/adocaes/administracao/administracao.html" ><span id ='person' class="material-symbols-outlined">assignment</span> Administração</a>
                </div>
                <div class="navbar-perfil">
                    <a onclick="toggleProfile()"><span id ='person' class="material-symbols-outlined"> person</span>Perfil</a>
                </div>
            </div>
        </nav>
    </header>    

    <div class="overlay" id="overlay" onclick="closeProfile()" style="display:none;"></div>

    <div class="profile-sidebar" id="profileSidebar" style="right: -100%;">
        <div class="close-button" onclick="closeProfile()">X</div>
        <div class="profile-content-top">
            <div class="profile-picture-container">
                <input type="file" id="uploadFile" style="display: none;" accept="image/*" onchange="mostrarImagemSelecionada()">
                <img id="profilePicture" alt="Imagem do Animal">
            </div>
            <div class ="perfil-text">
                <span class = "nome"></span>
                <br>
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

    <!-- Animal Carrossel -->
    <section id="animais-disponiveis-horizontal">
        <div class="banner" id="primeiro-banner">
            <h1>Adote um Amigo</h1>
            <p>Encontre seu companheiro perfeito e faça a diferença na vida de um animal.</p>
        </div>
        <div class="carrossel">
            <?php
            for ($i = 0; $i <= 12; $i++) {
                echo '<div class="animal-carrossel">';
                echo '<img src="'.(($animais[$i]['url'] !== "") ? $animais[$i]['url'] : (($animais[$i]['tipo'] === 'C') ? 'Imagens/cachorro1.jpeg' : 'Imagens/gato1.jpeg')).
                '" alt="'.(($animais[$i]['tipo'] === 'C') ? 'Cachorro' : 'Gato').'">';
                echo '<p class="nome-animal">'. $animais[$i]['nome'] .'</p>';
                echo '<p>Gênero: '.(($animais[$i]['genero'] === 'F') ? 'Femea' : 'Macho').'</p>';
                echo '<p>Cidade: '. $animais[$i]['cidade'] .' - '. $animais[$i]['estado'] .'</p>';
                echo '<div class="botao-mais-detalhes">';
                echo '<button onclick="mostrarDetalhes('.'\'popup'. $animais[$i]["id_Animal"] . '\')">Mais Detalhes</button>';
                echo '</div>';
                echo '</div>';
            ?>
            <?php
                echo '<div id="popup'.$animais[$i]["id_Animal"] .'" class="popup">';
                echo '<div class="popup-content">';
                echo '<span class="fechar" onclick="fecharDetalhes('.'\'popup'. $animais[$i]["id_Animal"] . '\')">&times;</span>';
                echo '<div class="imagem-animal">';
                echo '<img src="'.(($animais[$i]['url'] !== "") ? $animais[$i]['url'] : (($animais[$i]['tipo'] === 'C') ? 'Imagens/cachorro1.jpeg' : 'Imagens/gato1.jpeg')).
                '" alt="'.(($animais[$i]['tipo'] === 'C') ? 'Cachorro' : 'Gato').'">';
                echo '</div>';
                echo '<p>Nome: '. $animais[$i]['nome'] .'</p>';
                echo '<p>Raça: '. $animais[$i]['raca'] .'</p>';
                echo '<p>Data de nascimento: '. $animais[$i]['nascimento'] .'</p>';
                echo '<p>Genero: '.(($animais[$i]['genero'] === 'F') ? 'Femea' : 'Macho').'</p>';
                echo '<p>Porte: '.(($animais[$i]['porte'] === 'P') ? 'Pequeno' : (($animais[$i]['porte'] === 'M') ? 'Médio' : 'Grande')).'</p>';
                echo '<p>Cor: '. $animais[$i]['cor'] .'</p>';
                echo '<p>Castrado: '.(($animais[$i]['castrado'] === '1') ? 'Sim' : 'Não').'</p>';
                echo '<p>Vacinas: '. $animais[$i]['vacinas'] .'</p>';
                echo '<p>Observação: '. $animais[$i]['obs'] .'</p>';
                echo '<p>ONG: '. $animais[$i]['ong'] .'</p>';
                echo '<p>Cidade: '. $animais[$i]['cidade'] .'</p>';
                echo '<p>Estado: '. $animais[$i]['estado'] .'</p>';
                echo '<p>Telefone: '. $animais[$i]['telefone'] .'</p>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
        
        <span class="material-symbols-outlined" id="prevBtn">arrow_back_ios</span>
        <span class="material-symbols-outlined" id="nextBtn">arrow_forward_ios</span>

        <a href="adotar/adotar.php"><button class="botao-ver-mais">Ver Mais</button></a>
    </section>
    <!-- FIM CAROSSEL -->

    <section id="como-adotar">
        <div class="banner">
            <h1>Como Adotar</h1>
            <p>Descubra como é fácil adotar seu novo amigo.</p>
        </div>
        <div class="idade-docs">
            <div class="texto-como-adotar">
                <h2>Idade e documentos</h2>          
                <p>Animais de estimação só podem ser adotados por pessoas com idade igual ou superior a 21 anos. Mesmo assim, algumas instituições querem saber se os demais integrantes da família estão de acordo com a adoção do animal. Um conflito familiar pode resultar em mais um abandono ou maus tratos.</p>
                <p>Para formalizar a adoção é necessário apresentar a cédula de identidade, CPF e o comprovante de residência. Com isso, a entidade controla os processos de adoção e, como muitas delas implantam microchips nos animais, fica mais fácil localizar o adotante caso o animal seja encontrado nas ruas novamente.</p>
            </div>
            <img src="Imagens/modelo1.jpeg">
        </div>
        <div class="idade-docs">
            <img src="Imagens/modelo2.jpeg">
            <div class="texto-como-adotar">
                <h2>Responsabilidades e Entrevista</h2>          
                <p>Outra exigência é a assinatura de um termo de responsabilidade, por meio do qual o adotante assume o compromisso de cuidar bem do animal. Ao assinar esse documento, o adotante está sujeito às penalidades legais, em caso de maus tratos e abandono do animal.</p>
                <p>A entrevista faz parte do processo de adoção em algumas entidades. O objetivo é avaliar se a pessoa interessada realmente tem condições para cuidar do animal: alimentação, assistência veterinária, adestramento, proteção, entre outros cuidados.</p>
            </div>
        </div>
        <div class="idade-docs">
            <div class="texto-como-adotar">
                <h2>Taxas</h2>          
                <p>Algumas instituições cobram uma taxa de adoção para custear o microchip de identificação do animal e o Registro Geral de Animais. Por isso, antes de tomar a decisão, confirme aqui nossas organizações e entre em contato para mais informações.</p>
                
            </div>
            <img src="Imagens/modelo4.jpeg">
        </div>
    </section>

    <section id="porque-adotar">
        <div class="banner">
            <h1>Porque Adotar</h1>
            <p> Adote, ame, faça a diferença.</p>
        </div>
        <div class="escolha-adotar">
            <div class="texto-porque-adotar">
                <h2>Escolha adotar</h2>               
                <p>Ao escolher a adoção, você não apenas salva uma vida, mas cria uma conexão única e eterna, repleta de amor incondicional e gratidão. Cada patinha, cada olhar expressa uma história de esperança, resiliência e alegria.Escolha a adoção, você se torna parte de uma jornada extraordinária, oferecendo um refúgio seguro para aqueles que foram vítimas de abandono. A magia da adoção reside na transformação de vidas, onde a compaixão floresce e os laços criados ultrapassam desafios. Adotar é, acima de tudo, uma promessa de amor incondicional e empatia. Tornar-se o guardião de um animal resgatado é não apenas salvar uma vida, mas também encontrar um amigo fiel para toda a vida. Escolha a adoção e faça a diferença, construindo uma história onde o amor transcende espécies e deixa uma marca eterna no coração de ambos."</p>
            </div>
            <img src="Imagens/modelo3.jpeg">
        </div>
        <a href="adotar.php" class="faca-um-animal-feliz">Faça um animal feliz!</a>
    </section>

    <footer>
        <p>&copy; 2024 Adocães - Todos os direitos reservados</p>
    </footer>
    <script src="scripthome.js"></script>
    <script src="local_storage.js"></script>
</body>

</html>
