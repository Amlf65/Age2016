function validaCif(valor) {

    var cif = valor.value;
    var par = 0;
    var non = 0;
    var letras = "ABCDEFGHKLMNPQS";
    var let = cif.charAt(0);
    mensajeError = "";
    if (cif.length != 9) {
        valor.style.border = " 2px solid #FF0000 ";
        mensajeError += '<span style="color:red"> El Cif debe tener 9 digitos</span>';
    } else {
        valor.style.border = " 1px solid #B3B3B3 ";
    }

    if (letras.indexOf(let.toUpperCase()) == -1) {
        valor.style.border = " 2px solid #FF0000 ";
        mensajeError += '<span style="color:red"> El comienzo del Cif no es valido</span>';
    } else {
        valor.style.border = " 1px solid #B3B3B3 ";
    }

    for (zz = 2; zz < 8; zz += 2) {
        par = par + parseInt(cif.charAt(zz));
    }

    for (zz = 1; zz < 9; zz += 2) {
        nn = 2 * parseInt(cif.charAt(zz));
        if (nn > 9)
            nn = 1 + (nn - 10);
        non = non + nn;
    }

    parcial = par + non;
    control = (10 - (parcial % 10));
    if (control == 10)
        control = 0;

//CIF P O X
    if (let == 'X' || let == 'P') {
        alert(control);
        alert(cif.charAt(8));
        if (Chr(64 + control) != cif.charAt(8)) {
            valor.style.border = " 2px solid #FF0000 ";
             mensajeError += '<span style="color:red"> El Cif no es valido</span>';
        } else {
            valor.style.border = " 1px solid #B3B3B3 ";
        }

    } else {
        if (control != cif.charAt(8)) {
            valor.style.border = " 2px solid #FF0000 ";
            mensajeError += '<span style="color:red"> El Cif no es valido</span>';
        } else {
            valor.style.border = " 1px solid #B3B3B3 ";
        }
    }
    document.getElementById("error10").innerHTML = mensajeError;
}