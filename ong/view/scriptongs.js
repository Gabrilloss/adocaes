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
navbar()
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