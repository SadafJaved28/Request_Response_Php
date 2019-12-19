<html>

<head>
  <title> Request and response </title>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="page-header">
            <h3>Request & Response</h3>
          </div>
          <form action="" method="post">

            <div class="card-body">
              <div class="form-group row">
                <label for="sender" class="col-md-4 col-form-label text-md-right">Sender</label>
                <div class="col-md-6">
                  <input id="sender" type="text" class="form-control" name="sender" autofocus>
                </div>
              </div>
              <div class="form-group row">
                <label for="recipient" class="col-md-4 col-form-label text-md-right">Recipient</label>
                <div class="col-md-6">
                  <input id="recipient" type="text" class="form-control" name="recipient">
                </div>
              </div>
              <div class="form-group row">
                <label for="reference" class="col-md-4 col-form-label text-md-right">Reference</label>
                <div class="col-md-6">
                  <input id="reference" type="text" class="form-control" name="reference">
                </div>
              </div>
              <div class="form-group row">
                <label for="message" class="col-md-4 col-form-label text-md-right">Message</label>
                <div class="col-md-6">
                  <input id="message" type="text" class="form-control" name="message">
                </div>
              </div>

              <div class="form-group row">
                <label for="requesttype" class="col-md-4 col-form-label text-md-right">Request Type:</label>
                <div class="col-md-6">
                  <select id="requesttype" name="requesttype" width="10%" class="form-control" required>
                    <option value="">--Request Type--</option>
                    <option value="Ping">Ping</option>
                    <option value="Reverse">Reverse</option>
                    <option value="Other">Other</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-6">
                  <button type="submit" name="submit" class="btn btn-primary">Send Request</button>
                </div>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</body>

</html>

<?php 
 include ("UtilityClass.php");
 /*
  Author      : Sadaf
  Date        : 08-08-2018
  Description : Function to send xml as Post method to another page.
 */
 function sendXmlOverPost($url, $xml) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	// For xml, change the content-type.
	curl_setopt ($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml"));
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // ask for results to be returned
	curl_setopt($ch, CURLOPT_FORBID_REUSE, 1); 
  curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);

	// Send to receive page and return data to caller.
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}

 if(isset($_POST['submit']))
 { 
    $reqType=$_POST['requesttype'];   
    $obj = new UtilityClass();
    $getXml = $obj->generateXml($reqType);
    
    $url = "http://localhost/Request_Response/receive.php";
    $res = sendXmlOverPost($url ,$getXml);
    echo '<div class="form-group row"><div class="col-md-6"><textarea class="md-textarea form-control" rows="4"">'.$res.'</textarea></div></div>';
 }
?>