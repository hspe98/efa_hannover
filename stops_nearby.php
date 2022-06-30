<?php

include 'functions.php';
if (isset($_GET['help'])) {
    header("Content-Type: text/html");
    echo "
    <h1>".$_SERVER['SCRIPT_NAME']."</h1>
    <pre>
latitude        required
longitude       required
results	           8        number of results
distance        1000        maximum distance
poi             True        Get pois?
stops           True        Get stops?
linesOfStops    False       Get lines for all stops?
language        en          language
pretty          False       Pretty-print JSON?
    </pre>";
} else {
header("Content-Type: application/json");

//stops/nearby
if (!isset($_GET['latitude']) and !isset($_GET['longitude'])) {
    exit("Error! Set latitude and longitude or set help for help");;
}
if (isset($_GET['latitude'])) {
    $pLatitude = floatval($_GET['latitude']);
} else {
    exit("Error! Set latitude");
}
if (isset($_GET['longitude'])) {
    $pLongitude = floatval($_GET['longitude']);
} else {
    exit("Error! Set longitude");
}
/*
 latitude	Required.	number	–
 longitude	Required.	number	–
 results	maximum number of results	integer	8
 distance	maximum walking distance in meters	integer	–
 stops	Return stops/stations?	boolean	true
 poi	Return points of interest?	boolean	false
 linesOfStops	Parse & expose lines at each stop/station?	boolean	false
 language	Language of the results.	string	en
 pretty	Pretty-print JSON responses?	boolean	true
 
 */
if (isset($_GET['results'])) {
    $pResults = $_GET['results'];
} else {
    $pResults = 8;
}
if (isset($_GET['distance'])) {
    $pDistance = $_GET['distance'];
} else {
    $pDistance = 1000;
}
if (isset($_GET['language'])) {
    $pLang = $_GET['language'];
} else {
    $pLang = "en";
}
if (isset($_GET['stops'])) {
    $pStops = $_GET['stops'];
} else {
    $pStops = True;
}
if (isset($_GET['poi'])) {
    $pPoi = $_GET['poi'];
} else {
    $pPoi = False;
}
if (isset($_GET['linesOfStops'])) {
    $pLinesOfStops = $_GET['linesOfStops'];
} else {
    $pLinesOfStops = True;
}
if (isset($_GET['pretty'])) {
    $pPretty = $_GET['pretty'];
} else {
    $pPretty = False;
}

echo getStopsNearby($pLatitude, $pLongitude, $argResults=$pResults, $argDistance=$pDistance, $argStops=$pStops, $argPoi=$pPoi, $argLinesOfStops=$pLinesOfStops, $argLanguage=$pLang, $argPretty=$pPretty);
}