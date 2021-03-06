<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'c9agencia');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'c9agencia');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', 'ebbWdX9S!7');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8mb4');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', ';t.#4-3y._KaK8D^g->hB$MJbXFS>XZI~nt0z-FPFJMf8uXC|ZOYFl?W4eANU!)Q');
define('SECURE_AUTH_KEY', '}:yy3m7F^.eC9MxA:cU]ThMb_}&+v#9WieOCm8<E{]&;qPfc XU3cn>Gb@3OxMaD');
define('LOGGED_IN_KEY', '>.DWw,+-fkt]%&=d%ae8~*{&#7Mfgf[.E{q`Vqi!^E{D`HC{s>iiTL-k}m2.H-b6');
define('NONCE_KEY', '_)KlY^>4bU-EAQYer(!dT^bjooi?CkA{7>rTJV@%.M ?2VqWzrx2b4}Iq_~/PRc0');
define('AUTH_SALT', '~R&+T$r{7y$oYSy2>aY+1<nvK)^WvG2<xKCx~W.EU{B7;>a=mijlJ4-9OTABerB~');
define('SECURE_AUTH_SALT', 'rBMxYu(O!Rj%xZbm!M@>D`d5rV91G>![dLpoI+;nOx0cM0XTgQ#bUYP}LF3DoxzY');
define('LOGGED_IN_SALT', 'IG>+C<=gIKlQ5@+SN2%>q?]n!/s^ImE<.G[!NC|y(d,U*QStjMd&H#6?_,I#W]&!');
define('NONCE_SALT', 'bs3*C-CW-zblTjyL%ndTXr|1^UPRJ#` )VO+|qm8,2pW~ o92X ;/RcU{<eK:ZB|');

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'wp_';


/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

