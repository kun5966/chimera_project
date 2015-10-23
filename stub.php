<?php

//var $testing = true;
require_once "portDriver.php";



// Create the device;
$serial = new serialPort();

// Open the device.
$serial->openPort("/dev/ttyS0");
$serial->sendInit();



$message = chr(0x73).chr(0x0A);
//$message = chr(0x73).chr(0x20).chr(0x20);
//$serial->sendMessage($message);
//$message = pack("C*", $message);

//echo dechex($message[1]);
echo $message;
echo dechex($message);

for($j=0;$j<10;$j++)
{
for($i=0;$i<100;$i++)
{
$serial->sendMessage(chr(0x16));
}
$message = chr($j).chr(0x0A);
$serial->sendMessage($message);
}

// Close the device.
$serial->closePort();


?>