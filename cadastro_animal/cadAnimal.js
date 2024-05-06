recuperaOng();

function recuperaOng(){
    var id_ong = localStorage.getItem('id_ong');
    console.log("ONG recuperada: ", id_ong);
    document.getElementById("id_ong").value = id_ong;
}