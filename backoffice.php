<!DOCTYPE html>
<html style="height:100%;">
	<head>
		<meta charset="UTF-8">
		<title>back office</title>
	</head>
  <body>
  <?php
		include 'functions.php';
    $lang=getlang();
  ?>
  	<form action="upload.php" method="post" enctype="multipart/form-data">
			<input type="hidden" name="upload_type" value="article">
      <p> Ajouter un article</p><br>
      Text in English : <textarea rows="4" cols="50" name='news_text_en' ></textarea><br>
      Texte en francais : <textarea rows="4" cols="50" name='news_text_fr'></textarea><br>
      Date : <input type="date" name="news_date"><br>
      Chapitre :
			<select name="chapitre">
	      <?php
					// populate chapitre selection list
	        $qrycol="chapitre_".$lang;
	        $qry="Select ".$qrycol." , chapitre_id, chapitre_order from chapitre order by chapitre_order";
	        $rslt=dbselect($qry);
	        while ($ro = pg_fetch_object($rslt)) {
	          echo "<option value=\"".$ro->chapitre_id."\">". $ro->$qrycol."</option>";
	        }
	      ?>
      </select><br>
			<!-- possibility to add pictures or video so far -->
			medias : <input type="file" id="news_image" name="news_image[]" accept=".jpg, .jpeg, .png, .mp4" multiple><br>
			<input type='hidden' name='MAX_FILE_SIZE' value='500000' />
			<input type="submit" value="Envoyer">
    </form>
    <br><br>
    <form action="upload.php"  method="post">
			<input type="hidden" name="upload_type" value="chapitre">
      <P> Ajouter un chapitre</p><br>
      English : <input type='text' name='chapitre_en'><br>
      Francais : <input type='text' name='chapitre_fr'><br>
			Desktop image (landscape): <input type="file" id="chapitre_image_d" name="chapitre_image_d[]" accept=".jpg, .jpeg, .png"><br>
			Mobile image (portrait): <input type="file" id="chapitre_image_m" name="chapitre_image_m[]" accept=".jpg, .jpeg, .png"><br>
			<input type='hidden' name='MAX_FILE_SIZE' value='500000' />
      <input type="submit" value="Ajouter le chapitre">
    </form>
		<br><p> Mettre a jour un chapitre</p><br>
		<br><p> Ordonner les chapitres</p><br><br>
		<br><p> Mettre a jour un article</p><br>
		<br><p> Supprimer un article</p><br>
		<!-- [TODO] mettre a jour un chapitre, ordonner les chapitres
		     [TODO] Mettre a jour un article, supprimer un article
		-->
  </body>
</html>
