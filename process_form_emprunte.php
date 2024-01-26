<?php
session_start();
include 'connexion.php';

$mode = $_REQUEST["mode"];

if ($mode == "add_new" ) {

  $first_name = trim($_POST['first_name']);
  
  $last_name = trim($_POST['last_name']);
  $email_id = trim($_POST['email_id']);
  $contact_no1 = trim($_POST['contact_no1']);
  
  $contact_no12 = trim($_POST['contact_no12']);
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
    $sqll = "SELECT idlivre FROM livre WHERE tittre = '$first_name' ";
     ##########
     $stmtl = $bd->prepare($sqll);
     $stmtl->execute();
     $resultsl = $stmtl->fetch();
     
     #########

     $sqld = "SELECT idabonne FROM abonne WHERE nom = '$contact_no12' ";
     ##########
     $stmtd = $bd->prepare($sqld);
     $stmtd->execute();
     $resultsd = $stmtd->fetch();
     
     $idlivre = $resultsl["idlivre"];
     $idabonne =  $resultsd["idabonne"];
     ######### 

    $sql = "INSERT INTO emprunte (datedebut , datefin, daterendu ,idlivre , idabonne) VALUES ( '$last_name',   '$email_id',  '$contact_no1', '$idlivre' , '$idabonne' ) ";
    
    try {
     
      $stmt = $bd->prepare($sql);

      // execute Query
      $stmt->execute();
  
      $result = $stmt->rowCount();
      if ($result > 0) {
        $_SESSION["errorType"] = "success";
        $_SESSION["errorMsg"] = "emprunte ajouté avec succés.";
      } else {
        $_SESSION["errorType"] = "danger";
        $_SESSION["errorMsg"] = "échec d'addition de emprunte.";
      }
    } catch (Exception $ex) {

      $_SESSION["errorType"] = "danger";
      $_SESSION["errorMsg"] = $ex->getMessage();
    }
  } else {
    $_SESSION["errorType"] = "danger";
    $_SESSION["errorMsg"] = "échec de mise à jour de l'image.";
  }
  header("location:emprunte.php");
} elseif ( $mode == "update_old" ) {
  
  $first_name = trim($_POST['first_name']);
  
  $last_name = trim($_POST['last_name']);
  $email_id = trim($_POST['email_id']);
  $contact_no1 = trim($_POST['contact_no1']);
  $contact_no12 = trim($_POST['contact_no12']);
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
    $sqll = "SELECT idlivre FROM livre WHERE tittre = '$first_name' ";
     ##########
     $stmtl = $bd->prepare($sqll);
     $stmtl->execute();
     $resultsl = $stmtl->fetch();
     
     #########

     $sqld = "SELECT idabonne FROM abonne WHERE nom = '$contact_no12' ";
     ##########
     $stmtd = $bd->prepare($sqld);
     $stmtd->execute();
     $resultsd = $stmtd->fetch();
     
     $idlivre = $resultsl["idlivre"];
     $idabonne =  $resultsd["idabonne"];
     ######### 

    $sql = "UPDATE emprunte SET idlivre ='$idlivre', datedebut = '$last_name',  datefin = '$email_id',  daterendu = '$contact_no1' , idabonne='$idabonne'   WHERE idemprunte = '$cid'  ";

    try {
      $stmt = $bd->prepare($sql);

      // execute Query
      $stmt->execute();
      $result = $stmt->rowCount();
      if ($result > 0) {
        $_SESSION["errorType"] = "success";
        $_SESSION["errorMsg"] = " emprunte modifiée avec succes.";
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
  header("location:emprunte.php?pagenum=".$_POST['pagenum']);
} elseif ( $mode == "delete" ) {
   $cid = intval($_GET['cid']);
   
   $sql = "DELETE FROM emprunte WHERE idemprunte = '$cid' ";
   try {
     
      $stmt = $bd->prepare($sql);
     
        
       $stmt->execute();  
       $res = $stmt->rowCount();
       if ($res > 0) {
        $_SESSION["errorType"] = "success";
        $_SESSION["errorMsg"] = "Emprunte supprimé avec succés.";
      } else {
        $_SESSION["errorType"] = "info";
        $_SESSION["errorMsg"] = "échec de suppression de emprunte.";
      }
     
   } catch (Exception $ex) {
      $_SESSION["errorType"] = "danger";
      $_SESSION["errorMsg"] = $ex->getMessage();
   }
   
   header("location:emprunte.php?pagenum=".$_GET['pagenum']);
}
?>