document.getElementById('cnpjInput').addEventListener('blur', function() {
    const cnpjInput = this;
    const cnpj = cnpjInput.value.trim();
    var cnpjErro = document.getElementById('cnpjError')
    if (validarCNPJ(cnpj)) {
        console.log('CNPJ válido');
        cnpjInput.style.borderColor = 'green';
        cnpjErro.style.display = 'none';
    } else {
        console.log('CNPJ inválido');
        cnpjInput.style.borderColor = 'red';
        cnpjErro.textContent = 'CNPJ inválido. Por favor, verifique e tente novamente.';
        cnpjErro.style.display = 'block';
    }
});

document.getElementById('formularioOng').addEventListener('submit', function(event) {
    const cnpj = document.getElementById('cnpjInput').value.trim();
    if (!validarCNPJ(cnpj)) {
        event.preventDefault();
        alert('CNPJ inválido. Por favor, verifique e tente novamente.');
    }
});

function nextStep(step) {
    if (step === 1) {
        var stepFields = document.getElementById('step1').querySelectorAll('input, select');
        var isStepValid = true;
        stepFields.forEach(function(field) {
            if (!field.value.trim()) {
                isStepValid = false;
            }
        });
        
        var cnpj = document.getElementById('cnpjInput').value
        if (!validarCNPJ(cnpj)) {
            console.log('valida_cnpj nextstep()')
            isStepValid = false;
        }

        if (isStepValid) {
            document.getElementById('step1').classList.add('hidden');
            document.getElementById('step2').classList.remove('hidden');
        } else {
            alert('Por favor, preencha todos os campos na etapa 1.');
        }
    } else if (step === 2) {
        document.getElementById('step2').classList.add('hidden');
        document.getElementById('step1').classList.remove('hidden');
    }
}