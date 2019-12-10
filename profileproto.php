<?php

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$name = $vname = $str = $plz = $ort = $tel = $email = "";
$nameErr = $vnameErr = $strErr = $plzErr = $ortErr = $telErr = $emailErr = "";
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
// einfügen der Daten in Datenbank
if (isset($_POST['aktion']) and $_POST['aktion']=='speichern') {
    $vorname = "";
    if (isset($_POST['vorname'])) {
        $vorname = trim($_POST['vorname']);
    }
    $nachname = "";
    if (isset($_POST['nachname'])) {
        $nachname = trim($_POST['nachname']);
    }
	 $geburtsdatum = "";
    if (isset($_POST['geburtsdatum'])) {
        $geburtsdatum = trim($_POST['geburtsdatum']);
    }
    
     $strasse = "";
    if (isset($_POST['straße'])) {
        $strasse = trim($_POST['straße']);
    }
    $hnumber = "";
    if (isset($_POST['hausnummer'])) {
        $hnumber = trim($_POST['number']);
    }
    $plz = "";
    if (isset($_POST['plz'])) {
        $plz = trim($_POST['plz']);
    }
     $ort = "";
    if (isset($_POST['ort'])) {
        $ort = trim($_POST['ort']);
    }
    $email = "";
    if (isset($_POST['email'])) {
        $email = trim($_POST['email']);
    }
    $tnumber = "";
    if (isset($_POST['telefonnummer'])) {
        $tnumber = trim($_POST['telefonnummer']);
    }
	  $mnumber = "";
    if (isset($_POST['mobilnummer'])) {
        $tnumber = trim($_POST['mobilnummer']);
    }
	
    if ( $vorname != '' or $nachname != '' or $geburtsdatum != '' or $strasse != '' or $hnumber != '' 
	or $plz != '' or $ort != '' or $email != '' or $tnumber != '' or $mnumber != ''  )
	
    {
        // speichern
		 $update = $erg->prepare("
                 UPDATE patientdata SET vorname=?, nachname=?, geburtsdatum=?, strasse=?, hnummer=?, plz=?, ort=?, telefonnummer=?, mobilnummer=?, email=? WHERE id=? LIMIT 1
        ");
        $update->bind_param('ssdsssssss', $vorname, $nachname, $geburtsdatum, $strasse, $hnumber, $plz, $ort, $tnumber, $mnumber, $email);
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
//hier fehlt noch die verknüpfung zur richtigen id
$daten = array();
if ($erg = $db->query("SELECT vorname, nachname, geburtsdatum, strasse, hnummer, plz, ort, telefonnummer, mobilnummer, email FROM patientdata")) {
    if ($erg->num_rows) {
        while($datensatz = $erg->fetch_object()) {
            $daten[] = $datensatz;
        }
        $erg->free();
    }	
}
	?>
	 <table>
        <thead>
            <tr>
                
                <th>Vorname</th>
                <th>Nachname</th>
				<th>Geburtsdatum</th>
                <th>Strasse</th>
                <th>Hausnummer</th>
				<th>PLZ</th>
                <th>Wohnort</th>
                <th>Telefonnummer</th>
                <th>Mobilnummer</th>
				<th>Email</th>
         
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($daten as $inhalt) {
            ?>
                <tr>
                    
                    <td><?php echo $inhalt->vorname; ?></td>
                    <td><?php echo $inhalt->nachname; ?></td>
					<td><?php echo $inhalt->geburtsdatum; ?></td>
                    <td><?php echo $inhalt->strasse; ?></td>
                    <td><?php echo $inhalt->hnummer; ?></td>
					<td><?php echo $inhalt->plz; ?></td>
                    <td><?php echo $inhalt->ort; ?></td>
                    <td><?php echo $inhalt->telefonnummer; ?></td>
                    <td><?php echo $inhalt->mobilnummer; ?></td>
                    
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

	 <div class="container">
        <div class="row">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-4">

                <h2>Änderung der Werte:</h2>
                <form name="myForm" method="POST" action="<?= $_SERVER['PHP_SELF']; ?>" onsubmit="">
                    <div class="form-group">

                        <label for="name">Name:</label>
                        <input type="text" class='form-control' name="name" autofocus="autofocus" value="<?php echo $name; ?>" required="required">
                        <span class="error"> <?php echo $nameErr; ?></span>


                        <label for="vname">Vorname:</label>
                        <input type="text" class='form-control' name="vname" value="<?php echo $vname; ?>" required="required">
                        <span class="error"> <?php echo $vnameErr; ?></span>


                        <label for="str">Straße/Nr:</label>
                        <input type="text" class='form-control' name="str" value="<?php echo $str; ?>" required="required">
                        <span class="error"> <?php echo $strErr; ?></span>


                        <label for="plz">PLZ:</label>
                        <input type="text" class='form-control' name="plz" value="<?php echo $plz; ?>" required="required">
                        <span class="error"> <?php echo $plzErr; ?></span>


                        <label for="ort">Ort:</label>
                        <input type="text" class='form-control' name="ort" value="<?php echo $ort; ?>" required="required">
                        <span class="error"> <?php echo $ortErr; ?></span>


                        <label for="tel">Telefon:</label>
                        <input class='form-control' name="tel" value="<?php echo $tel; ?>" required="required">
                        <span class="error"> <?php echo $telErr; ?></span>


                        <label for="email">Email:</label>
                        <input type="mail" class='form-control' name="email" value="<?php echo $email; ?>" required="required">
                        <span class="error"> <?php echo $emailErr; ?></span>

                    </div>
                    <div class="form-group">
                        <input type="submit" class='btn btn-success btn-color form-control' value="Save">
                    </div> 
                </form>
            </div>
            <div class="col-sm-4">
            </div>
        </div>
    </div>
	

</body

</html>