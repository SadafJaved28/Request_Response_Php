<?php
include ("UtilityClass.php");
error_reporting(E_ERROR | E_PARSE); //to avoid warning in page

if ($_SERVER['REQUEST_METHOD'] = 'post')
{
    $postData = file_get_contents('php://input');
    $xml = new SimpleXmlElement($postData, LIBXML_NOCDATA);
    $doc = new DOMDocument();
    $doc->loadXML($postData); // load xml
    $cnt = count($xml->header);
    if($cnt > 0)
    {
      $type = $xml->header[0]->type;
      $sender = $xml->header[0]->sender;
      $recipient = $xml->header[0]->recipient;
      $reference = $xml->header[0]->reference;
    }
    $message = "";
    $reverse = "";
    if ($type =='Ping')
    {      
      $is_valid_xml = $doc->schemaValidate('xsds/ping_request.xsd'); // path to xsd file
      $message = 'Validation passed.Xml is Ok.';
    }
    else if($type =='Reverse')
    {
      $is_valid_xml = $doc->schemaValidate('xsds/reverse_request.xsd'); // path to xsd file
      $message  = $xml->body->string;
      $reverse = strrev($message);
    }
    else
    {
      $is_valid_xml = false;
    }
    if (!$is_valid_xml){
        $type = 'Nack';
        $obj = new UtilityClass();
        $message = 'The requested message is not recognized.';
        $reverse = '404';
        $getXml = $obj->generateResponseXml($type, $message, $reverse, $sender, $recipient, $reference);
        echo $getXml ;
    }else{
        $obj = new UtilityClass();
        $getXml = $obj->generateResponseXml($type, $message, $reverse, $sender, $recipient, $reference);
        echo $getXml ;
    }
}
//http_response_code()
?>