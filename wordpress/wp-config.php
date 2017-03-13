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
define('DB_NAME', 'actividades');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'actividades');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', 'actividades');

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
define('AUTH_KEY', 'r2pU@L/bRify-]9ziI5z08o_Ej><jtiIUb2`bNSS$^)I{l[<:{!h$]m[v2]J~j,L');
define('SECURE_AUTH_KEY', 'w/.E~nqA]w[g$yR_k7dQeVR,H4T0{?q1$ FKFCyw6vNz4Wz;=TbMnmx88u~Pra~A');
define('LOGGED_IN_KEY', 'i$88LDu5V( H(8Ezd8{>98;(L%;xbYf}_]vtRg+DwRPi4}toqHqzYsI_=[S]/(^c');
define('NONCE_KEY', '}$U8jU=)y?H/wyxMX^ed9W91YOzZ]Br+92%M,9FWS!1:};Wi(D?vngdhlIUWuy^e');
define('AUTH_SALT', 'X}7S~c#rvON0Yg*dgnpBE+3X&7k$Q>SEe+gz8bY#9#W&-Bt5?@Joc8--#NtWU9$5');
define('SECURE_AUTH_SALT', ';4GSZpKi!$j0/AN]R! G)ij,{U0EtwSLpE-Z:yR/ovx:KheaOS< nFN^d_JwQyzO');
define('LOGGED_IN_SALT', '{JN}igD?!/$)gX 1cCH.djXSiFir46r~@-KZAON`C[2dUr jGS4Z#{J3*A4Q5|4t');
define('NONCE_SALT', '3bWg.E^H5O2A-Jk[@^-c77}W0lo{Bz#@K>afi({n>F6]~O]0aiu`V+!KhkWG_xE)');

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

