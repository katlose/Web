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
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'patientendb';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if ( mysqli_connect_errno() ) {
    // If there is an error with the connection, stop the script and display the error.
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}

if (isset($_POST['aktion']) and $_POST['aktion']=='speichern') {
    $vorname = "";
    if (isset($_POST['vorname'])) {
        $vorname = trim($_POST['vorname']);
    }
    $nachname = "";
    if (isset($_POST['nachname'])) {
        $nachname = trim($_POST['nachname']);
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
    if ( $vorname != '' or $nachname != '' or $strasse != '' or $hnumber != '' 
	or $plz != '' or $ort != '' or $email != '' or $tnumber != ''  )
    {
        // speichern
		 $einfuegen = $erg->prepare("
                 INSERT INTO profile (id, vorname, nachname, geburtsdatum, strasse, number, plz, ort, email, telefonnummer) 
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                 ");
        $einfuegen->bind_param('sssssssss', $vorname, $nachname, $strasse, $hnumber, $plz, $ort, $email, $tnumber);
        if ($einfuegen->execute()) {
            header('Location: index.php?aktion=feedbackgespeichert');
            die();
        }
    }	
}
if (isset($_POST['aktion']) and $_POST['aktion']=='feedbackgespeichert') {
    echo '<p class="feedbackerfolg">Datensatz wurde gespeichert

';
}



$daten = array();
if ($erg = $db->query("SELECT * FROM profile")) {
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
                <th>ID</th>
                <th>Vorname</th>
                <th>Nachname</th>
                <th>Strasse</th>
                <th>Hausnummer</th>
				<th>PLZ</th>
                <th>Wohnort</th>
                <th>Email-Adresse</th>
                <th>Telefonnummer</th>
         
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($daten as $inhalt) {
            ?>
                <tr>
                    <td><?php echo $inhalt->id; ?></td>
                    <td><?php echo $inhalt->vorname; ?></td>
                    <td><?php echo $inhalt->nachname; ?></td>
                    <td><?php echo $inhalt->strasse; ?></td>
                    <td><?php echo $inhalt->hnumber; ?></td>
					<td><?php echo $inhalt->plz; ?></td>
                    <td><?php echo $inhalt->ort; ?></td>
                    <td><?php echo $inhalt->email; ?></td>
                    <td><?php echo $inhalt->tnumber; ?></td>
                    
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
<?php	
}
?>
	
	<form action="" method="post">
		<fieldset>
			<legend>Profil bearbeiten</legend>
			<label>
			Vorname: <input type="text" name="vorname" size="20"> </label>
			<label>
			Nachname: <input name="nachname" size="20"></label>
			<label>
			Geburtsdatum: <input type="date" name"Geburtsdatum"></label>
			<label>
			Straße: <input name="straße" size="20"> </label>
			<label>
			Hausnummer: <input type="number" name="hausnummer" size="20"></label>
			<label>
			PLZ: <input type="number" name="plz" size ="20"></label>
			<label>
			Wohnort: <input name="ort" size="20"></label>
			<label>
			Email-Adresse: <input type="email" name="Email-Adresse" size="20"></label>
			
			<label>
			Telefonnummer: <input type="number" name="telefonnummer""size="20"></label>
			
	<input type="hidden" name="aktion" value="speichern">
	<input type="submit" value="Speichern">
	</fieldset>
	</form>


</body
</html>