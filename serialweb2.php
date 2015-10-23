<HTML>
<HEAD>
	<TITLE>SERIAL PORT ACCESS</TITLE>
</HEAD>

<BODY>

<?php

// Include the serial port class file;
require_once "portDriver.php";

// Create the device;
$fp = fopen("/dev/ttyS1", "rt");  

    #check COM pointer
    if(!$fp) {
        fwrite($stdout, "ERROR OPENING COM1 FOR READING.\n");
        return;
    }else {
        #process the string when received.
        fwrite($stdout, "...Waiting for response from remote host\n");
        fflush($stdout);
    
        #fgetc section
        $char = fgetc($fp);
        
        if($char == false) {
            fwrite($stdout, "**PROBLEM ENCOUNTERED WHILE LISTENING**\n");
            fwrite($stdout, "...Closing communication with remote host\n");
            fflush($stdout);
            fclose($fp);
            return;
        }

        fwrite($stdout, "-> ");
        fflush($stdout);

        do {
            if($char == '^')
            {
                fwrite($stdout, "[Termination Signal]\n");
                fflush($stdout);
                break;
            }
            
            fwrite($stdout, $char);
            fflush($stdout);

            if($char == chr(10))
            {

                fwrite($stdout, "-> ");
                fflush($stdout);
            }
        }while(false !== ($char = fgetc($fp)));

        fwrite($stdout, "...Closing communication with remote host\n");
        fflush($stdout);
        
        #close file handles
        fclose($fp);
    }

?>

</BODY>

</HTML>