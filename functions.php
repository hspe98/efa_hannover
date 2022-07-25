<?php

define(BASE_URL,"https://app.efa.de/mdv_server/app_gvh/");

error_reporting(E_ALL);



/**
 * Check if function str_contains exists
 */
if (!function_exists('str_contains')) {
    /**
     * 
     * Checks if needle is substring of haystack
     * 
     * @param string $haystack
     * @param string $needle
     * @return boolean
     * @author https://www.php.net/manual/de/function.str-contains.php#125977
     */
    function str_contains($haystack, $needle) {
        return $needle !== '' && mb_strpos($haystack, $needle) !== false;
    }
}


/**
 * 
 * Converts xml element to php array
 * 
 * @param $xml
 * @param array $options
 * @author https://outlandish.com/blog/tutorial/xml-to-json/
 * @return array
 */
function xmlToArray($xml, $options = array())
{
    $defaults = array(
        'namespaceSeparator' => ':', // you may want this to be something other than a colon
        'attributePrefix' => '@', // to distinguish between attributes and nodes with the same name
        'alwaysArray' => array(), // array of xml tag names which should always become arrays
        'autoArray' => true, // only create arrays for tags which appear more than once
        'textContent' => '$', // key used for the text content of elements
        'autoText' => true, // skip textContent key if node has no attributes or child nodes
        'keySearch' => false, // optional search and replace on tag and attribute names
        'keyReplace' => false // replace values for above search values (as passed to str_replace())
    );
    $options = array_merge($defaults, $options);
    $namespaces = $xml->getDocNamespaces();
    $namespaces[''] = null; // add base (empty) namespace

    // get attributes from all namespaces
    $attributesArray = array();
    foreach ($namespaces as $prefix => $namespace) {
        foreach ($xml->attributes($namespace) as $attributeName => $attribute) {
            // replace characters in attribute name
            if ($options['keySearch'])
                $attributeName = str_replace($options['keySearch'], $options['keyReplace'], $attributeName);
            $attributeKey = $options['attributePrefix'] . ($prefix ? $prefix . $options['namespaceSeparator'] : '') . $attributeName;
            $attributesArray[$attributeKey] = (string) $attribute;
        }
    }

    // get child nodes from all namespaces
    $tagsArray = array();
    foreach ($namespaces as $prefix => $namespace) {
        foreach ($xml->children($namespace) as $childXml) {
            // recurse into child nodes
            $childArray = xmlToArray($childXml, $options);
            list ($childTagName, $childProperties) = each($childArray);

            // replace characters in tag name
            if ($options['keySearch'])
                $childTagName = str_replace($options['keySearch'], $options['keyReplace'], $childTagName);
            // add namespace prefix, if any
            if ($prefix)
                $childTagName = $prefix . $options['namespaceSeparator'] . $childTagName;

            if (! isset($tagsArray[$childTagName])) {
                // only entry with this key
                // test if tags of this type should always be arrays, no matter the element count
                $tagsArray[$childTagName] = in_array($childTagName, $options['alwaysArray']) || ! $options['autoArray'] ? array(
                    $childProperties
                ) : $childProperties;
            } elseif (is_array($tagsArray[$childTagName]) && array_keys($tagsArray[$childTagName]) === range(0, count($tagsArray[$childTagName]) - 1)) {
                // key already exists and is integer indexed array
                $tagsArray[$childTagName][] = $childProperties;
            } else {
                // key exists so convert to integer indexed array with previous value in position 0
                $tagsArray[$childTagName] = array(
                    $tagsArray[$childTagName],
                    $childProperties
                );
            }
        }
    }

    // get text content of node
    $textContentArray = array();
    $plainText = trim((string) $xml);
    if ($plainText !== '')
        $textContentArray[$options['textContent']] = $plainText;

    // stick it all together
    $propertiesArray = ! $options['autoText'] || $attributesArray || $tagsArray || ($plainText === '') ? array_merge($attributesArray, $tagsArray, $textContentArray) : $plainText;

    // return node as array
    return array(
        $xml->getName() => $propertiesArray
    );
}

/**
 *
 * Builds the URL and gets the data as an utf-8 decoded string
 *
 * @param string $method
 *            The XML method to be called
 * @param string $outputFormat
 *            The desired output format (json or xml)
 * @param string $query
 *            The query provided by the functions
 * @return string
 */
function getData($method, $outputFormat = "json", $query)
{
    // create curl resource
    $ch = curl_init();

    $url = BASE_URL . $method;
    // set encoding and session = 0
    $url .= "?sessionID=0&outputEncoding=UTF-8&inputEncoding=UTF-8";
    // set outputFormat and append query
    $url .= "&outputFormat=" . $outputFormat . "&" . $query;
    // set url
    curl_setopt($ch, CURLOPT_URL, $url);

    // return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // accept only utf-8 answer
    curl_setopt($ch, CURLOPT_ACCEPT_ENCODING, "utf-8");
    // $output contains the output string
    $output = curl_exec($ch);
    // check for error codes
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    // close curl resource to free up system resources
    curl_close($ch);

    // check if error isn't 200 -> exit
    if ($httpcode != 200) {
        exit("Server doesnt answer properly [".$httpcode."]");
    }
    // return the utf-8 decoded string
    return utf8_decode($output);
}

// used in locations.php
/**
 *
 * Takes a string of comma seperated numbers and converts them to MOT text
 *
 * Each numbers witch is in the list, is a avaiable MOT at this location
 *
 * [MOT = mode of transport]
 *
 * e.g. $numberStr = "5,6,10"
 *
 * result as json = {
 * "train": false,
 * "suburban": false,
 * "subway": false,
 * "tram": false,
 * "subwaytram": false,
 * "citybus": true,
 * "regiobus": false,
 * "expressbus": false,
 * "dialabus": false,
 * "others": false
 * }
 *
 *
 * @param string $numberStr
 * @return array $MOT_list
 */
function locations_translateMOTNumStrtoProdList($numberStr)
{
    // set up dictonary number => string
    $MOT_numbers = array(
        0 => "train", # Zug
        1 => "suburban", # S-Bahn
        2 => "subway", # U-Bahn
        3 => "tram", # Straßenbahn
        4 => "subwaytram", # Straßen- und U-Bahn
        5 => "citybus", # Stadtbus
        6 => "regiobus", # Regiobus
        7 => "expressbus", # Schnellbus
        10 => "dialabus", # Rufbus
        11 => "others"
    );
    // set up return array (everything = false)
    $MOT_list["train"] = False;
    $MOT_list["suburban"] = False;
    $MOT_list["subway"] = False;
    $MOT_list["tram"] = False;
    $MOT_list["subwaytram"] = False;
    $MOT_list["citybus"] = False;
    $MOT_list["regiobus"] = False;
    $MOT_list["expressbus"] = False;
    $MOT_list["dialabus"] = False;
    $MOT_list["others"] = False;
    // split given string with comma-seperated numbers into array with numbers
    $items = explode(",", $numberStr);
    // loop through dict (number->string)
    foreach ($MOT_numbers as $MOT) {
        // loop through number array
        foreach ($items as $item) {
            // if string of foreach loop1 = string of number of dict -> set to true
            if ($MOT == $MOT_numbers[$item]) {
                $MOT_list[$MOT] = True;
            }
        }
    }
    return $MOT_list;
}

/**
 *
 * get locations by query
 *
 * @param string $argQuery
 *            set the query string _(can also be id of stops etc.)_
 * @param number $argNumResults
 *            set the number of results witch should be returned
 * @param string $argLanguage
 *            set the language, default is "en" (alt.: "de")
 * @param boolean $argGetPOI
 *            get POI locations?
 * @param boolean $argGetStreets
 *            get streets as locations?
 * @param boolean $argGetStops
 *            get stops as locations?
 * @param boolean $argPretty
 *            return pretty-print json?
 * @return string
 * @usage
 */
function getLocation($argQuery, $argNumResults = 10, $argLanguage = "en", $argGetPOI = True, $argGetStreets = True, $argGetStops = True, $argPretty = False)
{
    // Calculate filter value
    /*
     * From the documentation:
     * "anyObjFilter_<usage>
     * Die Suche kann auf bestimmte Objekttypen eingegrenzt werden. Der Wert des Parameters ist eine Bitmaske. Die einzelnen Objekttypen lassen sich beliebig kombinieren=>
     *  0 (Kein Filter aktiv)
     *  1 (Orte)
     *  2 (Haltestellen-IDs und –Aliasnamen)
     *  4 (Straßennamen)
     *  8 (Adressen)
     *  16 (Kreuzungen)
     *  32 (POI-IDs und -Aliasnamen)
     *  64 (Postleitzahlen)"
     */
    // apply no filter, when everything should be gotten
    if (($argGetPOI) and ($argGetStreets) and ($argGetStops)) {
        $anyObjFilter_sf = 0;
    } else {
        if ($argGetPOI) {
            // get pois
            $anyObjFilter_sf += 32;
        }
        if ($argGetStreets) {
            // get street crossings, addresses and street names (16+8+4)
            $anyObjFilter_sf += 4+8+16+64+1;
        }
        if ($argGetStops) {
            // get stops
            $anyObjFilter_sf += 2;
        }
    }
    $argQuery = "locationServerActive=1&type_sf=any&coordOutputFormat=WGS84[DD.dddddddd]&name_sf=" . urlencode($argQuery) . "&anyMaxSizeHitList=" . $argNumResults . "&anyObjFilter_sf=" . $anyObjFilter_sf . "&language=" . $argLanguage;
    // get data
    $data = getData("XML_STOPFINDER_REQUEST", "json", $argQuery);
    // transform data to utf-8 encoded php array
    // select stopFinder->points
    $data = json_decode(utf8_encode($data), 1)["stopFinder"]["points"];
    // loop through each location result
    foreach ($data as $point) {
        // if point=poi: format output for poi
        if ($point['anyType'] == "poi") {
            $result[] = array(
                "type" => "location",
                "id" => $point["stateless"],
                "latitude" => floatval(explode(",", $point["ref"]["coords"])[1]),
                "longitude" => floatval(explode(",", $point["ref"]["coords"])[0]),
                "name" => $point["name"],
                "poi" => True
            );
        } elseif ($point['anyType'] == "stop") {
            // if point=stop: format output for stop
            $result[] = array(
                "type" => $point["anyType"],
                "id" => $point["stateless"],
                "name" => $point["name"],
                "location" => array(
                    "type" => "location",
                    "id" => $point["ref"]["omc"],
                    "latitude" => floatval(explode(",", $point["ref"]["coords"])[1]),
                    "longitude" => floatval(explode(",", $point["ref"]["coords"])[0])
                ),
                "products" => locations_translateMOTNumStrtoProdList($point["modes"])
            );
        } else {
            
            $result[] = array(
                "type" => $point["anyType"],
                "id" => $point["stateless"],
                "latitude" => floatval(explode(",", $point["ref"]["coords"])[1]),
                "longitude" => floatval(explode(",", $point["ref"]["coords"])[0]),
                "name" => $point["name"]
            );
        }
    }
    // return pretty-print json
    if ($argPretty == True) {
        return json_encode($result, JSON_PRETTY_PRINT);
    } else {
        return json_encode($result);
    }
}

// used in stops_nearby.php
/**
 * 
 * similiar to locations_translateMOTNumStrtoProdList
 * BUT with less MOT_numbers and different numbers!
 * 
 * @param string $numberStr
 * @return boolean[]
 */
function stops_nearby_translateMOTNumStrtoProdList($numberStr)
{
    $MOT_numbers = array(
        1 => "tram", # Straßenbahn
        2 => "suburban", # S-Bahn
        3 => "bus", # Stadtbus
        6 => "train" # Zug
    );
    // split string to array
    $items = explode(",", $numberStr);
    $MOT_list = array();
    $MOT_list["tram"] = false;
    $MOT_list["suburban"] = false;
    $MOT_list["bus"] = false;
    $MOT_list["train"] = false;
    $MOT_list["subway"] = false;
    $MOT_list["subwaytram"] = false;
    $MOT_list["expressbus"] = false;
    $MOT_list["dialabus"] = false;
    // loop through MOT_numbers
    foreach ($MOT_numbers as $MOT) {
        foreach ($items as $item) {
            if ($MOT == $MOT_numbers[$item]) {
                // if in array from numberStr: set to true (service avaiable)
                $MOT_list[$MOT] = true;
            }
        }
    }

    return $MOT_list;
}

/**
 * @param float $argLat Latitude
 * @param float $argLong Longitude
 * @param int $argResults number of results
 * @param int $argDistance maximal distance
 * @param boolean $argStops get stops
 * @param boolean $argPoi get POIs
 * @param boolean $argLinesOfStops get lines of stops
 * @param string $argLanguage set output language
 * @param boolean $argPretty pretty-print json?
 * @return string
 */
function getStopsNearby($argLat, $argLong, $argResults, $argDistance, $argStops = True, $argPoi = False, $argLinesOfStops = False, $argLanguage = "en", $argPretty = False)
{
    // build query
    $query = "coord=" . $argLong . ":" . $argLat . ":WGS84:&coordOutputFormat=WGS84[DD.dddddddd]";
    $query .= "&inclFilter=1";
    // helper variable for counting the number of filters for correct query parameter
    $numOfFilter = 1;
    if ($argStops) {
        $query .= "&type_" . $numOfFilter . "=STOP";
        $numOfFilter++;
    }
    if ($argPoi) {
        $query .= "&type_" . $numOfFilter . "=POI_POINT";
    }
    // limit the number of results by max and radius
    $query .= "&max=" . $argResults . "&radius_1=" . $argDistance;
    // get data
    $data = getData("XML_COORD_REQUEST", "json", $query);
    // get php array from utf-8 decoded json data
    // select pins
    $data = json_decode(utf8_encode($data), 1)["pins"];
    // pins: contains every stops -> loop through
    foreach ($data as $pin) {
        $result[] = array(
            "type" => "stop",
            "id" => $pin["id"],
            "name" => $pin["attrs"][1]["value"],
            "location" => array(
                "type" => "location",
                "id" => $pin["id"],
                "latitude" => floatval(explode(",", $pin["coords"])[1]),
                "longitude" => floatval(explode(",", $pin["coords"])[0])
            ),
            "products" => stops_nearby_translateMOTNumStrtoProdList($pin["attrs"][3]["value"]),
            "distance" => intval($pin["distance"])
        );
    }
    // pretty-print json
    if ($argPretty == True) {
        return json_encode($result, JSON_PRETTY_PRINT);
    } else {
        return json_encode($result);
    }
}

// used in stops.php
/**
 * @param string $argId Id of stop
 * @param boolean $argLinesOfStops Parse & expose lines at each stop/station?
 * @param string $argLanguage Language of the results
 * @param boolean $argPretty Pretty-print JSON responses?
 * @return string
 */
function getStopsById($argId, $argLinesOfStops = False, $argLanguage = "en", $argPretty = False)
{
    // build query
    $query = "&language=" . $argLanguage . "coordOutputFormat=WGS84&type_si=stop&stopService=timeTable&name_si=" . $argId;
    // get data
    $data = getData("XML_STOP_INFO_REQUEST", "xml", $query);
    // convert xml to php array (XML_STOP_INFO_REQUEST can only deliver xml!)
    $data = xmlToArray(simplexml_load_string($data))["itdRequest"];
    $result = array(
        "type" => "station",
        "id" => $data["itdStopInfoRequest"]["itdOdv"]["itdOdvName"]["odvNameElem"]["@id"],
        "name" => $data["itdStopInfoRequest"]["itdOdv"]["itdOdvName"]["odvNameElem"]["$"],
        "locations" => array(
            "type" => "location",
            "id" => $data["itdStopInfoRequest"]["itdOdv"]["itdOdvName"]["odvNameElem"]["@omc"],
            "latitude" => $data["itdStopInfoRequest"]["itdOdv"]["itdOdvName"]["odvNameElem"]["@y"] / 1000000,
            "longitude" => $data["itdStopInfoRequest"]["itdOdv"]["itdOdvName"]["odvNameElem"]["@x"] / 1000000
        ),
        "stops" => array(
            "type" => "stop",
            "id" => $data["itdStopInfoRequest"]["itdOdv"]["itdOdvName"]["odvNameElem"]["@id"],
            "name" => $data["itdStopInfoRequest"]["itdOdv"]["itdOdvName"]["odvNameElem"]["$"],
            "location" => array(
                "type" => "location",
                "id" => $data["itdStopInfoRequest"]["itdOdv"]["itdOdvName"]["odvNameElem"]["@omc"],
                "latitude" => $data["itdStopInfoRequest"]["itdOdv"]["itdOdvName"]["odvNameElem"]["@y"] / 1000000,
                "longitude" => $data["itdStopInfoRequest"]["itdOdv"]["itdOdvName"]["odvNameElem"]["@x"] / 1000000
            )
        )
    );
    // products added
    foreach ($data["itdStopInfoRequest"]["itdServingLines"]["itdServingLine"] as $line) {
        $MOT_num = $line["@motType"];
        $MOT_numNotInMOT_str = strpos($MOT_str, $MOT_num) === False;
        if ($MOT_numNotInMOT_str) {
            $MOT_str .= $line["@motType"] . ",";
        }
    }
    // translate MOT numbers to product list
    $products = locations_translateMOTNumStrtoProdList(trim($MOT_str, ","));
    $result["products"] = $products;
    $result["stops"]["products"] = $products;
    
    // append linesOfStops
    if ($argLinesOfStops == True) {
        $lines = array();
        // loop through avaiable lines
        foreach ($data["itdStopInfoRequest"]["itdServingLines"]["itdServingLine"] as $line) {
            $new_item = array(
                "type" => "line",
                "id" => $line["@productId"],
                "fahrtNr" => null,
                "name" => $line["itdNoTrain"]["@name"],
                "public" => true,
                "productName" => $line["itdNoTrain"]["@name"],
                "mode" => $line["itdNoTrain"]["@name"],
                "product" => $line["itdNoTrain"]["@name"],
                "symbol" => $line["@symbol"],
                "nr" => $line["@number"]
            );
            $lines[] = $new_item;
        }
        // filter for unique lines (eliminate duplicates due to directions)
        $lines = array_unique($lines, SORT_REGULAR);
        // reformat the array to have a continuous numbering in array
        foreach ($lines as $item) {
            $list_for_json[] = $item;
        }
        // append to result
        $result['lines'] = $list_for_json;
    }
    // pretty-print json
    if ($argPretty == True) {
        return json_encode($result, JSON_PRETTY_PRINT);
    } else {
        return json_encode($result);
    }
}

// used in stops_departures.php
/**
 * 
 * EFA uses as date format YYYYMMDD and as time format HHMM
 * 
 * This function converts these formats to an normal ISO timestamp
 * 
 * @param string[] $efa_dt
 * @return string
 */
function translateEFADateTimeToISO($efa_dt)
{
    // builds a time-/datestamp from the given array
    $datetime = strtotime($efa_dt['day'] . "." . $efa_dt['month'] . "." . $efa_dt['year'] . " " . $efa_dt['hour'] . ":" . $efa_dt['minute']);
    $datetime = date("c", $datetime);
    return $datetime;
}

function translateEFAarr_depDateTimeSecToLocalTime($efa_dt) {
    // given format = "YYYYMMDD HH:II:SS"
    return substr($efa_dt,9,5);
}

/**
 * @param string $argId id of stop
 * @param boolean $argWhen start time
 * @param number $argResults number of results
 * @param string $argDirection filter by direction (needs the destination Id)
 * @param number $argDuration duration for which departures should be searched
 * @param boolean $argRemarks get remarks?
 * @param boolean $argLinesOfStops get lines of each stop?
 * @param boolean $argSuburban get MOT(suburban)?
 * @param boolean $argSubway get MOT(subway)?
 * @param boolean $argTram get MOT(tram)?
 * @param boolean $argBus get MOT(bus)?
 * @param boolean $argFerry get MOT(ferry)?
 * @param boolean $argExpress get MOT(express)?
 * @param boolean $argRegional get MOT(regional)?
 * @param boolean $argPretty pretty-print json?
 * @return string
 */
function getStopsDeparturesById($argId, $argWhen = True, $argResults = 10, $argDirection = "",$argDuration = False,  $argRemarks = True, $argLinesOfStops = True, $argSuburban = True, $argSubway = True, $argTram = True, $argBus = True, $argFerry = True, $argExpress = True, $argRegional = True, $argPretty = True)
{
    // build query
    $query = "locationServerActive=1&mergeDep=1&coordOutputFormat=WGS84[DD.dddddddd]";
    $query .= "&type_dm=any&itOptionsActive=1&ptOptionsActive=1&mode=direct&useRealtime=1&depType=stopEvents&includeCompleteStopSeq=1";
    $query .= "&name_dm=" . urlencode($argId);
    // limit number of results
    $query .= "&limit=" . $argResults;
    // convert when argument to an unix timestamp
    $timestamp = strtotime($argWhen);
    // format as EFA time (HHMM)
    $filter_time = date('Hi', $timestamp); 
    // format as EFA date (JJJJMMTT)
    $filter_date = date('Ymd', $timestamp); 
    $query .= "&itdTime=" . $filter_time;
    $query .= "&itdDate=" . $filter_date;
    // determines if a filter was set
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
    // get data
    $data = getData("XML_DM_REQUEST", "json", $query);
    $data = json_decode(utf8_encode($data), 1);
    // save data for later use
    $original_data = $data;
    $data = $data["departureList"];
    
    // loop through every departure
    foreach ($data as $dep) {
        $stop_array = array(
            "input" => array(
            "type" => $original_data["dm"]["points"]["point"]["anyType"],
            "id" => $original_data["dm"]["points"]["point"]["stateless"],
            "name" => $original_data["dm"]["points"]["point"]["name"],
            "location" => array(
                "type" => "location",
                "id" => $original_data["dm"]["points"]["point"]["ref"]["omc"],
                "latitude" => floatval(explode(",", $original_data["dm"]["points"]["point"]["ref"]["coords"])[1]),
                "longitude" => floatval(explode(",", $original_data["dm"]["points"]["point"]["ref"]["coords"])[0])
            )
            ),
            "stop" => array(
                    "type" => "stop",
                    "id" => $dep["stopID"],
                    "name" => $dep["stopName"],
                    "location" => array(
                        "type" => "location",
                        "id" => null,
                        "latitude" => floatval($dep["y"]),
                        "longitude" => floatval($dep["x"])
                    )
                
            )
        );
        // append lines at this stop to the departure
        if ($argLinesOfStops == True) {
            $lines = array();
            foreach ($original_data["servingLines"]["lines"] as $line) {
                $line_helper = $line["mode"];
                $new_item = array(
                    "type" => "line",
                    "id" => $line_helper["productId"],
                    "fahrtNr" => $line_helper["diva"]["tripCode"],
                    "name" => $line_helper["name"],
                    "public" => true,
                    "productName" => $line_helper["product"],
                    "mode" => $line_helper["product"],
                    "product" => $line_helper["product"],
                    "symbol" => $line_helper["number"],
                    "nr" => $line_helper["number"]
                );
                $lines[] = $new_item;
            }
            $lines = array_unique($lines, SORT_REGULAR);
            foreach ($lines as $item) {
                $list_for_json[] = $item;
            }
            $stop_array["lines"] = $list_for_json;
            unset($list_for_json);
            unset($lines);
        }
        // retrieve the real departure time
        $when = translateEFADateTimeToISO($dep["realDateTime"]);
        // retrieve the planned departure time
        $whenPlanned = translateEFADateTimeToISO($dep["dateTime"]);
        // when the departure lays in the future and no changes are known to the system, it sets the when variable to NULL
        if ($dep["realDateTime"] == NULL) {
            $when = $whenPlanned;
        }
        // retrieve delay
        $delay = (strtotime($when) - strtotime($whenPlanned)) / 60;
        // retrieve origin of departure
        if (array_key_exists("0", $dep["prevStopSeq"])) {
            // this stop isnt the second stop --> multiple entries available
            $origin = array(
                "type" => "stop",
                "id" => $dep["prevStopSeq"][0]["ref"]["id"],
                "name" => $dep["prevStopSeq"][0]["name"],
                "location" => array(
                    "type" => "location",
                    "id" => $dep["prevStopSeq"][0]["omc"],
                    "latitude" => floatval(explode(",", $dep["prevStopSeq"][0]["ref"]["coords"])[1]),
                    "longitude" => floatval(explode(",", $dep["prevStopSeq"][0]["ref"]["coords"])[0])
                )
            );
        } else {
            $origin = array(
                "type" => "stop",
                "id" => $dep["prevStopSeq"]["ref"]["id"],
                "name" => $dep["prevStopSeq"]["name"],
                "location" => array(
                    "type" => "location",
                    "id" => $dep["prevStopSeq"]["omc"],
                    "latitude" => floatval(explode(",", $dep["prevStopSeq"]["ref"]["coords"])[1]),
                    "longitude" => floatval(explode(",", $dep["prevStopSeq"]["ref"]["coords"])[0])
                )
            );
        }

        // retrieve destination of departure
        if (array_key_exists("0", $dep["onwardStopSeq"])) {
            $destination = array(
                "type" => "stop",
                "id" => end($dep["onwardStopSeq"])["ref"]["id"],
                "name" => end($dep["onwardStopSeq"])["name"],
                "location" => array(
                    "type" => "location",
                    "id" => $dep["onwardStopSeq"][0]["omc"],
                    "latitude" => floatval(explode(",", end($dep["onwardStopSeq"])["ref"]["coords"])[1]),
                    "longitude" => floatval(explode(",", end($dep["onwardStopSeq"])["ref"]["coords"])[0])
                )
            );
        } else {
            $destination = array(
                "type" => "stop",
                "id" => $dep["onwardStopSeq"]["ref"]["id"],
                "name" => $dep["onwardStopSeq"]["name"],
                "location" => array(
                    "type" => "location",
                    "id" => $dep["onwardStopSeq"][0]["omc"],
                    "latitude" => floatval(explode(",", $dep["onwardStopSeq"]["ref"]["coords"])[1]),
                    "longitude" => floatval(explode(",", $dep["onwardStopSeq"]["ref"]["coords"])[0])
                )
            );
        }
        // filter by direction
        if (($argDirection == "") or ($dep["prevStopSeq"][0]["ref"]["id"] == $argDirection)) {
            // filter by time
            if (( (strtotime($when) <= $argDuration * 60 + strtotime($argWhen)) and (strtotime($when) >= strtotime($argWhen)) ) or ($argWhen == "now" and $argDuration == False) or ($argDuration == False and strtotime($when) >= strtotime($argWhen))) {
                $array = array(
                    "stop" => $stop_array,
                    "direction" => $dep["servingLine"]["direction"],
                    "line" => array(
                        "type" => "line",
                        "id" => $dep["servingLine"]["number"],
                        "fahrtNr" => $dep["servingLine"]["key"],
                        "name" => $dep["servingLine"]["name"],
                        "public" => true,
                        "productName" => $dep["servingLine"]["name"],
                        "mode" => $dep["servingLine"]["name"],
                        "product" => $dep["servingLine"]["name"],
                        "symbol" => $dep["servingLine"]["symbol"],
                        "nr" => $dep["servingLine"]["number"],
                        "adminCode" => $dep["liErgRiProj"]["network"],
                        "operator" => array(
                            "type" => "operator",
                            "id" => str_replace("?STRA", "ÜSTRA", $dep["operator"]["publicCode"]),
                            "name" => $dep["operator"]["name"]
                        )
                    ),
                    "when" => $when,
                    "whenPlanned" => $whenPlanned,
                    "delay" => $delay,
                    "platform" => $dep["platform"],
                    "plannedPlatform" => null,
                    "origin" => $origin,
                    "destination" => $destination
                );
                // add remarks of the departure if wanted
                if ($argRemarks) {
                    foreach ($dep['servingLine']["hints"] as $remark) {
                        $remarks[] = array(
                            "type" => "hint",
                            "code" => "bf",
                            "text" => $remark["content"]
                        );
                    }
                    foreach ($dep['attrs'] as $key => $val) {
                        if ($val['name'] == "platformChange") {
                            $remarks[] = array(
                                "type" => "hint",
                                "code" => "pc",
                                "text" => "Gleiswechsel"
                            );
                        }
                    }
                    $array["remarks"] = $remarks;
                    unset($remarks);
                }
                //trains have another naming in the api
                if ($dep["servingLine"]["motType"] == "0") {
                    $array["line"]["id"] = $dep["servingLine"]["key"];
                    $array["line"]["name"] = $dep["servingLine"]["number"];
                    $array["line"]["fahrNr"] = $dep["servingLine"]["code"];
                    $array["line"]["symbol"] = $dep["servingLine"]["trainType"]." ".$dep["servingLine"]["trainNum"];
                    $array["line"]["product"] = $dep["servingLine"]["trainType"];
                    $array["line"]["nr"] = $dep["servingLine"]["trainNum"];  
                }
                
                //add train "history"
                if (array_key_exists("0", $dep["prevStopSeq"])) {
                    // this stop isnt the second stop --> multiple entries available
                    foreach ($dep["prevStopSeq"] as $single_stop) {
                        $h_arr = key_exists("arrDateTimeSec", $single_stop["ref"]) ? translateEFAarr_depDateTimeSecToLocalTime($single_stop["ref"]["arrDateTimeSec"]) : "-";
                        $h_dep = key_exists("depDateTimeSec", $single_stop["ref"]) ? translateEFAarr_depDateTimeSecToLocalTime($single_stop["ref"]["depDateTimeSec"]) : "-";
                        
                        if ($h_arr == "-") {
                            $h_arr = date("H:i", strtotime($h_dep)+86400-60);
                        }
                        
                        $history[] = array("arr" => $h_arr, "dep" => $h_dep, "stop" => $single_stop['name'], "pos" => "past");
                    }
                } else {
                    $h_arr = key_exists("arrDateTimeSec", $dep["prevStopSeq"]["ref"]) ? translateEFAarr_depDateTimeSecToLocalTime($dep["prevStopSeq"]["ref"]["arrDateTimeSec"]) : "-";
                    $h_dep = key_exists("depDateTimeSec", $dep["prevStopSeq"]["ref"]) ? translateEFAarr_depDateTimeSecToLocalTime($dep["prevStopSeq"]["ref"]["depDateTimeSec"]) : "-";
                    
                    if ($h_arr == "-") {
                        $h_arr = date("H:i", strtotime($h_dep)+86400-60);
                    }
                    
                    $history[] = array("arr" => $h_arr, "dep" => $h_dep, "stop" => $dep["prevStopSeq"]['name'], "pos" => "past");
                }
                // current stop
                $h_arr = date("H:i", (strtotime(date("H:i",strtotime($when))) - strtotime($h_dep))/2 + strtotime($h_dep));
                $history[] = array("arr" => $h_arr, "dep" => date("H:i",strtotime($when)), "stop" => $stop_array['stop']['name'], "pos" => "current");
                //add train "future"
                if (array_key_exists("0", $dep["onwardStopSeq"])) {
                    // this stop isnt the second stop --> multiple entries available
                    foreach ($dep["onwardStopSeq"] as $single_stop) {
                        $h_arr = key_exists("arrDateTimeSec", $single_stop["ref"]) ? translateEFAarr_depDateTimeSecToLocalTime($single_stop["ref"]["arrDateTimeSec"]) : "-";
                        $h_dep = key_exists("depDateTimeSec", $single_stop["ref"]) ? translateEFAarr_depDateTimeSecToLocalTime($single_stop["ref"]["depDateTimeSec"]) : "-";
                                                
                        if ($h_dep == "-") {
                            $h_dep = date("H:i", strtotime($h_arr)+86400+60);
                        }
                                                
                        $history[] = array("arr" => $h_arr, "dep" => $h_dep, "stop" => $single_stop['name'], "pos" => "future");
                    }
                } else {
                    $h_arr = key_exists("arrDateTimeSec", $dep["onwardStopSeq"]["ref"]) ? translateEFAarr_depDateTimeSecToLocalTime($dep["onwardStopSeq"]["ref"]["arrDateTimeSec"]) : "-";
                    $h_dep = key_exists("depDateTimeSec", $dep["onwardStopSeq"]["ref"]) ? translateEFAarr_depDateTimeSecToLocalTime($dep["onwardStopSeq"]["ref"]["depDateTimeSec"]) : "-";
                    
                    if ($h_dep == "-") {
                        $h_dep = date("H:i", strtotime($h_arr)+86400+60);
                    }
                    
                    $history[] = array("arr" => $h_arr, "dep" => $h_dep, "stop" => $dep["onwardStopSeq"]['name'], "pos" => "future");
                }
                

                $array["history"] = $history;
                unset($history);
                $result[] = $array;
            }
        }
    }
    // pretty-print json
    if ($argPretty == True) {
        return json_encode($result, JSON_PRETTY_PRINT);
    } else {
        return json_encode($result);
    }
}

// used in journeys.php
function DateTimeArrayToISO($array, $addMinutes = 0)
{
    if ($array["errors"]["0"] == "Data missing") {
        return null;
    }
    return date("c", mktime($array["hour"], intval($array["minute"]) - $addMinutes, $array["second"], $array["month"], $array["day"], $array["year"]));
}

function getJourney($argOrigin, $argDestination, $argCalcNumberOfTrips = 5, $argRemarks=False, $argWhen = "now", $argDepOrArrTime = "dep", $argMaxTransfers = 9, $argWalkingSpeed = "normal", $argSuburban = True, $argSubway = True, $argTram = True, $argBus = True, $argFerry = True, $argExpress = True, $argRegional = True, $argLanguage = "en", $argPretty = True)
{
    $query = "locationServerActive=1&stateless=1&coordOutputFormat=WGS84[DD.ddddd]&useHouseNumberList=true&useSuburb=1&useRealtime=1";
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
    $data = json_decode(utf8_encode($data), 1, JSON_UNESCAPED_UNICODE);

    /*if (isset($_GET['test'])) {
        print_r(json_encode($data));
    }*/
    // Check if too many point options
    if ((count($data["origin"]["points"]) > 1) or (count($data["destination"]["points"]) > 1)) {
        $result = array();
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
                    "departure" => date("c", strtotime($leg["points"][0]["dateTime"]["date"]." ".$leg["points"][0]["dateTime"]["time"])),
                    "plannedDeparture" => date("c", strtotime($leg["points"][0]["dateTime"]["rtDate"]." ".$leg["points"][0]["dateTime"]["rtTime"])),
                    "departureDelay" => intval($leg["stopSeq"][0]["ref"]["depDelay"]),
                    "arrival" => date("c", strtotime($leg["points"][1]["dateTime"]["date"]." ".$leg["points"][1]["dateTime"]["time"])),
                    "plannedArrival" => date("c", strtotime($leg["points"][1]["dateTime"]["rtDate"]." ".$leg["points"][1]["dateTime"]["rtTime"])),
                    "arrivalDelay" => intval(end($leg["stopSeq"])["ref"]["arrDelay"]),
                    "reachable" => null,
                    "tripId" => $leg["mode"]["diva"]["tripCode"],
                    "line" => array(
                        "type" => "line",
                        "id" => "",//$leg["mode"]["productId"],
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
                    "arrivalPlatform" => $leg["points"][1]["ref"]["platform"],
                    "plannedArrivalPlatform" => $leg["points"][1]["ref"]["platform"],
                    "departurePlatform" => $leg["points"][0]["ref"]["platform"],
                    "plannedDeparturePlatform" => $leg["points"][0]["ref"]["platform"]
                );
                // when MOT = Fussweg (walking), then we need to adjust some fields
                if ($leg_helper["line"]["mode"] == "Fussweg") {
                    $leg_helper["departure"] = date("c", strtotime($leg_helper["arrival"] . " -" . ($leg["timeMinute"] + 1) . "minutes"));
                    $leg_helper["plannedDeparture"] = $leg_helper["departure"];
                    $leg_helper["direction"] = $leg_helper["destination"]["name"];
                }
                // show remarks
                if($argRemarks) {
                    foreach ($leg["attrs"] as $item) {
                        if ($item["name"] == "PlanLowFloorVehicle") {
                            $leg_helper["remarks"][] = array(
                                "type" => "hint",
                                "code" => "bf",
                                "text" => "Niederflurfahrzeug"
                            );
                        } elseif ($item["name"] == "PlanWheelChairAccess") {
                            $leg_helper["remarks"][] = array(
                                "type" => "hint",
                                "code" => "bf",
                                "text" => "Rollstuhlzugang"
                            );
                        }
                    }
                    
                }
                $legs[] = $leg_helper;
            }
            
            $trips[] = array(
                "type" => "journey",
                "legs" => $legs,
                "tickets" => $tickets
            );
            
            
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



function convertDownloadLink($argLink) {
    $helper = $_SERVER['SELF_SCRIPT']."download.php?file=";
    return str_replace("https://app.efa.de/mdv_server/app_gvh/FILELOAD?Filename=", $helper, $argLink);
}






