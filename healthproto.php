<?php

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$date = $blood = $puls = $height = $weight = $feel = $uid = "";
$dateErr = $bloodErr = $pulsErr = $heightErr = $weightErr = $feelErr = $uidErr = "";
$output = "";

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Stammdaten Patient</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
	<?php
	error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
// DB Verbindung
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'patientendb';

$db = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if ( mysqli_connect_errno() ) {
    // If there is an error with the connection, stop the script and display the error.
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// einfügen der Daten in Variablen
if (isset($_POST['aktion']) and $_POST['aktion']=='speichern') {
    $date = "";
    if (isset($_POST['date'])) {
        $date = trim($_POST['date']);
    }
    $blood = "";
    if (isset($_POST['blood'])) {
        $blood = trim($_POST['blood']);
    }
	 $puls = "";
    if (isset($_POST['puls'])) {
        $puls = trim($_POST['puls']);
    }
    
     $height = "";
    if (isset($_POST['height'])) {
        $height = trim($_POST['height']);
    }
    $weight = "";
    if (isset($_POST['weight'])) {
        $weight = trim($_POST['weight']);
    }
    $feel = "";
    if (isset($_POST['feel'])) {
        $feel = trim($_POST['feel']);
    }
	$uid = "";
    if (isset($_POST['uid'])) {
		$uid = trim($_POST['uid']);
	}
	
    if ( $date != '' or $blood != '' or $puls != '' or $height != '' or $weight != '' 
	or $feel != ''  )
	
    {
        // speichern der Variablen in DB
		 $update = $erg->prepare("
                  INSERT INTO healthdata (date, blutdruck, puls, groesse, gewicht, befinden, uid) 
                VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        $update->bind_param('dssiisi', $date, $blood, $puls, $height, $weight, $feel, $uid);
        if ($update->execute()) {
           echo '<p class="feedbackerfolg">Datensatz wurde geändert</p>';
            $modus_aendern = false;
        }
    }	
}
if (isset($_POST['aktion']) and $_POST['aktion']=='feedbackgespeichert') {
    echo '<p class="feedbackerfolg">Datensatz wurde gespeichert

';
}

//auslesen der Daten aus DB
//muss noch gemacht werden
// wie bei arzt


//Formular

	<div class="container">
        <div class="row">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-4">

                <h2>Eingabe der Werte:</h2>
                <form name="myForm" method="POST" action="<?= $_SERVER['PHP_SELF']; ?>" onsubmit="">
                    <div class="form-group">
                        <label for="date">Datum</label>
                        <input type="date" class='form-control' name="date" autofocus="autofocus" value="<?php echo $date; ?>" required="required">
                        <span class="error"> <?php echo $dateErr; ?></span>


                        <label for="blood">Blutdruck:</label>
                        <input type="text" class='form-control' name="blood" value="<?php echo $blood; ?>" required="required">
                        <span class="error"> <?php echo $bloodErr; ?></span>

                        <label for="puls">Puls:</label>
                        <input type="text" class='form-control' name="puls" value="<?php echo $puls; ?>" required="required">
                        <span class="error"> <?php echo $pulsErr; ?></span>

                        <label for="height">Körpergröße (m):</label>
                        <input type="text" class='form-control' name="height" value="<?php echo $height; ?>" required="required">
                        <span class="error"> <?php echo $heightErr; ?></span>

                        <label for="weight">Körpergewicht (kg):</label>
                        <input type="text" class='form-control' name="weight" value="<?php echo $weight; ?>" required="required">
                        <span class="error"> <?php echo $weightErr; ?></span>

                        <label for="feel">Befinden:</label>
                        <input type="text" class='form-control' name="feel" value="<?php echo $feel; ?>" required="required">
                        <span class="error"> <?php echo $feelErr; ?></span>

                    </div>
                    <div class="form-group">
                    <input type="submit" class='form-control btn btn-dark' value="Calculate" data-toggle="modal" data-target="#exampleModal">
                    </div>
                </form>
            </div>
            <div class="col-sm-4">
                
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row"></div>
    </div>
    <!-- Button trigger modal -->

<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">BMI-Ergebnis</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     <p>
        <?php echo $output?>
    </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>
</div>
	

</body

</html>