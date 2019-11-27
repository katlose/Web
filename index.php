<?php include('server.php') ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
<h1 class="greetings"> Herzlich Willkommen beim Programm für Gewichtsreduktion von Dr. Jungbrunnen! </h1>
        <div class="container">
            <div class="login-form">    
                    <form action="index.php" method="post">
                        <img src="logo.png" class="img-fluid" alt="logo">
                        <div class="form-group">
                            <input type="text" class="form-control" name="username" placeholder="Username" required="required">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Password" required="required">
                        </div>
                        <div class="form-group small clearfix">
                            <label class="checkbox-inline"><input type="checkbox"> Remember me</label>
                            <a href="#" class="forgot-link">Password vergessen?</a>
                        </div> 
                        <input type="submit" name="login_user" class="btn btn-primary btn-block btn-lg" value="Login">              
                    </form>			
                    <div class="text-center small">Noch keinen Account? <a href="register.php">Registrieren</a></div>
                </div>
				<div class="text-center small"><a href="impressum.html">Impressum</a></div>
            </div>
</body>

</html>