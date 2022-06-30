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
        $pQuery = $_GET['q'];
    } else {
        exit("Error! Set q or set help for help");
    }
    if (isset($_GET['poi'])) {
        $pPOI = filter_var($_GET['poi'], FILTER_VALIDATE_BOOLEAN);
    } else {
        $pPOI = True;
    }
    if (isset($_GET['stops'])) {
        $pStops = filter_var($_GET['stops'], FILTER_VALIDATE_BOOLEAN);
    } else {
        $pStops = True;
    }
    if (isset($_GET['addresses'])) {
        $pStreets = filter_var($_GET['addresses'], FILTER_VALIDATE_BOOLEAN);
    } else {
        $pStreets = True;
    }
    if (isset($_GET['results'])) {
        $pResults = $_GET['results'];
    } else {
        $pResults = 10;
    }
    if (isset($_GET['language'])) {
        $pLang = $_GET['language'];
    } else {
        $pLang = "en";
    }
    if (isset($_GET['pretty'])) {
        $pPretty = $_GET['pretty'];
    } else {
        $pPretty = False;
    }
    echo utf8_decode(getLocation($argQuery=$pQuery, $argNumResults=$pResults, $argLanguage=$pLang, $argGetPOI=$pPOI, $argGetStreets = $pStreets, $argGetStops = $pStops, $argPretty=$pPretty));
}