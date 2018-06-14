<?php
include "functions.php";
$lang=getlang();
$lim=$_GET["l"];
$offs=$_GET["o"];
$chapt=$_GET["c"];
echo '<div onclick="resetScroll();"><img src="medias/icons8-home-50.png"></div>';
echo '<div onclick="switchChapter(this,0,10,0);"><img src="medias/icons8-europe-50.png"></div>';
$qry="Select * from select_chapters( varchar '".$lang."');";
$rslt=dbselect($qry);
while ($ro = pg_fetch_row($rslt)) {
  if (!is_null($chapt) && $chapt==$ro[0]){
    echo "<div id='chap".$ro[0]."' onmouseover=\"mousePointer(this)\" class='articles_header_selected'><p onclick=\"switchChapter(this,".$ro[0].",".$lim.",".$offs.");\">". $ro[1]."</p></div>";
  }else{
    echo "<div id='chap".$ro[0]."' onmouseover=\"mousePointer(this)\" class='articles_header_other'><p onclick=\"switchChapter(this,".$ro[0].",".$lim.",".$offs.");\">". $ro[1]."</p></div>";
  }
}
?>
