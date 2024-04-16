const urlParams = new URLSearchParams(window.location.search);
const error = urlParams.get('error');

if (error) {
    var email_senha_invalido_erro = document.getElementById('email_senha_invalido')
    email_senha_invalido_erro.textContent = 'Email e/ou senha incorretos!';
    email_senha_invalido_erro.style.color = 'red';
    email_senha_invalido_erro.style.fontSize = '12px';
    email_senha_invalido_erro.style.display = 'block';
}
