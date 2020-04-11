# voraelfoc.net
Creació de una plataforma per generar histories cooperatives.



La base es un Wordpress per aprofitar tot el sistema de usuaris i recursos que ens pot oferir un plataforma tan oberta i opensource com es Wordpress.

Pluggins Wordpress necessaris perque la plaforma funcioni correctament Ultimate Members per poder fer un control de usuaris mes eficas i generar el formularis de registre i login.
Un altre plugin necessari es ACF (advance custom fields) que ens permetra crear un parell de camps nous per al usuaris, aquest camps son ocults pero s'utilitzen en la programacio del plugin.


Desenvolupament de un pluggin que ens fara de gestor de tota la plataforma de gravació i de control del sistema, aquest pluggin es el core de tota la aplicació.
El pluggin esta programat per generar una serie de shortcodes que ficat dintre del wordpress s'interpreten i generen les pagines del aplicatiu,  utilitza el tramat de taules de WP per alimentarse i generem una altra per al funcionament del sistema  (taule histories). Totes les conexions a la BBDD s'agafa automaticament del config del wordpress.

El pluggin esta enmagatzemat a la carpeta  wp-content/plugins/pixelon/ despres ja especificarem que es cada arxiu.


## shortcodes

###[grava_audios]
s
###[veure_historia]

###[veure_block_histories]

###[veure_home_histories]

###[veure_histories]


