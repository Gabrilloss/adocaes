info_usuario()

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
