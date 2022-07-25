<?php
require 'functions.php';

header("Content-Type: application/json; charset=utf-8");

if (isset($_GET['from'])) {
    $pOrigin = urldecode($_GET['from']);
} elseif (isset($_GET['from.latitude']) and isset($_GET['from.longitude'])) {
    $pOrigin = array(
        $_GET['from.latitude'],
        $_GET['from.longitude']
    );
} else {
    $error_text = "
Error! Set origin (from or from.latitude & from.longitude) or set help for help<br>

";
    exit($error_text);
}
if (isset($_GET['to'])) {
    $pDestination = urldecode($_GET['to']);
} elseif (isset($_GET['to.latitude']) and isset($_GET['to.longitude'])) {
    $pDestination = array(
        $_GET['to.latitude'],
        $_GET['to.longitude']
    );
} else {
    exit("Error! Set destination (to or to.latitude & to.longitude) or set help for help");
}

if (isset($_GET['departure'])) {
    $pDepOrArrTime = "dep";
    $pWhen = $_GET['departure'];
} elseif (isset($_GET['arrival'])) {
    $pDepOrArrTime = "arr";
    $pWhen = $_GET['arrival'];
} else {
    $pDepOrArrTime = "dep";
    $pWhen = "now";
}
if (isset($_GET['calcNumberOfTrips'])) {
    $pCalcNumberOfTrips = $_GET['calcNumberOfTrips'];
} else {
    $pCalcNumberOfTrips = 5;
}

if (isset($_GET['remarks'])) {
    $pRemarks = filter_var($_GET['remarks'], FILTER_VALIDATE_BOOLEAN);
} else {
    $pRemarks = False;
}

if (isset($_GET['maxTransfers'])) {
    $pMaxTransfers = $_GET['maxTransfers'];
} else {
    // 9 means no limit
    $pMaxTransfers = 9;
}

if (isset($_GET['walkingSpeed']) and (($_GET['walkingSpeed'] == "slow") or ($_GET['walkingSpeed'] == "normal") or ($_GET['walkingSpeed'] == "fast"))) {
    $pWalkingSpeed = $_GET['walkingSpeed'];
} else {
    // 9 means no limit
    $pWalkingSpeed = "normal";
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

echo getJourney($argOrigin = $pOrigin, $argDestination = $pDestination, $argCalcNumberOfTrips = $pCalcNumberOfTrips, $argRemarks=$pRemarks, $argWhen = $pWhen, $argDepOrArrTime = $pDepOrArrTime, $argMaxTransfers = $pMaxTransfers, $argWalkingSpeed = $pWalkingSpeed, $argSuburban = $pSuburban, $argSubway = $pSubway, $argTram = $pTram, $argBus = $pBus, $argFerry = $pFerry, $argExpress = $pExpress, $argRegional = $pRegional, $argLanguage = $pLanguage, $argPretty = $pPretty);


phpinfo();
