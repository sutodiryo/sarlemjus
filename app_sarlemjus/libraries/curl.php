<?php
// Server key from Firebase Console
define( 'API_ACCESS_KEY', 'AAAA----FE6F' );

$data = array("to" => "cNf2---6Vs9",
              "notification" => array( "title" => "Shareurcodes.com", "body" => "A Code Sharing Blog!","icon" => "icon.png", "click_action" => "http://shareurcodes.com"));                                                                    
$data_string = json_encode($data); 

echo "The Json Data : ".$data_string; 

$headers = array
(
     'Authorization: key=' . API_ACCESS_KEY, 
     'Content-Type: application/json'
);                                                                                 
                                                                                                                     
$ch = curl_init();  

curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );                                                                  
curl_setopt( $ch,CURLOPT_POST, true );  
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_POSTFIELDS, $data_string);                                                                  
                                                                                                                     
$result = curl_exec($ch);

curl_close ($ch);

echo "<p>&nbsp;</p>";
echo "The Result : ".$result;