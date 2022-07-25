<?php

# ## Language dictionary ###
if ($_GET['language'] == "de") {
    // START
    define("STR_START_1", "Bitte Name des gewünschten Haltes eingeben");
    define("STR_START_21", "Starthalt eingeben");
    define("STR_START_22", "Zielhalt eingeben");
    define("STR_START_3", "Absenden");
    // SEARCH
    define("STR_SEARCH_1", "Wähle deine Haltestellen aus");
    define("STR_SEARCH_1_1", "Start-Haltestelle");
    define("STR_SEARCH_1_2", "Ziel-Haltestelle");
    define("STR_SEARCH_2", "Anzahl der Resultate");
    define("STR_SEARCH_3", "Datum");
    define("STR_SEARCH_4", "Uhrzeit");
    define("STR_SEARCH_3_1", "Abfahrt");
    define("STR_SEARCH_3_2", "Ankunft");
    define("STR_SEARCH_3_3", "langsam");
    define("STR_SEARCH_3_4", "normal");
    define("STR_SEARCH_3_5", "schnell");
    define("STR_SEARCH_3_6", "Gehgeschwindigkeit");
    define("STR_SEARCH_5", "Auswahl Verkehrsmittel");
    define("STR_SEARCH_6", "S-Bahn");
    define("STR_SEARCH_7", "U-Bahn");
    define("STR_SEARCH_8", "Straßen-/Stadtbahn");
    define("STR_SEARCH_9", "Bus");
    define("STR_SEARCH_10", "Fähre");
    define("STR_SEARCH_11", "Schnellzug");
    define("STR_SEARCH_12", "Regionalzug");
    define("STR_SEARCH_13", STR_START_3);
    // SHOW
    define("STR_SHOW_1", "Reisen am");
    define("STR_SHOW_2", "Abfahrt");
    define("STR_SHOW_3", "Ankunft");
    define("STR_SHOW_4", "Reisedauer");
    define("STR_SHOW_5", "Von");
    define("STR_SHOW_6", "Nach");
    define("STR_SHOW_7", "Preisliste");
    define("STR_SHOW_8", "Zeige aktuelle Reisen");
    define("STR_SHOW_9", "Zeige mehr Reisen");
    
    define("STR_SHOW_15", "Hinweise");
    define("STR_SHOW_16", "Sitzenbleiben");
    define("STR_SHOW_21", "Niederflurbus mit Rampe");
    define("STR_SHOW_22", "Gleiswechsel");
    define("STR_SHOW_23", "GVH-Garantiefall");
    define("STR_SHOW_24", "behindertengerechtes Fahrzeug");
    define("STR_SHOW_25", "Niederflurfahrzeug");
    define("STR_SHOW_26", "Rollstuhlzugang");
} else {
    // START
    define("STR_START_1", "Please enter the name of the desired stop");
    define("STR_START_21", "Enter stopname (origin)");
    define("STR_START_22", "Enter stopname (destination)");
    define("STR_START_3", "Send");
    // SEARCH
    define("STR_SEARCH_1", "Choose your stations");
    define("STR_SEARCH_1_1", "origin station");
    define("STR_SEARCH_1_2", "destination station");
    define("STR_SEARCH_2", "Number of results");
    define("STR_SEARCH_3", "Date");
    define("STR_SEARCH_4", "Time");
    define("STR_SEARCH_3_1", "Arrival");
    define("STR_SEARCH_3_2", "Departure");
    define("STR_SEARCH_3_3", "slow");
    define("STR_SEARCH_3_4", "normal");
    define("STR_SEARCH_3_5", "fast");
    define("STR_SEARCH_3_6", "walking speed");
    define("STR_SEARCH_5", "Select MOT");
    define("STR_SEARCH_6", "suburban");
    define("STR_SEARCH_7", "subway");
    define("STR_SEARCH_8", "tram");
    define("STR_SEARCH_9", "bus");
    define("STR_SEARCH_10", "ferry");
    define("STR_SEARCH_11", "express");
    define("STR_SEARCH_12", "regional");
    define("STR_SEARCH_13", STR_START_3);
    // SHOW
    define("STR_SHOW_1", "Journeys at");
    define("STR_SHOW_2", "Dep");
    define("STR_SHOW_3", "Arr");
    define("STR_SHOW_4", "Duration");
    define("STR_SHOW_5", "From");
    define("STR_SHOW_6", "To");
    define("STR_SHOW_7", "Price list");
    define("STR_SHOW_8", "Show current journeys");
    define("STR_SHOW_9", "Show more journeys");
    define("STR_SHOW_15", "Remarks");
    define("STR_SHOW_16", "stay seated");
    define("STR_SHOW_21", "low floor bus with ramp");
    define("STR_SHOW_22", "platform change");
    define("STR_SHOW_23", "GVH warranty case");
    define("STR_SHOW_24", "accessible vehicle");
    define("STR_SHOW_25", "low floor vehicle");
    define("STR_SHOW_26", "wheel chair access");
}

if (count($_GET) <= 1 or isset($_GET['start'])) {
    ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>DM > Start</title>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
	integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
	crossorigin="anonymous" type="text/javascript"></script>

<!-- 
    License of Content used from Bootstrap
    
    The MIT License (MIT)
    
    Copyright (c) 2011-2018 Twitter, Inc.
    Copyright (c) 2011-2018 The Bootstrap Authors
    
    Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:
    
    The above copyright notice and this permission notice shall be included in
    all copies or substantial portions of the Software.
    
    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
    THE SOFTWARE.
     -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet"
	href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css"
	integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu"
	crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet"
	href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap-theme.min.css"
	integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ"
	crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script
	src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"
	integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd"
	crossorigin="anonymous" type="text/javascript"></script>

<style type="text/css">
/* stylelint-disable selector-no-qualifying-type, property-no-vendor-prefix */
body {
	padding-top: 40px;
	padding-bottom: 40px;
	background-color: #eee;
}

.form-signin {
	max-width: 330px;
	padding: 15px;
	margin: 0 auto;
}

.form-signin .form-signin-heading, .form-signin .checkbox {
	margin-bottom: 10px;
}

.form-signin .checkbox {
	font-weight: 400;
}

.form-signin .form-control {
	position: relative;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	height: auto;
	padding: 10px;
	font-size: 16px;
}

.form-signin .form-control:focus {
	z-index: 2;
}

.form-signin input[type="email"] {
	margin-bottom: -1px;
	border-bottom-right-radius: 0;
	border-bottom-left-radius: 0;
}

.form-signin input[type="password"] {
	margin-bottom: 10px;
	border-top-left-radius: 0;
	border-top-right-radius: 0;
}
</style>
</head>
<body>
	<div class="container">
		<form class="form-signin" method="GET" action="">
			<h2 class="form-signin-heading text-center"><?php echo STR_START_1; ?></h2>
			<br> <input type="text" id="inputEmail" class="form-control"
				placeholder="<?php echo STR_START_21; ?>" name="from" required
				autofocus><br> <input type="text" id="inputEmail"
				class="form-control" placeholder="<?php echo STR_START_22; ?>"
				name="to" required autofocus><br> <input type="hidden" name="search">
			<input type="hidden" name="language"
				value="<?php echo $_GET["language"]; ?>">
			<button class="btn btn-lg btn-primary btn-block" type="submit"><?php echo STR_START_3; ?></button>
			<br> <br>
			<h4>language/Sprache</h4>
			<div class="row">
				<p class="col-sm-12 col-md-6 col-lg-4">
					<a class="btn btn-default col-md-12"
						href="<?php echo $_SERVER['SCRIPT_NAME']."?language=en"; ?>">English</a>
				</p>
				<p class="col-sm-12 col-md-6 col-lg-4">
					<a class="btn btn-default col-md-12"
						href="<?php echo $_SERVER['SCRIPT_NAME']."?language=de"; ?>">Deutsch</a>
				</p>
			</div>
		</form>

	</div>
</body>
</html>

<?php
} elseif (isset($_GET['search'])) {
    ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>DM > Search</title>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
	integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
	crossorigin="anonymous" type="text/javascript"></script>

<!-- 
License of Content used from Bootstrap

The MIT License (MIT)

Copyright (c) 2011-2018 Twitter, Inc.
Copyright (c) 2011-2018 The Bootstrap Authors

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
 -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet"
	href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css"
	integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu"
	crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet"
	href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap-theme.min.css"
	integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ"
	crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script
	src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"
	integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd"
	crossorigin="anonymous" type="text/javascript"></script>

<style type="text/css">
/* stylelint-disable selector-no-qualifying-type, property-no-vendor-prefix */
body {
	padding-top: 40px;
	padding-bottom: 40px;
	background-color: #eee;
}

.form-signin {
	max-width: 330px;
	padding: 15px;
	margin: 0 auto;
}

.form-signin .form-signin-heading, .form-signin .checkbox {
	margin-bottom: 10px;
}

.form-signin .checkbox {
	font-weight: 400;
}

.form-signin .form-control {
	position: relative;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	height: auto;
	padding: 10px;
	font-size: 16px;
}

.form-signin .form-control:focus {
	z-index: 2;
}

.form-signin input[type="email"] {
	margin-bottom: -1px;
	border-bottom-right-radius: 0;
	border-bottom-left-radius: 0;
}

.form-signin input[type="password"] {
	margin-bottom: 10px;
	border-top-left-radius: 0;
	border-top-right-radius: 0;
}

.input-group {
	margin-top: 10px;
	margin-bottom: 10px;
}
</style>
</head>
<body>
	<div class="container">
		<form class="form-signin" method="GET" action="">
			<h2 class="form-signin-heading"><?php echo STR_SEARCH_1; ?></h2>
<?php

    require '../functions.php';

//     if (isset($_GET['from'])) {
//         $pOrigin = urldecode($_GET['from']);
//     } elseif (isset($_GET['from.latitude']) and isset($_GET['from.longitude'])) {
//         $pOrigin = array(
//             $_GET['from.latitude'],
//             $_GET['from.longitude']
//         );
//     } else {
//         $error_text = "
// Error! Set origin (from or from.latitude & from.longitude) or set help for help<br>
        
// ";
//         exit($error_text);
//     }
//     if (isset($_GET['to'])) {
//         $pDestination = urldecode($_GET['to']);
//     } elseif (isset($_GET['to.latitude']) and isset($_GET['to.longitude'])) {
//         $pDestination = array(
//             $_GET['to.latitude'],
//             $_GET['to.longitude']
//         );
//     } else {
//         exit("Error! Set destination (to or to.latitude & to.longitude) or set help for help");
//     }
    // I dont know why the code above doesnt work, but it only works if the following segment is used
    $pOrigin = urldecode($_GET['from']);
    $pDestination = urldecode($_GET['to']);
    

    if (isset($_GET['departure'])) {
        $pDepOrArrTime = "dep";
    } elseif (isset($_GET['arrival'])) {
        $pDepOrArrTime = "arr";
    } else {
        $pDepOrArrTime = "dep";
        $pWhen = "now";
    }
    if (isset($_GET['whend']) and isset($_GET['whent'])) {
        $pWhen = urldecode($_GET['whend']) . " " . urldecode($_GET['whent']);
    } elseif (isset($_GET['when'])) {
        $pWhen = urldecode($_GET['when']);
    } else {
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
    $data = getJourney($argOrigin = $pOrigin, $argDestination = $pDestination, $argCalcNumberOfTrips = $pCalcNumberOfTrips, $argRemarks = $pRemarks, $argWhen = $pWhen, $argDepOrArrTime = $pDepOrArrTime, $argMaxTransfers = $pMaxTransfers, $argWalkingSpeed = $pWalkingSpeed, $argSuburban = $pSuburban, $argSubway = $pSubway, $argTram = $pTram, $argBus = $pBus, $argFerry = $pFerry, $argExpress = $pExpress, $argRegional = $pRegional, $argLanguage = $pLanguage, $argPretty = $pPretty);
    
    $loc = json_decode($data, 1, JSON_UNESCAPED_UNICODE);
    $already_got_from = '<h4>' . STR_SEARCH_1_1 . '</h4><div class="checkbox">
		  <label>
			<input checked type="radio" required name="from" value="' . $_GET['from'] . '"> ' . $_GET['from'] . '
		  </label>
		</div>';
    $already_got_to = '<h4>' . STR_SEARCH_1_2 . '</h4><div class="checkbox">
		  <label>
			<input checked type="radio" required name="to" value="' . $_GET['to'] . '"> ' . $_GET['to'] . '
		  </label>
		</div>';
    if (array_key_exists("errors", $loc)) {
        if (array_key_exists("origin", $loc["options"])) {
            $origin_options = $loc["options"]["origin"];
            echo '<h4>' . STR_SEARCH_1_1 . '</h4>';
            for ($i = 0; $i < count($origin_options); $i ++) {
                $l = $origin_options[$i];
                if ($l['poi'] == "1") {
                    $poi_text = " (" . STR_SHOW_8 . ")";
                } elseif ($l['type'] == "street") {
                    $poi_text = " (" . STR_SHOW_9 . ")";
                } else {
                    $poi_text = "";
                }
                echo '		<div class="checkbox">
		  <label>
			<input type="radio" required name="from" value="' . $l['stateless'] . '"> ' . $l['name'] . $poi_text . '
		  </label>
		</div>';
            }
        } else {
            echo $already_got_from;
        }
        if (array_key_exists("destination", $loc["options"])) {
            $destination_options = $loc["options"]["destination"];
            echo '<h4>' . STR_SEARCH_1_2 . '</h4>';
            for ($i = 0; $i < count($destination_options); $i ++) {
                $l = $destination_options[$i];
                if ($l['poi'] == "1") {
                    $poi_text = " (" . STR_SHOW_8 . ")";
                } elseif ($l['type'] == "street") {
                    $poi_text = " (" . STR_SHOW_9 . ")";
                } else {
                    $poi_text = "";
                }
                echo '		<div class="checkbox">
		  <label>
			<input type="radio" required name="to" value="' . $l['stateless'] . '"> ' . $l['name'] . $poi_text . '
		  </label>
		</div>';
            }
        } else {
            echo $already_got_to;
        }
    } else {
        echo $already_got_from;
        echo $already_got_to;
    }
    ?>
			<label> <input type="number" id="inputEmail" class="form-control"
				value="10" name="calcNumberOfTrips" required="" autofocus="0"> <?php echo STR_SEARCH_2; ?>
			</label> <label> <input type="date" id="when-d" class="form-control"
				name="whend" required="" autofocus="1"> <?php echo STR_SEARCH_3; ?>
			</label> <label> <input type="time"
				pattern="[0-9]{2}:[0-9]{2}:[0-9]{2}" id="when-t"
				class="form-control" name="whent" required="" autofocus="2"> <?php echo STR_SEARCH_4; ?>
			</label>
			<div class="btn-group btn-group-justified" role="group"
				aria-label="...">
				<div class="btn-group" role="group">
					<button type="button" id="useDep" class="btn btn-default active"><?php echo STR_SEARCH_3_1; ?></button>
				</div>
				<div class="btn-group" role="group">
					<button type="button" id="useArr" class="btn btn-default"><?php echo STR_SEARCH_3_2; ?></button>
				</div>
			</div>
			<input type="hidden" id="ArrOrDep" name="departure">
			<br><br>
			<h4><?php echo STR_SEARCH_3_6; ?></h4>
			<div class="btn-group btn-group-justified" role="group"
				aria-label="...">
				<div class="btn-group" role="group">
					<button type="button" data-speed="slow" class="btn btn-default changeWalkingSpeed"><?php echo STR_SEARCH_3_3; ?></button>
				</div>
				<div class="btn-group" role="group">
					<button type="button" data-speed="normal" class="btn btn-default changeWalkingSpeed active"><?php echo STR_SEARCH_3_4; ?></button>
				</div>
				<div class="btn-group" role="group">
					<button type="button" data-speed="fast" class="btn btn-default changeWalkingSpeed"><?php echo STR_SEARCH_3_5; ?></button>
				</div>
				
			</div>
			<input type="hidden" id="walkingSpeed" name="walkingSpeed" value="normal">

			<!-- MOT selection -->
			<hr>
			<h4><?php echo STR_SEARCH_5; ?></h4>
			<div class="row">
				<div class="col-lg-12">
					<div class="input-group">
						<span class="input-group-addon"> <input type="hidden"
							name="suburban" value="0"> <input type="checkbox"
							class="form-check-input" name="suburban" checked value="1">
						</span>
						<p class="form-control"><?php echo STR_SEARCH_6; ?></p>
					</div>
					<!-- /input-group -->
				</div>
				<!-- /.col-lg-12 -->
				<br>
				<div class="col-lg-12">
					<div class="input-group">
						<span class="input-group-addon"> <input type="hidden"
							name="subway" value="0"> <input type="checkbox"
							class="form-check-input" name="subway" checked value="1">
						</span>
						<p class="form-control"><?php echo STR_SEARCH_7; ?></p>
					</div>
					<!-- /input-group -->
				</div>
				<!-- /.col-lg-12 -->
				<br>
				<div class="col-lg-12">
					<div class="input-group">
						<span class="input-group-addon"> <input type="hidden" name="tram"
							value="0"> <input type="checkbox" class="form-check-input"
							name="tram" checked value="1">
						</span>
						<p class="form-control"><?php echo STR_SEARCH_8; ?></p>
					</div>
					<!-- /input-group -->
				</div>
				<!-- /.col-lg-12 -->
				<br>
				<div class="col-lg-12">
					<div class="input-group">
						<span class="input-group-addon"> <input type="hidden" name="bus"
							value="0"> <input type="checkbox" class="form-check-input"
							name="bus" checked value="1">
						</span>
						<p class="form-control"><?php echo STR_SEARCH_9; ?></p>
					</div>
					<!-- /input-group -->
				</div>
				<!-- /.col-lg-12 -->
				<br>
				<div class="col-lg-12">
					<div class="input-group">
						<span class="input-group-addon"> <input type="hidden" name="ferry"
							value="0"> <input type="checkbox" class="form-check-input"
							name="ferry" checked value="1">
						</span>
						<p class="form-control"><?php echo STR_SEARCH_10; ?></p>
					</div>
					<!-- /input-group -->
				</div>
				<!-- /.col-lg-12 -->
				<br>
				<div class="col-lg-12">
					<div class="input-group">
						<span class="input-group-addon"> <input type="hidden"
							name="express" value="0"> <input type="checkbox"
							class="form-check-input" name="express" checked value="1">
						</span>
						<p class="form-control"><?php echo STR_SEARCH_11; ?></p>
					</div>
					<!-- /input-group -->
				</div>
				<!-- /.col-lg-12 -->
				<br>
				<div class="col-lg-12">
					<div class="input-group">
						<span class="input-group-addon"> <input type="hidden"
							name="regional" value="0"> <input type="checkbox"
							class="form-check-input" name="regional" checked value="1">
						</span>
						<p class="form-control"><?php echo STR_SEARCH_12; ?></p>
					</div>
					<!-- /input-group -->
				</div>
				<!-- /.col-lg-12 -->
				<br>

			</div>
			<!-- /.row -->
			<input type="hidden" name="show"> <input type="hidden"
				name="language" value="<?php echo $pLanguage; ?>">


			<button class="btn btn-lg btn-primary btn-block" type="submit"><?php echo STR_SEARCH_13; ?></button>
		</form>
	</div>
	<script type="text/javascript">
$(document).ready(function() {
	let now = new Date();
	$('#when-d').val(now.getFullYear()+"-"+("0" + (now.getMonth()+1)).slice(-2)+"-"+("0" + now.getDate()).slice(-2));
	$('#when-t').val(now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: false }));
	
});

$('#useDep').click(function()
{
	var x = $(this);
	var y = $('#useArr');
	x.addClass("active");
	y.removeClass("active");
	$('#ArrOrDep').attr('name', "departure");
});

$('#useArr').click(function()
{
	var x = $(this);
	var y = $('#useDep');
	x.addClass("active");
	y.removeClass("active");
	$('#ArrOrDep').attr('name', "arrival");
});

$('.changeWalkingSpeed').click(function(){
	var x = $(this);
	$('.changeWalkingSpeed').removeClass("active");
	x.addClass("active");
	$('#walkingSpeed').attr('value', x.attr("data-speed"));
});

</script>
</body>
</html>
<?php
} elseif (isset($_GET['show'])) {
    ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>DM > Show</title>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
	integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
	crossorigin="anonymous" type="text/javascript"></script>

<!-- 
		License of Content used from Bootstrap

		The MIT License (MIT)

		Copyright (c) 2011-2018 Twitter, Inc.
		Copyright (c) 2011-2018 The Bootstrap Authors

		Permission is hereby granted, free of charge, to any person obtaining a copy
		of this software and associated documentation files (the "Software"), to deal
		in the Software without restriction, including without limitation the rights
		to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
		copies of the Software, and to permit persons to whom the Software is
		furnished to do so, subject to the following conditions:

		The above copyright notice and this permission notice shall be included in
		all copies or substantial portions of the Software.

		THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
		IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
		FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
		AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
		LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
		OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
		THE SOFTWARE.
		 -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet"
	href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css"
	integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu"
	crossorigin="anonymous">
<!-- Optional theme -->
<link rel="stylesheet"
	href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap-theme.min.css"
	integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ"
	crossorigin="anonymous">
<!-- Latest compiled and minified JavaScript -->
<script
	src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"
	integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd"
	crossorigin="anonymous" type="text/javascript"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
	rel="stylesheet">
<style type="text/css">
.highlight-row {
	background-color: lightyellow;
}

.highlight-row-hover {
	background-color: lightcoral;
}

li.highlight-line {
	margin: 10px;
}

.timeline-past p {
	font-style: italic;
	color: grey;
}

.timeline-current p {
	font-weight: bolder;
}

.hiddenRow {
	padding: 0 !important;
}

.material-icons {
	display: inline-flex;
	vertical-align: middle;
}
</style>
</head>
<body>
	<?php
    require '../functions.php';

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
        //exit($error_text);
    }
    if (isset($_GET['to'])) {
        $pDestination = urldecode($_GET['to']);
    } elseif (isset($_GET['to.latitude']) and isset($_GET['to.longitude'])) {
        $pDestination = array(
            $_GET['to.latitude'],
            $_GET['to.longitude']
        );
    } else {
        //exit("Error! Set destination (to or to.latitude & to.longitude) or set help for help");
    }

    if (isset($_GET['departure'])) {
        $pDepOrArrTime = "dep";
    } elseif (isset($_GET['arrival'])) {
        $pDepOrArrTime = "arr";
    } else {
        $pDepOrArrTime = "dep";
        $pWhen = "now";
    }
    if (isset($_GET['whend']) and isset($_GET['whent'])) {
        $pWhen = urldecode($_GET['whend']) . " " . urldecode($_GET['whent']);
    } elseif (isset($_GET['when'])) {
        $pWhen = urldecode($_GET['when']);
    } else {
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
        $pRemarks = True;
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

    $journeys = json_decode(utf8_encode(getJourney($argOrigin = $pOrigin, $argDestination = $pDestination, $argCalcNumberOfTrips = $pCalcNumberOfTrips, $argRemarks = $pRemarks, $argWhen = $pWhen, $argDepOrArrTime = $pDepOrArrTime, $argMaxTransfers = $pMaxTransfers, $argWalkingSpeed = $pWalkingSpeed, $argSuburban = $pSuburban, $argSubway = $pSubway, $argTram = $pTram, $argBus = $pBus, $argFerry = $pFerry, $argExpress = $pExpress, $argRegional = $pRegional, $argLanguage = $pLanguage, $argPretty = $pPretty)), 1, JSON_UNESCAPED_UNICODE);

    // echo "<code>".json_encode($journeys)."</code>";

    echo '	<div class="container">';
    // Heading
    echo "<h1>" . STR_SHOW_1 . " " . date("d.m.Y H:i", strtotime($pWhen)) . "</h1>";
    echo "<h2>". strtolower(STR_SHOW_5)." ".$_GET['from']." ". strtolower(STR_SHOW_6)." ".$_GET['to']."</h2>";

    ?>
    		<div class="row">
			<p class="col-md-12 col-lg-12">
				<a class="btn btn-primary col-md-12"
					href="<?php
			$arg_GET = $_GET;
			unset($arg_GET['when']);
			unset($arg_GET['whend']);
			unset($arg_GET['whent']);

			echo $_SERVER['SCRIPT_NAME'] . "?" . http_build_query($arg_GET);
			?>"
					target="_blank"><?php echo STR_SHOW_8; ?></a>
			</p>
			<p class="col-md-12 col-lg-12">
				<a class="btn btn-primary col-md-12"
					href="<?php
			$arg_GET = $_GET;
			$arg_GET['calcNumberOfTrips'] = $arg_GET['calcNumberOfTrips'] + 5;

			echo $_SERVER['SCRIPT_NAME'] . "?" . http_build_query($arg_GET);
			?>"><?php echo STR_SHOW_9; ?></a>
			</p>
		</div>
    <?php 


    $table_content .= '<table class="table table-condensed table-hover">';

    $table_content .= '<tr>
        <th>' . STR_SHOW_2 . '</th>
        <th>' . STR_SHOW_3 . '</th>
        <th>' . STR_SHOW_4 . '</th>
        <th>' . STR_SHOW_5 . '</th>
        <th>' . STR_SHOW_6 . '</th>
        <th></th>
        </tr>';
    $row_in_table = 0;

    foreach ($journeys[0]["journeys"] as $j) {
        $table_content .= '<tr data-toggle="collapse" data-target="#row' . $row_in_table . '" class="accordion-toggle">';
        $table_content .= "\t\t\t\t<td title='" . date("c", strtotime($j["legs"][0]["departure"])) . "'>" . date("H:i", strtotime($j["legs"][0]["departure"])) . '&nbsp;Uhr'; // Departure Time
        if ($j["legs"][0]['departureDelay'] > 0) {
            $table_content .= '&nbsp;<span class="badge">+' . $j["legs"][0]['departureDelay'] . "</span></td>\n";
        } else {
            $table_content .= "</td>\n";
        }
        $table_content .= "\t\t\t\t<td title='" . date("c", strtotime(end($j["legs"])["arrival"])) . "'>" . date("H:i", strtotime(end($j["legs"])["arrival"])) . '&nbsp;Uhr'; // Departure Time
        if (end($j["legs"])['departureDelay'] > 0) {
            $table_content .= '&nbsp;<span class="badge">+' . end($j["legs"])['arrivalDelay'] . "</span></td>\n";
        } else {
            $table_content .= "</td>\n";
        }

        $table_content .= "\t\t\t\t<td>" . minutesToH_i(end($j["legs"])["minuteInJourney"]) . '</td>';

        $table_content .= "\t\t\t\t<td>" . $j["legs"][0]['origin']['name'] . '</td>';
        $table_content .= "\t\t\t\t<td>" . end($j["legs"])['destination']['name'] . '</td>';
        unset($mot);
        foreach ($j["legs"] as $leg) {
            // filter MOTs
            if ($leg["line"]["product"] == "Fussweg") {
                $mot[] = '<i class="material-icons">directions_walk</i>';
            } else {
                if (str_contains($leg["line"]['name'], "Flixbus")) {
                    $mot[] = $leg["line"]['name'];
                } elseif (str_contains($leg["line"]['name'], "RE") or str_contains($leg["line"]['name'], "RB")) {
                    $mot[] = $leg["line"]['name'];
                } elseif (str_contains($leg["line"]["name"], "IC")) {
                    $mot[] = str_replace("InterCity", "", str_replace("InterCityExpress", "", $leg["line"]['name']));
                } elseif (! is_numeric($leg["line"]['symbol'])) {
                    $mot[] = $leg["line"]['symbol'];
                } elseif (empty($leg["line"]['name'])) {
                    $mot[] = STR_SHOW_16;
                } else{
                    $mot[] = $leg["line"]['name'];
                }
            }
        }
        $mot_string = implode('<i class="material-icons">
arrow_right
</i>', $mot);
        $table_content .= "\t\t\t\t<td>" . $mot_string . '</td>';

        $table_content .= '</tr>';
        // add hidden row

        $table_content .= '<tr>
				<td colspan="6" class="hiddenRow">
					<div id="row' . $row_in_table . '" class="accordian-body collapse container">
                        <br>
                        <div class="col-md-12"><table class="table table-condensed">';
        $tmp_count = 0;
        foreach ($j["legs"] as $leg) {
            // filter MOTs
            if ($leg["line"]["product"] == "Fussweg") {
                $mot = '<i class="material-icons">directions_walk</i> '.$leg["distance"]."&nbsp;m";
            } else {
                if (str_contains($leg["line"]['name'], "Flixbus")) {
                    $mot = $leg["line"]['name'];
                } elseif (str_contains($leg["line"]['name'], "RE") or str_contains($leg["line"]['name'], "RB")) {
                    $mot = $leg["line"]['name'];
                } elseif (str_contains($leg["line"]["name"], "IC")) {
                    $mot = str_replace("InterCity", "", str_replace("InterCityExpress", "", $leg["line"]['name']));
                } elseif (! is_numeric($leg["line"]['symbol'])) {
                    $mot = $leg["line"]['symbol'];
                } elseif (empty($leg["line"]['name'])) {
                    $mot = STR_SHOW_16;
                } else{
                    $mot = $leg["line"]['name'];
                }
            }

            // $change_at[] = $leg["destination"]["name"];

            $table_content .= "<tr>";
            $table_content .= '<td class="text-right">'.$leg['minuteInJourney']."</td>";
            $table_content .= '<td><a target="_blank" href="' . convertDownloadLink($leg['origin']['download']) . '">' . $leg['origin']['name'] . "</a></td>";
            $table_content .= '<td><i class="material-icons">timer</i> ' . $leg['duration'] . "&nbsp;min.</td>";
            $table_content .= '<td><i class="material-icons">logout</i> ' . date("H:i", strtotime($leg['departure'])) . "</td>";
            $table_content .= "<td>" . $leg['departurePlatform'] . "</td>";
            $table_content .= "<td>" . $mot . "</td>";
            $table_content .= "<td>" . $leg['arrivalPlatform'] . "</td>";
            $table_content .= '<td><i class="material-icons">login</i> ' . date("H:i", strtotime($leg['arrival'])) . "</td>";
            $table_content .= '<td><a target="_blank" href="' . convertDownloadLink($leg['destination']['download']) . '">' . $leg['destination']['name'] . "</a></td>";
            $table_content .= "</tr>";

            // get remarks list
//             foreach ($leg['remarks'] as $rm) {
//                 if ($rm['text'] == "behindertengerechtes Fahrzeug") {
//                     $helper_remarks[] = '<i class="material-icons">accessible</i> ' . STR_SHOW_24;
//                 } elseif ($rm['text'] == "Gleiswechsel") {
//                     $helper_remarks[] = '<i class="material-icons">call_split</i> ' . STR_SHOW_22;
//                 } elseif ($rm['text'] == "Niederflurbus mit Rampe") {
//                     $helper_remarks[] = '<i class="material-icons">accessible</i> ' . STR_SHOW_21;
//                 } elseif ($rm['text'] == "Niederflurfahrzeug") {
//                     $helper_remarks[] = '<i class="material-icons">accessible</i> ' . STR_SHOW_25;
//                 } elseif ($rm['text'] == "Rollstuhlzugang") {
//                     $helper_remarks[] = '<i class="material-icons">accessible</i> ' . STR_SHOW_26;
//                 } else {
//                     $helper_remarks[] = $rm['text'];
//                 }
//             }
//             if (! empty($helper_remarks)) {
//                 $remarks[] = $mot . ": " . implode(", ", $helper_remarks);
//             }
//             unset($helper_remarks);
        }
        $table_content .= '</table></div><div class="col-md-6">';
        if (count($j["tickets"]) > 0) {

            $table_content .= '<h4>' . STR_SHOW_7 . '</h4>';
            $table_content .= '<table class="table table-condensed">';
            foreach ($j["tickets"] as $ticket) {
                $table_content .= "<tr>";
                $table_content .= '<td>' . $ticket['name'] . "</td>";
                if ($ticket['price']['child'] > 0) {
                    $table_content .= '<td class="text-right">' . number_format((float) $ticket['price']['child'], 2, ',', '') . "&nbsp;€</td>";
                } else {
                    $table_content .= '<td>' . "</td>";
                }
                if ($ticket['price']['adult'] > 0) {
                    $table_content .= '<td class="text-right">' . number_format((float) $ticket['price']['adult'], 2, ',', '') . "&nbsp;€</td>";
                } else {
                    $table_content .= '<td>' . "</td>";
                }
                $table_content .= "</tr>";
            }
            $table_content .= '</table>';
        }
        // Remarks
        $table_content .= "<h4>" . STR_SHOW_15 . "</h4>";
        $table_content .= implode("<br>", $remarks) . "\n";
        unset($remarks);

        $table_content .= '</div></div>
							</td>
						</tr>';

        $row_in_table ++;
    }

    echo $table_content;

    ?>
        </table>
	</div>
	<script type="text/javascript">
		</script>
</body>
</html>


<?php } ?>



