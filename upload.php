<?php
include 'functions.php';
$upload_type=$_POST["upload_type"];
switch ($upload_type){
  case 'article':
    // get form data
    $news_text_en=$_POST["news_text_en"];
    $news_text_fr=$_POST["news_text_fr"];
    if(empty($_POST["news_date"])){
      $news_date="null";
    }else{
      $news_date=$_POST['news_date'];
      $news_date="timestamp '".$news_date."'";
    }
    $chapitre=$_POST["chapitre"];
    // Insert in the news table
    $qry="SELECT add_news(".$news_date.",varchar '".$news_text_fr."',varchar '".$news_text_en."',".$chapitre.")";
    dbselect($qry);
    // files handling
    $news_image=$_FILES["news_image"];
    // get the number of images
    $total_image = count($news_image['name']);
    if($total_image>0){
      $uploaddir = 'medias/';
      for($i=0; $i<$total_image; $i++) {
        //Get the temp file path
        $tmpFilePath = $news_image['tmp_name'][$i];
        //Make sure we have a filepath
        $no_file=file_exists("medias/".$news_image["name"][$i]);
        if ($tmpFilePath != ""){
          //Setup our new file path
          $newFilePath = basename($news_image['name'][$i]);
          $newFilePath = "medias/news/".$newFilePath;
          $moved=move_uploaded_file($tmpFilePath, $newFilePath);
          //Upload the file into the temp dir
          if($moved) {
            // upload OK --> create thumb
            if ($news_image['type'][$i]!="video/mp4"){
              // if not a video --> is a picture
              $thbName="medias/thumbs/thb_".$news_image["name"][$i];
              make_thumb($newFilePath, $thbName, 150);
              // upload OK --> insert info in data base
            }
            echo $news_image['type'][$i];
            $qry="SELECT add_media(varchar '".$news_image['name'][$i]."',varchar '".$news_image['type'][$i]."')";
            dbselect($qry);
            echo 'Article created and '.$i.'file(s) uploaded</br>';
          }
        }
      }
    }else{
        // if no image inserted, display :
        echo 'Article created, no file uploaded';
    }
    break;
  case 'chapitre':
    $chapitre_en=$_POST["chapitre_en"];
    $chapitre_fr=$_POST["chapitre_fr"];
    $qry="SELECT add_chapter(varchar '".$chapitre_fr."',varchar '".$chapitre_en."')";
    dbselect($qry);
    $chapitre_image_d=$_FILES["chapitre_image_d"];
    $chapitre_image_m=$_FILES["chapitre_image_m"];
    $uploaddir = 'medias/';
    //Get the temp file path
    $tmpFilePath = $chapitre_image_m['tmp_name'][0];
    //Make sure we have a filepath
    $no_file=file_exists("medias/".$chapitre_image_m["name"][0]);
    if ($tmpFilePath != ""){
      //Setup our new file path
      $newFilePath = basename($chapitre_image_m['name'][0]);
      $newFilePath = "medias/".$newFilePath;
      $moved=move_uploaded_file($tmpFilePath, $newFilePath);
      //Upload the file into the temp dir
      if($moved) {
        echo 'mobile background uploaded</br>';
      }
    }
    //Get the temp file path
    $tmpFilePath = $chapitre_image_d['tmp_name'][0];
    //Make sure we have a filepath
    $no_file=file_exists("medias/".$chapitre_image_d["name"][0]);
    if ($tmpFilePath != ""){
      //Setup our new file path
      $newFilePath = basename($chapitre_image_d['name'][0]);
      $newFilePath = "medias/".$newFilePath;
      $moved=move_uploaded_file($tmpFilePath, $newFilePath);
      //Upload the file into the temp dir
      if($moved) {
        echo 'desktop background uploaded</br>';
      }
    }
    echo 'Chapter added';
    break;
  default:
    break;
}
?>
