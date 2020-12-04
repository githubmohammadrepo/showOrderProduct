<?php
$mobile = $_POST['MobilePhone'];
$text = $_POST['Regcode'];
try {
  $user = "rjabrisham";
  $pass = "rj9354907433";

  $client = new SoapClient("http://188.0.240.110/class/sms/wsdlservice/server.php?wsdl");
  $user = $user;
  $pass = $pass;
  $fromNum = "500010708120";
  $toNum = array($mobile);
  $pattern_code = "3ahrlw9s7d";
  $input_data = array(
    "verification-code" => $text
  );

  $res =  $client->sendPatternSms($fromNum, $toNum, $user, $pass, $pattern_code, $input_data);
} catch (SoapFault $ex) {
  echo "$ex->faultstring";
}
