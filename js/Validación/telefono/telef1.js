function validateTelef() {
    var tmovil = document.getElementById("movil");
    var tfijo = document.getElementById("telefono");
    mensajeError = "";
    if (tmovil.value.length == 0 && tfijo.value.length == 0) {
        mensajeError = '<span style="color:red"> Tiene que facilitar al menos un teléfono. </span>';
    } else {
        mensajeErro1 = "";
         mensajeErro2 = ""
        if (!(/^\d{9}$/.test(tmovil.value)) && tmovil.value.length != 0 ) {
            tmovil.style.border = "2px solid #FF0000 ";
            mensajeErro1 = '<span style="color:red"> Teléfono erroneo, formato de movil no válido </span>';
        } else {
            tmovil.style.border = "1px solid #B3B3B3";
            mensajeErro1 = "";
        }
        mensajeErro2 = ""
        if (!(/^\d{9}$/.test(tfijo.value)) && tfijo.value.length != 0) {
            tfijo.style.border = "2px solid #FF0000 ";
            mensajeErro2 = '<span style="color:red"> Teléfono erroneo, formato de fijo no válido </span>';
        } else {
            tfijo.style.border = "1px solid #B3B3B3";
            mensajeErro2 = "";
        }
        mensajeError = mensajeErro1 + " " +mensajeErro2;
    }
    
    document.getElementById("error3").innerHTML = mensajeError;
}
