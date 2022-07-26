<?php
require 'functions.php';

header("Content-Type: application/json; charset=utf-8");

//25003001 Uhlhornstraße
if (isset($_GET['id'])) {
    $pId = $_GET['id'];
} else {
    exit("Error! Set id or set help for help");
}
if (isset($_GET['when'])) {
    $pWhen = $_GET['when'];
} else {
    $pWhen = "now";
}
if (isset($_GET['deporarr']) and (($_GET['deporarr']=="dep") or ($_GET['deporarr']=="arr"))) {
    $pDepOrArr = $_GET['deporarr'];
} else {
    $pDepOrArr = "dep";
}
if (isset($_GET['results'])) {
    $pResults = $_GET['results'];
} else {
    $pResults = 10;
}
if (isset($_GET['suburban'])) {
    $pSuburban = filter_var($_GET['suburban'], FILTER_VALIDATE_BOOLEAN);
} else {
    $pSuburban = True;
}
if (isset($_GET['subway'])) {
    $pSubway = filter_var($_GET['subway'], FILTER_VALIDATE_BOOLEAN);
} else {
    $pSubway = True;
}
if (isset($_GET['tram'])) {
    $pTram = filter_var($_GET['tram'], FILTER_VALIDATE_BOOLEAN);
} else {
    $pTram = True;
}
if (isset($_GET['bus'])) {
    $pBus = filter_var($_GET['bus'], FILTER_VALIDATE_BOOLEAN);
} else {
    $pBus = True;
}
if (isset($_GET['ferry'])) {
    $pFerry = filter_var($_GET['ferry'], FILTER_VALIDATE_BOOLEAN);
} else {
    $pFerry = True;
}
if (isset($_GET['express'])) {
    $pExpress = filter_var($_GET['express'], FILTER_VALIDATE_BOOLEAN);
} else {
    $pExpress = True;
}
if (isset($_GET['regional'])) {
    $pRegional = filter_var($_GET['regional'], FILTER_VALIDATE_BOOLEAN);
} else {
    $pRegional = True;
}
if (isset($_GET['remarks'])) {
    $pRemarks = filter_var($_GET['remarks'], FILTER_VALIDATE_BOOLEAN);
} else {
    $pRemarks = True;
}

if (isset($_GET['duration'])) {
    $pDuration = $_GET['duration'];
} else {
    $pDuration = False;
}
if (isset($_GET['direction'])) {
    $pDirection = $_GET['direction'];
} else {
    $pDirection = "";
}

if (isset($_GET['pretty'])) {
    $pPretty = $_GET['pretty'];
} else {
    $pPretty = False;
}

echo getStopsDeparturesById($argId=$pId, $argWhen = $pWhen, $argDepOrArr = $pDepOrArr, $argResults = $pResults, $argDirection=$pDirection, $argDuration=$pDuration, $argRemarks=$pRemarks, $argLinesOfStops=True, $argSuburban = $pSuburban, $argSubway = $pSubway, $argTram = $pTram, $argBus = $pBus, $argFerry = $pFerry, $argExpress = $pExpress, $argRegional = $pRegional, $argPretty=$pPretty);

