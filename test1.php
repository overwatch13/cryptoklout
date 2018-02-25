<?php 
echo __DIR__; 
echo "<BR/>";
echo $_SERVER['DOCUMENT_ROOT'];
echo "<BR/>";
echo $_SERVER["SERVER_PROTOCOL"];
echo "<BR/>";
echo substr($_SERVER["SERVER_PROTOCOL"],0,5);
echo "<BR/>";
if(substr($_SERVER["SERVER_PROTOCOL"],0,5) == "http"){
	echo "True";
}else{
	echo "False";
}
echo "<BR/>";
echo $_SESSION['email'];




$siteurl = ((substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http').'://'.$_SERVER["HTTP_HOST"].'/';
echo $siteurl;


?>
