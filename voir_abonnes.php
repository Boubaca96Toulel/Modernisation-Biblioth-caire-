<?php
session_start();
include 'connexion.php';
include './header.php';
try {
   $sql = "SELECT * FROM abonne WHERE 1 AND idabonne = :cid";
   $stmt = $bd->prepare($sql);
   $stmt->bindValue(":cid", intval($_GET["cid"]));
   
   $stmt->execute();
   $results = $stmt->fetchAll();
} catch (Exception $ex) {
  echo $ex->getMessage();
}

?>

<div class="row">
  <ul class="breadcrumb">
      <li><a href="contacts.php">abonnés</a></li>
      <li class="active">Voir Abonnés</li>
    </ul>
</div>

  <div class="row">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Voir Abonnés</h3>
      </div>
      <div class="panel-body">
        <form class="form-horizontal" name="contact_form" id="contact_form" enctype="multipart/form-data" method="post" action="process_form.php">
          <fieldset>
            <div class="form-group">
              <label class="col-lg-4 control-label" for="first_name"><span class="required">*</span>Nom:</label>
              <div class="col-lg-5">
                <input type="text" readonly="" placeholder="Nom" value="<?php if (isset($results[0]["nom"])) {echo $results[0]["nom"];} ?>" id="first_name" class="form-control" name="first_name"><span id="first_name_err" class="error"></span>
              </div>
            </div>
            
            
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="last_name"><span class="required">*</span>Prenom:</label>
              <div class="col-lg-5">
                <input type="text" readonly="" value="<?php if (isset($results[0]["prenom"])) {echo $results[0]["prenom"];} ?>" placeholder="Prenom" id="last_name" class="form-control" name="last_name"><span id="last_name_err" class="error"></span>
              </div>
            </div>
            
             <div class="form-group">
              <label class="col-lg-4 control-label" for="profile_pic">Photo:</label>
              <div class="col-lg-5">
                <?php  if (isset($results[0]["avatar"])) {$pic = ($results[0]["avatar"] <> "" ) ? $results[0]["avatar"] : "no_avatar.png";} else {
                  $pic = ($results[0]["profil_pic"] <> "" ) ? $results[0]["profil_pic"] : "no_avatar.png";
                } ?>
                <a href="profile_pics/<?php echo $pic ?>" target="_blank"><img src="profile_pics/<?php echo $pic ?>" alt="" width="100" height="100" class="thumbnail" ></a>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="email_id"><span class="required">*</span>Nationalité:</label>
              <div class="col-lg-5">
                <input type="text" readonly="" value="<?php if (isset($results[0]["nationnalite"])) {echo $results[0]["nationnalite"];} ?>" placeholder="Nationnalité" id="email_id" class="form-control" name="email_id"><span id="email_id_err" class="error"></span>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="contact_no1"><span class="required">*</span>Date de naissance:</label>
              <div class="col-lg-5">
                <input type="text" readonly="" value="<?php if (isset($results[0]["datenaissance"])) {echo $results[0]["datenaissance"]; }?>" placeholder="Date de naissance" id="contact_no1" class="form-control" name="contact_no1"><span id="contact_no1_err" class="error"></span>
              </div>
            </div>
            
            
            
           
            
    
          </fieldset>
        </form>

      </div>
    </div>
  </div>
<?php
include './footer.php';
?>