<?php
function replyToUser($reToken,$message,$ac_token){
	
	// Make a POST Request to Messaging API to reply to sender
	$url = 'https://api.line.me/v2/bot/message/reply';
	$data = [
		'replyToken' => $reToken,
		'messages' => [$message]
	];
	$post = json_encode($data);
	$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $ac_token);

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	$result = curl_exec($ch);
	curl_close($ch);
	//echo $result . "\r\n";
}

$access_token = 'T5hAc8fLduXLiBDGN1CuvnXBkevO/uppw7pS8e/yst/d/4Kc1cb/s3BkKQIo8SF7XFfFeDesZxbMoENRGxznP4jJvGnW7ogEcHOt1OHeWY/dCDs/Y1vxqLNa7FkK3OsG+xXiSf/ySJYt5JP1GwjxEgdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);

echo $events . "\r\n";
// Validate parsed JSON data
if (!is_null($events['events'])) {
		
		// Loop through each event
		foreach ($events['events'] as $event) {
			
			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
				$messages = [
					'type' => 'text',
					'text' => "Respond :" . $content
				];
			
			replyToUser($replyToken,$messages,$access_token);
		}
	
}
echo "Hello Line BOT";
?>