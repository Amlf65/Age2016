  function validateRepetir(valor,contrasena) {
var repetir = valor.value;
var contrasena1 = contrasena.value;
//var contrasena1 = document.getElementsByName("contrasena").value;
mensajeError="";
if( contrasena1!=repetir ) {
    valor.style.border = " 2px solid #FF0000 ";
    mensajeError += '<span style="color:red">No coincide la contraseña</span>';
}else{
     valor.style.border = " 1px solid #B3B3B3 ";
}
    document.getElementById("error8").innerHTML = mensajeError;
}
