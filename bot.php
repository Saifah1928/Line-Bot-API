<?php
//created by Pol.Cpl khomsan khemthong
$access_token ='CLqjjqj3TgmcbF85sAlsJ5b1mm6OgJu8W7KQH3Yc2P/4szNviDkrbBsFp1sYrGk2NvmNlzdky0qVdYxG5GoBOZJRwGAF39Z0SpAOmaPhMx80GtHeJFlEbcWYLNwrhq8r09AY8aj3sx3qSltj+v34fgdB04t89/1O/w1cDnyilFU=';


// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			//source
     			$userId = $event['source']['userId'];

			// Get replyToken
			$replyToken = $event['replyToken'];
	   		$receivetext = $event['message']['text'];

      		$processtext = 'ระบบเบิกวัสดุ แผนกคอมพิวเตอร์ธุรกิจ ลพบีรี'."\n";
			$processtext .= $receivetext;
				if($receivetext="สวัสดี"){
					echo "สวัดีครับยินดีที่ได้รู้จัก";
				}

		 	 // Build message to reply back
	    		$messages = [
	   		'type' => 'text',
	    		'text' => $processtext
	     		];

			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
			'replyToken' => $replyToken,
			'messages' => [$messages],
			];

      $post = json_encode($data);
      $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
      $result = curl_exec($ch);
      curl_close($ch);

      echo $result . "\r\n";


    }
  }
}
echo "OK SAIFAH";

?>
