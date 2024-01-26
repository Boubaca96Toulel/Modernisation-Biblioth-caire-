<?php
session_start();
include 'connexion.php';

$mode = $_REQUEST["mode"];

if ($mode == "add_new" ) {

  $first_name = trim($_POST['first_name']);
  
  $last_name = trim($_POST['last_name']);
  $email_id = trim($_POST['email_id']);
  $contact_no1 = trim($_POST['contact_no1']);
  $nombrepage = trim($_POST['nombrepage']);
  $dparution = trim($_POST['dparution']);
  $dateachat = trim($_POST['dateachat']);
  
  $filename = "";
  $error = FALSE;

  if (is_uploaded_file($_FILES["profile_pic"]["tmp_name"])) {
    $filename = time() . '_' . $_FILES["profile_pic"]["name"];
    $filepath = 'profile_pics/' . $filename;
    if (!move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $filepath)) {
      $error = TRUE;
    }
    
    }
   
  if (!$error) {
    $sql = "INSERT INTO abonne (nom , prenom, nationnalite, datenaissance , avatar) VALUES ( '$first_name', '$last_name',   '$email_id',  '$contact_no1' , '$filename')";

    try {
      $stmt = $bd->prepare($sql);


    
      // execute Query
      $stmt->execute();
      $result = $stmt->rowCount();
      if ($result > 0) {
        $_SESSION["errorType"] = "success";
        $_SESSION["errorMsg"] = "abonné ajouté avec succés.";
      } else {
        $_SESSION["errorType"] = "danger";
        $_SESSION["errorMsg"] = "échec d'addition de abonné.";
      }
    } catch (Exception $ex) {

      $_SESSION["errorType"] = "danger";
      $_SESSION["errorMsg"] = $ex->getMessage();
    }
  } else {
    $_SESSION["errorType"] = "danger";
    $_SESSION["errorMsg"] = "échec de mise à jour de l'image.";
  }
  header("location:abonnes.php");
} elseif ( $mode == "update_old" ) {
  
  $first_name = trim($_POST['first_name']);
  
  $last_name = trim($_POST['last_name']);
  $email_id = trim($_POST['email_id']);
  $contact_no1 = trim($_POST['contact_no1']);
  $nombrepage = trim($_POST['nombrepage']);
  $dparution = trim($_POST['dparution']);
  $dateachat = trim($_POST['dateachat']);

  $cid = trim($_POST['cid']);
  $filename = "";
  $error = FALSE;

  if (is_uploaded_file($_FILES["profile_pic"]["tmp_name"])) {
    $filename = time() . '_' . $_FILES["profile_pic"]["name"];
    $filepath = 'profile_pics/' . $filename;
    if (!move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $filepath)) {
      $error = TRUE;
    }
  } else {
     $filename = $_POST['old_pic'];
  }

  if (!$error) {
    $sql = "UPDATE abonne SET nom = '$first_name',  prenom = '$last_name' ,  nationnalite = '$email_id',  datenaissance = '$contact_no1'  , avatar = '$filename'  WHERE idabonne = '$cid'  ";

    try {
      $stmt = $bd->prepare($sql);

      // execute Query
      $stmt->execute();
      $result = $stmt->rowCount();
      if ($result > 0) {
        $_SESSION["errorType"] = "success";
        $_SESSION["errorMsg"] = "abonné modifiée avec succes.";
      } else {
        $_SESSION["errorType"] = "info";
        $_SESSION["errorMsg"] = "aucune modification n'est effectuée";
      }
    } catch (Exception $ex) {

      $_SESSION["errorType"] = "danger";
      $_SESSION["errorMsg"] = $ex->getMessage();
    }
  } else {
    $_SESSION["errorType"] = "danger";
    $_SESSION["errorMsg"] = "échec de mise à jour de l'image.";
  }
  header("location:abonnes.php?pagenum=".$_POST['pagenum']);
} elseif ( $mode == "delete" ) {
   $cid = intval($_GET['cid']);
   
   $sql = "DELETE FROM abonne WHERE idabonne = '$cid' ";
   try {
     
      $stmt = $bd->prepare($sql);
     
        
       $stmt->execute();  
       $res = $stmt->rowCount();
       if ($res > 0) {
        $_SESSION["errorType"] = "success";
        $_SESSION["errorMsg"] = "abonné supprimé avec succés.";
      } else {
        $_SESSION["errorType"] = "info";
        $_SESSION["errorMsg"] = "échec de suppression de abonné.";
      }
     
   } catch (Exception $ex) {
      $_SESSION["errorType"] = "danger";
      $_SESSION["errorMsg"] = $ex->getMessage();
   }
   
   header("location:abonnes.php?pagenum=".$_GET['pagenum']);
}
?>