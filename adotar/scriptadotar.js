//HEADER

let lastScrollTop = 0;

window.addEventListener("scroll", function() {
    let currentScroll = window.scrollY || document.documentElement.scrollTop;
    if (window.innerWidth >= 1284) {
    if (currentScroll > lastScrollTop) {
        // Scroll para baixo
        document.getElementById("siteHeader").style.top = "-100%"; // Esconda a header
    } else {
        // Scroll para cima
        document.getElementById("siteHeader").style.top = "0"; // Mostra a header
    }
    lastScrollTop = currentScroll <= 0 ? 0 : currentScroll; // Para tratar o caso de descer até o topo
}
}, false);

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

// DRAWER PERFIL
function toggleProfile() {
    var profileSidebar = document.getElementById('profileSidebar');
    var overlay = document.getElementById('overlay');

    if (profileSidebar.style.right === "0px" || profileSidebar.style.right === "") {
        closeProfile();
    } else {
        profileSidebar.style.right = "0px";
        overlay.style.display = 'block';
        document.body.classList.add('no-scroll');
    }
}

function closeProfile() {
    var profileSidebar = document.getElementById('profileSidebar');
    var overlay = document.getElementById('overlay');

    profileSidebar.style.right = "-100%";
    profileSidebar.classList.remove('active');
    overlay.style.display = 'none';
    document.body.classList.remove('no-scroll');
    closePopup();
}

function mostrarImagemSelecionada() {
    const input = document.getElementById("uploadFile");
    const profilePicture = document.getElementById("profilePicture");

    const file = input.files[0];

    if (file) {
        const reader = new FileReader();

        reader.onload = function (e) {
            profilePicture.src = e.target.result;
        };

        reader.readAsDataURL(file);
    }
}

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

/*MOSTRAR E ESCONDER FILTRO*/

function mostrarFiltro() {
    document.querySelector('.filtro-opcoes').style.display = 'block';
}

function esconderFiltro() {
    document.querySelector('.filtro-opcoes').style.display = 'none';
}


/*FILTRAGEM*/

// function handleEnterKey(event) {
//     if (event.key === 'Enter') {
//         aplicarFiltro();
//         filtrarPopups();
//     }
// }

// function aplicarFiltro() {
//     const filtroGato = document.getElementById('filtro-gato').checked;
//     const filtroCachorro = document.getElementById('filtro-cachorro').checked;

//     const animais = document.querySelectorAll('.animal-card');

//     animais.forEach(animal => {
//         const tipoAnimal = animal.querySelector('img').alt.toLowerCase();

//         if ((filtroGato && tipoAnimal === 'gato') || (filtroCachorro && tipoAnimal === 'cachorro')) {
//             animal.style.display = 'flex';
//         } else if (!filtroGato && !filtroCachorro) {
//             animal.style.display = 'flex';
//         } else {
//             animal.style.display = 'none';
//         }
//     });
// }
function aplicarFiltro() {
    const filtroGato = document.getElementById('filtro-gato').checked;
    const filtroCachorro = document.getElementById('filtro-cachorro').checked;

    const animaisVisiveis = document.querySelectorAll('.corresponde-pesquisa');

    animaisVisiveis.forEach(animal => {
        const tipoAnimal = animal.querySelector('img').alt.toLowerCase();

        if ((filtroGato && tipoAnimal === 'gato') || (filtroCachorro && tipoAnimal === 'cachorro')) {
            animal.style.display = 'block';
        } else if (!filtroGato && !filtroCachorro){
            animal.style.display = 'block';
        } else {
            animal.style.display = 'none';
        }
    });
}

function handleEnterKey(event) {
    if (event.key === 'Enter') {
        filtrarPopups();
    }
}

function filtrarPopups() {
    var textoPesquisa = document.getElementById('barra-pesquisa').value.toLowerCase();
    var popups = document.querySelectorAll('.popup-content');

    popups.forEach(function(popup) {
        var animalCard = popup.parentElement.previousElementSibling;
        var textoPopup = popup.textContent.toLowerCase();
        if (textoPopup.includes(textoPesquisa)) {
            animalCard.classList.add('corresponde-pesquisa');
            animalCard.style.display = 'block';
        } else {
            animalCard.classList.remove('corresponde-pesquisa');
            animalCard.style.display = 'none';
        }
    });
}

// POP UP MAIS DETALHES
// Função para mostrar o popup de detalhes
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
navbar();
function navbar() {
    console.log("function nav-bar")
    const ong = localStorage.getItem("id_ong")
    const user = localStorage.getItem("id_adotante")

    console.log(ong, user);

    if (ong !== null){
        const navbarCadastro = document.getElementsByClassName('navbar-cadastro')[0]
        navbarCadastro.style.display = "none";
        const navbar = document.getElementsByClassName('navbar-adm')[0]
        navbar.style.display = "block";
    }

    if (user !== null){
        const navbarCadastro = document.getElementsByClassName('navbar-cadastro')[0]
        navbarCadastro.style.display = 'none';
        const navbar = document.getElementsByClassName('navbar-perfil')[0]
        navbar.style.display = 'block';
    }
    
}
