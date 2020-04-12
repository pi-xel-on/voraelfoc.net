# voraelfoc.net

## Presentació
Hola! som del projecte “vora el foc”. 

Jo sóc en Sergi Mussull i faig Producció d’audiovisual i programació. 
Jo sóc en Jordi Marquès, sóc Desenvolupador i Cap de Projectes.

Portem 20? (molts) anys treballant per empreses, corporacions, museus i altres institucions realitzant software i instal.lacions audiovisuals. 
Sempre hem treballat utilitzant les darreres tecnologies com la realitat augmentada, la realitat virtual 360 amb Oculus, dissenyant aplicacions tant per ios com per Android, creant instal.lacions reactives, interactives, fotomaton, amb inteligencia artificial amb reconeixement de persones i desenvolupant molts altres projectes sempre innovadors.

Ara, nosaltres com molts milers de vosaltres vivim confinats a casa. 
El Jordi i jo mateix, som pares de família i estem vivint el millor possible tot el que comporta el confinament especialment amb la família. És per això que hem volgut satisfer les necessitats que tenim tots de vencer l'avorriment i de relacionar-nos entre nosaltres. amb una eina que ens permet expressar-nos, sentir-nos escoltats i corresponguts amb respostes a les nostres preocupacions, per més senzilles que siguin. Això reconforta. 

El nostre desig és que amb vora al foc tant nens com gent gran trobar l'escalf de les paraules de gent que no sempre coneixeran . Amb respostes i potser nous punts de vista a les nostres inquietuds i dubtes.
Amb una actitud de molta serietat o amb tocs d' humor que dibuixin un somriure a les nostres cares; amb un tó romàntic o sentimental, podràs expressar-te com vulguis. Tot serà Benvingut. Segur que totes les participacions tindran respostes úniques i meravelloses.

Vora el foc és una Aplicació Web senzilla d'utilitzar. Ho podràs fer des del dispositiu que prefereixis, ja sigui un ordinador, una tablet o un mòbil. Quan ingressos podreu escoltar les participacions de la gent: històries per completar i històries finalitzades i sobretot, podràs iniciar una història personal i veure com la completa gent anònima. Per registrar-te, només caldrà el teu nom i un email per immediatament poder participar. 
Esperem que us agradi tant com a nosaltres ens ha agradat preparar-la. 

Bones històries i bona estada a casa! si pot ser vora el foc. 


## Com hem fet voraelfoc.net
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

### [veure_histories filtre='---']
Visualització de les històries amb filtre, el tag filtre podem generar una consulta SQL per poder filtra les històries. Es pot jugar amb els camps de la taula **histories** de la BBDD.
Els filtres poden ser diversos des d'històries completades, històries inacabades, per data de creació, data d'actualització...


## Taula Histories:

Estructura de la taula `histories`

*CREATE TABLE `histories` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;*

## Llenguatge i llibreries

En la programació s'ha utilitzat els següents llenguatges: PHP, Javascript, CSS. Per la BBDD s'ha utilitzat la de Wodpress MySql.
Les llibreries utilitzades són JQuery, Bootstrap, WaveSurfer

## Navegadors recomanats
Hem fica't un llista de navegadors recomanats, ja que utilitzem mediaDevices.getUserMedia per poder utilitzar el micròfon dels dispositius. I no tots els navegadors actuals són compatibles amb aquest sistema.
Recomanem utilitzar Chrome, Firefox, Opera, Edge, Yandex, Safari versió MacOS


## Postdata
Per ser una eina desenvolupada durant solament 1 setmana de temps dintre la Hackovid ha quedat prou resultona i els inputs obtinguts per algun tester ha sigut satisfactòria.



Idea creativa Pixelon

