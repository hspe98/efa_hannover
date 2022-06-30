<?php

include 'functions.php';
if (isset($_GET['help'])) {
    header("Content-Type: text/html");
    echo "
    <h1>".$_SERVER['SCRIPT_NAME']."</h1>
    <pre>
id              required
linesOfStops    False       Get lines for all stops?
language        en          language
pretty          False       Pretty-print JSON?
    </pre>";
} else {
    header("Content-Type: application/json");
    
    
    //XML_STOP_INFO_REQUEST?sessionID=0&type_si=stop&stopService=timeTable&name_si=25003001&outputFormat=XML
    if (isset($_GET['id'])) {
        $pId = floatval($_GET['id']);
    } else {
        exit("Error! Set ID or set help for help");
    }
    if (isset($_GET['linesOfStops'])) {
        $pLinesOfStops = $_GET['linesOfStops'];
    } else {
        $pLinesOfStops = True;
    }
    if (isset($_GET['language'])) {
        $pLanguage = $_GET['language'];
    } else {
        $pLanguage = "en";
    }
    if (isset($_GET['pretty'])) {
        $pPretty = $_GET['pretty'];
    } else {
        $pPretty = False;
    }
    
    
    echo getStopsById($pId, $argLinesOfStops=$pLinesOfStops, $argLanguage=$pLanguage, $argPretty=$pPretty);
}