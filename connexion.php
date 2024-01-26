<?php
try
{
    $bd= new PDO('mysql:host=localhost;dbname=bibliotheque','root','');
//$dbh = new PDO('mysql:host=localhost;dbname=test', $user, $pass);
}
catch(Exceptipn $e)
{
    die('Erreur : ' . $e->getMessage());
    
}

//get error/success messages

if (isset($_SESSION["errorType"])&&isset($_SESSION["errorMsg"]))
{
if ($_SESSION["errorType"] != "" && $_SESSION["errorMsg"] != "" ) {
    $ERROR_TYPE = $_SESSION["errorType"];
    $ERROR_MSG = $_SESSION["errorMsg"];
    $_SESSION["errorType"] = "";
    $_SESSION["errorMsg"] = "";
}}

?>