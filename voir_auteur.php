<?php
session_start();
include 'connexion.php';
include './header.php';
try {
   $sql = "SELECT * FROM auteur WHERE 1 AND idauteur = :cid";
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
      <li><a href="livres.php">Nos livres</a></li>
      <li class="active">Voir Auteur</li>
    </ul>
</div>

  <div class="row">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Voir Auteur</h3>
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
                <input type="text" readonly="" value="<?php if (isset($results[0]["prenom"])) {echo $results[0]["prenom"];} ?>" placeholder="Last Name" id="last_name" class="form-control" name="last_name"><span id="last_name_err" class="error"></span>
              </div>
            </div>
            
             <div class="form-group">
              
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="last_name"><span class="required">*</span>Nationnalité:</label>
              <div class="col-lg-5">
                <input type="text" readonly="" value="<?php if (isset($results[0]["nationnalite"])) {echo $results[0]["nationnalite"];} ?>" placeholder="nationalite" id="last_name" class="form-control" name="last_name"><span id="last_name_err" class="error"></span>
              </div>
            </div>

            <div class="form-group">
              <label class="col-lg-4 control-label" for="last_name"><span class="required">*</span>Date de naissance:</label>
              <div class="col-lg-5">
                <input type="text" readonly="" value="<?php if (isset($results[0]["datenaissance"])) {echo $results[0]["datenaissance"];} ?>" placeholder="date de naissance" id="last_name" class="form-control" name="last_name"><span id="last_name_err" class="error"></span>
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