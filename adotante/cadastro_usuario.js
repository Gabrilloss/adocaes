function validarCPF(cpf) {
    cpf = cpf.replace(/[^\d]+/g,''); // Remove caracteres não numéricos
    if(cpf == '') return false; // Retorna false se o cpf estiver vazio
    if (cpf.length != 11) return false; // Retorna false se o cpf não tiver 11 dígitos
    // Validação dos 9 primeiros dígitos
    let add = 0;
    for (let i=0; i < 9; i ++)
        add += parseInt(cpf.charAt(i)) * (10 - i);
    let rev = 11 - (add % 11);
    if (rev == 10 || rev == 11)
        rev = 0;
    if (rev != parseInt(cpf.charAt(9)))
        return false;
    // Validação dos 2 últimos dígitos
    add = 0;
    for (let i = 0; i < 10; i ++)
        add += parseInt(cpf.charAt(i)) * (11 - i);
    rev = 11 - (add % 11);
    if (rev == 10 || rev == 11)
        rev = 0;
    if (rev != parseInt(cpf.charAt(10)))
        return false;
    return true;
}

// Exemplo de uso
document.getElementById('cpfInput').addEventListener('blur', function() {
    if (validarCPF(this.value)) {
        console.log('CPF válido');
        // Aqui você pode adicionar lógica para indicar que o CPF é válido, por exemplo, alterar a cor do campo
        this.style.borderColor = 'green';
    } else {
        console.log('CPF inválido');
        // Aqui você pode adicionar lógica para indicar que o CPF é inválido, por exemplo, alterar a cor do campo
        this.style.borderColor = 'red';
    }
});
document.getElementById('formularioCadastro').addEventListener('submit', function(event) {
    const cpf = document.getElementById('cpfInput').value
    console.log(cpf)
    if (!validarCPF(cpf)) {
        event.preventDefault(); // Cancela a submissão do formulário
        alert('CPF inválido. Por favor, verifique e tente novamente.');
    }
});
    