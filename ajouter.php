<?php

session_start();
include 'connexion.php';
include './header.php';


 /****************************                                                           *
 $req=$bd->prepare('SELECT * FROM contacts WHERE id=:id');  
 $req->execute(array('id' => $id));                         
 $resultat=$req->fetch();                                   
 *****************************/

try {
   
   if(isset($_GET["cid"]))
   {
   $sql = "SELECT * FROM livre , auteur ,categorie where 1 and livre.idauteur=auteur.idauteur and livre.idcategorie=categorie.idcategorie  AND idlivre = :cid";
   $sqlau = "SELECT * FROM auteur";
  $sqlca = "SELECT * FROM categorie";

   $stmt = $bd->prepare($sql);
   $stmt->bindValue(":cid", intval($_GET["cid"]));
   
   $stmt->execute();
   $results = $stmt->fetchAll();

  #################
    $stmtau = $bd->prepare($sqlau);
    $stmtau->execute();
    $resultsau = $stmtau->fetchAll();
  
      #################
    $stmtca = $bd->prepare($sqlca);
    $stmtca->execute();
    $resultsca = $stmtca->fetchAll();

  }
  else
  {
    $sqlau = "SELECT * FROM auteur";
    $sqlca = "SELECT * FROM categorie";
     #################
   $stmtau = $bd->prepare($sqlau);
   $stmtau->execute();
   $resultsau = $stmtau->fetchAll();

    #################
    $stmtca = $bd->prepare($sqlca);
    $stmtca->execute();
    $resultsca = $stmtca->fetchAll();
  }
 
} catch (Exception $ex) {
  echo $ex->getMessage();
}
if (!(isset($_GET["m"])))
{
$m ="ajouter";
}
else {
  $m =$_GET["m"];
}

?>

<div class="row">
  <ul class="breadcrumb">
      <li><a href="livres.php">Livres</a></li>
      <li class="active"><?php echo ($m == "update") ? "Modifier" : "Ajouter"; ?> Livres</li>
    </ul>
</div>

  <div class="row">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title"><?php echo ($m == "update") ? "Modifier" : "Ajouter"; ?> Livre</h3>
      </div>
      <div class="panel-body">

        <form class="form-horizontal" name="contact_form" id="contact_form" enctype="multipart/form-data" method="post" action="process_form.php">
          <input type="hidden" name="mode" value="<?php echo ($m == "update") ? "update_old" : "add_new"; ?>" >
          <input type="hidden" name="old_pic" value="<?php echo $results[0]["images"] ?>" >
          <input type="hidden" name="cid" value="<?php echo intval($results[0]["idlivre"]); ?>" >
          <input type="hidden" name="pagenum" value="<?php if(isset($_GET["pagenum"])) {echo $_GET["pagenum"];} ?>" >
          <fieldset>
            <div class="form-group">
              <label class="col-lg-4 control-label" for="first_name"><span class="required">*</span>Titre :</label>
              <div class="col-lg-5">
                <input type="text" value="<?php if (isset($results)) {echo $results[0]["tittre"]; }?>" placeholder="nom" id="first_name" class="form-control" name="first_name"><span id="first_name_err" class="error"></span>
              </div>
            </div>
            
            
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="last_name"><span class="required">*</span>Auteur:</label>
              <div class="col-lg-5">
                
                <select name="last_name" id="last_name" class="form-control">
                  <option value="<?php if (isset($results)) {echo $results[0]["nom"];} ?>" selected><?php if (isset($results)) {echo $results[0]["nom"];} else {echo "Selectionez un auteur";}?></option>
                  <?php foreach ($resultsau as $res) { ?>
                  <option value="<?php echo $res["nom"]; ?>" ><?php echo $res["nom"]; ?></option>
                  <?php } ?>
                </select>
                
                <span id="last_name_err" class="error"></span>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="email_id"><span class="required">*</span>Langue:</label>
              <div class="col-lg-5">
                <input type="text" value="<?php if (isset($results)) {echo $results[0]["langue"];} ?>" placeholder="Langue" id="email_id" class="form-control" name="email_id"><span id="email_id_err" class="error"></span>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="contact_no1"><span class="required">*</span>Categorie:</label>
              <div class="col-lg-5">
                
                <select name="contact_no1" id="contact_no1" class="form-control">
                  <option value="<?php if (isset($results)) {echo $results[0]["libelle"];} ?>" selected><?php if (isset($results)) {echo $results[0]["libelle"];} else {echo "Selectionez un categorie";}?></option>
                  <?php foreach ($resultsca as $res) { ?>
                  <option value="<?php echo $res["libelle"]; ?>" ><?php echo $res["libelle"]; ?></option>
                  <?php } ?>
                </select>

                <span id="contact_no1_err" class="error"></span>
                <span class="help-block"> </span>
              </div>
            </div>

            <div class="form-group">
              <label class="col-lg-4 control-label" for="contact_no1_1"><span class="required">*</span>Date parution:</label>
              <div class="col-lg-5">
                <input type="text" value="<?php if (isset($results)) {echo $results[0]["dateparution"];} ?>" placeholder="date parution" id="contact_no1" class="form-control" name="dparution"><span id="contact_no1_err" class="error"></span>
                <span class="help-block"> </span>
              </div>
            </div>

            <div class="form-group">
              <label class="col-lg-4 control-label" for="contact_no1_2"><span class="required">*</span>Date Achat:</label>
              <div class="col-lg-5">
                <input type="text" value="<?php if (isset($results)) {echo $results[0]["dateachat"];} ?>" placeholder="date Achat" id="contact_no1" class="form-control" name="dateachat"><span id="contact_no1_err" class="error"></span>
                <span class="help-block"> </span>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-4 control-label" for="contact_no1_2"><span class="required">*</span>Nombre des pages:</label>
              <div class="col-lg-5">
                <input type="text" value="<?php if (isset($results)) {echo $results[0]["nombrepage"];} ?>" placeholder="nombre des pages" id="contact_no1" class="form-control" name="nombrepage"><span id="contact_no1_err" class="error"></span>
                <span class="help-block"> </span>
              </div>
            </div>
            
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="profile_pic">Image:</label>
              <div class="col-lg-5">
                <input type="file"  id="profile_pic" class="form-control file" name="profile_pic"><span id="profile_pic_err" class="error"></span>
                <span class="help-block">doit etre une image jpg, jpeg, png, gif, ou bmp seulement.</span>
              </div>
            </div>
            
            <?php if ($m == "update") { ?>
            <div class="form-group">
              <div class="col-lg-1 col-lg-offset-4">
                <?php $pic = ($results[0]["images"] <> "" ) ? $results[0]["images"] : "noavatar.png" ?>
                <a href="profile_pics/<?php echo $pic ?>" target="_blank"><img src="profile_pics/<?php echo $pic ?>" alt="" width="100" height="100" class="thumbnail" ></a>
              </div>
            </div>
            <?php 
            }
            ?>
            
            
          
            
            <div class="form-group">
              <div class="col-lg-5 col-lg-offset-4">
                <button class="btn btn-primary" type="submit">Soumettre</button> 
              </div>
            </div>
          </fieldset>
        </form>

      </div>
    </div>
  </div>

<script type="text/javascript">
$(document).ready(function() {
	
	// the fade out effect on hover
	$('.error').hover(function() {
		$(this).fadeOut(200);  
	});
	
	
	$("#contact_form").submit(function() {
		$('.error').fadeOut(200);  
		if(!validateForm()) {
            // go to the top of form first
            $(window).scrollTop($("#contact_form").offset().top);
			return false;
		}     
		return true;
    });

});

function validateForm() {
	 var errCnt = 0;
	 
	 var first_name = $.trim( $("#first_name").val());
     var last_name = $.trim( $("#last_name").val());
	 var email_id = $.trim( $("#email_id").val());
	 var contact_no1 = $.trim( $("#contact_no1").val());
	 var contact_no2 = $.trim( $("#contact_no2").val());
     
	 var profile_pic =  $.trim( $("#profile_pic").val());

	// validate name
	if (first_name == "" ) {
		$("#first_name_err").html("Entrez le titre.");
		$('#first_name_err').fadeIn("fast"); 
		errCnt++;
	}  else if (first_name.length < 2 ) {
		$("#first_name_err").html("Entrer au moins 2 lettre.");
		$('#first_name_err').fadeIn("fast"); 
		errCnt++;
	}
    
    if (last_name == "" ) {
		$("#last_name_err").html("remplicez ce champ.");
		$('#last_name_err').fadeIn("fast"); 
		errCnt++;
	} /* else if (last_name.length < 2 ) {
		$("#last_name_err").html("Entrez au moins 2 lettre.");
		$('#last_name_err').fadeIn("fast"); 
		errCnt++;
	}
    
    <!-- if (!isValidEmail(email_id)) {
		$("#email_id_err").html("Entrez un email valide.");
		$('#email_id_err').fadeIn("fast"); 
		errCnt++;
	} --> */
    
    if (contact_no1 == "" ) {
		$("#contact_no1_err").html("veuillez remplir ce champ.");
		$('#contact_no1_err').fadeIn("fast"); 
		errCnt++;
	} /* else if (contact_no1.length < 8 || contact_no1.length > 12 ) {
		$("#contact_no1_err").html("Entrez au moins 8 chiifre et au plus 11 chiffre.");
		$('#contact_no1_err').fadeIn("fast"); 
		errCnt++;
	} else if ( !$.isNumeric(contact_no1) ) {
		$("#contact_no1_err").html("ce champs doit etre des chiffre .");
		$('#contact_no1_err').fadeIn("fast"); 
		errCnt++;
	}
    
    if (contact_no2.length > 0) {
      if (contact_no2.length <= 9 || contact_no2.length > 10 ) {
		$("#contact_no2_err").html("Enter 10 digits only.");
		$('#contact_no2_err').fadeIn("fast"); 
		errCnt++;
	} else if ( !$.isNumeric(contact_no2) ) {
		$("#contact_no2_err").html("Must be digits only.");
		$('#contact_no2_err').fadeIn("fast"); 
		errCnt++;
	}
    }*/
    if (email_id == "" ) {
		$("#email_id_err").html("veuillez remplir ce champ.");
		$('#email_id_err').fadeIn("fast"); 
		errCnt++;
	}
    

    
    if (profile_pic.length > 0) {
        var exts = ['jpg','jpeg','png','gif', 'bmp'];
		var get_ext = profile_pic.split('.');
		get_ext = get_ext.reverse();
        
       
        if ($.inArray ( get_ext[0].toLowerCase(), exts ) <= -1 ){
          $("#profile_pic_err").html("doit etre une image jpg, jpeg, png, gif, bmp .. uniquement");
          $('#profile_pic_err').fadeIn("fast"); 
        }
       
    }
    
	if(errCnt > 0) return false; else return true;
}

function isValidEmail(email) {
  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}
</script>
<?php
include './footer.php';
?>