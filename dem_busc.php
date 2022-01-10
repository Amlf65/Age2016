                <script type="text/javascript">
                	function buscador(busc){
                            if (busc.value == 'Buscar una oferta...') {
                                    busc.value = '';
                            };
                	}
                	function oferta(nofer, boton){
                            if (nofer.value=='' || /^\s+$/.test(nofer.value)) {
                                    nofer.value = 'Buscar una oferta...';
                                    boton.value='OFERTAS'
                            };
                	}
                	function ofertas(boton){
                            boton.value = 'BUSCAR';
                	}
                </script>
                <form action="dem_ofer.php" method="post">
                	<div id="buscador"> 
                            <input type="text" name="busqueda" id="busqueda" value="Buscar una oferta..." onfocus="buscador(this)" onblur="oferta(this, buscar)" onkeypress="ofertas(buscar)"/>
                            <input type="submit" name="buscar" id="buscar" value="OFERTAS"/>
	                </div>
                </form>
	                