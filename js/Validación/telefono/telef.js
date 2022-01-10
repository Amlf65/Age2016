function validateTelef(valor) {
var telefono = valor.value;

mensajeError="";
if( !(/^\d{9}$/.test(telefono)) ) {
    valor.style.border = "2px solid #FF0000 ";
    mensajeError += '<span style="color:red"> Teléfono erroneo, formato no válido </span>';
}else{
    valor.style.border = "1px solid #B3B3B3";
}
    document.getElementById("error3").innerHTML = mensajeError;
}