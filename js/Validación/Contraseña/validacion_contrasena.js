//Validacion de formulario
function validacion(valor) {
  	//var contrasena = document.getElementById("contrasena").value;
        var contrasena = valor.value;
  	mensajeError="";
	/*No debe contener espacios en blanco*/
  	var contra = contrasena.split("");
    for(var i = 0; i < contra.length ; i++){
    	if(contra[i]==" "){
                valor.style.border = " 2px solid #FF0000 ";
    		mensajeError+='<span style="color:red"> No debe contener espacios en blanco. </span>';
           
    	}else{
            valor.style.border = " 1px solid #B3B3B3 ";
        }
    }
	/*Debe tener un mínimos de 6 caracteres*/
	if( contra == null || contra.length < 6 ) {
                valor.style.border = " 2px solid #FF0000 ";
                mensajeError+='<span style="color:red"> Debe tener un mínimo de 6 caracteres. </span>';
	}else{
		/*Debe insertar una letra mayúscula*/
		var mayus = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
		var minus = "abcdefghijklmnñopqrstuvwxyz";
		var nMayus=0;
		var nMinus=0;
		for (x=0;x<contrasena.length;x++) { 
			if ( mayus.indexOf(contrasena.charAt(x)) != -1 ) {
				nMayus++;
			}else if ( minus.indexOf(contrasena.charAt(x)) != -1 ) {
				nMinus++;
			} 
		} 
		if(nMayus==0 && nMinus==0){ 
                     valor.style.border = " 2px solid #FF0000 ";
                     mensajeError+='<span style="color:red"> Debe insertar una letra. </span>';
		}else if( nMayus==0 ){ 
                             valor.style.border = " 2px solid #FF0000 ";
                             mensajeError+='<span style="color:red"> Debe insertar una letra mayúscula.</span>';
		}
		/*No debe contener caraceteres distintos a los alfanuméricos, "/" o "$"*/
		for(var z = 0; z < contra.length ; z++){
	    	if (!/^[a-z]|^[A-Z]|^[0-9]|^\/|^\$/.test(contra[z])) {
                     valor.style.border = " 2px solid #FF0000 ";
                     mensajeError+='<span style="color:red"> No debe contener caraceteres distintos a los alfanuméricos</span>';
			}
	    }
	}
    document.getElementById("error").innerHTML=mensajeError;
}