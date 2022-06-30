<?php

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
 * @param string $method The XML method to be called
 * @param string $outputFormat The desired output format (json or xml)
 * @param string $query The query provided by the functions
 * @return string
 */
function getData($method, $outputFormat = "json", $query)
{
    // create curl resource
    $ch = curl_init();

    $url = "https://app.efa.de/mdv_server/app_gvh/" . $method;
    // set encoding and session = 0
    $url .= "?session=0&outputEncoding=UTF-8&inputEncoding=UTF-8";
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
    // close curl resource to free up system resources
    curl_close($ch);
    // return the utf-8 decoded string
    return utf8_decode($output);
}

// LOCATIONS
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
 *      "train": false,
 *      "suburban": false,
 *      "subway": false,
 *      "tram": false,
 *      "subwaytram": false,
 *      "citybus": true,
 *      "regiobus": false,
 *      "expressbus": false,
 *      "dialabus": false,
 *      "others": false
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
 * @param string $argQuery set the query string _(can also be id of stops etc.)_
 * @param number $argNumResults set the number of results witch should be returned
 * @param string $argLanguage set the language, default is "en" (alt.: "de")
 * @param boolean $argGetPOI get POI locations?
 * @param boolean $argGetStreets get streets as locations?
 * @param boolean $argGetStops get stops as locations?
 * @param boolean $argPretty return pretty-print json?
 * @return string
 * @usage 
 */
function getLocation($argQuery, $argNumResults = 10, $argLanguage = "en", $argGetPOI = True, $argGetStreets = True, $argGetStops = True, $argPretty = False)
{
    // Calculate filter value
    /*
     * anyObjFilter_<usage>
     * Die Suche kann auf bestimmte Objekttypen eingegrenzt werden. Der Wert des Parameters ist eine Bitmaske. Die einzelnen Objekttypen lassen sich beliebig kombinieren=>
     *  0 (Kein Filter aktiv)
     *  1 (Orte)
     *  2 (Haltestellen-IDs und –Aliasnamen)
     *  4 (Straßennamen)
     *  8 (Adressen)
     *  16 (Kreuzungen)
     *  32 (POI-IDs und -Aliasnamen)
     *  64 (Postleitzahlen)
     */
    if (($argGetPOI) and ($argGetStreets) and ($argGetStops)) {
        $anyObjFilter_sf = 0;
    } else {
        if ($argGetPOI) {
            $anyObjFilter_sf += 32;
        }
        if ($argGetStreets) {
            $anyObjFilter_sf += 28;
        }
        if ($argGetStops) {
            $anyObjFilter_sf += 2;
        }
    }
    $argQuery = "locationServerActive=1&type_sf=any&coordOutputFormat=WGS84[DD.dddddddd]&name_sf=" . $argQuery . "&anyMaxSizeHitList=" . $argNumResults . "&anyObjFilter_sf=" . $anyObjFilter_sf . "&language=" . $argLanguage;
    $data = getData("XML_STOPFINDER_REQUEST", "json", $argQuery);

    $data = json_decode(utf8_encode($data), 1)["stopFinder"]["points"];
    foreach ($data as $point) {
        // format output for poi
        if ($point['anyType'] == "poi") {
            $result[] = array(
                "type" => "location",
                "id" => $point["stateless"],
                "latitude" => floatval(explode(",", $point["ref"]["coords"])[1]),
                "longitude" => floatval(explode(",", $point["ref"]["coords"])[0]),
                "name" => $point["name"],
                "poi" => True
            );
        }
        // format output for address
        if ($point['anyType'] == "street") {
            $result[] = array(
                "type" => "location",
                "id" => null,
                "latitude" => floatval(explode(",", $point["ref"]["coords"])[1]),
                "longitude" => floatval(explode(",", $point["ref"]["coords"])[0]),
                "name" => $point["name"]
            );
        }
        // format output for stop
        if ($point['anyType'] == "stop") {
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
        }
    }

    if ($argPretty == True) {
        return json_encode($result, JSON_PRETTY_PRINT);
    } else {
        return json_encode($result);
    }
}

// stops_nearby
function stops_nearby_translateMOTNumStrtoProdList($numberStr)
{
    $MOT_numbers = array(
        1 => "tram", # Straßenbahn
        2 => "suburban", # S-Bahn
        3 => "bus", # Stadtbus
        6 => "train" # Zug
    );
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

    foreach ($MOT_numbers as $MOT) {
        foreach ($items as $item) {
            if ($MOT == $MOT_numbers[$item]) {
                $MOT_list[$MOT] = true;
            }
        }
    }

    return $MOT_list;
}

/*
 * latitude Required. number –
 * longitude Required. number –
 * results maximum number of results integer 8
 * distance maximum walking distance in meters integer –
 * stops Return stops/stations? boolean true
 * poi Return points of interest? boolean false
 * linesOfStops Parse & expose lines at each stop/station? boolean false
 * language Language of the results. string en
 * pretty Pretty-print JSON responses? boolean true
 *
 */
function getStopsNearby($paramLat, $paramLong, $results, $distance, $stops = True, $poi = False, $linesOfStops = False, $language = "en", $pretty = False)
{
    // $query = "locationServerActive=1&type_sf=any&coordOutputFormat=WGS84[DD.dddddddd]&name_sf=".$query."&anyMaxSizeHitList=".$numResults."&anyObjFilter_sf=".$anyObjFilter_sf."&language=".$language;
    $query = "coord=" . $paramLong . ":" . $paramLat . ":WGS84:&coordOutputFormat=WGS84[DD.dddddddd]";
    $query .= "&inclFilter=1";
    $numOfFilter = 1;
    if ($stops) {
        $query .= "&type_" . $numOfFilter . "=STOP";
    }
    if ($poi) {
        $query .= "&type_" . $numOfFilter . "=POI_POINT";
    }
    $query .= "&max=" . $results . "&radius_1=" . $distance;

    $data = getData("XML_COORD_REQUEST", "json", $query);
    $data = json_decode(utf8_encode($data), 1)["pins"];
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

    if ($pretty == True) {
        return json_encode($result, JSON_PRETTY_PRINT);
    } else {
        return json_encode($result);
    }
}

// stops
/*
 * parameter description type default value
 * linesOfStops Parse & expose lines at each stop/station? boolean false
 * language Language of the results. string en
 * pretty Pretty-print JSON responses? boolean true
 *
 */
function getStopsById($argId, $argLinesOfStops = False, $argLanguage = "en", $pretty = False)
{
    $query = "&language=" . $argLanguage . "coordOutputFormat=WGS84&type_si=stop&stopService=timeTable&name_si=" . $argId;
    // echo "https://app.efa.de/mdv_server/app_gvh/XML_STOP_INFO_REQUEST?session=0&outputFormat=xml&".$query;
    $data = getData("XML_STOP_INFO_REQUEST", "xml", $query);
    $data = xmlToArray(simplexml_load_string($data))["itdRequest"];
    // var_dump($data["itdStopInfoRequest"]["itdServingLines"]);
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
    $products = locations_translateMOTNumStrtoProdList(trim($MOT_str, ","));
    $result["products"] = $products;
    $result["stops"]["products"] = $products;
    // linesOfStops

    if ($argLinesOfStops == True) {
        // $line = $data["itdStopInfoRequest"]["itdServingLines"]["itdServingLine"][0];

        $lines = array();
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
        $lines = array_unique($lines, SORT_REGULAR);
        foreach ($lines as $item) {
            $list_for_json[] = $item;
        }
        $result['lines'] = $list_for_json;
    }
    // $location_info = json_decode(getLocation($argId, $numResults=1),1);
    // var_dump($location_info);
    if ($pretty == True) {
        return json_encode($result, JSON_PRETTY_PRINT);
    } else {
        return json_encode($result);
    }
}

// STOPS_DEPARTURE
function translateEFADateTimeToISO($efa_dt)
{
    $datetime = strtotime($efa_dt['day'] . "." . $efa_dt['month'] . "." . $efa_dt['year'] . " " . $efa_dt['hour'] . ":" . $efa_dt['minute']);
    $datetime = date("c", $datetime);
    return $datetime;
}

function getStopsDeparturesById($argId, $argWhen = True, $argResults = 10, $argDuration = 99999999, $argDirection = "", $argRemarks = True, $argLinesOfStops = True, $argSuburban = True, $argSubway = True, $argTram = True, $argBus = True, $argFerry = True, $argExpress = True, $argRegional = True, $argPretty = True)
{
    /*
     * XML_DM_REQUEST?
     * name_dm=25000033
     * &type_dm=any
     * &trITMOTvalue100=10
     * &changeSpeed=normal
     * &exclMOT_0=1
     * &exclMOT_1=1
     * &exclMOT_2=1
     * &mergeDep=1
     * &coordOutputFormat=WGS84
     * &coordListOutputFormat=STRING
     * &outputFormat=JSON
     * &useAllStops=1
     * &excludedMeans=checkbox
     * &useRealtime=1
     * &deleteAssignedStops=1
     * &itOptionsActive=1
     * &canChangeMOT=0
     * &mode=direct
     * &ptOptionsActive=1
     * &limit=10
     * &imparedOptionsActive=1
     * &locationServerActive=1
     * &depType=stopEvents
     * &useProxFootSearch=0
     * &maxTimeLoop=2
     * &includeCompleteStopSeq=1
     */
    $query = "locationServerActive=1&mergeDep=1&coordOutputFormat=WGS84[DD.dddddddd]";
    $query .= "&type_dm=any&itOptionsActive=1&ptOptionsActive=1&mode=direct&useRealtime=1&depType=stopEvents&includeCompleteStopSeq=1";
    $query .= "&name_dm=" . $argId;
    $query .= "&limit=" . $argResults;
    $timestamp = strtotime($argWhen);
    $filter_time = date('Hi', $timestamp); // HHMM
    $filter_date = date('Ymd', $timestamp); // JJJJMMTT
    $query .= "&itdTime=" . $filter_time;
    $query .= "&itdDate=" . $filter_date;
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
    //echo "https://app.efa.de/mdv_server/app_gvh/XML_DM_REQUEST?session=0&outputEncoding=UTF-8&inputEncoding=UTF-8&outputFormat=json&".$query;
    $data = getData("XML_DM_REQUEST", "json", $query);
    $data = json_decode(utf8_encode($data), 1);
    // var_dump($data);
    $original_data = $data;
    $data = $data["departureList"];
    // var_dump($data);

    foreach ($data as $dep) {
        $stop_array = array(
            "type" => "stop",
            "id" => $original_data["dm"]["points"]["point"]["stateless"],
            "name" => $original_data["dm"]["points"]["point"]["name"],
            "location" => array(
                "type" => "location",
                "id" => $original_data["dm"]["points"]["point"]["ref"]["omc"],
                "latitude" => floatval(explode(",", $original_data["dm"]["points"]["point"]["ref"]["coords"])[1]),
                "longitude" => floatval(explode(",", $original_data["dm"]["points"]["point"]["ref"]["coords"])[0])
            )
        );
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
        $when = translateEFADateTimeToISO($dep["realDateTime"]);
        $whenPlanned = translateEFADateTimeToISO($dep["dateTime"]);
        if ($dep["realDateTime"] == NULL) {
            $when = $whenPlanned;
        }
        $delay = (strtotime($when) - strtotime($whenPlanned)) / 60;
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
        );//onwardStopSeq
        if (($argDirection == "") or ($dep["prevStopSeq"][0]["ref"]["id"] == $argDirection)) {
            if (strtotime($when) <= (($argDuration * 6000) + time())) {
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
                            "id" => str_replace("?", "Ü", $dep["operator"]["publicCode"]),
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
                if ($argRemarks) {
                    foreach ($dep['servingLine']["hints"] as $remark) {
                        $remarks[] = array(
                            "type" => "hint",
                            "code" => "bf",
                            "text" => $remark["content"]
                        );
                    }
                    $array["remarks"] = $remarks;
                    unset($remarks);
                }
                $result[] = $array;
            }
        }
    }

    if ($argPretty == True) {
        return json_encode($result, JSON_PRETTY_PRINT);
    } else {
        return json_encode($result);
    }
}

