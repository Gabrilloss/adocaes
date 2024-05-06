
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