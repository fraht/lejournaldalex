<!DOCTYPE html>
<html style="height:100%;">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css" />
		<link rel="stylesheet" href="style_map.css" />
		<link rel="icon" type="image/png" href="medias/favicon.png">
		<title>L'est</title>
	</head>
	<script>
	// function to check if the device is a mobile or a laptop
	window.mobilecheck = function() {
		var check = false;
		(function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
		return check;
	}
	if(window.mobilecheck()){
		var deviceType='mobile';
	}else{
		var deviceType='desktop';
	}
	// testing purpose [TODELETE]:
	</script>
	<body style="height:100%;" onmousemove="moveThatBox(event);" onload="resetScroll();" onresize="resizeTheseBoxes(event);"onscroll="testScroll();">
		<?php
			include 'functions.php';
			$lang=getlang();
		?>
		<div  id="slide1"></div>
		<div  id="slide2">
		<!-- menu des chapitres qui va chercher les chapitres crees dans la table chapitre -->
			<nav id="menu-bar-wrapper">
				<ul class="menu">
          <!-- format : <li><a href=".....html" title="......">.....</a></li> -->
          <?php
						$qry="Select * from select_chapters( varchar '".$lang."');";
						$rslt=dbselect($qry);
						while ($ro = pg_fetch_row($rslt)) {
							echo "<li><span c-id='".$ro[0]."' onclick='articles_country(this);'>".$ro[1]."</span></li>";
						}
          ?>
        </ul>
      </nav>
		</div>
		<?php
		//[TODO:] add database call to get c-id and make it at the same time
			$taiwanN=countChapArticles(1);
			$vietnamN=countChapArticles(2);
			$cambodiaN=countChapArticles(3);
			$philippinesN=countChapArticles(4);
			$thailandN=countChapArticles(5);
			$newZealandNorthN=countChapArticles(6);
			$newZealandSouthN=countChapArticles(7);
			$usaN=countChapArticles(8);
			$indonesiaN=countChapArticles(9);
		?>
		<div   id="slide3">
		<!-- div3 : map -->
			<div c-id="1" id="taiwan" onmouseleave="countryLeaving(this);" onmouseenter="countryHoving(event);"<?PHP if($taiwanN>0){echo ' onclick="articles_country(this);"';}?> class="svg_country"></div>
			<div c-id="2"id="vietnam" onmouseleave="countryLeaving(this);" onmouseenter="countryHoving(event);"  <?PHP if($vietnamN>0){echo 'onclick="articles_country(this);"';}?> class="svg_country"></div>
			<div c-id="3" id="cambodia" onmouseleave="countryLeaving(this);" onmouseenter="countryHoving(event);"<?PHP if($cambodiaN>0){echo 'onclick="articles_country(this);"';}?>   class="svg_country"></div>
			<div c-id="4" id="palawan" onmouseleave="countryLeaving(this);" onmouseenter="countryHoving(event);" <?PHP if($philippinesN>0){echo 'onclick="articles_country(this);"';}?> class="svg_country"></div>
			<div c-id="4" id="mindoro" onmouseleave="countryLeaving(this);" onmouseenter="countryHoving(event);" <?PHP if($philippinesN>0){echo 'onclick="articles_country(this);"';}?> class="svg_country"></div>
			<div c-id="4" id="luzon" onmouseleave="countryLeaving(this);" onmouseenter="countryHoving(event);" <?PHP if($philippinesN>0){echo 'onclick="articles_country(this);"';}?> class="svg_country"></div>
			<div c-id="5" id="thailand" onmouseleave="countryLeaving(this);" onmouseenter="countryHoving(event);" <?PHP if($thailandN>0){echo 'onclick="articles_country(this);"';}?>class="svg_country"></div>
			<div c-id="6" id="new_zealand_north" onmouseleave="countryLeaving(this);" onmouseenter="countryHoving(event);"<?PHP if($newZealandNorthN>0){echo 'onclick="articles_country(this);"';}?>  class="svg_country"></div>
			<div c-id="7" id="new_zealand_south" onmouseleave="countryLeaving(this);" onmouseenter="countryHoving(event);" <?PHP if($newZealandSouthN>0){echo 'onclick="articles_country(this);"';}?> class="svg_country"></div>
			<div c-id="8" id="usa" onmouseleave="countryLeaving(this);" onmouseenter="countryHoving(event);" <?PHP if($usaN>0){echo 'onclick="articles_country(this);"';}?> class="svg_country"></div>
			<div c-id="9" id="java" onmouseleave="countryLeaving(this);" onmouseenter="countryHoving(event);" <?PHP if($indonesiaN>0){echo 'onclick="articles_country(this);"';}?>  class="svg_country"></div>
			<div c-id="9"  id="bali" onmouseleave="countryLeaving(this);" onmouseenter="countryHoving(event);" <?PHP if($indonesiaN>0){echo 'onclick="articles_country(this);"';}?> class="svg_country"></div>
		</div>
		<!-- la div combleur permet de pouvoir scroller -->
		<div   id="slide4" onscroll="wScroll(event);">
			<div id="background_image"></div><div id='article_bandeau_header'></div>
		</div>
		<div id="combleur"></div>
    <script>
			var articlesLoad=false;
			var inCountry=false;
			var currentPage=1;
			var lazyloading=false;
			if(window.mobilecheck()){
				var slide1=document.getElementById('slide1');
				var slide2=document.getElementById('slide2');
				slide1.style.backgroundImage='url("medias/fond_index_mobile.JPG")';
				slide2.style.backgroundImage='url("medias/fond_train_mobile.jpg")';
				document.getElementById('slide3').remove();
			}else{
				var slide1=document.getElementById('slide1');
				var slide2=document.getElementById('slide2');
				slide1.style.backgroundImage='url("medias/fond_index_desktop.JPG")';
				slide2.style.backgroundImage='url("medias/fond_train_desktop.jpg")';
			}
			function defilMenuMobile(){
				// display article header menu on mobile device
				var ah=document.getElementsByClassName('articles_header')[0];
				ah.style.display="inline-block";
				ah.style.zIndex="10";
				ah.style.borderRadius="12px";
				ah.style.marginTop="1vw";
				ah.style.backgroundColor="#c7daea";
				ah.style.marginLeft="1vw";
				document.getElementById('article_wrapper').setAttribute('onclick','refilMenu()');
			}
			function defilMenuDesktop(bougeId){
				var mdd=document.getElementsByClassName('menuDefillDesktop');
				if(mdd.length>0){
					while(document.getElementsByClassName("menuDefillDesktop").length>0){
						document.getElementsByClassName("menuDefillDesktop")[0].style.top="";
						document.getElementsByClassName("menuDefillDesktop")[0].style.display="none";
						document.getElementsByClassName("menuDefillDesktop")[0].classList.remove('menuDefillDesktop');
					}
				}else{
					var allheader=document.querySelectorAll("div.articles_header_other, div.articles_header_selected");
					var multiplier=1;
					for (var hi=0;hi<allheader.length;hi++){
						if(allheader[hi].id.substr(4,allheader[hi].id.length-4)>=bougeId){
							allheader[hi].classList.add('menuDefillDesktop');
							allheader[hi].style.display=null;
							allheader[hi].style.top=(multiplier*100)+"%";
							multiplier++;
						}
					}
				}
			}
			function refilMenu(){
				// hide article header menu on mobile device
				var ah=document.getElementsByClassName('articles_header')[0];
				ah.style="display:none";
				document.getElementById('article_wrapper').removeAttribute('onclick');
			}
			function moveThatBox(event){
				// move the div containing the name of the country on the map
				if(inCountry){
					var x = event.clientX;
					var b=document.getElementById("countryNameBox");
					var bw=b.offsetWidth;
					var tooClose=window.innerWidth-(x+bw);
					if(tooClose<0){
						x=x-bw-20
					}else{
						x=x+20;
					}
					var y = event.clientY;
					y=y+20;
					b.style.top=y+"px";
					b.style.left=x+"px";
				}
			}
			function keepRatio(ratio,el){
				var y=window.innerHeight;
				var x=window.innerWidth;
				var rat=y/x;
				if(rat<ratio){
					// hauteur reduite
					// on veut mettre de la margin a droite et a gauche
					var newX=y/ratio;
					if(newX>x){
						var dia=(x/newX)*100;
					}else{
						var dia=(newX/x)*100;
					}
					var diff2=(100-dia)/2;
					el.style.minWidth=dia+'%';
					el.style.maxWidth=dia+'%';
					el.style.marginRight=diff2+'%';
					el.style.marginLeft=diff2+'%';
					el.style.marginTop='0';
					el.style.marginBottom='0';
					el.style.minHeight='100%';
					el.style.maxHeight='100%';
				}else if(rat>ratio){
					// largeur reduite
					// on veut mettre de la margin en haut et en bas
					var newY=x*ratio;
					if(newY>y){
						var dia=(y/newY)*100;
					}else{
						var dia=(newY/y)*100;
					}
					var diff2=(100-dia)/2;
					el.style.minHeight=dia+'%';
					el.style.maxHeight=dia+'%';
					el.style.marginTop=diff2+'%';
					el.style.marginBottom=diff2+'%';
					el.style.marginRight='0';
					el.style.marginLeft='0';
					el.style.minWidth='100%';
					el.style.maxWIdth='100%';
				}
			}
			function resizeTheseBoxes(event){
				console.log('resizing');
				// [TODO] : a ejouter eviter de scroll lorsquon resize
				// resize map
				// ratio a garder : 311/683 (0.455344070278)
				if (currentPage==3){
					keepRatio(0.455344070278,document.getElementById('slide3'));
				}else if(currentPage==4){
					// check articles header menu
					/* [TODO] : check if already menu deroulant
					 --> no mais not needed
					 --> no mais a creer
					*/
					if(document.getElementById('articles_header_menu_icon')!=undefined){
						// reinitialize
						document.getElementById('articles_header_menu_icon').remove();
						var mdd=document.querySelectorAll("div.articles_header_other, div.articles_header_selected");
						if (mdd.length>0){
							for (var mddi=0;mddi<mdd.length;mddi++){
								if(mdd[mddi].style.display=="none"){
									mdd[mddi].style.display="";
								}
								if(mdd[mddi].style.top!=undefined){mdd[mddi].style.top="";}
							}
						}
						//var mdd=document.getElementsByClassName("menuDefillDesktop");
						while(document.getElementsByClassName("menuDefillDesktop").length>0){
							document.getElementsByClassName("menuDefillDesktop")[0].classList.remove('menuDefillDesktop');
						}
					}
					var ahw=document.getElementById('articles_header').offsetWidth
					var x=window.innerWidth;
						// window < menu --> menu a reduire
						var allheader=document.querySelectorAll("div.articles_header_other, div.articles_header_selected");
						var aBoubouger=[];
						for (var hi=0;hi<allheader.length;hi++){
							var xPos=(allheader[hi].offsetLeft - allheader[hi].scrollLeft + allheader[hi].clientLeft+allheader[hi].parentNode.offsetLeft)+allheader[hi].clientWidth;
							if(allheader[hi].clientHeight>25||xPos>x){
								// les problemes
								aBoubouger.push(allheader[hi].id.substr(4,allheader[hi].id.length-4));
							}else{}
						}
						if(aBoubouger.length>0){
							// do it only if header has to be resized
							aBoubouger.sort(function(a, b){return a - b});
							var aBouger=aBoubouger[0];
							for (var hi=0;hi<allheader.length;hi++){
								if(allheader[hi].id.substr(4,allheader[hi].id.length-4)>=aBouger){
									allheader[hi].style.display="none";
								}
							}
							var menuImage=document.createElement('img');
							var menuImageDiv=document.createElement('div');
							menuImage.src="medias/menu.png";
							menuImageDiv.id='articles_header_menu_icon';
							menuImageDiv.setAttribute('onclick','defilMenuDesktop('+aBouger+')');
							allheader[0].parentNode.appendChild(menuImageDiv);
							menuImageDiv.appendChild(menuImage);
						}
				}
			}
			function countryHoving(event){
				inCountry=true;
				var e=event.target;
				// change the color and enlarge the country
			  e.style.backgroundColor="#ebebe0";
			  e.style.transform="scale(1.1)";
			  e.style.transitionDuration="1s";
				// get mouse position
				var x = event.clientX;
				x=x+20;
				var y = event.clientY;
				y=y+20;
				// create the name div
				var nameDiv=document.createElement("div");
				var newId=e.id.replace(/_/g," ")
				var debut=newId.charAt(0);
				debut=debut.toUpperCase();
				newId=newId.slice(1, newId.length);
				newId=debut+newId;
				// check if the div is larger that the distance between the pointer and the right side of screen
				var divWidth=newId.length*12;
				var tooClose=window.innerWidth-(x+divWidth);
				if(tooClose<0){
					x=x-divWidth-20
				}else{
					x=x+20;
				}
				divWidth=divWidth+"px";
				nameDiv.innerHTML=newId;
				nameDiv.style.position="fixed";
				nameDiv.style.zIndex="10";
				nameDiv.id="countryNameBox";
				nameDiv.style.top=y+"px";
				nameDiv.style.left=x+"px";
				nameDiv.style.backgroundColor="white";
				nameDiv.style.borderRadius="10px";
				nameDiv.style.height="25px";
				nameDiv.style.width=divWidth;
				nameDiv.style.textAlign="center";
				e.parentNode.insertBefore(nameDiv,e);
			}
			function countryLeaving(e){
				// remove the name div when pointer is leaving a country on the map
				document.getElementById("countryNameBox").remove();
			  e.style.backgroundColor=null;
			  e.style.transform="scale(1)";
			  e.style.transitionDuration="1s";
				inCountry=false;
			}
			function resetScroll(){
				// reset the scroll to 0 when page is refreshed
			  document.body.scrollTop=0; // safari
			  document.documentElement.scrollTop=0; // chrome, firefox ie
				testScroll();
			}
			function articles_country(e){
				// event on click in a country on the map --> display the articles of a country
				var id=e.getAttribute("c-id");
				if(currentPage==3){
					document.body.scrollTop=document.body.scrollHeight;
					initArticles(id);
				}else if(currentPage==4){
					var headerE=document.getElementById('chap'+id).getElementsByTagName('p')[0];
					switchChapter(headerE,id,10,0);
				}
			}
			function wScroll(event){
				// load more articles on load
				var chapitreId=document.getElementById('chapId').value;
				if (!lazyloading && ((window.innerHeight + event.target.scrollTop) >= document.getElementById('article_wrapper').offsetHeight)) {
					lazyloading=true;
					loadMore(chapitreId);
				}
			}
			function testScroll(){
		  	// cette fonction cree un fondu des fonds d'ecrans
			  var wo=window.pageYOffset;
			  var h = window.innerHeight;
			  var hh=h+h;
				var hhh=hh+h;
				// 4 levels
				var s1=document.getElementById("slide1").style;
				var s2=document.getElementById("slide2").style;
				var s3=document.getElementById("slide3").style;
				var s4=document.getElementById("slide4").style;
				if(wo==hhh|| wo>hhh){
					// 4eme page - window= 3 hauteurs ou plus
					if(currentPage!=4){
						if(!articlesLoad){
							initArticles(0);
						}else{
							// remove style attribute used to resize map to keep the ratio
							s3.minWidth=null;
							s3.maxWidth=null;
							s3.marginRight=null;
							s3.marginLeft=null;
							s3.marginTop=null;
							s3.marginBottom=null;
							s3.minHeight=null;
							s3.maxHeight=null;
							// resize the map in the left top corner
							s3.height="16.6666666667%";
							s3.width="16.6666666667%";
							s3.webkitTransition="all 3s ease";
	 					 	s3.MozTransition="all 3s ease";
	 					 	s3.OTransition="all 3s ease";
	 					 	s3.transition="all 3s ease";
							s3.opacity="1";
							s3.zIndex="2";
							s3.minWidth="16.6666666667%";
							s3.minHeight="16.6666666667%";
							s3.borderBottomRightRadius="6px";
							s4.opacity="1";
							s4.zIndex="1";
							currentPage=4;
							resizeTheseBoxes(null);
						}
					}
				}else	if (wo==h||wo<h ){
					// page 1 - window = 1 hauteur ou moins
					if (currentPage!=1){
						var cstyle=document.getElementById("slide"+currentPage).style;
						cstyle.opacity="0";
					 	cstyle.zIndex="-1";
					 	s1.opacity="1";
					 	s1.zIndex="1";
					 	currentPage=1;
					}
					if(s3.zIndex>0){
						s3.webkitTransition="none !important";
					 s3.MozTransition="none !important";
					 s3.OTransition="none !important";
					 s3.transition="none !important";
					 s3.zIndex=-1;
					}
				}else if(wo==hh||wo>hh ){
					// page 3 : window=2 hauteurs ou plus
					var cstyle=document.getElementById("slide"+currentPage).style;
					if(mobilecheck() && currentPage!=4){
						// no page 3, load articles
						if(!articlesLoad){
							initArticles(0);
						}else{
							cstyle.opacity="0";
							cstyle.zIndex="-1";
							s4.opacity="1";
							s4.zIndex="1";
							currentPage=4;
						}
					}else if (currentPage!=3){
						// load map
						cstyle.opacity="0";
						cstyle.zIndex="-1";
						s3.opacity="1";
						s3.zIndex="1";
						s3.webkitTransition="all 3s ease";
					 s3.MozTransition="all 3s ease";
					 s3.OTransition="all 3s ease";
					 s3.transition="all 3s ease";
						currentPage=3;
						resizeTheseBoxes(null);
					}
				}else if (wo==hh||wo<hh ){
					// page 2 : window = 2 hauteurs ou moins
					var cstyle=document.getElementById("slide"+currentPage).style;
					if (currentPage!=2){
						s2.opacity="1";
						s2.zIndex="1";
						currentPage=2;
						cstyle.opacity="0";
						cstyle.zIndex="-1";
					}
					if(s3.zIndex>0){
						s3.webkitTransition="none !important";
					 s3.MozTransition=null;
					 s3.OTransition="none !important";
					 s3.transition=null;
					 s3.zIndez=-1;
					}
				}
			}
			function initArticles(cId){
				// initialisation of the article page
				articlesLoad=true;
				lazyloading=true;
				// resize the map
				if(mobilecheck()){
					document.getElementById("slide2").style.opacity="0";
					document.getElementById("slide2").style.zIndex="-1";
					document.getElementById("slide4").style.opacity="1";
					document.getElementById("slide4").style.zIndex="1";
					currentPage=4;
					var abh=document.getElementById('article_bandeau_header')
					abh.classList.add('mobile_bandeau');
					var menuImage=document.createElement('img');
					menuImage.src="medias/menu.png";
					menuImage.setAttribute('onclick','defilMenu()');
					abh.appendChild(menuImage);
				}else{
					var abh=document.getElementById('article_bandeau_header')
					abh.classList.add('desktop_bandeau');
					var s3=document.getElementById("slide3").style;
					// remove style attribute used to resize map to keep the ratio
					s3.minWidth=null;
					s3.maxWidth=null;
					s3.marginRight=null;
					s3.marginLeft=null;
					s3.marginTop=null;
					s3.marginBottom=null;
					s3.minHeight=null;
					s3.maxHeight=null;
					s3.webkitTransition="all 3s ease";
				 	s3.MozTransition="all 3s ease";
				 	s3.OTransition="all 3s ease";
				 	s3.transition="all 3s ease";
					// resize the map in the left top corner
					s3.height="16.6666666667%";
					s3.width="16.6666666667%";
					s3.opacity="1";
					s3.zIndex="2";
					s3.minWidth="16.6666666667%";
					s3.minHeight="16.6666666667%";
					s3.borderBottomRightRadius="6px";
					document.getElementById("slide4").style.opacity="1";
					document.getElementById("slide4").style.zIndex="1";
					currentPage=4;
				}
				var backImage=document.getElementById("background_image");
				if (cId==0){
					backImage.style.backgroundImage='url("medias/global_'+deviceType+'.jpg")';
				}else{
					backImage.style.backgroundImage='url("medias/'+cId+'_'+deviceType+'.jpg")';
				}
				function loadScript( url, callback ) {
					var script = document.createElement( "script" )
					script.type = "text/javascript";
					if(script.readyState) {  //IE
						script.onreadystatechange = function() {
							if ( script.readyState === "loaded" || script.readyState === "complete" ) {
								script.onreadystatechange = null;
								callback();
							}
						};
					}else{  //Others
						script.onload = function() {callback();};
					}
					script.src = url;
					document.getElementsByTagName( "head" )[0].appendChild( script );
				}
				// [START]
				loadScript("scripts.js", function() {
					// change la taille des images verticales
					// load article header
					if (window.XMLHttpRequest) {
						// code for IE7+, Firefox, Chrome, Opera, Safari
						xhttp = new XMLHttpRequest();
					} else {
						// code for IE6, IE5
						xhttp = new ActiveXObject("Microsoft.XMLHTTP");
					}
					var initParams = "l=10&o=0&c="+cId;
					xhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							// element.innerHTML +=this.responseText;
							var articleHeader=document.createElement('div');
							articleHeader.classList.add('articles_header');
							articleHeader.id="articles_header";
							articleHeader.innerHTML=this.responseText;
							if(mobilecheck()){
								articleHeader.setAttribute('onclick','refilMenu()');
							}

							slide4.appendChild(articleHeader);
							var articleWrapper=document.createElement('div');
							articleWrapper.id='article_wrapper';
							if(mobilecheck()){
								articleWrapper.style.top="30px";
							}
							slide4.appendChild(articleWrapper);
							var limitVal=document.createElement('input');
							var offsetVal=document.createElement('input');
							var chapId=document.createElement('input');
							var totalNews=document.createElement('input');
							limitVal.type='hidden';
							offsetVal.type='hidden';
							chapId.type='hidden';
							totalNews.type='hidden';
							limitVal.value=10;
							offsetVal.value=0;
							chapId.value=cId;
							limitVal.id="limitVal";
							offsetVal.id="offsetVal";
							chapId.id="chapId";
							totalNews.id="totalNews";
							backImage.appendChild(limitVal);
							backImage.appendChild(offsetVal);
							backImage.appendChild(chapId);
							backImage.appendChild(totalNews);
							var wrappperFound=false;
							var poll = setInterval(function () {
								var slideChilds=slide4.childNodes;
								for (var sci=0;sci<slideChilds.length;sci++){
									if(slideChilds[sci]==articleWrapper){
										wrapperFound=true;
										break;
									}
								}
								if(wrapperFound){
									clearInterval(poll);
									// count articles
									var params = "c="+cId;
									if (window.XMLHttpRequest) {
											// code for IE7+, Firefox, Chrome, Opera, Safari
											xhttp = new XMLHttpRequest();
									} else {
											// code for IE6, IE5
											xhttp = new ActiveXObject("Microsoft.XMLHTTP");
									}
									xhttp.onreadystatechange = function() {
											if (this.readyState == 4 && this.status == 200) {
												totalNews.value=this.responseText;
											}else{/*wait*/}
									}
									xhttp.open("GET", "ajax_countarticles.php"+"?"+params, true);
									xhttp.send();
									loadMore(cId);
								}
							},10);
						}else{/*wait*/}
					}
					xhttp.open("GET", "ajax_initarticles.php"+"?"+initParams, true);
					xhttp.send();
					// change the country color
					if(!mobilecheck()){
						var mapCountries=document.getElementsByClassName('svg_country');
		        if(mapCountries.length>0){
		          for (var mci=0;mci<mapCountries.length;mci++){
		            if (mapCountries[mci].getAttribute('c-id')==cId){
		              mapCountries[mci].classList.add('svg_country_selected');
		              mapCountries[mci].classList.remove('svg_country');
		            }
		          }
		        }
					}else{
						var ahFound=false;
						var poll2 = setInterval(function () {
							var headers=document.getElementsByClassName('articles_header');
								if(headers.length>0){
									var ah=headers[0];
									ahFound=true;
								}
								if(ahFound){
									clearInterval(poll2);
									ah.style.display="none";
								}
						},10);
					}
				});
				resizeTheseBoxes(null);
			}
		</script>
	</body>
</html>
