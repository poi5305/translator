<?php
ini_set("user_agent", "Mozilla/5.0 (Windows;+U; Windows+NT+5.2; zh-CN; rv:1.9.0.10) Gecko/2009042316 Firefox/3.0.10");
function c2e($S){
  $S = str_ireplace(" ","%20",$S);
  if($R = get_dict($S))	return $R;
  $S = iconv("UTF-8","big5",$S);
  $url = "http://translate.google.com.tw/translate_a/t?client=t&text=".$S."&hl=zh-TW&sl=zh-CN&tl=en&multires=1&otf=2&ssel=0&tsel=0&sc=1";
  $R = get($url);
  return $R;
}
function e2c($S){
  $S = str_ireplace(" ","%20",$S);
  if($R = get_dict($S))	return $R;
  $S = iconv("UTF-8","big5",$S);
  $url = "http://translate.google.com.tw/translate_a/t?client=t&text=".$S."&hl=zh-TW&sl=en&tl=zh-TW&multires=1&prev=conf&psl=auto&ptl=zh-CN&otf=1&rom=1&it=sel.5439%2Ctgtd.1587&ssel=4&tsel=4&uptl=zh-TW&sc=1";
  $R = get($url);
  return $R;
}
function get_dict($S)
{
  if(is_file("dict.txt"))
  {
	  $dict = File("dict.txt");
	  foreach($dict as $line)
	  {
		  $line = explode("\t", $line);
		  if(strtolower($line[0]) == strtolower($S))
		  {
			  return $line[1];
		  }
	  }
  }
  return 0;
}
function get($url){
  
  $R = file_get_contents($url);
  $R = str_replace("[","",$R);
  $R = str_replace("]","",$R);
  $R = str_replace(",,,,",",",$R);
  $R = str_replace(",,,",",",$R);
  $R = str_replace(",,",",",$R);
  $R = "[$R]";
  $R = json_decode($R);
  $R = "$R[4], $R[0], $R[5], $R[6]";
  return $R;
}
function is_en($str){
  $len = strlen($str);
  for($i=0;$i<$len;$i++)  {
    $sbit = ord(substr($str,$i,1));
    if($sbit >= 128) {
      return false;
    }
  }
  return true;
}
$S = trim($argv[1]);
echo $S;
if(is_en($S)){
  echo "\r\nCH: ".e2c($S);
}else{
  echo "\r\nEN: ".c2e($S);
}
?>