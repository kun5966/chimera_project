<html>
<head>
<title>SERIAL SENDER</title>
</head>

<body>
<?php

//var $testing = true;
require_once "portDriver.php";



// Create the device;
$serial = new serialPort();

// Open the device.
$serial->openPort("/dev/ttyS0");
$serial->sendInit();





// Send a message.
//for($i=0;$i<100;$i++)
//{
//$serial->sendMessage(chr(0x48) . chr(0x01));
$serial->sendMessage("whats up mother fucker?".chr(10));
//$serial->sendMessage("1234".chr(2).chr(4)."567".chr(48)."890".chr(10));
//$serial->sendMessage(chr(03).chr(04));
//$reader = $serial->getMessage();
//echo chr($reader);
//}
//$serial->sendMessage();
//$serial->sendMessage("C");
// Receive.
//$testing = $serial->getMessage();

//if($testing == false)
//{
	//echo "Your request timed out!";
//}
/**
if(($testing = $serial->getMessage()) !== false)
{
	$message=" ";
	$reader = $serial->getMessage();
	do{
		$message.= $reader;
		$reader = $serial->getMessage();
			
		//echo $reader;
	}while($reader !== chr(10));
	echo $message;
}
else
{
	echo "\nIts not working!";

}
**/

// Close the device.
$serial->closePort();


?>

</body>

</html>