<HTML>
<HEAD>
	<TITLE>SERIAL PORT ACCESS</TITLE>
</HEAD>

<BODY>

<?php

// Include the serial port class file;
require_once "portDriver.php";

// Create the device;
$serial = new serialPort();



// Open the device.
if(($serial->openPort("/dev/ttyS0")) )
{
	if($serial->sendInit() === true) 
	{ 	$newCommand = false;
		$quit = false;
		$serial->sendMessage(chr(1));
		do{
			if($newCommand === true)
			{}
			$reader = $serial->getMessage();
			echo $reader;
			if($reader === chr(3)) {echo "etx";}
			if($reader === chr(4)) { echo "eot"; }

			if($reader === chr(1)) {echo "soh";}
			if($reader === chr(2)) {echo "stx";}


		}while($reader !== chr(10));

	}
	else { echo "\nThe device failed to initialize!\n"; }
// Close the device.
$serial->closePort();
}
else
{
	echo "\nThe device failed to open!\n";
}

?>

</BODY>

</HTML>