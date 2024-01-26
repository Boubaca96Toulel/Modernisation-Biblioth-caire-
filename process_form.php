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
    $sqll = "SELECT idauteur FROM auteur WHERE nom = '$last_name' ";
     ##########
     $stmtl = $bd->prepare($sqll);
     $stmtl->execute();
     $resultsl = $stmtl->fetch();
     
     #########

     $sqld = "SELECT idcategorie FROM categorie WHERE libelle = '$contact_no1' ";
     ##########
     $stmtd = $bd->prepare($sqld);
     $stmtd->execute();
     $resultsd = $stmtd->fetch();
     
     $idauteur = $resultsl["idauteur"];
     $idcategorie =  $resultsd["idcategorie"];
     ######### 
   

    $sql = "INSERT INTO livre (tittre, idauteur, langue, idcategorie ,dateachat ,dateparution , nombrepage , images) VALUES ( '$first_name', '$idauteur',   '$email_id',  '$idcategorie' ,' $dateachat','$dparution', '$nombrepage', '$filename')";
    

    try {
      $stmt = $bd->prepare($sql);
      


    
      // execute Query
      $stmt->execute();

      
      $result = $stmt->rowCount();
      if ($result > 0) {
        $_SESSION["errorType"] = "success";
        $_SESSION["errorMsg"] = "livre ajouté avec succés.";
      } else {
        $_SESSION["errorType"] = "danger";
        $_SESSION["errorMsg"] = "échec d'addition de livre.";
      }
    } catch (Exception $ex) {

      $_SESSION["errorType"] = "danger";
      $_SESSION["errorMsg"] = $ex->getMessage();
    }
  } else {
    $_SESSION["errorType"] = "danger";
    $_SESSION["errorMsg"] = "échec de mise à jour de l'image.";
  }
  header("location:livres.php");
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
    $sqll = "SELECT idauteur FROM auteur WHERE nom = '$last_name' ";
     ##########
     $stmtl = $bd->prepare($sqll);
     $stmtl->execute();
     $resultsl = $stmtl->fetch();
     
     #########

     $sqld = "SELECT idcategorie FROM categorie WHERE libelle = '$contact_no1' ";
     ##########
     $stmtd = $bd->prepare($sqld);
     $stmtd->execute();
     $resultsd = $stmtd->fetch();
     
     $idauteur = $resultsl["idauteur"];
     $idcategorie =  $resultsd["idcategorie"];
     ######### 
    $sql = "UPDATE livre SET tittre = '$first_name',  idauteur = '$idauteur' ,  langue = '$email_id',  idcategorie = '$idcategorie' ,nombrepage='$nombrepage' ,dateparution='$dparution',dateachat='$dateachat', images = '$filename'  WHERE idlivre = '$cid'  ";

    try {
      $stmt = $bd->prepare($sql);

      // execute Query
      $stmt->execute();
      $result = $stmt->rowCount();
      if ($result > 0) {
        $_SESSION["errorType"] = "success";
        $_SESSION["errorMsg"] = "livre modifiée avec succes.";
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
  header("location:livres.php?pagenum=".$_POST['pagenum']);
} elseif ( $mode == "delete" ) {
   $cid = intval($_GET['cid']);
   
   $sql = "DELETE FROM livre WHERE idlivre = '$cid' ";
   try {
     
      $stmt = $bd->prepare($sql);
     
        
       $stmt->execute();  
       $res = $stmt->rowCount();
       if ($res > 0) {
        $_SESSION["errorType"] = "success";
        $_SESSION["errorMsg"] = "livre supprimé avec succés.";
      } else {
        $_SESSION["errorType"] = "info";
        $_SESSION["errorMsg"] = "échec de suppression de livre.";
      }
     
   } catch (Exception $ex) {
      $_SESSION["errorType"] = "danger";
      $_SESSION["errorMsg"] = $ex->getMessage();
   }
   
   header("location:livres.php?pagenum=".$_GET['pagenum']);
}
?>