                <aside id="tuPerfil">
                    <h1 id="titulo1"><a href="dem.php" style="text-decoration: none;">TU PERFIL</a></h1>
                    <img id="fotoPerfil" src="img/persona.png">
                    <p id="saludo" class="title1">
                        <?php 
                        echo ($row['sexo']=='2') ? 'Bienvenida ' : (
                            ($row['sexo']=='1') ? 'Bienvenido ' : '');
                        echo $row['nombre'];?></p>
                    <a href="dem_dat.php"><button >Mis Datos</button></a></br>
                    <a href="dem_cv.php"><button >Mi Curriculum Vitae</button></a></br>
                    <a href="dem_cand.php"><button>Mis candidaturas</button></a></br> 
                    <a href="fin_ses.php"><button id="cerrarSesion">Cerrar Sesión</button></a></br> 
                </aside>