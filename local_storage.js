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
info_ong()

function info_ong(){
    console.log("info-ong")
    var infoOngString = localStorage.getItem('info_ong');
    if (infoOngString) {
        console.log(`values: ${JSON.stringify(infoOngString)}`);

        var infoOng = JSON.parse(infoOngString);
        
        document.getElementById('site').value = infoOng.site || '';
        document.getElementById('cnpj').value = infoOng.cnpj || '';
        document.getElementById('telefone').value = infoOng.telefone || '';
        if (infoOngString !== true ){
        document.querySelector('.nome').textContent = infoOng.nome || 'Nome';
        hidden.style.display = 'none';
    }
    }
}
