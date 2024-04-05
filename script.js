
/*MOSTRAR E ESCONDER FILTRO*/

function mostrarFiltro() {
    document.querySelector('.filtro-opcoes').style.display = 'block';
}

function esconderFiltro() {
    document.querySelector('.filtro-opcoes').style.display = 'none';
}


/*FILTRAGEM*/

function aplicarFiltro() {
    const filtroGato = document.getElementById('filtro-gato').checked;
    const filtroCachorro = document.getElementById('filtro-cachorro').checked;

    const animais = document.querySelectorAll('.animal-card');

    animais.forEach(animal => {
        const tipoAnimal = animal.querySelector('img').alt.toLowerCase();

        if ((filtroGato && tipoAnimal === 'gato') || (filtroCachorro && tipoAnimal === 'cachorro')) {
            animal.style.display = 'flex';
        } else if (!filtroGato && !filtroCachorro) {
            animal.style.display = 'flex';
        } else {
            animal.style.display = 'none';
        }
    });
}

/*CARROSSEL DE IMAGENS*/

let currentIndex = 0;
const slides = document.querySelectorAll('.animal-carrossel');

function showSlide(index) {
    slides.forEach((slide, i) => {
        slide.style.display = i === index ? 'block' : 'none';
    });
}

function nextSlide() {
    currentIndex = (currentIndex + 1) % slides.length;
    showSlide(currentIndex);
}

function prevSlide() {
    currentIndex = (currentIndex - 1 + slides.length) % slides.length;
    showSlide(currentIndex);
}

document.getElementById('nextBtn').addEventListener('click', nextSlide);
document.getElementById('prevBtn').addEventListener('click', prevSlide);

// Exibir o primeiro slide ao carregar a página
showSlide(currentIndex);







