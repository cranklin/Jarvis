<?php 
    $url = "https://www.google.com/speech-api/v1/recognize?xjerr=1&client=chromium&lang=en-US";
    $ttsurl = "http://translate.google.com/translate_tts?tl=en&q=text";
    $filename = "./test1.flac";

    $upload = file_get_contents($filename);
    $data = array(
        "Content_Type"  =>  "audio/x-flac; rate=16000",
        "Content"       =>  $upload,
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    //curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
    //curl_setopt($ch, CURLOPT_INTERFACE, "127.0.0.1");
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array("Content-Type: audio/x-flac; rate=16000"));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    ob_start();
    curl_exec($ch);
    curl_close($ch);
    $contents = ob_get_contents();
    ob_end_clean();
    echo $contents;
    $textarray = (json_decode($contents,true));
    $text = $textarray['hypotheses']['0']['utterance'];
    echo $text;



?>
