<?php
/*$lmFlag='true';
   $continuousFlag='true';
   $doEndpointing='true';
   $CmnBatchFlag='true';
   $fullfilepath = 'cool.wav';
   $upload_url = 'http://spokentech.net:8000/speechcloud/SpeechUploadServlet';
   $params = array(
     'lmFlag'=>$lmFlag,
     'continuousFlag'=>$continuousFlag ,
     'doEndpointing'=>$doEndpointing ,
     'CmnBatchFlag'=>$CmnBatchFlag ,
     'audio'=>"@$fullfilepath"
   );       
   set_time_limit(0); 
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_VERBOSE, 1);
   curl_setopt($ch, CURLOPT_TIMEOUT, 300);
   curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
   curl_setopt($ch, CURLOPT_URL, $upload_url);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
   $response = curl_exec($ch);
   echo "$response";
   curl_close($ch);
*/

$url = 'https://www.google.com/speech-api/v1/recognize?xjerr=1&client=chromium&lang=en-IN';
/*$uploadfile = 'sounds/hi.wav';
$newfile = 'sounds/abc3.flac';
//$soxCommand = "sox $uploadfile $newfile rate 16k";
shell_exec ("sox /sounds/hi.wav /sounds/abc3.flac 16k");
//shell_exec('sox $uploadfile $newfile rate 16k');
*/
$audio = file_get_contents('sounds/abc2.flac');
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
 curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: audio/x-flac; rate=16000'));
curl_setopt($ch, CURLOPT_POSTFIELDS, $audio);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$json = curl_exec($ch);
curl_close($ch);
$data = json_decode($json, true);
echo "<pre>";
print_r($data);
echo "</pre>";

?>


