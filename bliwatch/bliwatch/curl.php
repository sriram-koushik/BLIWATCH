<?php
function cURLcheckBasicFunctions() 
{
  if( !function_exists("curl_init") && 
      !function_exists("curl_setopt") && 
      !function_exists("curl_exec") && 
      !function_exists("curl_close") ) return false; 
  else return true; 
} 

function cURLdownload($url, $file) 
{
  if( !cURLcheckBasicFunctions() ) return "UNAVAILABLE: cURL Basic Functions"; 
  $ch = curl_init(); 
  if($ch) 
  { 
    $fp = fopen($file, "w"); 
    if($fp) 
    { 
      if( !curl_setopt($ch, CURLOPT_URL, $url) ) 
      { 
        fclose($fp); // to match fopen() 
        curl_close($ch); // to match curl_init() 
        return "FAIL: curl_setopt(CURLOPT_URL)"; 
      } 
      if( !curl_setopt($ch, CURLOPT_FILE, $fp) ) return "FAIL: curl_setopt(CURLOPT_FILE)"; 
      if( !curl_setopt($ch, CURLOPT_HEADER, 0) ) return "FAIL: curl_setopt(CURLOPT_HEADER)"; 
      if( !curl_exec($ch) ) return "FAIL: curl_exec()"; 
      curl_close($ch); 
      fclose($fp); 
      return "SUCCESS: $file [$url]";
	     } 
    else return "FAIL: fopen()"; 
  } 
  else return "FAIL: curl_init()"; 
}

// Download from 'example.com' to 'example.txt' 
echo cURLdownload("http://www.w3creatorz.org", "w3.php"); 

?> 