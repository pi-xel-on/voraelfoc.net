# voraelfoc.net
Creació d'una plataforma per generar històries cooperatives.


La base és un Wordpress per aprofitar tot el sistema d'usuaris i recursos que ens pot oferir una plataforma tan oberta i opensource com és Wordpress amb una plantilla facilitada pel servidor utilitzat.

plugins Wordpress necessaris perquè la plaforma funcioni correctament Ultimate Members per poder fer un control d'usuaris mes eficaç i generar el formulari de registre i login.
Un altre pluggin necessari és ACF (advance custom fields) que  permetrà crear un parell de camps nous per a l'usuari, aquest camp són ocults però s'utilitzen en la programació del pluggin. (https://github.com/pi-xel-on/voraelfoc.net/tree/master/wp-content/plugins/pixelon)

Desenvolupament d'un pluggin que  farà de gestor de tota la plataforma de gravació i de control del sistema, aquest pluggin és el core de tota l'aplicació.
El pluggin està programat per generar una sèrie de shortcodes que ficat dintre del wordpress s'interpreten i generen les pàgines de l'aplicatiu, utilitza el tramat de taules de WP per alimentar-se i generem una altra per al funcionament del sistema (taule histories). Totes les connexions a la BBDD s'agafa automàticament del config del wordpress.

El pluggin està emmagatzemat a la carpeta wp-content/plugins/pixelon/ despres ja especificarem que és cada arxiu.


## shortcodes

### [grava_audios]
Aquest shortcode en crearà la pàgina de participació on tindrem dos enllaços un per crear una nova història i un altre per continuar històries ja començades.

### [veure_historia]
Visualització d'històries, on es podran escoltar els audios que ja estiguin enregistrats, sinó està acabada la història tindràs l'oportunitat de continuar-la gravant el següent àudio.

### [veure_home_histories]
Visualització per a l'apartat de la home de les últimes històries. Crear 4 blocs amb la info de la història.

### [veure_histories filtre='$WHERE']
Visualització de les històries amb filtre, el tag filtre podem generar una consulta SQL per poder filtra les històries. Es pot jugar amb els camps de la taula **histories** de la BBDD.
Els filtres poden ser diversos des d'històries completades, històries inacabades, per data de creació, data d'actualització...


## Taula Histories:

--
-- Estructura de la taula `histories`
--
CREATE TABLE `histories` (
  `id` int(11) NOT NULL,
  `usu_intro` int(11) DEFAULT NULL,
  `audio_intro` text DEFAULT NULL,
  `usu_nus` int(11) DEFAULT NULL,
  `audio_nus` text DEFAULT NULL,
  `usu_final` int(11) DEFAULT NULL,
  `audio_final` text DEFAULT NULL,
  `finalitzat` int(11) DEFAULT NULL,
  `estrelles` int(11) DEFAULT NULL,
  `musica_fons` text DEFAULT NULL,
  `titol` text DEFAULT NULL,
  `text_resum` text DEFAULT NULL,
  `ima` text DEFAULT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_creacio` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



