
/*CARROSSEL DE IMAGENS*/

/* var valorAdotante = localStorage.getItem('id_adotante');
var valorOng = localStorage.getItem('id_ong');
if (valorAdotante != null ){
    document.getElementById('teste2').classList.add('hidden');
    document.getElementById('teste').classList.remove('hidden');
}
if(valorOng != null ){
    document.getElementById('teste').classList.add('hidden');
    document.getElementById('teste2').classList.remove('hidden');
    document.getElementById('cad').classList.add('hidden');
    document.getElementById('log').classList.add('hidden');}
else{
    document.getElementById('cad').classList.remove('hidden');
    document.getElementById('log').classList.remove('hidden');
}; */

let currentIndex = 0;
const slides = document.querySelectorAll('.animal-carrossel');
const slideWidth = slides[0].offsetWidth;
const slidesToShow = 3.3;

function showSlide(index) {
    const leftPosition = index * slideWidth;
    document.querySelector('.carrossel').scrollTo({
        left: leftPosition,
        behavior: 'smooth'
    });
}

function nextSlide() {
    if (window.innerWidth >= 1284) {
        currentIndex = (currentIndex + 3.3) > 12.5 ? 0 : (currentIndex + 3.3);
        showSlide(currentIndex);
    } else {
        currentIndex = (currentIndex + 1.1) > 12 ? 0 : (currentIndex + 1.12);
        showSlide(currentIndex);
    }
}

function prevSlide() {
    if (window.innerWidth >= 1284) {
        currentIndex = (currentIndex - 3.3) < 0 ? 9.9 : (currentIndex - 3.3);
        showSlide(currentIndex);
    } else {
        currentIndex = (currentIndex - 1.1) < 0 ? 12.34 : (currentIndex - 1.12);
        showSlide(currentIndex);
    }
}

document.getElementById('nextBtn').addEventListener('click', nextSlide);
document.getElementById('prevBtn').addEventListener('click', prevSlide);


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

window.addEventListener("scroll", function () {
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

window.onload = function () {
    var buttons = document.querySelectorAll('[id="stylus"]');

    buttons.forEach(function (button) {
        button.addEventListener('click', function () {
            // Seleciona todos os inputs e textareas dentro do elemento pai
            var inputsAndTextarea = this.parentElement.querySelectorAll('input, textarea');

            // Verifica se algum dos inputs ou textareas está readonly
            var readOnly = false;
            inputsAndTextarea.forEach(function (element) {
                if (element.hasAttribute('readonly')) {
                    readOnly = true;
                }
            });

            // Se os inputs ou textareas estiverem readonly, torna-os editáveis e muda o ícone para 'save'
            // Caso contrário, torna os inputs e textareas readonly novamente e muda o ícone para 'stylus'
            if (readOnly) {
                inputsAndTextarea.forEach(function (element) {
                    element.removeAttribute('readonly');
                    element.style.border = '1px solid #FF8743';
                });
                this.innerHTML = 'save';
            } else {
                inputsAndTextarea.forEach(function (element) {
                    element.setAttribute('readonly', 'readonly');
                    element.style.border = 'none';
                });
                this.innerHTML = 'stylus';
            }
        });
    });
};

navbar()

function clearLocalStorage() {
    localStorage.clear()
}

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

// Função para mostrar o popup de detalhes
function mostrarDetalhes(idPopup) {
    const popup = document.getElementById(idPopup);
    popup.style.display = "block";
    document.body.classList.add('popup-aberto'); // Adicione a classe ao body
    
    // Adicione um ouvinte de evento de clique ao fundo semi-transparente do popup
    popup.addEventListener('click', function(event) {
        // Verifique se o clique ocorreu dentro do popup ou em seus filhos
        if (!event.target.closest('.popup-content')) {
            // Se o clique ocorreu fora do popup, feche-o
            fecharDetalhes(idPopup);
        }
    });
}

// Função para fechar o popup de detalhes
function fecharDetalhes(idPopup) {
    const popup = document.getElementById(idPopup);
    popup.style.display = "none";
    document.body.classList.remove('popup-aberto'); // Remova a classe do body
}

function logout() {
    localStorage.clear(); 

    window.location.href = "/adocaes/home.php";
}


function info_usuario(){
    console.log("info-usuario")
    var infoUsuarioString = localStorage.getItem('info_usuario');
    if (infoUsuarioString) {
        console.log(`values: ${JSON.stringify(infoUsuarioString)}`);

        var infoUsuario = JSON.parse(infoUsuarioString);
        

        document.getElementById('email').value = infoUsuario.email || '';
        document.getElementById('cpf').value = infoUsuario.cpf || '';
        document.getElementById('profilePicture').src = infoUsuario.imagem || 'default.jpg';
        document.getElementById('telefone').value = infoUsuario.telefone || '';
        document.querySelector('.nome').textContent = infoUsuario.nome || 'Nome';
        
    }
}

updateGetById()

function updateGetById(){
    document.getElementById('updateForm').addEventListener('submit', function() {
        var idAdotante = localStorage.getItem('id_adotante');
        console.log('ID_ADOTANTE: ', idAdotante)
        document.getElementById('idAdotante').value = idAdotante;
    });
}

//  document.getElementById('updateForm').addEventListener('submit', function(event) {
//      event.preventDefault(); // Impede o envio do formulário de maneira tradicional


//      const email = document.getElementById('email').value;
//     const idAdotante = localStorage.getItem('id_adotante');
//      const data = {
//          email: email,
//          id: idAdotante
//      };
//      console.log(data);
//      fetch('edit_form.php')
//      .then(response => {
//         if (!response.ok) throw new Error('Network response was not ok');
//         return response.text(); // Convert to plain text to inspect
//       })
//      .then(text => {
//         if (text.trim() === '') {
//           console.log('Response is empty');
//           return {}; // Return an empty object or handle accordingly
//         }
//         return JSON.parse(text);
//       })
//      .catch(error => console.error('Error:', error));
//  });
