<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="css/myStyle.css"/>
</head>
<body>
<?php require_once("entete.php")?>
<div class="container spacer col-md-6 col-xs-12 col-md-offset-3">
    <div class="panel panel-warning">
        <div class="panel-heading">CONNEXION</div>
        <div class="panel-boby">
            <form method="post" action="seconnecter.php">
            <div class="form-group">
                <label class="control-label">login:</label>
                <input type="text" name="username" class="form-control"/>
            </div>
            <div class="form-group">
                <label class="control-label">pass:</label>
                <input type="password" name="password" class="form-control" />
            </div>
            <div>
                <button type="submit" class="btn-warning" >Login</button>
            </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>