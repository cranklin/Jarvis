<?php 
    $stturl = "https://www.google.com/speech-api/v1/recognize?xjerr=1&client=chromium&lang=en-US";
    $wolframurl = "http://api.wolframalpha.com/v2/query?appid=YOUR_APP_ID_HERE&format=plaintext&podtitle=Result&input=";
    $ttsurl = "http://translate.google.com/translate_tts?tl=en&q=";

    if(isset($_GET['speechinput'])){

/*
        // Google Speech to Text

        $filename = "./test1.flac";
        $upload = file_get_contents($filename);
        $data = array(
            "Content_Type"  =>  "audio/x-flac; rate=16000",
            "Content"       =>  $upload,
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $stturl);
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
        //echo $contents;
        $textarray = (json_decode($contents,true));
        $text = $textarray['hypotheses']['0']['utterance'];
        //echo $text;
*/
        $text = $_GET['speechinput'];


	if(stripos($text,"turn")!==FALSE){
		// Home Control API
		// Handle stuff here
        $search = array("turn","my");
        $replace = array("turned","your");
		$responsetext = str_ireplace($search,$replace,$text);
		$answer = "Yes master cranky, I have ".$responsetext;
	}
	else{
		// Wolfram Alpha API

		$wolframurl .= urlencode($text);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $wolframurl);
		ob_start();
		curl_exec($ch);
		curl_close($ch);
		$contents = ob_get_contents();
		ob_end_clean();
		//echo $contents;
		$obj = new SimpleXMLElement($contents);
		$answer = $obj->pod->subpod->plaintext;
		if(!strlen($answer)) $answer = "sorry master cranky, I can't help you with that";
		else $answer = "master cranky, ".$answer;
		//echo $answer;
	}



        // Google Text to Speech

        $ttsurl .= urlencode($answer);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $ttsurl);
        ob_start();
        curl_exec($ch);
        curl_close($ch);
        $contents = ob_get_contents();
        ob_end_clean();
        //header('Content-Disposition: attachment; filename="response.mp3"');
        //header("Content-Transfer-Encoding: binary"); 
        //header("Content-Type: audio/mpeg, audio/x-mpeg, audio/x-mpeg-3, audio/mpeg3");
        header('Content-Type: audio/mpeg');
        header('Cache-Control: no-cache');
        print $contents;
    }
    else{
        ?>
        <html>
            <head>
                <title>.: Jarvis :.</title>
		<script>
			function submitandclear(){
				if(document.getElementById('speechinput').value != ""){
					document.jarvisform.submit();
					document.getElementById('speechinput').value = "";
				}
			}


		</script>
            </head>
            <body>
                <form method="get" name="jarvisform" id="jarvisform" action="<?=$_SERVER['PHP_SELF']?>" target="voiceframe">
                    <input name="speechinput" id="speechinput" type="text" onFocus="submitandclear(this);" style="width:20px;" x-webkit-speech /><!--input type="submit" value="ASK" /-->
                </form>
                <iframe width="0px" height="0px" style="border:0px;" src="about:none" name="voiceframe"></iframe>
            </body>
        </html>
        <?
    }
?>
