# efa_hannover
Ich habe eine API zum Abfragen des ÖPNV im Bereich des Großverkehrsraumes Hannover gefunden.

## Wie es dazu kam

Mir kam die Idee, dass der API-Endpunkt in der Android-App hinterlegt sein müsste. Also habe ich die App mittels Diggy dekompiliert und mir die URLs genau angeschaut.

Dabei stieß ich auf folgende URLs:

/assets/www/app-b654b087dd.js:https://app.efa.de/mdv_server/app_gvh/XML_STOPFINDER_REQUEST

/assets/www/app-b654b087dd.js:https://app.efa.de/mdv_server/app_gvh/XML_TRIP_REQUEST2

/assets/www/app-b654b087dd.js:https://app.efa.de/mdv_server/app_gvh/XML_DM_REQUEST

/assets/www/app-b654b087dd.js:https://app.efa.de/mdv_server/app_gvh/XML_DM_REQUEST

/assets/www/app-b654b087dd.js:http://app.efa.de/efaws2/default/PT_PRICE_INFO_REQUEST

/assets/www/app-b654b087dd.js:https://app.efa.de/mdv_server/app_gvh/XML_COORD_REQUEST

/assets/www/app-b654b087dd.js:https://app.efa.de/mdv_server/app_gvh/XML_ADDINFO_REQUEST

/assets/www/app-b654b087dd.js:https://app.efa.de/mdv_server/mdv/XML_LINELIST_REQUEST


Mit ein bisschen Google und der hervorragenden Dokumentation der Wiener Linien (https://data.wien.gv.at/pdf/wiener-linien-routing.pdf) gelang es mir herauszufinden, wie man die API anspricht.

## XML_DM_REQUEST

https://app.efa.de/mdv_server/app_gvh/XML_COORD_REQUEST?session=0&coord=3550553.68953:355034.12035:NAV3:&coordListOutputFormat=STRING&coordOutputFormat=NAV3&inclFilter=1&type_1=STOP&stateless=1&max=200&radius_1=50000


Die obrige URL führt zu einem XML-Dokument in welchem man 200 Haltestelle (max) im Umkreis von 50.000 Meter (radius_1) um die Koordinaten 3550553.68953, 355034.12035 (coord) findet.
