function fecha(valor) {
    
    var hoy = new Date();
    var cumpleanos = new Date(valor.value);
    var edad = hoy.getFullYear() - cumpleanos.getFullYear();
    var m = hoy.getMonth() - cumpleanos.getMonth();

    if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
        edad--;
    }
    if(edad<=0){
        mensajeError = '<span style="color:red"> Edad no existente.</span>';
    }else{
     if(edad>75){
        mensajeError = '<span style="color:red"> Los pensionistas no pueden registrase.</span>';
    }else{
      if(edad<18){
        mensajeError = '<span style="color:red"> No puede registrarse, es usted menor de edad.</span>';
    }else{
        mensajeError = "";
    }  
    }   
    }
    document.getElementById("erro4").innerHTML = mensajeError;
}