<?php   
         
		$RRRt =$rrr;
        $s_id='2520531693';
		$m_id="2522929340";
		$api="386507";
		$statusUrl='https://login.remita.net/remita/ecomm';

		$concatString = $RRRt . $api . $m_id;
		$hash = hash('sha512', $concatString);
		$url 	= $statusUrl . '/' . $m_id  . '/' . $RRRt . '/' . $hash . '/' . 'status.reg';
		//  Initiate curl
		$ch = curl_init();
		// Disable SSL verification
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		// Will return the response, if false it print the response
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Set the url
		curl_setopt($ch, CURLOPT_URL,$url);
		// Execute
		$result=curl_exec($ch);
		// Closing
		curl_close($ch);
		$response = json_decode($result, true);

		$response_code = $response['status'];
		$response_message = $response['message'];

?>