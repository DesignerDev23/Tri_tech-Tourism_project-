<?php
/*
$amt=8000;
$bank = '223';
$tamt=$bank + $amt;

$s_id=4430731;
$m_id=2547916;
$api=1946;
$o_id=rand(10000000,99999999);//DATE("dmyHis");//rand(100000000000,999999999999).rand(10,99);
echo '<br>';
$hash_str = $m_id . $s_id . $o_id . $amt . $api;
$hash = hash('sha512', $hash_str);

$hash1='remitaConsumerToken='.$hash;

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://remitademo.net/remita/exapp/api/v1/send/api/echannelsvc/merchant/api/paymentinit',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "serviceTypeId": "4430731",
    "amount": "8000",
    "orderId": "'.$o_id.'",
    "payerName": "Abbey Kingsley Atedo",
    "payerEmail": "abey@gmail.com",
    "payerPhone": "08036635543",
    "customFields": [
		{
		   "name": "Student Number",
		   "value": "561561516",
		   "type": "ALL"
		}],
    "lineItems":[
       {
          "lineItemsId":"itemid1",
          "beneficiaryName":"Alozie Michael",
          "beneficiaryAccount":"6020067886",
          "bankCode":"058",
          "beneficiaryAmount":"5000",
          "deductFeeFrom":"1"
       },
       {
          "lineItemsId":"itemid2",
          "beneficiaryName":"Folivi Joshua",
          "beneficiaryAccount":"0360883515",
          "bankCode":"058",
          "beneficiaryAmount":"3000",
          "deductFeeFrom":"0"
       }
    ]
}',
  CURLOPT_HTTPHEADER => array('Content-Type: application/json','Authorization: remitaConsumerKey=2547916,'.$hash1),
));

$response = curl_exec($curl);
curl_close($curl);

echo '<br><br>'.$response;

*/