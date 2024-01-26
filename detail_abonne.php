
<?php
include 'connexion.php';
include './header.php';
/*try {
   $sql = "SELECT * FROM abonne WHERE 1 AND idabonne = :cid";
   $stmt = $bd->prepare($sql);
   $stmt->bindValue(":cid", intval($_GET["cid"]));
   
   $stmt->execute();
   $results = $stmt->fetchAll();
} catch (Exception $ex) {
  echo $ex->getMessage();
} */

$sql = "SELECT * FROM abonne  ORDER BY nom ";
$stmt = $bd->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll();
?>

 
 <head>
	 <link rel="stylesheet" href="mystyle/css/bootstrap.min.css">
 </head>
 
 
 <style>
	 a {
  
    text-decoration: none;
}

h5 {
    font-size: 3rem;
}
body{
	font-size:14px;
}

.btn-group-sm>.btn, .btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 1.875rem;
    border-radius: 0.2rem;
}
P{
	font-size:2rem;
}
b, strong {
    font-weight: bolder;
	font-size: 2rem
}

.h1, h1 {
    font-size: calc(3rem + 1.5vw);
}

.btn-primary {
    color: #fff;
    background-color: #0d6efd;
    border-color: #0d6efd;
	font-size:1.8rem;
}
 </style>



<?php
	$reponse = $bd->query('SELECT * FROM abonne where idabonne ='. $_GET['cid']);

    $donnees = $reponse->fetch();
        
     

?>

<body>
	<br>
	<br>
	
		
<div class="row">
	<div class="col-md">
		<div class="card card-body">
			<h5>Abonné : <?php echo $donnees['nom'];?></h5>
			<hr>
			<a class="btn btn-outline-info  btn-sm btn-block " href="ajouter_abonnes.php?m=update&cid=<?php echo $_GET['cid']; ?>">Modifier abonné</a>
			<a class="btn btn-outline-danger  btn-sm btn-block " href="process_form_abonne.php?mode=delete&cid=<?php echo $_GET['cid']; ?>" onclick="return confirm('Etes-vous sur de vouloir supprimer ?')">Supprimer abonné</a>

		</div>
	</div>

	<div class="col-md">
		<div class="card card-body">
			<h5>Informations</h5>
			<hr>
			<p>Nationalité : <b><?php echo $donnees['nationnalite'];?></b> </p>
			
			<p>Date naissance: <b><?php echo $donnees['datenaissance'];?></b></p>
		</div>
	</div>

	<?php
$total = $bd->query('SELECT count(idemprunte) as compte FROM emprunte  where idabonne='. $_GET['cid']);
$tot= $total->fetch();

?>

	<div class="col-md">
		<div class="card card-body">
			<h5>Total des Empruntes </h5>
			<hr>

			<h1 style="text-align: center;padding: 10px"><?php echo $tot['compte'];?></h1>
		</div>
	</div>
</div>


<br>
<div class="row">
	<div class="col">
		<div class="card card-body">
			<form method="get">

		    <p class="btn btn-primary" type="">Les empruntes realisés</p>
		  </form>
		</div>
	</div>

</div>
<br>

<?php
$reponse3 = $bd->query('SELECT * FROM livre , emprunte where   livre.idlivre=emprunte.idlivre  and emprunte.idabonne='. $_GET['cid']);

?>

<div class="row">
	<div class="col-md">
		<div class="card card-body">
			<table class="table table-sm">
				<tr>
					<th>Livre</th>
					<th>Date debut</th>
					<th>Date rendu</th>
					<th>Date fin</th>
					
				</tr>
		<?php		
		while ($donnees3 = $reponse3->fetch())
        {
        ?>
                <tr>
					<td><?php echo $donnees3['tittre']; ?></td>
					<td><?php echo $donnees3['datedebut'];?></td>
					<td><?php echo $donnees3['datefin']; ?> </td>
                    <td><?php echo $donnees3['daterendu']; ?></td>
				

				</tr>
        <?php
        }
        $reponse->closeCursor(); 

        ?>

			</table>
		</div>
	</div>
</div>

</body>


<?php
include './footer.php';
?>