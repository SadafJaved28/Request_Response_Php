# Request_Response_Php
This project is based on request and response of ping and reverse type.

There are 3 php page are used along with xsd folder for validating the xml request.

⦁	index.php :
             In this page user can enter Sender, Recipient, Reference, Message & Request type either Ping  or Reverse  and also Other
             for checking wrong xml validation with xsd file.
						 
⦁	receive.php:
             This page receive xml with post method and checking the input request and validating with xsd.
						 
⦁	UtilityClass.php:
              This is utility class used for other php pages. It consist of two functions.
							
⦁       	Function to generate request xml by passing request type.

⦁        	Function to generate response xml by passing request type, message, sender, recipient, reference and reverse, reverse parameter is used for reverse response and also for error code. 


How to run this Project?                        
⦁	Paste the project in C:\xampp\htdocs folder.
⦁	Use Xampp control panel to run the project.
Tool used:
⦁	Visual Studio Code and Xampp control panel.
Technology used:
⦁	Php, Html, Bootstrap
