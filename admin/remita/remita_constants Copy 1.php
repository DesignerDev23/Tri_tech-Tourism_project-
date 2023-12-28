<!-- 
@company - SystemSpecs
@product - Remita
@author - Oshadami Mike
-->
<?php
define("MERCHANTID", "2547916");
define("SERVICETYPEID", "4430731");
define("APIKEY", "1946");
define("CHECKSTATUSURL", "https://remitademo.net/remita/ecomm/"); ////http://www.remitademo.net/remita/ecomm/merchantId/RRR/hash/status.reg
define("GATEWAYURL", "https://www.remitademo.net/remita/ecomm/init.reg");
define("GATEWAYINITIATEURL", "https://remitademo.net/remita/exapp/api/v1/send/api/echannelsvc/merchant/api/paymentinit");
define("GATEWAYRRRPAYMENTURL", "https://remitademo.net/remita/ecomm/finalize.reg");
define("PATH", 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']));
?>