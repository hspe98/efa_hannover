<?php

include 'functions.php';

if (isset($_GET['help'])) {
    header("Content-Type: text/html");
    echo "
    <h1>".$_SERVER['SCRIPT_NAME']."</h1>
    <pre>
    q           required            Search term
    poi         True		Get pois?
    stops       True		Get stops?
    addresses   True		Get addresses?
    results     10			Number of results
    language    en			language
    pretty      False		Pretty-print JSON?
    </pre>";
} else {
    header("Content-Type: application/json");
    //locations
    if (isset($_GET['q'])) {
        $pQ = $_GET['q'];
    } else {
        exit("Error! Set q or set help for help");
    }
    if (isset($_GET['poi'])) {
        $gPOI = filter_var($_GET['poi'], FILTER_VALIDATE_BOOLEAN);
    } else {
        $gPOI = True;
    }
    if (isset($_GET['stops'])) {
        $gStops = filter_var($_GET['stops'], FILTER_VALIDATE_BOOLEAN);
    } else {
        $gStops = True;
    }
    if (isset($_GET['addresses'])) {
        $gStreets = filter_var($_GET['addresses'], FILTER_VALIDATE_BOOLEAN);
    } else {
        $gStreets = True;
    }
    if (isset($_GET['results'])) {
        $paramResults = $_GET['results'];
    } else {
        $paramResults = 10;
    }
    if (isset($_GET['language'])) {
        $paramLang = $_GET['language'];
    } else {
        $paramLang = "en";
    }
    if (isset($_GET['pretty'])) {
        $pPretty = $_GET['pretty'];
    } else {
        $pPretty = False;
    }
    echo utf8_decode(getLocation($argQuery=$pQ, $argNumResults=$paramResults, $argLanguage=$paramLang, $argGetPOI=$gPOI, $argGetStreets = $gStreets, $argGetStops = $gStops, $argPretty=$pPretty));
}