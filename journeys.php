<?php
require 'functions.php';

header("Content-Type: application/json; charset=utf-8");

function DateTimeArrayToISO($array, $addMinutes = 0)
{
    if ($array["errors"]["0"] == "Data missing") {
        return null;
    }
    return date("c", mktime($array["hour"], intval($array["minute"]) - $addMinutes, $array["second"], $array["month"], $array["day"], $array["year"]));
}

function getJourney($argOrigin, $argDestination, $argCalcNumberOfTrips = 5, $argWhen = "now", $argDepOrArrTime = "dep", $argMaxTransfers = 9, $argWalkingSpeed = "normal", $argSuburban = True, $argSubway = True, $argTram = True, $argBus = True, $argFerry = True, $argExpress = True, $argRegional = True, $argLanguage = "en", $argPretty = True)
{
    $query = "locationServerActive=1&odvMacro=true&stateless=1&coordOutputFormat=WGS84[DD.ddddd]&useHouseNumberList=true&useSuburb=1&execIns=normal&useRealtime=1";
    if (is_array($argOrigin)) {
        // origin is an array of coords
        $query .= "&type_origin=coord&name_origin=" . floatval($argOrigin[1]) . ":" . floatval($argOrigin[0]) . ":WGS84:";
    } else {
        // else give stopID
        $query .= "&type_origin=any&name_origin=" . urlencode($argOrigin);
    }
    if (is_array($argDestination)) {
        // destination is an array of coords
        $query .= "&type_destination=coord&name_destination=" . floatval($argDestination[1]) . ":" . floatval($argDestination[0]) . ":WGS84:";
    } else {
        // else give stopID
        $query .= "&type_destination=any&name_destination=" . urlencode($argDestination);
    }

    $query .= "&itOptionsActive=1&ptOptionsActive=1";
    // limit number of results
    $query .= "&calcNumberOfTrips=" . $argCalcNumberOfTrips;
    // convert when argument to an unix timestamp
    $timestamp = strtotime($argWhen);
    // format as EFA time (HHMM)
    $filter_time = date('Hi', $timestamp);
    // format as EFA date (JJJJMMTT)
    $filter_date = date('Ymd', $timestamp);
    $query .= "&itdTime=" . $filter_time;
    $query .= "&itdDate=" . $filter_date;
    // arrival or departure time?
    $query .= "&itdTripDateTimeDepArr=" . $argDepOrArrTime;
    // filter by changes
    $query .= "&maxChanges=" . $argMaxTransfers;
    // define walking speed
    if (($argWalkingSpeed == "normal") or ($argWalkingSpeed == "fast") or ($argWalkingSpeed == "slow")) {
        $query .= "&changeSpeed=" . $argWalkingSpeed;
    } else {
        $query .= "&changeSpeed=normal";
    }
    // determines if a MOT filter was set
    if (! $argSuburban) {
        $query .= "&excludedMeans=1";
    }
    if (! $argSubway) {
        $query .= "&excludedMeans=2";
    }
    if (! $argTram) {
        $query .= "&excludedMeans=3";
    }
    if (! $argBus) {
        $query .= "&excludedMeans=5&excludedMeans=6&excludedMeans=7";
    }
    if (! $argFerry) {
        $query .= "&excludedMeans=8";
    }
    if (! $argExpress) {
        $query .= "&excludedMeans=0";
    }
    if (! $argRegional) {
        $query .= "&excludedMeans=0";
    }
    $query .= "&language=" . $argLanguage;
    // test url
    // echo "https://app.efa.de/mdv_server/app_gvh/XML_TRIP_REQUEST2?session=0&outputEncoding=UTF-8&inputEncoding=UTF-8&outputFormat=json&" . $query;
    $data = getData("XML_TRIP_REQUEST2", $outputFormat = "json", $query);
    $data = json_decode(utf8_encode($data), 1);
    if (isset($_GET['test'])) {
        print_r(json_encode($data));
    }
    // Check if too many point options
    if ((count($data["origin"]["points"]) > 1) or (count($data["destination"]["points"]) > 1)) {
        if (count($data["origin"]["points"]) > 1) {
            $result["errors"]["origin"] = array("Too many origin options"=>count($data["origin"]["points"]));

            foreach ($data["origin"]["points"] as $point) {
                $result["options"]["origin"][] = array(
                    "stopID" => $point["ref"]["id"],
                    "name" => $point["name"],
                    "stateless" => $point["stateless"]
                );
            }
        }
        if (count($data["destination"]["points"]) > 1) {
            $result["errors"]["destination"] = array("Too many destination options"=>count($data["destination"]["points"]));
            foreach ($data["destination"]["points"] as $point) {
                $result["options"]["destination"][] = array(
                    "stopID" => $point["ref"]["id"],
                    "name" => $point["name"],
                    "stateless" => $point["stateless"]
                );
            }
        }
        return json_encode($result, JSON_PRETTY_PRINT);
    } else {
        // loop through each trip
        foreach ($data["trips"] as $trip) {
            // fares
            foreach ($trip["itdFare"]["fares"]["fare"]["genericTicketGroups"] as $ticket) {
                $tickets[] = array(
                    "name" => $ticket["genericTickets"][0]["value"],
                    "category" => $ticket["genericTickets"][1]["value"],
                    "authority" => $ticket["genericTickets"][7]["value"],
                    "price" => array(
                        "adult" => ((floatval($ticket["genericTickets"][2]["value"]) == 0) ? null : floatval($ticket["genericTickets"][2]["value"])),
                        "child" => ((floatval($ticket["genericTickets"][3]["value"]) == 0) ? null : floatval($ticket["genericTickets"][3]["value"]))
                    )
                );
            }

            // loop through each trip for legs
            foreach ($trip["legs"] as $leg) {
                $leg_helper = array(
                    "origin" => array(
                        "type" => $leg["points"][0]["usage"],
                        "id" => $leg["points"][0]["ref"]["id"],
                        "name" => $leg["points"][0]["name"],
                        "location" => array(
                            "type" => "location",
                            "id" => $leg["points"][0]["ref"]["id"],
                            "latitude" => floatval(explode(",", $leg["points"][0]["ref"]["coords"])[1]),
                            "longitude" => floatval(explode(",", $leg["points"][0]["ref"]["coords"])[0])
                        ),
                        "download" => BASE_URL . $leg["points"][0]["links"][0]["href"]
                    ),
                    "destination" => array(
                        "type" => $leg["points"][1]["usage"],
                        "id" => $leg["points"][1]["ref"]["id"],
                        "name" => $leg["points"][1]["name"],
                        "location" => array(
                            "type" => "location",
                            "id" => $leg["points"][1]["ref"]["id"],
                            "latitude" => floatval(explode(",", $leg["points"][1]["ref"]["coords"])[1]),
                            "longitude" => floatval(explode(",", $leg["points"][1]["ref"]["coords"])[0])
                        ),
                        "download" => BASE_URL . $leg["points"][1]["links"][0]["href"]
                    ),
                    "departure" => DateTimeArrayToISO(date_parse_from_format("Ymd H:i", $leg["stopSeq"][0]["ref"]["depDateTime"])),
                    "plannedDeparture" => DateTimeArrayToISO(date_parse_from_format("Ymd H:i", $leg["stopSeq"][0]["ref"]["depDateTime"]), $leg["stopSeq"][0]["ref"]["depDelay"]),
                    "departureDelay" => intval($leg["stopSeq"][0]["ref"]["depDelay"]),
                    "arrival" => DateTimeArrayToISO(date_parse_from_format("Ymd H:i", end($leg["stopSeq"])["ref"]["arrDateTime"])),
                    "plannedArrival" => DateTimeArrayToISO(date_parse_from_format("Ymd H:i", end($leg["stopSeq"])["ref"]["arrDateTime"]), end($leg["stopSeq"])["ref"]["arrDelay"]),
                    "arrivalDelay" => intval(end($leg["stopSeq"])["ref"]["arrDelay"]),
                    "reachable" => null,
                    "tripId" => $leg["mode"]["diva"]["tripCode"],
                    "line" => array(
                        "type" => "line",
                        "id" => $leg["mode"]["productId"],
                        "fahrtNr" => null,
                        "name" => $leg["mode"]["name"],
                        "public" => true,
                        "productName" => $leg["mode"]["product"],
                        "mode" => $leg["mode"]["product"],
                        "product" => $leg["mode"]["product"],
                        "symbol" => $leg["mode"]["symbol"],
                        "nr" => $leg["mode"]["number"]
                    ),
                    "direction" => $leg["mode"]["destination"],
                    "currentLocation" => null,
                    "arrivalPlatform" => $leg["points"][0]["ref"]["platform"],
                    "plannedArrivalPlatform" => $leg["points"][0]["ref"]["platform"],
                    "departurePlatform" => $leg["points"][1]["ref"]["platform"],
                    "plannedDeparturePlatform" => $leg["points"][1]["ref"]["platform"]
                );
                // when MOT = Fussweg (walking), then we need to adjust some fields
                if ($leg_helper["line"]["mode"] == "Fussweg") {
                    $leg_helper["departure"] = date("c", strtotime($leg_helper["arrival"] . " -" . ($leg["timeMinute"] + 1) . "minutes"));
                    $leg_helper["plannedDeparture"] = $leg_helper["departure"];
                    $leg_helper["direction"] = $leg_helper["destination"]["name"];
                }
                $legs[] = $leg_helper;
            }

            $trips[] = array(
                "type" => "journey",
                "legs" => $legs
            );
            // "tickets" => $tickets

            unset($legs);
            unset($tickets);
        }
    }

    $result[] = array(
        "journeys" => $trips
    );

    // pretty-print json
    if ($argPretty == True) {
        return json_encode($result, JSON_PRETTY_PRINT);
    } else {
        return json_encode($result);
    }
}

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

echo getJourney($argOrigin = $pOrigin, $argDestination = $pDestination, $argCalcNumberOfTrips = $pCalcNumberOfTrips, $argWhen = $pWhen, $argDepOrArrTime = $pDepOrArrTime, $argMaxTransfers = $pMaxTransfers, $argWalkingSpeed = $pWalkingSpeed, $argSuburban = $pSuburban, $argSubway = $pSubway, $argTram = $pTram, $argBus = $pBus, $argFerry = $pFerry, $argExpress = $pExpress, $argRegional = $pRegional, $argLanguage = $pLanguage, $argPretty = $pPretty);



