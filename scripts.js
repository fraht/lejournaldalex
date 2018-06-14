// variables used in function resize portraits
var i=0;
var j=0;
var iv=0;
var jv=0;
// functions for the page articles
function mousePointer(e){
  // change the mouse cursor to a pointer
  e.style.cursor="pointer";
}
function showart(e){
  // show the whole text of an article
  e.parentNode.className="hidden_article";
  e.parentNode.nextSibling.className="article_text";
}

function tscroll(){
  var chapitreId=document.getElementById('chapId').value;
  if (!lazyloading && ((window.innerHeight + window.scrollY) >= document.body.offsetHeight)) {
    lazyloading=true;
    loadMore(chapitreId);
  }
}

function loadMore(chapitreId){
  // load more news
  var element=document.getElementById('article_wrapper');
  var l=document.getElementById('limitVal').value;
  var o=document.getElementById('offsetVal').value;
  var tn=document.getElementById('totalNews').value;
  if (o==0 || parseInt(l)+parseInt(tn)>(parseInt(o)+parseInt(l))){
    // check if limit not reached
    var params = "o="+o+"&l="+l+"&c="+chapitreId;
    if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xhttp = new XMLHttpRequest();
    }else{
      // code for IE6, IE5
      xhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var newVal=parseInt(o)+parseInt(l);
        document.getElementById('offsetVal').value=(newVal);
        var myArr = JSON.parse(this.responseText);
        element.innerHTML +=myArr.HTMLresponse;
        resizePortraits();
        lazyloading=false;
      }
    }
    xhttp.open("GET", "ajax_loadarticles.php"+"?"+params, true);
    xhttp.send();
  }
}
function switchChapter(e,chapitreId,lim,off){
  lazyloading=true;
  if("articles_header_selected" != e.parentNode.classList[0] && "svg_country_selected" != e.parentNode.classList[0]){
    // change country only if click on new country
    // if menu deroulant, ferme le menu deroulant
    for (var ci=0;ci<e.parentNode.classList.length;ci++){
      if(e.parentNode.classList[ci]=='menuDefillDesktop'){
        var allheader=document.querySelectorAll("div.articles_header_other, div.articles_header_selected");
        for (var ahi=0;ahi<allheader.length;ahi++){
          for (ahci=0;ahci<allheader[ahi].classList.length;ahci++){
            if(allheader[ahi].classList[ci]=='menuDefillDesktop'){
              allheader[ahi].classList.remove('menuDefillDesktop');
              allheader[ahi].style.top=null;
              allheader[ahi].style.display="none";
            }
          }
        }
      }
    }
    var params = "c="+chapitreId;
    if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xhttp = new XMLHttpRequest();
    }else{
      // code for IE6, IE5
      xhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhttp.onreadystatechange = function() {
      if(this.readyState == 4 && this.status == 200){
        document.getElementById('totalNews').value=this.responseText;
        i=0;
        j=0;
        document.getElementById('limitVal').value=lim;
        document.getElementById('offsetVal').value=off;
        document.getElementById('article_wrapper').innerHTML="";
        var heads=document.getElementsByClassName('articles_header_selected');
        if(heads.length>0){
          var oldid=heads[0].getAttribute('id').substr(4,1);
          for (var hi=0;hi<heads.length;hi++){
            heads[hi].classList.add('articles_header_other');
            heads[hi].classList.remove('articles_header_selected');
          }
        }
        // map formating
        var mapCountries=document.getElementById('slide3').getElementsByTagName('div');
        for (var mci=0;mci<mapCountries.length;mci++){
          if(mapCountries[mci].getAttribute('c-id')==chapitreId){
            mapCountries[mci].classList.remove('svg_country');
            mapCountries[mci].classList.add('svg_country_selected');
          }else{
            mapCountries[mci].classList.remove('svg_country_selected');
            mapCountries[mci].classList.add('svg_country');
          }
        }
        if(e.tagName.toUpperCase()=='P'){
          e.parentNode.classList.remove('articles_header_other');
          e.parentNode.classList.add('articles_header_selected');
        }
        document.getElementById('chapId').value=chapitreId;
        if(chapitreId>0){
          document.getElementById('background_image').style.backgroundImage='url("medias/'+chapitreId+'_'+deviceType+'.jpg")';

        }else{
          document.getElementById('background_image').style.backgroundImage='url("medias/global_'+deviceType+'.jpg")';
        }
        loadMore(chapitreId);
      }else{/*wait*/}
    }
    xhttp.open("GET", "ajax_countarticles.php"+"?"+params, true);
    xhttp.send();
  }
}
function resizePortraits(){
  // reduit la taille des photos en portrait
  // hauteur = largeur
  // redefini la taille des images sur le cote
  var mains=document.getElementsByClassName("article_main_image");
  for (j = i; j < mains.length; j++) {
    var im=mains[j].getElementsByTagName("img");
    if(im.length>0){
      if(im[0].clientHeight>im[0].clientWidth){
        var di=im[0].width;
        im[0].style.height=String(im[0].width)+"px";
        im[0].style.width="auto";
        di=(di-im[0].width);
        im[0].style.marginLeft=String(di/2)+"px";
      }
      // resize side images
      var sidesImages=mains[j].nextSibling;
      var sih=sidesImages.clientHeight;
      if(sih>im[0].height){
        sidesImages.style.height=String(im[0].height)+"px";
        sidesImages.style.overflow="scroll";
      }
    }
    // videos
    var vid=mains[j].getElementsByTagName("video");
    if(vid.length>0){
      var poll = setInterval(function (){
        if (vid[0].videoWidth) {
          clearInterval(poll);
          if(vid[0].clientHeight>vid[0].clientWidth){
            var di=vid[0].clientWidth;
            vid[0].style.height=String(vid[0].clientWidth)+"px";
            vid[0].style.width="auto";
            di=(di-vid[0].width);
            vid[0].style.marginLeft=String(di/4)+"px";
          }
          // resize side images
          var sidesImages=vid[0].parentNode.nextSibling;
          var sih=sidesImages.clientHeight;
          if(sih>vid[0].videoHeight){
            sidesImages.style.height=String(vid[0].clientHeight)+"px";
            sidesImages.style.overflow="scroll";
          }
        }
      },10);
    }
  }
  i=j
}
function enlargeSidePicture(e){
  // agrandi une miniature
  var etype=e.tagName;
  if (etype=='IMG'){etype=true;}else{etype=false;}
  if (etype){
    var sou=e.src;
  }else{
    var sou =e.firstChild.src;
  }
  // path to the original picture
  // window width and height
  var wh = window.innerHeight;
  var ww = window.innerWidth;
  // creation of the new element for the interstial
  var inter=document.createElement("div");
  var backInter=document.createElement("div");
  if (etype){
    var newI=document.createElement("img");
  }else{
    var newI=document.createElement("video");
    var newS=document.createElement("source");
  }
  var closer=document.createElement('div');
  if(etype){
    sou=sou.replace("thumbs/thb_","");
    newI.src=sou;
  }else{
    newS.src=sou;
  }
  closer.classList.add('intersticiel_closer');
  newI.classList.add('imageGrosPlan');
  backInter.classList.add("fond_intersticiel");
  inter.classList.add("intersticiel");
  inter.appendChild(newI);
  if(!etype){
    newI.appendChild(newS);
    newI.controls="controls";
  }
  inter.appendChild(closer);
  document.body.appendChild(backInter);
  document.body.appendChild(inter);
  var poll = setInterval(function () {
    if (newI.naturalWidth || newI.videoWidth) {
      clearInterval(poll);
      if(etype){
        var dh = newI.naturalHeight;
        var dw = newI.naturalWidth;
      }else{
        var dh=newI.videoHeight;
        var dw=newI.videoWidth;
      }
      if(dh>wh){
        nh=wh*0.9;
        diffHW=nh/dh;
        nw=dw*diffHW;
        if(nw<ww){
          inter.style.height=String(nh)+"px";
          inter.style.width=String(nw)+"px";
        }else{
          nw=ww*0.9;
          diffHW=nw/dw;
          nh=dh*diffHW;
          inter.style.height=String(nh)+"px";
          inter.style.width=String(nw)+"px";
        }
        var t=(wh-nh)/2;
        var l=(ww-nw)/2;
      }else if(dw>ww){
        nw=ww*0.9;
        diffHW=ww/nw;
        nh=dh*diffHW;
        if(nh<wh){
          inter.style.height=String(nh)+"px";
          inter.style.width=String(nw)+"px";
        }else{
          nh=wh*0.9;
          diffHW=wh/nh;
          nw=dw*diffHW;
          inter.style.height=String(nh)+"px";
          inter.style.width=String(nw)+"px";
        }
        var t=(wh-nh)/2;
        var l=(ww-nw)/2;
      }else{
        // image plus petite que l'ecran
        var t=(wh-dh)/2;
        var l=(ww-dw)/2;
      }
      inter.style.top=String(t)+"px";
      inter.style.left=String(l)+"px";
      closer.addEventListener('click',closeInter);
    }
  },10);
}
function closeInter(){
  // ferme l'intersticiel (apres avoir ouvert une miniature)
  var aSupprimer= document.getElementsByClassName("intersticiel");
  aSupprimer[0].parentNode.removeChild(aSupprimer[0]);
  aSupprimer= document.getElementsByClassName("fond_intersticiel");
  aSupprimer[0].parentNode.removeChild(aSupprimer[0]);
}
