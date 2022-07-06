<?php
if (count($_GET) == 0 or isset($_GET['start'])) {

    ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>DM > Start</title>
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
	crossorigin="anonymous"></script>
	<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
	
	<style>
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
.form-signin .form-signin-heading,
.form-signin .checkbox {
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
      <form class="form-signin" method="GET">
        <h2 class="form-signin-heading">Please enter the name of the desired stop</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="text" id="inputEmail" class="form-control" placeholder="Enter stopname" name="q" required autofocus>
        <input type="hidden" name="search">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Send</button>
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
<title>DM > Search</title>
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
	crossorigin="anonymous"></script>
	<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
	
	<style>
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
.form-signin .form-signin-heading,
.form-signin .checkbox {
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
      <form class="form-signin" method="GET">
        <h2 class="form-signin-heading">Choose your station</h2>
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
    //print_r($loc);
    for ($i = 0; $i < count($loc); $i ++) {
        $l = $loc[$i];
        if ($l['poi'] == "1") {
            $poi_text = " (POI)";
        } elseif ($l['type'] == "street") {
            $poi_text = " (street)";
        } else {
            $poi_text = "";
        }
        /*echo '        <div class="checkbox">
<label for="chooseId' . $i . '">';
        echo '<input type="radio" id="chooseId' . $i . '" name="id" class="form-control" value="' . $l['id'] . '">'. $l['name'] . $poi_text. '</label></div>';
*/
        echo '        <div class="checkbox">
          <label>
            <input type="radio" required name="id" value="' . $l['id'] . '"> '. $l['name'] . $poi_text. '
          </label>
        </div>';

    }
    ?>
    		<label>
				<input type="number" id="inputEmail" class="form-control" value="10" name="results" required="" autofocus=""> Number of results
			</label>
			<label>
				<input type="date" id="when-d" class="form-control" name="whend" required="" autofocus="">
			</label>
			<label>
				<input type="time" pattern="[0-9]{2}:[0-9]{2}:[0-9]{2}" id="when-t" class="form-control" name="whent" required="" autofocus="">
			</label>
			
			
	        <input type="hidden" name="show">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Send</button>
      </form>
    </div>
<script>
$(document).ready(function() {
    let now = new Date();
    $('#when-d').val(now.toISOString().substring(0,10));
    $('#when-t').val(now.toISOString().substring(11,16));
    
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
<title>DM > Show</title>
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
	crossorigin="anonymous"></script>
	<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
	
<style>
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
        $pWhen = urldecode($_GET['whend'])." ".urldecode($_GET['whent']);
    } elseif (isset($_GET['when'])) {
        $pWhen = urldecode($_GET['when']);
    } else {
        $pWhen = "now";
    }
    $args_for_links_in_table .= "&when=".$pWhen;
    if (isset($_GET['results'])) {
        $pResults = $_GET['results'];
    } else {
        $pResults = 10;
    }
    $args_for_links_in_table .= "&results=".$pResults;
    if (isset($_GET['suburban'])) {
        $pSuburban = filter_var($_GET['suburban'], FILTER_VALIDATE_BOOLEAN);
    } else {
        $pSuburban = True;
    }
    $args_for_links_in_table .= "&suburban=".$pSuburban;
    if (isset($_GET['subway'])) {
        $pSubway = filter_var($_GET['subway'], FILTER_VALIDATE_BOOLEAN);
    } else {
        $pSubway = True;
    }
    $args_for_links_in_table .= "&subway=".$pSubway;
    if (isset($_GET['tram'])) {
        $pTram = filter_var($_GET['tram'], FILTER_VALIDATE_BOOLEAN);
    } else {
        $pTram = True;
    }
    $args_for_links_in_table .= "&tram=".$pTram;
    if (isset($_GET['bus'])) {
        $pBus = filter_var($_GET['bus'], FILTER_VALIDATE_BOOLEAN);
    } else {
        $pBus = True;
    }
    $args_for_links_in_table .= "&bus=".$pBus;
    if (isset($_GET['ferry'])) {
        $pFerry = filter_var($_GET['ferry'], FILTER_VALIDATE_BOOLEAN);
    } else {
        $pFerry = True;
    }
    $args_for_links_in_table .= "&ferry=".$pFerry;
    if (isset($_GET['express'])) {
        $pExpress = filter_var($_GET['express'], FILTER_VALIDATE_BOOLEAN);
    } else {
        $pExpress = True;
    }
    $args_for_links_in_table .= "&express=".$pExpress;
    if (isset($_GET['regional'])) {
        $pRegional = filter_var($_GET['regional'], FILTER_VALIDATE_BOOLEAN);
    } else {
        $pRegional = True;
    }
    $args_for_links_in_table .= "&regional=".$pRegional;
    if (isset($_GET['remarks'])) {
        $pRemarks = filter_var($_GET['remarks'], FILTER_VALIDATE_BOOLEAN);
    } else {
        $pRemarks = True;
    }
    $args_for_links_in_table .= "&remarks=".$pRemarks;
    if (isset($_GET['duration'])) {
        $pDuration = $_GET['duration'];
    } else {
        $pDuration = False;
    }    
    $args_for_links_in_table .= "&duration=".$pDuration;
    if (isset($_GET['direction'])) {
        $pDirection = $_GET['direction'];
    } else {
        $pDirection = "";
    }
    $args_for_links_in_table .= "&direction=".$pDirection;
    if (isset($_GET['pretty'])) {
        $pPretty = $_GET['pretty'];
    } else {
        $pPretty = False;
    }

    $deps = json_decode(utf8_encode(getStopsDeparturesById($argId = $pId, $argWhen = $pWhen, $argResults = $pResults, $argDirection = $pDirection, $argDuration = $pDuration, $argRemarks = $pRemarks, $argLinesOfStops = True, $argSuburban = $pSuburban, $argSubway = $pSubway, $argTram = $pTram, $argBus = $pBus, $argFerry = $pFerry, $argExpress = $pExpress, $argRegional = $pRegional, $argPretty = $pPretty)), 1, JSON_UNESCAPED_UNICODE);

    // $loc = json_decode(utf8_encode(getLocation($argQuery=$pQuery, $argNumResults=$pResults, $argLanguage=$pLang, $argGetPOI=$pPOI, $argGetStreets = $pStreets, $argGetStops = $pStops, $argPretty=$pPretty)),1,JSON_UNESCAPED_UNICODE);
    echo '    <div class="container">';

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
            $line_div = '<li class="col-md-2">' . $tmp['name'] . '</li>';
            if (str_contains($line_divs, $line_div) == false) {
                $line_divs .= $line_div;
            }
        }
        $coords = $d['stop']['location']['latitude'] . "," . $d['stop']['location']['longitude'];
        $dep_divs .= '<tr>';
        $dep_divs .= '<td>' . date("H:i", strtotime($d['when'])) . '&nbsp;Uhr';
        if ($d['delay'] > 0) {
            $dep_divs .= '&nbsp;<span class="badge">+' . $d['delay'] . "</span></td>";
        } else {
            $dep_divs .= '</td>';
        }

        if (!is_numeric($d['line']['symbol'])) {
            $dep_divs .= '<td>' . $d['line']['symbol'] . "</td>";
        } elseif (str_contains($d['line']['name'], "RE") or str_contains($d['line']['name'], "RB")) {
            $dep_divs .= '<td>' . $d['line']['name'] . "</td>";
        } else {
            $dep_divs .= '<td>' . $d['line']['name'] ." ".$d['line']['symbol']. "</td>";
        }
        if ($warning_multiple_stations) {
            $dep_divs .= '<td>'.$d['stop']['stop']['name']."</td>";
        }
        $dep_divs .= '<td><a href="dm.php?show&id='.$d['origin']['id'].$args_for_links_in_table.'" target="_blank">' . $d['origin']['name'] . '</a></td>';
        $dep_divs .= '<td><a href="dm.php?show&id='.$d['destination']['id'].$args_for_links_in_table.'" target="_blank">'.$d['direction']."</a></td>";

        $dep_divs .= '</tr>';
    }
    

    ?>
<h1>Station "<?php echo $deps[0]['stop']['input']['name'].'" at '.date("d.m.Y H:i", strtotime($pWhen)); ?></h1>
	<?php if ($warning_multiple_stations) {
	    echo '<div class="alert alert-warning" role="alert">Searched stop is POI/street; multiple stations are found for this POI/street</div>';
	     } ?>
	<?php if (!isset($_GET['min'])) { ?>
	<div class="row">
		<h2 class="col-md-12">Lines</h2>
		<ul class="list-inline col-md-12">
        <?php
            echo $line_divs;
        ?>
        </ul>
    </div>
    <br>
	<div class="row">
		<div class="col-md-12"><a class="btn btn-primary"
			href="https://www.google.com/maps/search/?api=1&query=<?php echo $coords; ?>"
			target="_blank">Navigate to station</a></div>
	</div>
		<?php } ?>
	    <br>
	<table class="table table-condensed table-hover">
	<tr>
	<th></th>
	<th>Line</th>
<?php 
    if ($warning_multiple_stations) {
        echo "<th>Boarding at</th>";
    }
?>
	<th>From</th>
	<th>To</th>
	
	</tr>
    	<?php echo $dep_divs; ?>
    </table>
	</div>
</body>
</html>


<?php } ?>



