function validarCP(valor)
{
   var codigo = valor.value;
 mensajeError="";
  if(codigo.length == 5 && parseInt(codigo) >= 1000 && parseInt(codigo) <= 52999)
  
  {
valor.style.border = " 1px solid #B3B3B3";
  }
  else{
    valor.style.border = " 2px solid #FF0000 ";
    mensajeError += '<span style="color:red"> Código no valido </span>';
   }
   document.getElementById("error4").innerHTML = mensajeError;
}


