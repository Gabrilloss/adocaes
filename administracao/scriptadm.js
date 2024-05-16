
//BOTÃO EDITAR PERFIL

window.onload = function() {
    var buttons = document.querySelectorAll('[id="stylus"]');

    buttons.forEach(function(button) {
        button.addEventListener('click', function() {
            // Seleciona todos os inputs e textareas dentro do elemento pai
            var inputsAndTextarea = this.parentElement.querySelectorAll('input, textarea');

            // Verifica se algum dos inputs ou textareas está readonly
            var readOnly = false;
            inputsAndTextarea.forEach(function(element) {
                if (element.hasAttribute('readonly')) {
                    readOnly = true;
                }
            });

            // Se os inputs ou textareas estiverem readonly, torna-os editáveis e muda o ícone para 'save'
            // Caso contrário, torna os inputs e textareas readonly novamente e muda o ícone para 'stylus'
            if (readOnly) {
                inputsAndTextarea.forEach(function(element) {
                    element.removeAttribute('readonly');
                    element.style.border = '1px solid #FF8743';
                });
                this.innerHTML = 'save';
            } else {
                inputsAndTextarea.forEach(function(element) {
                    element.setAttribute('readonly', 'readonly');
                    element.style.border = 'none';
                });
                this.innerHTML = 'stylus';
            }
        });
    });
};


//POP UP REDEFINIR SENHA

function openPopup() {
    var popup = document.getElementById('popup');
    var telaAdm = document.querySelector('.tela-adm');
    document.getElementById("popup").style.display = "block";
    document.querySelector(".close-button").style.pointerEvents = "none";
    document.body.classList.add('no-scroll');
    telaAdm.classList.add('bloqueada');
    
}

function closePopup() {
    var popup = document.getElementById('popup');
    var telaAdm = document.querySelector('.tela-adm');
    document.getElementById("popup").style.display = "none";
    document.querySelector(".close-button").style.pointerEvents = "auto";
    document.body.classList.remove('no-scroll');
    telaAdm.classList.remove('bloqueada');
}

function logout() {
    localStorage.clear(); 

    window.location.href = "/adocaes/home.php";
}

function recuperaAnimais() {
    console.log("Recuperando animais...");
    var idOng = localStorage.getItem('id_ong');

    //FRONT END PERGUNTA EM BINARIO ------> AJAX TRADUZ PARA O BACKEND EM LINGUAGEM NAO BURRA ---->  BACKEND ENTENDE TUDO E REPASSA de vota qualquer msg que queira
    
    if (idOng) {
        console.log("Request...");
        $.ajax({
            url: 'busca_animais.php',
            type: 'POST',
            data: {id_ong: idOng},
            success: function(response) {
                console.log("Response: ", response);
                if (response) {
                    var allAnimais = JSON.parse(response);
                    return allAnimais;
                }
                return;
            },
            error: function(xhr, status, error) {
                console.error('Erro ao recuperar animais: ', error);
            }
        });
    } else {
        console.error('ID_ONG não localizado.');
    }
}

recuperaAnimais();


function criaCardAnimal(){

    var allAnimais = recuperaAnimais();

    // compõe o card com os valores de allAnimais.

}

//BOTÃO EDITAR PERFIL

window.onload = function() {
    var buttons = document.querySelectorAll('[id="stylus"]');

    buttons.forEach(function(button) {
        button.addEventListener('click', function() {
            // Seleciona todos os inputs e textareas dentro do elemento pai
            var inputsAndTextarea = this.parentElement.querySelectorAll('input, textarea');

            // Verifica se algum dos inputs ou textareas está readonly
            var readOnly = false;
            inputsAndTextarea.forEach(function(element) {
                if (element.hasAttribute('readonly')) {
                    readOnly = true;
                }
            });

            // Se os inputs ou textareas estiverem readonly, torna-os editáveis e muda o ícone para 'save'
            // Caso contrário, torna os inputs e textareas readonly novamente e muda o ícone para 'stylus'
            if (readOnly) {
                inputsAndTextarea.forEach(function(element) {
                    element.removeAttribute('readonly');
                    element.style.border = '1px solid #FF8743';
                });
                this.innerHTML = 'save';
            } else {
                inputsAndTextarea.forEach(function(element) {
                    element.setAttribute('readonly', 'readonly');
                    element.style.border = 'none';
                });
                this.innerHTML = 'stylus';
            }
        });
    });
};


//POP UP REDEFINIR SENHA

function openPopup() {
    var popup = document.getElementById('popup');
    var telaAdm = document.querySelector('.tela-adm');
    document.getElementById("popup").style.display = "block";
    document.querySelector(".close-button").style.pointerEvents = "none";
    document.body.classList.add('no-scroll');
    telaAdm.classList.add('bloqueada');
    
}

function closePopup() {
    var popup = document.getElementById('popup');
    var telaAdm = document.querySelector('.tela-adm');
    document.getElementById("popup").style.display = "none";
    document.querySelector(".close-button").style.pointerEvents = "auto";
    document.body.classList.remove('no-scroll');
    telaAdm.classList.remove('bloqueada');
}

function logout() {
    localStorage.clear(); 

    window.location.href = "/adocaes/home.php";
}

function recuperaAnimais() {
    console.log("Recuperando animais...");
    var idOng = localStorage.getItem('id_ong');

    //FRONT END PERGUNTA EM BINARIO ------> AJAX TRADUZ PARA O BACKEND EM LINGUAGEM NAO BURRA ---->  BACKEND ENTENDE TUDO E REPASSA de vota qualquer msg que queira
    if (idOng) {
        console.log("Request...");
        $.ajax({
            url: 'busca_animais.php',
            type: 'POST',
            data: {id_ong: idOng},
            success: function(response) {
                console.log("Response: ", response);
                if (response) {
                    var allAnimais = JSON.parse(response);
                    criarCard(allAnimais);
                    return allAnimais;
                }
                return;
            },
            error: function(xhr, status, error) {
                console.error('Erro ao recuperar animais: ', error);
            }
        });
    } else {
        console.error('ID_ONG não localizado.');
    }
}

recuperaAnimais();


// function criaCardAnimal(){
    
//     var allAnimais = recuperaAnimais();
//     // compõe o card com os valores de allAnimais.

// }
//criaCardAnimal();


function criarCard(animais) {
    const todosAnimaisDiv = document.querySelector('.todos-animais');

    animais.forEach(animal => {
        const animalCardDiv = document.createElement('div');
        animalCardDiv.classList.add('animal-card'); //animalCardDiv.classList.add('animal-card', 'corresponde-pesquisa');

        const imagem = document.createElement('img');
        imagem.src = ((animal.url !== null) ? animal.url : ((animal.tipo === 'C') ? '../Imagens/cachorro1.jpeg' : '../Imagens/gato4.jpeg'));
        imagem.alt = animal.tipo === 'C' ? 'Cachorro' : 'Gato';

        const nomeAnimal = document.createElement('p');
        nomeAnimal.classList.add('nome-animal');
        nomeAnimal.textContent = animal.nomeAnimal;

        const genero = document.createElement('p');
        genero.textContent = 'Gênero: ' + (animal.genero === 'F' ? 'Fêmea' : 'Macho');

        const botaoDetalhes = document.createElement('div');
        const botao = document.createElement('button');
        botao.textContent = 'Mais Detalhes';
        botao.addEventListener('click', function() {
            mostrarDetalhes('popup' + animal.idAnimais);
        });
        botaoDetalhes.appendChild(botao);

        animalCardDiv.appendChild(imagem);
        animalCardDiv.appendChild(nomeAnimal);
        animalCardDiv.appendChild(genero);
        animalCardDiv.appendChild(botaoDetalhes);

        todosAnimaisDiv.appendChild(animalCardDiv);
        /////////////////////////////////////////////////
        const popupDiv = document.createElement('div');
        popupDiv.id = 'popup' + animal.idAnimais;
        popupDiv.classList.add('popup');

        const popupContentDiv = document.createElement('div');
        popupContentDiv.classList.add('popup-content');

        const fecharSpan = document.createElement('span');
        fecharSpan.classList.add('fechar');
        fecharSpan.textContent = '×';
        fecharSpan.onclick = function() {
            fecharDetalhes('popup' + animal.idAnimais);
        };

        //const imagemAnimalDiv = document.createElement('div');
        
        const imagemAnimal = document.createElement('img');
        imagemAnimal.classList.add('imagem-animal');
        imagemAnimal.src = ((animal.url !== null) ? animal.url : ((animal.tipo === 'C') ? '../Imagens/cachorro1.jpeg' : '../Imagens/gato4.jpeg'));
        imagemAnimal.alt = animal.tipo === 'C' ? 'Cachorro' : 'Gato';

        //imagemAnimalDiv.appendChild(imagemAnimal);

        const nomeP = document.createElement('p');
        nomeP.textContent = 'Nome: ' + animal.nomeAnimal;

        const racaP = document.createElement('p');
        racaP.textContent = 'Raça: ' + animal.raca;

        const nascimentoP = document.createElement('p');
        nascimentoP.textContent = 'Data de nascimento: ' + animal.dataNascimento;

        const generoPopupP = document.createElement('p');
        generoPopupP.textContent = 'Gênero: ' + (animal.genero === 'F' ? 'Fêmea' : 'Macho');

        const porteP = document.createElement('p');
        porteP.textContent = 'Porte: ' + (animal.porte === 'P' ? 'Pequeno' : (animal.porte === 'M' ? 'Médio' : 'Grande'));

        const corP = document.createElement('p');
        corP.textContent = 'Cor: ' + animal.cor;

        const castradoP = document.createElement('p');
        castradoP.textContent = 'Castrado: ' + (animal.castrado === '1' ? 'Sim' : 'Não');

        const vacinasP = document.createElement('p');
        vacinasP.textContent = 'Vacinas: ' + animal.vacinas;

        const observacaoP = document.createElement('p');
        observacaoP.textContent = 'Observação: ' + animal.observacao;

        popupContentDiv.appendChild(fecharSpan);
        popupContentDiv.appendChild(imagemAnimal);
        popupContentDiv.appendChild(nomeP);
        popupContentDiv.appendChild(racaP);
        popupContentDiv.appendChild(nascimentoP);
        popupContentDiv.appendChild(generoPopupP);
        popupContentDiv.appendChild(porteP);
        popupContentDiv.appendChild(corP);
        popupContentDiv.appendChild(castradoP);
        popupContentDiv.appendChild(vacinasP);
        popupContentDiv.appendChild(observacaoP);

        popupDiv.appendChild(popupContentDiv);

        todosAnimaisDiv.appendChild(popupDiv);
    });
}



function mostrarDetalhes(idPopup) {
    const popup = document.getElementById(idPopup);

    popup.style.display = "block";
    document.body.classList.add('popup-aberto'); // Fecha o overflow do Body quando abrir o popup
    popup.addEventListener('click', function(event) {
        // Verifique se ocorreu clique dentro do PopUp ou fora
        if (!event.target.closest('.popup-content')) {
            // Se foi fora, então é fechado o opopup
            fecharDetalhes(idPopup);
        }
    });
    console.log("mostrarDetalhes - LIGOU\nOverFlow - Desligado");
}

// Função para fechar o popup de detalhes
function fecharDetalhes(idPopup) {
    const popup = document.getElementById(idPopup);
    
    popup.style.display = "none";
    document.body.classList.remove('popup-aberto'); // Remova a classe que fecha o overflow do Body quando fechar o popup
    console.log("mostrarDetalhes - DESLIGOU\nOverFlow - Ligado");
}
