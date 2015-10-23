<?php


/**************************************************************************************************
***	Serial Port Class									***
***												***
***  	Description:  This class encapsulates the serial port and every method used to access   ***
***	 	      it.  									***
***												***
**************************************************************************************************/
class serialPort
{
	var $deviceName = null;
	var $outBuffer = "";
	var $handle = null;
	var $pkgSize = 1;
	//var $inBuffer = "";
	var $timeOut = 10;



/**************************************************************************************************
***												***
***	Function: 	openPort								***
***	Description: 	It takes the name of the device to open.  It will return a true or 	***
***			a false depending on whether it was successful opening it.		***
***												***
***	Parameters:	device name.								***
***												***
**************************************************************************************************/

	function openPort($device)
	{
		
		$this->deviceName = $device;
		
		$this->handle = (fopen($this->deviceName, "r+t")) or die("There was an error opening the device!");
		echo "\nOpening device " . $this->deviceName."........";
		if($this->handle !== null) 
		{ 	//set_file_buffer($this->handle,100);
			echo "Success\n"."<br />";
			return true;	
		}
		else 
		{	return false; 	}
		
	}

	function sendInit()
	{
		//$e = chr(27);
		//$initString = $e . "A" . $e . "H300". $e . "V100" . $e . "XL1SATO". $e . "Q1" . $e . "Z"."\r\n";
		//$initString = "\r\n";
		$initString = chr(0x0A);
		//echo $initString;
		//echo "\nInitialization.....";
		if(($this->sendMessage($initString)) === true) { 
			//echo "Success\n"."<br />";
			return true; 
		}
		
		else { 
			//echo "Failed\n";
			return false;
		}
	}


/**************************************************************************************************
***												***
***	Function:	closePort								***
***												***
***	Description:	It will try to close the port and will return a true or false depending ***
***			on whether it was successful or not.					***
***												***
***	Parameters:	none									***
***												***
**************************************************************************************************/
	function closePort()
	{
		if($this->handle !== null)
		{	fclose($this->handle);	
			echo "\nClosing device: " . $this->deviceName . "\n"."<br />";
			return true;
		}
		else
		{	return false;	}
	}


/**************************************************************************************************
***												***
***	Function:	sendMessage								***
***												***
***	Description:	It takes a string and tries to output to the device.  It will return	***
***			a true or false depending on whether or not it was successful.		***
***												***
***	Parameters:	message									***
***												***
**************************************************************************************************/

	function sendMessage($message)
	{
		//$temp = "";
		//for($i=0;$i<strlen($message);$i++)
		//{
		//	$temp .= pack("n", $message[$i]);
		//}
		$this->outBuffer = $message;
		$safe = false;
		if((fwrite($this->handle, $this->outBuffer)) !== false)
		{
			//echo "\nMessage sent.\n";
			$safe = true;
		}
		$this->outBuffer = "";
		return $safe;		

		
	}


/**************************************************************************************************
***												***
***	Function:	getMessage								***
***												***
***	Description:	It will try to read from the device.  If it is successful, it will	***
***			return a string containing the message.  Otherwise, it will return an	***
***			empty string.								***
***												***
***	Parameters:	none									***
***												***
**************************************************************************************************/
	function getMessage()
	{
		set_time_limit(20);

		return $result=fread($this->handle, 1);
		//$proceed=true;
		//$fh=$this->handle;
		//do
		//{
			//if(($result = fread($this->handle,1)) !== NULL)
			//{	
				//$temp = unpack("n",$result);
			//$this->inBuffer = $inMessage;
				//if($result !== chr(10))
				//{
					//$inMessage .= $result;
					//return $result;
				//}
				//else
				//{
					//$proceed = false;
				//}
			
			//}
			//else
			//{
				//$proceed = false;
			//	return false;
			//}
		//}while($proceed === true);
		
		//if($proceed === false)
		//{ return $inMessage; }
		//else
		//{ return false; }
		//echo "\nExiting\n";
	}

}
?>