# efa_hannover
Ich habe eine API zum Abfragen des ÖPNV im Bereich des Großverkehrsraumes Hannover gefunden.

## Wie es dazu kam

Mir kam die Idee, dass der API-Endpunkt in der Android-App hinterlegt sein müsste. Also habe ich die App mittels [Diggy](https://github.com/s0md3v/Diggy) dekompiliert und mir die URLs genau angeschaut.

Dabei stieß ich auf folgende URLs:

```
/assets/www/app-b654b087dd.js:https://app.efa.de/mdv_server/app_gvh/XML_STOPFINDER_REQUEST

/assets/www/app-b654b087dd.js:https://app.efa.de/mdv_server/app_gvh/XML_TRIP_REQUEST2

/assets/www/app-b654b087dd.js:https://app.efa.de/mdv_server/app_gvh/XML_DM_REQUEST

/assets/www/app-b654b087dd.js:http://app.efa.de/efaws2/default/PT_PRICE_INFO_REQUEST

/assets/www/app-b654b087dd.js:https://app.efa.de/mdv_server/app_gvh/XML_COORD_REQUEST

/assets/www/app-b654b087dd.js:https://app.efa.de/mdv_server/app_gvh/XML_ADDINFO_REQUEST

/assets/www/app-b654b087dd.js:https://app.efa.de/mdv_server/mdv/XML_LINELIST_REQUEST
```

Mit ein bisschen Google und der hervorragenden Dokumentation der Wiener Linien (https://data.wien.gv.at/pdf/wiener-linien-routing.pdf) gelang es mir herauszufinden, wie man die API anspricht.

## XML_COORD_REQUEST

```
https://app.efa.de/mdv_server/app_gvh/XML_COORD_REQUEST?session=0&coord=3550553.68953:355034.12035:NAV3:&coordListOutputFormat=STRING&coordOutputFormat=NAV3&inclFilter=1&type_1=STOP&stateless=1&max=200&radius_1=50000
```

Die obrige URL führt zu einem XML-Dokument in welchem man 200 Haltestelle (`max`) im Umkreis von 50.000 Meter (`radius_1`) um die Koordinaten 3550553.68953, 355034.12035 (`coord`) findet.

Besonders relevant in dem Dokument sind die Ids der jeweiligen Haltestellen: Man findet die Haltestellen unter dem Pfad `/itdRequest/itdCoordInfoRequest/itdCoordInfo/coordInfoItemList`.

### Beispielhafter Aufbau eines Elementes:

```xml
<coordInfoItem type="STOP" id="25000033" name="Hauptbahnhof/E.-August-Platz" omc="3241001" placeID="18" locality="Hannover" gisLayer="SYS-STOP" gisID="25000033" distance="0" stateless="25000033">
  <itdPathCoordinates>
    <coordEllipsoid>UNKNOWN_ELLIPSOID</coordEllipsoid>
    <coordType>UNKNOWN_COORDINATE_TYPE</coordType>
    <itdCoordinateString decimal="." cs="," ts="&#x20;" format="x,y">3550553.68953,355034.12035</itdCoordinateString>
  </itdPathCoordinates>
  <genAttrList>
    <genAttrElem>
      <name>STOP_GLOBAL_ID</name>
      <value>de:03241:33</value>
    </genAttrElem>
    <genAttrElem>
      <name>STOP_NAME_WITH_PLACE</name>
      <value>Hannover Hauptbahnhof/E.-A.-Pl</value>
    </genAttrElem>
    <genAttrElem>
      <name>STOP_MAJOR_MEANS</name>
      <value>3</value>
    </genAttrElem>
    <genAttrElem>
      <name>STOP_MEANS_LIST</name>
      <value>3,104</value>
    </genAttrElem>
    <genAttrElem>
      <name>STOP_TARIFF_ZONES:gvh</name>
      <value>101</value>
    </genAttrElem>
  </genAttrList>
  <itdIndexInfoList/>
</coordInfoItem>
```

Die exakte Bedeutung der einzelnen Codes sind mir noch unbekannt, aber bestimmt schwirrt da draußen irgendwo wer rum, der damit was anfangen kann.

## XML_DM_REQUEST

```
https://app.efa.de/mdv_server/app_gvh/XML_DM_REQUEST?name_dm=25000033&type_dm=any&trITMOTvalue100=10&changeSpeed=normal&exclMOT_0=1&exclMOT_1=1&exclMOT_2=1&mergeDep=1&coordOutputFormat=NAV3&coordListOutputFormat=STRING&useAllStops=1&excludedMeans=checkbox&useRealtime=1&deleteAssignedStops=1&itOptionsActive=1&canChangeMOT=0&mode=direct&ptOptionsActive=1&limit=10&imparedOptionsActive=1&locationServerActive=1&depType=stopEvents&useProxFootSearch=0&maxTimeLoop=2&includeCompleteStopSeq=1
```

Mit dieser Funktion kann man sich einen Abfahrtsmonitor anzeigen lassen. Die exakten Parameter sind in der Dokumentation der Wiener Linien beschrieben. Besonders relevant ist `name_dm`: Hier trägt man die ID der Haltestelle ein (z.B. aus dem Attribut `id` des Elements `coordInfoItem` aus der Abfrage an XML_COORDS_REQUEST).
