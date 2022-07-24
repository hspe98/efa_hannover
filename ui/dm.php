<?php


### Language dictionary ###
if ($_GET['language'] == "de") {
    // START
    define(STR_START_1, "Bitte Name des gewünschten Haltes eingeben");
    define(STR_START_2, "Halt eingeben");
    define(STR_START_3, "Absenden");
    // SEARCH
    define(STR_SEARCH_1, "Wähle deinen Halt aus");
    define(STR_SEARCH_2, "Anzahl der Resultate");
    define(STR_SEARCH_3, "Datum");
    define(STR_SEARCH_4, "Uhrzeit");
    define(STR_SEARCH_5, "Auswahl Verkehrsmittel");
    define(STR_SEARCH_6, "S-Bahn");
    define(STR_SEARCH_7, "U-Bahn");
    define(STR_SEARCH_8, "Straßen-/Stadtbahn");
    define(STR_SEARCH_9, "Bus");
    define(STR_SEARCH_10, "Fähre");
    define(STR_SEARCH_11, "Schnellzug");
    define(STR_SEARCH_12, "Regionalzug");
    define(STR_SEARCH_13, STR_START_3);
    // SHOW
    define(STR_SHOW_1, "Haltestelle");
    define(STR_SHOW_2, "am");
    define(STR_SHOW_3, "Linien");
    define(STR_SHOW_4, "Aktuelle Abfahrten anzeigen");
    define(STR_SHOW_5, "Mehr Abfahrten anzeigen");
    define(STR_SHOW_6, "Navigiere zu ");
    define(STR_SHOW_7, "Gesuchte Haltestelle ist eine Straße/Sehenswürdigkeit; mehrere Haltestelle sind für diese Straße/Sehenswürdigkeit gefunden worden");
    define(STR_SHOW_8, "Sehenswürdigkeit");
    define(STR_SHOW_9, "Straße");
    define(STR_SHOW_10, "Einstieg");
    define(STR_SHOW_11, "Linie");
    define(STR_SHOW_12, "von");
    define(STR_SHOW_13, "nach");
    define(STR_SHOW_14, "Gl.");
    define(STR_SHOW_15, "Hinweise");
    define(STR_SHOW_21, "Niederflurbus mit Rampe");
    define(STR_SHOW_22, "Gleiswechsel");
    define(STR_SHOW_23, "GVH-Garantiefall");
} else {
    // START
    define(STR_START_1, "Please enter the name of the desired stop");
    define(STR_START_2, "Enter stopname");
    define(STR_START_3, "Send");
    // SEARCH
    define(STR_SEARCH_1, "Choose your station");
    define(STR_SEARCH_2, "Number of results");
    define(STR_SEARCH_3, "Date");
    define(STR_SEARCH_4, "Time");
    define(STR_SEARCH_5, "Select MOT");
    define(STR_SEARCH_6, "suburban");
    define(STR_SEARCH_7, "subway");
    define(STR_SEARCH_8, "tram");
    define(STR_SEARCH_9, "bus");
    define(STR_SEARCH_10, "ferry");
    define(STR_SEARCH_11, "express");
    define(STR_SEARCH_12, "regional");
    define(STR_SEARCH_13, STR_START_3);
    // SHOW
    define(STR_SHOW_1, "Station");
    define(STR_SHOW_2, "at");
    define(STR_SHOW_3, "Lines");
    define(STR_SHOW_4, "Show current departures");
    define(STR_SHOW_5, "Show more departures");
    define(STR_SHOW_6, "Navigate to ");
    define(STR_SHOW_7, "Searched stop is POI/street; multiple stations are found for this POI/street");
    define(STR_SHOW_8, "POI");
    define(STR_SHOW_9, "street");
    define(STR_SHOW_10, "Boarding at");
    define(STR_SHOW_11, "Line");
    define(STR_SHOW_12, "From");
    define(STR_SHOW_13, "To");
    define(STR_SHOW_14, "Pl.");
    define(STR_SHOW_15, "Remarks");
    define(STR_SHOW_21, "low floor bus with ramp");
    define(STR_SHOW_22, "platform change");
    define(STR_SHOW_23, "GVH warranty case");
    
    
    
    
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
    			<h2 class="form-signin-heading text-center"><?php echo STR_START_1; ?></h2><br>
    			<input
    				type="text" id="inputEmail" class="form-control"
    				placeholder="<?php echo STR_START_2; ?>" name="q" required autofocus><br>
    			<input
    				type="hidden" name="search">
    			<input type="hidden" name="language" value="<?php echo $_GET["language"]; ?>">
    			<button class="btn btn-lg btn-primary btn-block" type="submit"><?php echo STR_START_3; ?></button>
    			<br>
    			<br>
    			<h4>language/Sprache</h4>
    			<div class="row">
        			<p class="col-sm-12 col-md-6 col-lg-4">
        				<a class="btn btn-default col-md-12" href="<?php echo $_SERVER['SCRIPT_NAME']."?language=en"; ?>">English</a>
        			</p>
        			<p class="col-sm-12 col-md-6 col-lg-4">
        				<a class="btn btn-default col-md-12" href="<?php echo $_SERVER['SCRIPT_NAME']."?language=de"; ?>">Deutsch</a>
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
	$loc = json_decode(utf8_encode(getLocation($argQuery = $pQuery, $argNumResults = $pResults, $argLanguage = $pLang, $argGetPOI = $pPOI, $argGetStreets = $pStreets, $argGetStops = $pStops, $argPretty = $pPretty)), 1, JSON_UNESCAPED_UNICODE);
	// print_r($loc);
	for ($i = 0; $i < count($loc); $i ++) {
		$l = $loc[$i];
		if ($l['poi'] == "1") {
			$poi_text = " (".STR_SHOW_8.")";
		} elseif ($l['type'] == "street") {
			$poi_text = " (".STR_SHOW_9.")";
		} else {
			$poi_text = "";
		}
		/*
		 * echo ' <div class="checkbox">
		 * <label for="chooseId' . $i . '">';
		 * echo '<input type="radio" id="chooseId' . $i . '" name="id" class="form-control" value="' . $l['id'] . '">'. $l['name'] . $poi_text. '</label></div>';
		 */
		echo '		<div class="checkbox">
		  <label>
			<input type="radio" required name="id" value="' . $l['id'] . '"> ' . $l['name'] . $poi_text . '
		  </label>
		</div>';
	}
	?>
			<label> <input type="number" id="inputEmail" class="form-control"
				value="10" name="results" required="" autofocus="0"> <?php echo STR_SEARCH_2; ?>
			</label> <label> <input type="date" id="when-d" class="form-control"
				name="whend" required="" autofocus="1"> <?php echo STR_SEARCH_3; ?>
			</label> <label> <input type="time"
				pattern="[0-9]{2}:[0-9]{2}:[0-9]{2}" id="when-t"
				class="form-control" name="whent" required="" autofocus="2"> <?php echo STR_SEARCH_4; ?>
			</label>
			<!-- MOT selection -->
			<hr>
			<h3><?php echo STR_SEARCH_5; ?></h3>
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
			<input type="hidden" name="show">
			<input type="hidden" name="language" value="<?php echo $pLang; ?>">
			

			<button class="btn btn-lg btn-primary btn-block" type="submit"><?php echo STR_SEARCH_13; ?></button>
		</form>
	</div>
	<script type="text/javascript">
$(document).ready(function() {
	let now = new Date();
	$('#when-d').val(now.getFullYear()+"-"+("0" + (now.getMonth()+1)).slice(-2)+"-"+("0" + now.getDate()).slice(-2));
	$('#when-t').val(now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: false }));
	
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
			.material-icons {
                display: inline-flex;
                vertical-align: middle;
            }
		</style>
	</head>
	<body>
	<?php
		require '../functions.php';

		if (isset($_GET['id'])) {
			$pId = $_GET['id'];
		} else {
			exit("Error! Set id or set help for help");
		}
		if (isset($_GET['whend']) and isset($_GET['whent'])) {
			$pWhen = urldecode($_GET['whend']) . " " . urldecode($_GET['whent']);
		} elseif (isset($_GET['when'])) {
			$pWhen = urldecode($_GET['when']);
		} else {
			$pWhen = "now";
		}
		$args_for_links_in_table .= "&when=" . $pWhen;
		if (isset($_GET['results'])) {
			$pResults = $_GET['results'];
		} else {
			$pResults = 10;
		}
		$args_for_links_in_table .= "&results=" . $pResults;
		if (isset($_GET['suburban'])) {
			$pSuburban = filter_var($_GET['suburban'], FILTER_VALIDATE_BOOLEAN);
		} else {
			$pSuburban = True;
		}
		$args_for_links_in_table .= "&suburban=" . $pSuburban;
		if (isset($_GET['subway'])) {
			$pSubway = filter_var($_GET['subway'], FILTER_VALIDATE_BOOLEAN);
		} else {
			$pSubway = True;
		}
		$args_for_links_in_table .= "&subway=" . $pSubway;
		if (isset($_GET['tram'])) {
			$pTram = filter_var($_GET['tram'], FILTER_VALIDATE_BOOLEAN);
		} else {
			$pTram = True;
		}
		$args_for_links_in_table .= "&tram=" . $pTram;
		if (isset($_GET['bus'])) {
			$pBus = filter_var($_GET['bus'], FILTER_VALIDATE_BOOLEAN);
		} else {
			$pBus = True;
		}
		$args_for_links_in_table .= "&bus=" . $pBus;
		if (isset($_GET['ferry'])) {
			$pFerry = filter_var($_GET['ferry'], FILTER_VALIDATE_BOOLEAN);
		} else {
			$pFerry = True;
		}
		$args_for_links_in_table .= "&ferry=" . $pFerry;
		if (isset($_GET['express'])) {
			$pExpress = filter_var($_GET['express'], FILTER_VALIDATE_BOOLEAN);
		} else {
			$pExpress = True;
		}
		$args_for_links_in_table .= "&express=" . $pExpress;
		if (isset($_GET['regional'])) {
			$pRegional = filter_var($_GET['regional'], FILTER_VALIDATE_BOOLEAN);
		} else {
			$pRegional = True;
		}
		$args_for_links_in_table .= "&regional=" . $pRegional;
		if (isset($_GET['remarks'])) {
			$pRemarks = filter_var($_GET['remarks'], FILTER_VALIDATE_BOOLEAN);
		} else {
			$pRemarks = True;
		}
		$args_for_links_in_table .= "&remarks=" . $pRemarks;
		if (isset($_GET['duration'])) {
			$pDuration = $_GET['duration'];
		} else {
			$pDuration = False;
		}
		$args_for_links_in_table .= "&duration=" . $pDuration;
		if (isset($_GET['direction'])) {
			$pDirection = $_GET['direction'];
		} else {
			$pDirection = "";
		}
		$args_for_links_in_table .= "&direction=" . $pDirection;
		if (isset($_GET['pretty'])) {
			$pPretty = $_GET['pretty'];
		} else {
			$pPretty = False;
		}

		$deps = json_decode(utf8_encode(getStopsDeparturesById($argId = $pId, $argWhen = $pWhen, $argResults = $pResults, $argDirection = $pDirection, $argDuration = $pDuration, $argRemarks = $pRemarks, $argLinesOfStops = True, $argSuburban = $pSuburban, $argSubway = $pSubway, $argTram = $pTram, $argBus = $pBus, $argFerry = $pFerry, $argExpress = $pExpress, $argRegional = $pRegional, $argPretty = $pPretty)), 1, JSON_UNESCAPED_UNICODE);

		// $loc = json_decode(utf8_encode(getLocation($argQuery=$pQuery, $argNumResults=$pResults, $argLanguage=$pLang, $argGetPOI=$pPOI, $argGetStreets = $pStreets, $argGetStops = $pStops, $argPretty=$pPretty)),1,JSON_UNESCAPED_UNICODE);
		echo '	<div class="container">';

		// count different stations for edge case street/poi ID
		foreach ($deps as $d) {
			$d_helper[] = $d['stop']['stop']['name'];
		}
		if (count(array_unique($d_helper)) > 1) {
			$warning_multiple_stations = True;
		}

		for ($i = 0; $i < count($deps); $i ++) {
			$d = $deps[$i];
			// get all lines which are departing from stop
			foreach ($d['stop']['lines'] as $tmp) {
				$line_div = "\t\t\t\t\t".'<li id="checkbox1" class="btn btn-default col-md-2 highlight-line">';
				if (str_contains($d['line']['name'], "Flixbus")) {
					$line_div .= $d['line']['name'] . " " . $d['line']['symbol'];
				} elseif (str_contains($d['line']['name'], "RE") or str_contains($d['line']['name'], "RB")) {
					$line_div .= $d['line']['name'];
				} elseif (! is_numeric($d['line']['symbol'])) {
					$line_div .= $d['line']['symbol'];
				} else {
					$line_div .= $d['line']['name'] . " " . $d['line']['symbol'];
				}
				$line_div .= "</li>\n";
				if (str_contains($line_divs, $line_div) == false) {
					$line_divs .= $line_div;
					$line_divs_arr[] = $line_div;
				}
			}
			// sort line_divs
			sort($line_divs_arr);
			$line_divs = implode("",$line_divs_arr);
			$coord_check = $d['stop']['stop']['name'];
			if (! str_contains($coord_check_in_list, $coord_check)) {
				$coords[] = array(
					"latlong" => $d['stop']['stop']['location']['latitude'] . "," . $d['stop']['stop']['location']['longitude'],
					"name" => $d['stop']['stop']['name']
				);
				$coord_check_in_list .= $coord_check;
			}
			$dep_divs .= "\t\t\t<tr>\n";
			$dep_divs .= "\t\t\t\t<td>" . date("H:i", strtotime($d['when'])) . '&nbsp;Uhr';
			if ($d['delay'] > 0) {
				$dep_divs .= '&nbsp;<span class="badge">+' . $d['delay'] . "</span></td>\n";
			} else {
				$dep_divs .= "</td>\n";
			}
			if (str_contains($d['line']['name'], "Flixbus")) {
				$dep_divs .= "\t\t\t\t<td>" . $d['line']['name'] . " " . $d['line']['symbol'] . "</td>\n";
			} elseif (str_contains($d['line']['name'], "RE") or str_contains($d['line']['name'], "RB")) {
			    $dep_divs .= "\t\t\t\t<td title='".$d['line']['nr']."'>" . $d['line']['name'] . "</td>\n";
			} elseif (! is_numeric($d['line']['symbol'])) {
				$dep_divs .= "\t\t\t\t<td>" . $d['line']['symbol'] . "</td>\n";
			} else {
				$dep_divs .= "\t\t\t\t<td>" . $d['line']['name'] . " " . $d['line']['symbol'] . "</td>\n";
			}
			if ($warning_multiple_stations) {
				$dep_divs .= "\t\t\t\t<td>" . $d['stop']['stop']['name'] . "</td>\n";
			}

			$dep_divs .= "\t\t\t\t".'<td><a href="dm.php?show&id=' . $d['origin']['id'] . $args_for_links_in_table . '" target="_blank">' . $d['origin']['name'] . "</a></td>\n";
			$dep_divs .= "\t\t\t\t".'<td><a href="dm.php?show&id=' . $d['destination']['id'] . $args_for_links_in_table . '" target="_blank">' . $d['direction'] . "</a></td>\n";
			$dep_divs .= "\t\t\t\t<td>" . $d['platform'] . "</td>\n";
			if (($d['delay'] >= 20) and ($d['line']['operator']['id'] == "ÜSTRA" or $d['line']['operator']['id'] == "TDHS")) {
				$remarks[] = '<i class="material-icons">monetization_on</i> '.STR_SHOW_23;
			}
			foreach ($d['remarks'] as $rm) {
				if ($rm['text'] == "behindertengerechtes Fahrzeug") {
					$remarks[] = '<i class="material-icons">accessible</i>';
				} elseif ($rm['text'] == "Gleiswechsel") {
					$remarks[] = '<i class="material-icons">call_split</i> '.STR_SHOW_22;
				} elseif ($rm['text'] == "Niederflurbus mit Rampe") {
				    $remarks[] = '<i class="material-icons">accessible</i> '.STR_SHOW_21;
				} else {
					$remarks[] = $rm['text'];
				}
			}

			$dep_divs .= "\t\t\t\t<td>" . implode(", <br>", $remarks) . "</td>\n";
			unset($remarks);

			$dep_divs .= "\t\t\t</tr>\n";
		}

		?>
	<h1><?php echo STR_SHOW_1." \"".$deps[0]['stop']['input']['name'].'" '.STR_SHOW_2.' '.date("d.m.Y H:i", strtotime($pWhen)); ?></h1>
		<?php
		if ($warning_multiple_stations) {
		    echo '<div class="alert alert-warning" role="alert">'.STR_SHOW_7.'</div>'."\n";
		}
		?>
		<?php if (!isset($_GET['min'])) { ?>
		<div class="row">
			<h2 class="col-md-12" role="button" id="line_list_heading"><?php echo STR_SHOW_3; ?>
			<?php if(count($line_divs_arr) > 10) {
			    echo ' <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></h2><div class="collapse" id="line_list">';
			} else {
			    echo ' <span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></h2><div class="collapse in" id="line_list">';
			} ?>
			
			<ul class="list-inline col-md-12">
<?php
	echo $line_divs;
?>
			</ul></div>
		</div>
		<br>
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
					target="_blank"><?php echo STR_SHOW_4; ?></a>
			</p>
			<p class="col-md-12 col-lg-12">
				<a class="btn btn-primary col-md-12"
					href="<?php
			$arg_GET = $_GET;
			$arg_GET['results'] = $arg_GET['results'] + 20;

			echo $_SERVER['SCRIPT_NAME'] . "?" . http_build_query($arg_GET);
			?>"><?php echo STR_SHOW_5; ?></a>
			</p>
				<?php
			foreach ($coords as $c) {
				echo '			<p  class="col-md-12 col-lg-6"><a class="btn btn-info col-md-12"
					href="https://www.google.com/maps/search/?api=1&query=' . $c["latlong"] . '"
					target="_blank">'.STR_SHOW_6.' ' . $c["name"] . '</a></p>';
			}

			?>
		</div>
		<?php } ?>
		<br>
			<?php 
			// durch Fahrten iterieren
			for ($i = 0; $i < count($deps); $i++) {
			    $d = $deps[$i];
			    //var_dump($d['history']);
			    // get all history stops
			    echo '<div class="collapse journeys" id="journey'.$i.'"><h4>Fahrtverlauf</h4><table class="table table-bordered">';
			    foreach ($d['history'] as $tmp) {
			            echo '<tr class="timeline-'.$tmp['pos'].'"><td><p class="timeline-time">'.$tmp['arr'].'</p></td>';
			            echo '<td rowspan="2"><p class="timeline-stop">'.$tmp['stop'].'</p></td></tr>';
			            echo '<tr class="timeline-'.$tmp['pos'].'"><td><p class="timeline-time">'.$tmp['dep'].'</p></td></tr>';
			            
		        }
		        echo '</table></div>';
			    
			}
			
			?>
		
		<br>
		<table class="table table-condensed table-hover">
			<tr>
				<th></th>
				<th><?php echo STR_SHOW_11; ?></th>
				<?php
					if ($warning_multiple_stations) {
						echo "<th>".STR_SHOW_10."</th>\n";
					}
				?>
				<th><?php echo STR_SHOW_12; ?></th>
				<th><?php echo STR_SHOW_13; ?></th>
				<th><?php echo STR_SHOW_14; ?></th>
				<th><?php echo STR_SHOW_15; ?></th>
			</tr>
<?php echo $dep_divs; ?>
		</table>
		<script type="text/javascript">

		
		
			$('li').click(function()
			{
				var x = $(this);
				var x_text = $(this).text();
				var elem = $("td").filter(function(index)
				{
					return $(this).text() == x_text;
				});
				if (elem.closest('tr').hasClass("highlight-row"))
				{
					elem.closest('tr').removeClass("highlight-row");
					x.removeClass("active");
				}
				else
				{
					elem.closest('tr').addClass("highlight-row");
					x.addClass("active");
				}
			});
			$('#line_list_heading').click(function()
			{
				$('#line_list').collapse("toggle");
				$(this).find('span').toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
			});
			
			$("li").hover(function()
			{
				var x = $(this).text();
				$("td").filter(function(index)
				{
					return $(this).text() == x;
				}).addClass("highlight-row-hover");
			}, function()
			{
				var x = $(this).text();
				$("td").filter(function(index)
				{
					return $(this).text() == x;
				}).removeClass("highlight-row-hover");
			});
			
			$('tr').click(function()
			{
				var x = $(this);
				var n = x.index()-1;
				console.log(n);
				$('.journeys').collapse("hide");
				$('#journey'+n).collapse("show");
				$('tr.timeline-past').addClass("active");
				$('tr.timeline-current').addClass("info");
				$('.journeys *').css('vertical-align', "middle");

			});
		</script>
	</body>
</html>


<?php } ?>



