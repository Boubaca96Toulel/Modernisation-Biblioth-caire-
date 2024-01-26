<?php

session_start();
include 'connexion.php';
include './header.php';




try {
   
   if(isset($_GET["cid"]))
   {
   $sql = "SELECT * FROM emprunte , livre ,abonne where 1 AND livre.idlivre = emprunte.idlivre  and abonne.idabonne = emprunte.idabonne  AND idemprunte = :cid";
   $sqlb = "SELECT * FROM abonne";
   $sqlc = "SELECT * FROM livre";
  
   $stmt = $bd->prepare($sql);
   $stmt->bindValue(":cid", intval($_GET["cid"]));
   
   $stmt->execute();
   $results = $stmt->fetchAll();

   #################
   $stmtb = $bd->prepare($sqlb);
   $stmtb->execute();
   $resultsb = $stmtb->fetchAll();

    #################
    $stmtc = $bd->prepare($sqlc);
    $stmtc->execute();
    $resultsc = $stmtc->fetchAll();
  }
  else
  {
    $sqlb = "SELECT * FROM abonne";
    $sqlc = "SELECT * FROM livre";
     #################
   $stmtb = $bd->prepare($sqlb);
   $stmtb->execute();
   $resultsb = $stmtb->fetchAll();

    #################
    $stmtc = $bd->prepare($sqlc);
    $stmtc->execute();
    $resultsc = $stmtc->fetchAll();
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
      <li><a href="emprunte.php">Emprunte</a></li>
      <li class="active"><?php echo ($m == "update") ? "Modifier" : "Ajouter"; ?> Empruntes</li>
    </ul>
</div>

  <div class="row">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title"><?php echo ($m == "update") ? "Modifier" : "Ajouter"; ?> Emprunte</h3>
      </div>
      <div class="panel-body">

        <form class="form-horizontal" name="contact_form" id="contact_form" enctype="multipart/form-data" method="post" action="process_form_emprunte.php">
          <input type="hidden" name="mode" value="<?php echo ($m == "update") ? "update_old" : "add_new"; ?>" >
          <input type="hidden" name="old_pic" value="<?php echo $results[0]["images"] ?>" >
          <input type="hidden" name="cid" value="<?php echo intval($results[0]["idemprunte"]); ?>" >
          <input type="hidden" name="pagenum" value="<?php if(isset($_GET["pagenum"])) {echo $_GET["pagenum"];} ?>" >
          <fieldset>
            <div class="form-group">
              <label class="col-lg-4 control-label" for="first_name"><span class="required">*</span>Tittre :</label>
              <div class="col-lg-5">
                
                
                <select name="first_name" id="first_name" class="form-control">
                  <option value="<?php if (isset($results)) {echo $results[0]["tittre"]; }?>" selected><?php if (isset($results)) {echo $results[0]["tittre"]; } else {echo "Selectionez un livre";}?></option>
                  <?php foreach ($resultsc as $res) { ?>
                  <option value="<?php echo $res["tittre"]; ?>" ><?php echo $res["tittre"]; ?></option>
                  <?php } ?>
                </select>

                <span id="first_name_err" class="error"></span>
              </div>
            </div>
            
            
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="last_name"><span class="required">*</span>Date debut:</label>
              <div class="col-lg-5">
                <input type="text" value="<?php if (isset($results)) {echo $results[0]["datedebut"];} ?>" placeholder="Date debut" id="last_name" class="form-control" name="last_name"><span id="last_name_err" class="error"></span>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="email_id"><span class="required">*</span>Date fin:</label>
              <div class="col-lg-5">
                <input type="text" value="<?php if (isset($results)) {echo $results[0]["datefin"];} ?>" placeholder="Date fin" id="email_id" class="form-control" name="email_id"><span id="email_id_err" class="error"></span>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="contact_no1"><span class="required">*</span>Date rendu:</label>
              <div class="col-lg-5">
                <input type="text" value="<?php if (isset($results)) {echo $results[0]["daterendu"];} ?>" placeholder="Date rendu" id="contact_no1" class="form-control" name="contact_no1"><span id="contact_no1_err" class="error"></span>
                <span class="help-block"> </span>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-4 control-label" for="contact_no12"><span class="required">*</span>Abonné:</label>
              <div class="col-lg-5">
                
                
                <select name="contact_no12" id="contact_no1" class="form-control">
                  <option value="<?php if (isset($results)) {echo $results[0]["nom"];} ?>" selected><?php if (isset($results)) {echo $results[0]["nom"];} else {echo "Selectionez un abonné";}?></option>
                  <?php foreach ($resultsb as $res) { ?>
                  <option value="<?php echo $res["nom"]; ?>" ><?php echo $res["nom"]; ?></option>
                  <?php } ?>
                </select>

                <span id="contact_no1_err" class="error"></span>
                <span class="help-block"> </span>
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