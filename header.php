<link rel="stylesheet" type="text/css" href="css/iconic.css" />
<?php

session_start();
if (isset($_SESSION['DNI'])) {
    echo '
    <header class="wrap">
        <nav>
            <ul class="menu">
                <li id="escudo"><img src="img/AyuntamientoTelde2.png" alt="Ayuntamiento"></li>
                <li><a href="index.php">INICIO<span class="iconic user"></span></a>
                    <ul>
                        <li><a href="quiso.php">¿QUIÉNES SOMOS?</a></li>
                        <li><a href="contacto.php">CONTACTO</a></li>
                    </ul>
                </li>
                <li><a href="noticia.php">NOTICIAS<span class="iconic mail"></span></a></li>
                <li><a href="empre.php">EMPRENDEDORES</a>
                </li>
                <li><a href="ofer_pub.php">OFERTAS <span class="iconic pin"></span></a></li>
                <li><a href="formacion.php">FORMACIÓN</a></li>
                <li><a href="dem.php">TU PERFIL</a>
                    <ul>
                        <li><a href="dem_dat.php">MIS DATOS</a></li>
                        <li><a href="dem_cv.php">MI CURRICULUM VITAE</a></li>
                        <li><a href="dem_cand.php">MIS CANDIDATURAS</a></li>
                    </ul>
                </li>
                <li><a href="fin_ses.php">CERRAR SESIÓN<span class="iconic key"></span></a></li>
            </ul>
            <div class="clearfix"></div>
        </nav>
    </header>';
}
else if (isset($_SESSION['admin'])) {
    echo '
    <header class="wrap">
        <nav>
            <ul class="menu">
                <li id="escudo"><img src="img/AyuntamientoTelde2.png" alt="Ayuntamiento"></li>
                <li><a href="empre.php">EMPRENDEDORES</a>
                </li>
                <li><a href="ofer_pub.php">OFERTAS <span class="iconic pin"></span></a></li>
                <li><a href="formacion.php">FORMACIÓN</a></li>
                <li><a href="noticia.php">NOTICIAS<span class="iconic mail"></span></a></li>
                <li><a href="">DESCARGAS</a>
                <ul>
                        <li><a href="adm_xml.php">GENERAR XML</a></li>
                        <li><a href="dat_exe.php?sql=SELECT * FROM `demandantes`">DESCARGAR EXCEL</a></li>
                    </ul></li>
                    <li><a href="adm.php">MI CUENTA<span class="iconic user"></span></a>  
                </li>
                <li><a href="fin_ses.php">CERRAR SESIÓN<span class="iconic key"></span></a></li> 
            </ul>
            <div class="clearfix"></div>
        </nav>
    </header>';
}
else if (isset($_SESSION['CIF'])) {
    echo '
    <header class="wrap">
        <nav>
            <ul class="menu">
                <li id="escudo"><img src="img/AyuntamientoTelde2.png" alt="Ayuntamiento"></li>
                <li><a href="index.php">INICIO<span class="iconic user"></span></a>
                    <ul>
                        <li><a href="quiso.php">¿QUIÉNES SOMOS?</a></li>
                        <li><a href="contacto.php">CONTACTO</a></li>
                    </ul>
                </li>
                <li><a href="empre.php">EMPRENDEDORES</a>
                </li>
                <li><a href="emp_gesofer.php">OFERTAS <span class="iconic pin"></span></a></li>
                <li><a href="formacion.php">FORMACIÓN</a></li>
                <li><a href="noticia.php">NOTICIAS<span class="iconic mail"></span></a></li>
                <li><a href="emp.php">MI CUENTA</a></li>
                <li><a href="fin_ses.php">CERRAR SESIÓN<span class="iconic key"></span></a></li> 
            </ul>
            <div class="clearfix"></div>
        </nav>
    </header>';
} 


else {
    echo '
    <header class="wrap">
        <nav>
            <ul class="menu">
                <li id="escudo"><img src="img/AyuntamientoTelde2.png" alt="Ayuntamiento"></li>
                <li><a href="index.php">INICIO <span class="iconic user"></span></a>
                    <ul>
                        <li><a href="quiso.php">¿QUIÉNES SOMOS?</a></li>
                        <li><a href="contacto.php">CONTACTO</a></li>
                    </ul>
                </li>
                <li><a href="demandantes.php">DEMANDANTES <span class="iconic chat-alt"></span></a>
                    <ul>

                        <li><a href="form_dem.php">REGISTRARSE</a></li>
                        <li><a href="dem_acc.php">ACCEDER AL PERFIL</a></li>
                    </ul>
                </li>
                <li><a href="empresas.php">EMPRESAS <span class="iconic phone"></span></a>
                    <ul>

                        <li><a href="form_emp.php">REGISTRARSE</a></li>
                        <li><a href="emp_acc.php">ACCEDER AL PERFIL</a></li>
                    </ul>
                </li>
                <li><a href="empre.php">EMPRENDEDORES</a>
                </li>
                <li><a href="ofer_pub.php">OFERTAS <span class="iconic pin"></span></a></li>
                <li><a href="formacion.php">FORMACIÓN</a></li>
                <li><a href="noticia.php">NOTICIAS<span class="iconic mail"></span></a></li>
            </ul>
            <div class="clearfix"></div>
        </nav>
    </header>';
}
?>
