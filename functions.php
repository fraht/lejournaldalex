<?php
$lang='en'; // english by default
function getlang(){
  // define if the website language is English or French
  $lang=substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2);
  // get the browser language
  // if the browser language is not french it is set to English
  if($lang!='fr'){$lang='en';}
  return $lang;
}
// articles
function countChapArticles($c){
  $lang=getlang();
  $total_news=0;
  $qry="Select * from count_chapter_news(".$c.", varchar '".$lang."');";
  $rslt=dbselect($qry);
    while ($ro = pg_fetch_object($rslt)) {
      $total_news=$ro->total_news;
    }
    return $total_news;
}
function loadChaptArticles($c,$lim,$offs){
  $lang=getlang();
  if ($c==null || $c==0){
    $qry="Select * from select_some_news(varchar '".$lang."',".$lim.",".$offs.");";
  }else{
    $qry="Select * from select_some_chapter_news(".$c.", varchar '".$lang."',".$lim.",".$offs.");";
  }
  $rslt=dbselect($qry);
  $ending=0;
  $JSONresponse="";
  while ($ro = pg_fetch_object($rslt)) {
    // date and chapter
    $JSONresponse.="<div class='article'><div class='article_title'>";
    $JSONresponse.=$ro->chapitre." - ".$ro->news_date;
    $JSONresponse.="</div><br>";
    // medias (pictures) if available
    $med_qry="Select * from select_medias(".$ro->news_id.");";
    $med_rslt=dbselect($med_qry);
    $nr=pg_num_rows($med_rslt);
    if($nr==1){
      while ($row = pg_fetch_object($med_rslt)) {
        switch($row->media_type){
          case 'image/jpeg':
            $JSONresponse.="<div class='article_main_image'><img src='medias/news/".$row->media_source."'></div>";
          break;
          case 'video/mp4':
            $JSONresponse.="<div class='article_main_image'><video controls><source src='medias/news/".$row->media_source."' type='video/mp4'>Your browser does not support the video tag.</video></div>";
          break;
        }
      }
    }elseif($nr==0){
      // do nothing
    }else{
      // more than one picture, append pictures on the side
      $r=1;
      while ($row = pg_fetch_object($med_rslt)) {
        if($r==1){
          switch($row->media_type){
            case 'image/jpeg':
              $JSONresponse.="<div class='article_main_image'><img src='medias/news/".$row->media_source."'></div>";
              $JSONresponse.="<div class='article_side_image'>";
            break;
            case 'video/mp4':
              $JSONresponse.="<div class='article_main_image'><video controls><source src='medias/news/".$row->media_source."' type='video/mp4'>Your browser does not support the video tag.</video></div>";
              $JSONresponse.="<div class='article_side_image'>";
            break;
          }
        }else{
          switch($row->media_type){
            case 'image/jpeg':
              $JSONresponse.="<img onclick='enlargeSidePicture(this)' src='medias/thumbs/thb_".$row->media_source."'/>";
            break;
            case 'video/mp4':
            $JSONresponse.="<video onclick='enlargeSidePicture(this)'><source src='medias/news/".$row->media_source."' type='video/mp4'>Your browser does not support the video tag.</video>";
            break;
          }
        }
        $r++;
      }
      $JSONresponse.='</div>';
    }
    // texte de l'article
    $JSONresponse.="<div class='article_text'>";
    $t=$ro->news_text;
    if(str_word_count($t,0)>70){
      $w= str_word_count($t,1);
      $zz= array_keys(str_word_count($t,2),$w[70]);
      foreach ($zz as &$value) {
        $v= $value.".";
        if($v>300){break;}
      }
      if($lang='en'){$rm='read more';}else{$rm='lire plus';}
      $JSONresponse.=substr($t,0,$v-1)."...<span onclick='showart(this)'' onmouseover='mousePointer(this)'>".$rm."</span>";
      $JSONresponse.="</div><div class='hidden_article'>".$t;
    }else{
      $JSONresponse.=$t;
    }
    $JSONresponse.='</div></div><br>';
    $ending++;
  }
  if( $GLOBALS['ift']){
    echo $JSONresponse;
    $ift=false;
  }else{
    $arrayJSON=array('HTMLresponse'=>$JSONresponse,'endingValue'=>$ending);
    echo json_encode($arrayJSON);
  }
}
// database functions
function dbselect($qry){
  // select query to the database
  $conn_string = "host=localhost port=5432 dbname=alalpg user=alaluser password=alalpgpass02";
  $dbconn = pg_connect($conn_string);
  // connect to the database
  $rslt=pg_query($dbconn, $qry);
  // query
  pg_close($dbconn);
  // close connection
  return $rslt;
}
function make_thumb($src, $dest, $desired_width) {
  $info = getimagesize($src);
  // get extension
  $a=strrpos($src,".");
  $b=strlen($src)-$a;
  $ext=strtolower(substr($src,$a+1,$b));
	// read the source image
  if ($ext=="png"){
    $source_image = imagecreatefrompng($src);
  }else{
	  $source_image = imagecreatefromjpeg($src);
  }
	$width = imagesx($source_image);
	$height = imagesy($source_image);
	/* find the "desired height" of this thumbnail, relative to the desired width  */
	$desired_height = floor($height * ($desired_width / $width));
	/* create a new, "virtual" image */
	$virtual_image = imagecreatetruecolor($desired_width, $desired_height);
	/* copy source image at a resized size */
	imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
	/* create the physical thumbnail image to its destination */
	imagejpeg($virtual_image, $dest);
}
?>
