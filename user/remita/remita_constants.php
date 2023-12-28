<!-- 
@company - SystemSpecs
@product - Remita
@author - Oshadami Mike
-->

<!-- $merchantId = "8824468874";
$apiKey = "768321";
$serviceTypeId = "8799249766"; -->
<?php
define("MERCHANTID", "8824468874");
define("SERVICETYPEID", "8799249766");
define("APIKEY", "768321");
define("CHECKSTATUSURL", "https://login.remita.net/remita/ecomm"); 
define("GATEWAYURL", "https://login.remita.net/remita/ecomm/init.reg");
define("GATEWAYINITIATEURL", "https://login.remita.net/remita/exapp/api/v1/send/api/echannelsvc/merchant/api/paymentinit");
define("GATEWAYRRRPAYMENTURL", "https://login.remita.net/remita/ecomm/finalize.reg");



define("PATH", 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']));
?>