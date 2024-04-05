
document.getElementById('cpfInput').addEventListener('blur', function() {
    const cpfInput = this;
    const cpf = cpfInput.value.trim();
    var cpfErro = document.getElementById('cpfError')
    if (validarCPF(cpf)) {
        console.log('cpf válido');
        cpfInput.style.borderColor = 'green';
        cpfErro.style.display = 'none';
    } else {
        console.log('cpf inválido');
        cpfInput.style.borderColor = 'red';
        cpfErro.textContent = 'cpf inválido. Por favor, verifique e tente novamente.';
        cpfErro.style.display = 'block';
    }
});

document.getElementById('formularioCadastro').addEventListener('submit', function(event) {
    const cpf = document.getElementById('cpfInput').value.trim();
    if (!validarCPF(cpf)) {
        event.preventDefault();
        alert('cpf inválido. Por favor, verifique e tente novamente.');
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
        
        var cpf = document.getElementById('cpfInput').value
        if (!validarCPF(cpf)) {
            console.log('valida_cpf nextstep()')
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