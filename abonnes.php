<?php
session_start();

include 'connexion.php';
include './header.php';



/*******PAGINATION CODE STARTS*****************/
 
if (!(isset($_GET['pagenum']))) {
  $pagenum = 1;
} else {
  $pagenum = $_GET['pagenum'];
}

$page_limit =  8;


try {
  if (isset($_GET["keyword"]))
  {
  $keyword = trim($_GET["keyword"]);

  if ($keyword <> "" ) {
  
    $sql = "SELECT * FROM abonne WHERE  nom LIKE :keyword ORDER BY nom ";
    $stmt = $bd->prepare($sql);
    
    $stmt->bindValue(":keyword", $keyword."%");
    
    
    
  } else {
    header('location:abonnes.php');
  }
  
 } else {
    $sql = "SELECT * FROM abonne  ORDER BY nom ";


    $stmt = $bd->prepare($sql);

    
  }
  

  $stmt->execute();
  
  $total_count = count($stmt->fetchAll());
  
 

  $last = ceil($total_count / $page_limit);

  if ($pagenum < 1) {
    $pagenum = 1;
  } elseif ($pagenum > $last) {
    $pagenum = $last;
  }

  $lower_limit = ($pagenum - 1) * $page_limit;
  $lower_limit = ($lower_limit < 0) ? 0 : $lower_limit;


  $sql2 = $sql . " limit " . ($lower_limit) . " ,  " . ($page_limit) . " ";
  
  $stmt = $bd->prepare($sql2);
  
  if (isset($_GET["keyword"]))
  {
    $keyword =$_GET["keyword"] ;
  if ($keyword <> "" ) {
    $stmt->bindValue(":keyword", $keyword."%");
   }
   
  }

  $stmt->execute();
  $results = $stmt->fetchAll();
} catch (Exception $ex) {
  echo $ex->getMessage();
}

/*******PAGINATION CODE ENDS*****************/
?>
<div class="row">
<?php
if (isset($ERROR_MSG)&&isset($ERROR_TYPE))
 {
 if ($ERROR_MSG <> "") { ?>
    <div class="alert alert-dismissable alert-<?php echo $ERROR_TYPE ?>">
      <button data-dismiss="alert" class="close" type="button">×</button>
      <p><?php echo $ERROR_MSG; ?></p>
    </div>
<?php } } ?>
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">Les Abonnés</h3>
    </div>
    <div class="panel-body">

      <div class="col-lg-12" style="padding-left: 0; padding-right: 0;" >
        <form action="abonnes.php" method="get" >
        <div class="col-lg-6 pull-left"style="padding-left: 0;"  >
          <span class="pull-left">  
            <label class="col-lg-12 control-label" for="keyword" style="padding-right: 0;">
              <input type="text" value="" placeholder="Rechercher par nom" id="" class="form-control" name="keyword" style="height: 41px;">
            </label>
            </span>
          <button class="btn btn-info" style=" border-radius:0px 10px 10px 0px;">Recherche</button>
        </div>
        </form>
        <div class="pull-right" ><a href="ajouter_abonnes.php"><button class="btn btn-success"  style=" border-radius:10px 10px 10px 10px;"><span class="glyphicon glyphicon-user"></span> Ajouter </button></a></div>
      </div>

      <div class="clearfix"></div>
<?php if (count($results) > 0) { ?>
        <div class="table-responsive">
          <table class="table table-striped table-hover table-bordered ">
            <tbody><tr>
                <th>Avatar</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Date de naissance</th>
                <th>Nationnalité</th>
                
                
                <th>Action </th>

              </tr>
  <?php foreach ($results as $res) { ?>
                <tr>
                  <td style="text-align: center;">
                <?php $pic = ($res["avatar"] <> "" ) ? $res["avatar"] : "no_avatar.png" ?>
                    <a href="profile_pics/<?php echo $pic ?>" target="_blank"><img src="profile_pics/<?php echo $pic ?>" alt="" width="50" height="50" style="" ></a>
                  </td>
                  <td><?php echo $res["nom"]; ?></td>
                  <td><?php echo $res["prenom"]; ?></td>
                  <td><?php echo $res["datenaissance"]; ?></td>
                  <td><?php echo $res["nationnalite"]; ?></td>
                  
                  <td>
                    <a href="detail_abonne.php?cid=<?php echo $res["idabonne"]; ?>"><button class="btn btn-sm btn-info"><span class="glyphicon glyphicon-zoom-in"></span> Voir</button></a>&nbsp;
                    <a href="ajouter_abonnes.php?m=update&cid=<?php echo $res["idabonne"]; ?>&pagenum=<?php echo $pagenum; ?>"><button class="btn btn-sm btn-warning" style=" border-radius:8px 8px 8px 8px;"><span class="glyphicon glyphicon-edit"></span> Modifier</button></a>&nbsp;
                    <a href="process_form_abonne.php?mode=delete&cid=<?php echo $res["idabonne"]; ?>&keyword=<?php if (isset($_GET["keyword"])) {echo $_GET["keyword"];} ?>&pagenum=<?php if (isset($_GET["pagenum"])){ echo $_GET["pagenum"];} ?>" onclick="return confirm('Etes-vous sur de vouloir supprimer ?')"><button class="btn btn-sm btn-danger" style=" border-radius:8px 8px 8px 8px;"><span class="glyphicon glyphicon-remove-circle"></span> Supprimer</button></a>&nbsp;
                  </td>
                </tr>
  <?php } ?>
            </tbody></table>
        </div>
        <div class="col-lg-12 center">
          <ul class="pagination pagination-sm">
  <?php
  //Show page links

  $last = ceil($total_count / $page_limit);
  for ($i = 1; $i <= $last; $i++) {
    if ($i == $pagenum) {
      ?>
                <li class="active"><a href="javascript:void(0);" ><?php echo $i ?></a></li>
                <?php
              } else {
                
                 if (isset($_GET["keyword"]))
                 {
                 ?>
                <li><a href="abonnes.php?pagenum=<?php echo $i; ?>&keyword=<?php echo $_GET["keyword"]; ?>&id=<?php echo $identifiant; ?>" class="links"  onclick="displayRecords('<?php echo $page_limit; ?>', '<?php echo $i; ?>');" ><?php echo $i ?></a></li>
                <?php
                }
                 else
                 {
                 ?>
                  <li><a href="abonnes.php?pagenum=<?php echo $i; ?>" class="links"  onclick="displayRecords('<?php echo $page_limit; ?>', '<?php echo $i; ?>');" ><?php echo $i ?></a></li>
            <?php
                 }
              }
            }
            ?>
          </ul>
        </div>

          <?php } else { ?>
        <div class="well well-lg">Aucun abonné trouvé</div>
<?php } ?>
    </div>
  </div>
</div>
<span style="font-size:16px; border:solid 2px #4a4576; border-radius:5px;">nombre d'abonnés : <?php echo $total_count; ?></span>
      <?php
      include './footer.php';
    
      ?>