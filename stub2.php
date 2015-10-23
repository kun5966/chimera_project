<?php

//var $testing = true;

require_once "portDriver.php";



// Create the device;
$serial = new serialPort();

// Open the device.
$serial->openPort("/dev/ttyS1");
$serial->sendInit();

// Send a message.
//$serial->sendMessage(chr(0x00) . chr(0x01));

// Receive.
//$testing = $serial->getMessage();

//do{
//if(($testing = $serial->getMessage()) === false)
//{
//	echo "\nYour request timed out!\n";
//}
//else
//{
	$reader = "";
	$message="";
	$myArray="";
	//echo "\nYou have a message \n";
	//if($testing !== chr(10) ) 
	//{ 
		//echo "\n".(chr($testing))."\n";
	/*	do{
			$message.= $reader;
			$reader = $serial->getMessage();

			if($reader === chr(1)) { echo "\nStarting...\n"; }

			if($reader === chr(06)) 
			{ 
				echo "\nAcknowledged\n"; 
				
			}
			if($reader===chr(0)) { echo "\nYou got a NULL"; }
			//echo $reader;
		}while($reader !== chr(10));
	//}
	echo $message;
	// Reply
	*/
	do{
		//$myArray .= $reader;
		$reader = $serial->getMessage();
		echo "\n".$reader."\n";
		if($reader == chr(0x00)) { echo "null  ";  }
		if($reader === chr(0x16)) {	echo "idle"; }

	}while(true);

	//$myArray = unpack("n*", $myArray);

	// Rebuild message from array
	
	if($reader === 10)
	{	echo "hello there"; }

	

	echo "\n".$reader."\n";
//}
//}while($testing !=="5");

// Close the device.
$serial->closePort();


?>