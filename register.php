<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
    <title>Registrierung</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="container">
            <div class="login-form">    
                    <form action="register.php" method="post">
                        <img src="images/logo.png" class="img-fluid" alt="logo">
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="E-Mail" required="required">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="username" placeholder="Benutzername">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password_1" placeholder="Passwort" required="required">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password_2" placeholder="Passwort wiederholen" required="required">
                        </div>
                        <input type="submit" name="register_user" class="btn btn-primary btn-block btn-lg" value="Registrieren">              
                    </form>
                    <p>
  		                Bereits Mitglied? <a href="index.php">Anmelden</a>
                      </p>
                </div>
                <?php  if (count($errors) > 0) : ?>
                    <div class="error">
                        <?php foreach ($errors as $error) : ?>
                        <p><?php echo $error ?></p>
                        <?php endforeach ?>
                    </div>
                    <?php  endif ?>
            </div>
</body>
</html>