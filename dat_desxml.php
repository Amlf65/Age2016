<?php
  $fichero="xml.xml";
  header( "Content-Disposition: attachment; filename=".$fichero);
 // header( "Content-Length: ".filesize($fichero));
  header( "Content-Type: aplication/octet-stream; name=".$fichero);  
  readfile($fichero);

?>
