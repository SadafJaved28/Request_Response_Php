<?php
class UtilityClass
{
    /*
      Author      : Sadaf
      Date        : 08-08-2018
      Description : Function to generate xml by passing request type.
    */
    function generateXml($type)
    {
      try
      {
          //open xml	
          $xml = new DOMDocument( "1.0", "UTF-8" );
          $xml->preserveWhiteSpace = false;
          $xml->formatOutput   = true;				
          // Create "root" Elements
          if ($type =='Ping')
          {
            $xml_root = $xml->createElement("ping_request");
          }
          elseif($type =='Reverse')
          {
            $xml_root = $xml->createElement("reverse_request");
          }
          else
          {
            $xml_root = $xml->createElement("other_request");
          }
          
          //$xml_root->setAttribute("Version", "1.0");	
          
          $xml_item = $xml->createElement("header");
          $xml_root->appendChild($xml_item);	
          $xml_item->appendChild($xml->createElement( "type", $type));	
          $xml_item->appendChild($xml->createElement( "sender", $_POST['sender'] ));	
          $xml_item->appendChild($xml->createElement( "recipient", $_POST['recipient'] ));	
          $xml_item->appendChild($xml->createElement( "reference", $_POST['reference'] ));	
          $xml_item->appendChild($xml->createElement( "timestamp", date("Y-m-d\TH:i:sP")));
                              
          $xml_item = $xml->createElement("body");
          $xml_root->appendChild($xml_item);			
          
          if ($type =='Ping')
          {
            $xml_item->appendChild($xml->createElement( 'echo', 	$_POST['message'] ) );	
          }
          elseif($type =='Reverse')
          {
            $xml_item->appendChild($xml->createElement( 'string', 	$_POST['message'] ) );	
          }
                                                                                                            
          //close xml	
          $xml->appendChild($xml_root);		
          // Parse the XML.
          $_xml = $xml->saveXML();	
          return $_xml;
      }
      catch(Exception $ex)
      {
          return $ex->getMessage();
      }
    }
    /*
      Author      : Sadaf
      Date        : 08-08-2018
      Description : Function to generate response xml by passing request type,message,sender,recipient,reference and reverse.
                    reverse parameter is used for reverse reponse and also for error code.
    */
    function generateResponseXml($type, $message, $reverse, $sender, $recipient, $reference)
    {
      try
      {
          //open xml	
          $xml = new DOMDocument( "1.0", "UTF-8" );
          $xml->preserveWhiteSpace = false;
          $xml->formatOutput   = true;				
          // Create "root" Elements
          if ($type =='Ping')
          {
            $xml_root = $xml->createElement("ping_response");
          }
          elseif($type =='Reverse')
          {
            $xml_root = $xml->createElement("reverse_response");
          }
          elseif($type =='Nack')
          {
            $xml_root = $xml->createElement("nack");
          }
          else
          {
            $xml_root = $xml->createElement("other_request");
          }          
          //$xml_root->setAttribute("Version", "1.0");	
          
          $xml_item = $xml->createElement("header");
          $xml_root->appendChild($xml_item);	
          $xml_item->appendChild($xml->createElement( "type", $type));	
          $xml_item->appendChild($xml->createElement( "sender", $recipient ));	
          $xml_item->appendChild($xml->createElement( "recipient", $sender ));	
          $xml_item->appendChild($xml->createElement( "reference", $reference ));	
          $xml_item->appendChild($xml->createElement( "timestamp", date("Y-m-d\TH:i:sP")));
                              
          $xml_item = $xml->createElement("body");
          $xml_root->appendChild($xml_item);			
          
          if ($type =='Ping')
          {
            $xml_item->appendChild($xml->createElement( 'echo', 	$message ) );	
          }
          elseif($type =='Reverse')
          {
            $xml_item->appendChild($xml->createElement( 'string', 	$message) );	
            $xml_item->appendChild($xml->createElement( 'reverse', 	$reverse) );
          }
          elseif($type =='Nack')
          {
            $xml_item1 = $xml->createElement("error");
            $xml_item->appendChild($xml_item1);	
            $xml_item1->appendChild($xml->createElement( 'code', 	$reverse) );	
            $xml_item1->appendChild($xml->createElement( 'message', 	$message) );
          }
                                                                                                            
          //close xml	
          $xml->appendChild($xml_root);		
          // Parse the XML.
          $_xml = $xml->saveXML();	
          return $_xml;
      }
      catch(Exception $ex)
      {
          return $ex->getMessage();
      }
    }
}
?>