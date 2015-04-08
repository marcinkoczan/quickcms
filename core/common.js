/*
* Common JS scripts
*/

function gEBI( objId ){
  return document.getElementById( objId );
}

function createCookie( sName, sValue, iDays ){
  sValue = escape( sValue );
  if( iDays ){
    var oDate = new Date();
    oDate.setTime( oDate.getTime() + ( iDays*24*60*60*1000 ) );
    var sExpires = "; expires="+oDate.toGMTString();
  }
  else
    var sExpires = "";
  document.cookie = sName+"="+sValue+sExpires+"; path=/";
}

function throwCookie( sName ){
  var sNameEQ = sName + "=";
  var aCookies = document.cookie.split( ';' );
  for( var i=0; i < aCookies.length; i++ ){
    var c = aCookies[i];
    while( c.charAt(0) == ' ' )
      c = c.substring( 1, c.length );
    if( c.indexOf( sNameEQ ) == 0 )
      return unescape( c.substring( sNameEQ.length, c.length ) );
  }
  return null;
}

function delCookie( sName ){
  createCookie( sName, "", -1 );
}

function isset( sVar ){
  return( typeof( window[sVar] ) != 'undefined' );
}

_bUa=navigator.userAgent.toLowerCase();
_bOp=(_bUa.indexOf("opera")!=-1?true:false);
_bIe=(_bUa.indexOf("msie")!=-1&&!_bOp?true:false);
_bIe4=(_bIe&&(_bUa.indexOf("msie 2.")!=-1||_bUa.indexOf("msie 3.")!=-1||_bUa.indexOf("msie 4.")!=-1)&&!_bOp?true:false)
isIe=function(){return _bIe;}
isOldIe=function(){return _bIe4;}
var olArray=[];

function AddOnload( f ){
  if( isIe() && isOldIe() ){
    window.onload = ReadOnload;
    olArray[olArray.length] = f;
  }
  else if( window.onload ){
    if( window.onload != ReadOnload ){
      olArray[0] = window.onload;
      window.onload = ReadOnload;
    }
    olArray[olArray.length] = f;
  }
  else
    window.onload=f;
}
function ReadOnload(){
  for( var i=0; i < olArray.length; i++ ){
    olArray[i]();
  }
}
function hasClassName(oObj, sName){
  var aList = oObj.className.split(" ");
  for( var i = 0; i < aList.length; i++ )
    if( aList[i] == sName )
      return true;
  return false;
}

function addClassName(oObj, sName){
  if( oObj.className == null )
    return;
  if( hasClassName( oObj, sName ) )
    return;
  oObj.className = oObj.className+' '+sName;
}

function removeClassName( oObj, sName ){
  if( oObj.className == null )
    return;
  var aNewList = new Array();
  var aCurList = oObj.className.split(" ");
  for( var i = 0; i < aCurList.length; i++ )
    if( aCurList[i] != sName )
      aNewList.push( aCurList[i] );
  oObj.className = aNewList.join(" ");
}

/* PLUGINS */
function backToTop(){
  $('#backToTop').hide();
  $(window).scroll( function(){
    if( $(this).scrollTop() > 100 )
      $('#backToTop').fadeIn();
    else
      $('#backToTop').fadeOut();
  } );
  $('#backToTop a').click( function(){
    $('body,html').animate( {scrollTop:0}, 600 );
    return false;
  } );
}