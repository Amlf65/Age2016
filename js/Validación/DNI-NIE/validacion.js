function validateDNI(valor) {
    var numero, let, letra;
    var expresion_regular_dni = /^[XYZ]?\d{5,8}[A-Z]$/;
    var mensajeError = "";
      var mensajeError1 = "";
    
    valor1 = valor.value.toUpperCase();
    if (expresion_regular_dni.test(valor1)) {
        numero = valor1.substr(0, valor1.length - 1);
        numero = numero.replace('X', 0);
        numero = numero.replace('Y', 1);
        numero = numero.replace('Z', 2);
        let = valor1.substr(valor1.length - 1, 1);
        numero = numero % 23;
        letra = 'TRWAGMYFPDXBNJZSQVHLCKET';
        letra = letra.substring(numero, numero + 1);
       
        if (letra != let) {
            valor.style.border = " 2px solid #FF0000 ";
            mensajeError += '<span style="color:red"> Dni erroneo, la letra del NIF no se corresponde </span>';
            mensajeError1 += '<span style="color:red"> CIF erroneo, la letra del NIF no se corresponde </span>';
        } else {
            valor.style.border = " 1px solid #B3B3B3";
        }
    } else {
        valor.style.border = " 2px solid #FF0000 ";
        mensajeError += '<span style="color:red">Dni erroneo, formato no válido</span>';
        mensajeError1 += '<span style="color:red"> CIF erroneo, la letra del NIF no se corresponde </span>';
    }
    document.getElementById("error2").innerHTML = mensajeError;
    document.getElementById("error0").innerHTML = mensajeError1;
}