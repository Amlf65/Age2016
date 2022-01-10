
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
 <link rel= "stylesheet" type="text/css" href="css/formucss.css"/>   
 <link rel="stylesheet" type="text/css" href="css/general.css"/> 
</head>
<body>
<?php
include 'conexion.php';
?>
    <br/>
<h1>Bienvenido usuario/a administrador</h1>
<div id="inicio"><p><a href="adm.php">INICIO</a></p></div>
<div id="imgempresaa"><img src="img/imgempresaa.png"/></div>
<div id="admintable">
    <legend>Buscar demandante</legend>
    <table>
        <tr>
            <td>Edad</td>
            <td><select>
  <option value="menort">&le;30</option>
  <option value="mayort">&gt;30</option>
  <option value="mayorc">&ge;50</option>
                </select></td>
        </tr>
        <tr>
            <td>V.V.G. (Víctima de Violencia de Género)</td>
            <td><input type="checkbox" name="vvg"/></td>
        </tr>
        <tr>
            <td>Grado de discapacidad</td>
             <td><select>
  <option value="nod">Sin discapacidad</option>
  <option value=""></option>
  <option value=""></option>
  <option value=""></option>
                </select></td>           
        </tr>    
    </table>

<?php
include 'footer.php';
?>
</body>
</html>

